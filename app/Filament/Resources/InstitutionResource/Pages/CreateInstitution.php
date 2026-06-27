<?php

namespace App\Filament\Resources\InstitutionResource\Pages;

use App\Filament\Resources\InstitutionResource;
use App\Models\Institution;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateInstitution extends CreateRecord
{
    protected static string $resource = InstitutionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Capture admin details
        $adminName = $data['admin_name'];
        $adminEmail = $data['admin_email'];
        $adminPassword = $data['admin_password'];

        // Remove fields that don't exist in institutions table
        unset(
            $data['admin_name'],
            $data['admin_email'],
            $data['admin_password']
        );

        // Create Institution first
        $institution = Institution::create($data);

        // Create Institution Admin
        $admin = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'username' => Str::slug($adminName) . rand(100,999),
            'password' => Hash::make($adminPassword),
            'role' => 'institution_admin',
            'institution_id' => $institution->id,
            'must_change_password' => 1,
        ]);

        // Link admin back to institution
        $institution->institution_admin_id = $admin->id;
        $institution->save();

        return $institution;
    }
}