<?php

namespace App\Filament\Resources\InstitutionResource\Pages;

use App\Filament\Resources\InstitutionResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateInstitution extends CreateRecord
{
    protected static string $resource = InstitutionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Extract admin fields safely
        $data['admin_name'] = $data['admin_name'] ?? null;
        $data['admin_email'] = $data['admin_email'] ?? null;
        $data['admin_password'] = $data['admin_password'] ?? null;

        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState(); // ✅ THIS is the reliable source

        $name = $data['admin_name'] ?? null;
        $email = $data['admin_email'] ?? null;
        $password = $data['admin_password'] ?? null;

        // 🚨 HARD CHECK
        if (!$name || !$email) {
            logger()->error('ADMIN DATA MISSING', $data);
            return;
        }

        // default password if empty
        $password = $password ?: Str::random(10);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'username' => Str::slug($name) . rand(100, 999),
            'password' => Hash::make($password),

            'role' => 'institution_admin',
            'institution_id' => $this->record->id,
            'must_change_password' => 1,
        ]);

        $this->record->update([
            'institution_admin_id' => $user->id,
        ]);
    }
}