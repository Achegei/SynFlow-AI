<?php

namespace App\Filament\Resources\InstitutionResource\Pages;

use App\Filament\Resources\InstitutionResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EditInstitution extends EditRecord
{
    protected static string $resource = InstitutionResource::class;

    protected function afterSave(): void
    {
        $institution = $this->record;

        $admin = $institution->admin;

        if (!$admin) {
            return;
        }

        $data = $this->form->getState();

        /*
        |--------------------------------------------------------------------------
        | Update admin safely
        |--------------------------------------------------------------------------
        */

        $email = $data['admin_email'] ?? $admin->email;

        if ($admin->email !== $email) {

            $exists = User::where('email', $email)
                ->where('id', '!=', $admin->id)
                ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'admin_email' => 'This email is already taken.',
                ]);
            }

            $admin->email = $email;
        }

        $admin->name = $data['admin_name'] ?? $admin->name;

        /*
        |--------------------------------------------------------------------------
        | Password update
        |--------------------------------------------------------------------------
        */

        if (!empty($data['admin_password'])) {
            $admin->password = Hash::make($data['admin_password']);
            $admin->must_change_password = 1;
        }

        $admin->save();
    }
}