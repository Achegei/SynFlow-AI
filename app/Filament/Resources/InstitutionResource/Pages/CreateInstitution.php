<?php

namespace App\Filament\Resources\InstitutionResource\Pages;

use App\Filament\Resources\InstitutionResource;
use App\Models\Institution;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateInstitution extends CreateRecord
{
    protected static string $resource = InstitutionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data): Model {
            $adminName = $data['admin_name'];
            $adminEmail = $data['admin_email'];
            $adminPassword = $data['admin_password'];

            unset(
                $data['admin_name'],
                $data['admin_email'],
                $data['admin_password']
            );

            // Referral codes are optional.
            $data['referral_code'] = filled($data['referral_code'] ?? null)
                ? trim($data['referral_code'])
                : null;

            $institution = Institution::create($data);

            $admin = User::create([
                'name' => $adminName,
                'email' => $adminEmail,
                'username' => Str::slug($adminName) . '-' . Str::lower(Str::random(8)),
                'password' => Hash::make($adminPassword),
                'role' => 'institution_admin',
                'institution_id' => $institution->id,
                'must_change_password' => true,
            ]);

            $institution->institution_admin_id = $admin->id;
            $institution->save();

            return $institution;
        });
    }
}
