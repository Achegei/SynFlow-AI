<?php

namespace App\Filament\Resources\SalesExecutiveResource\Pages;

use App\Filament\Resources\SalesExecutiveResource;
use App\Models\SalesExecutive;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateSalesExecutive extends CreateRecord
{
    protected static string $resource = SalesExecutiveResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $mode = $this->form->getRawState()['account_mode'] ?? 'new';

        if (!in_array($mode, ['new', 'existing'], true)) {
            throw ValidationException::withMessages([
                'data.account_mode' => 'Select a valid account setup method.',
            ]);
        }

        return DB::transaction(function () use ($data, $mode): Model {
            if ($mode === 'new') {
                $name = trim((string) ($data['new_user_name'] ?? ''));
                $email = Str::lower(trim((string) ($data['new_user_email'] ?? '')));
                $password = (string) ($data['new_user_password'] ?? '');

                if ($name === '' || $email === '' || $password === '') {
                    throw ValidationException::withMessages([
                        'data.new_user_name' => 'Complete the new user account details.',
                    ]);
                }

                if (User::query()->where('email', $email)->exists()) {
                    throw ValidationException::withMessages([
                        'data.new_user_email' => 'This email address is already registered.',
                    ]);
                }

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'username' => Str::slug($name) . '-' . Str::lower(Str::random(12)),
                    'password' => $password,
                    'role' => 'sales_executive',
                    'is_admin' => false,
                    'institution_id' => null,
                    'must_change_password' => true,
                    'initial_password_reset_required' => false,
                ]);
            } else {
                $userId = $data['user_id'] ?? null;

                $user = User::query()
                    ->whereKey($userId)
                    ->lockForUpdate()
                    ->first();

                if (
                    !$user
                    || (bool) $user->is_admin
                    || $user->institution_id !== null
                    || in_array($user->role, ['admin', 'institution_admin'], true)
                ) {
                    throw ValidationException::withMessages([
                        'data.user_id' => 'Select an eligible existing user.',
                    ]);
                }

                if (
                    SalesExecutive::query()
                        ->where('user_id', $user->id)
                        ->exists()
                ) {
                    throw ValidationException::withMessages([
                        'data.user_id' => 'This user is already linked to a Sales Executive.',
                    ]);
                }

                $user->role = 'sales_executive';
                $user->save();
            }

            return SalesExecutive::create([
                'user_id' => $user->id,
                'wallet_balance' => 0,
                'status' => $data['status'] ?? 'active',
            ]);
        });
    }
}
