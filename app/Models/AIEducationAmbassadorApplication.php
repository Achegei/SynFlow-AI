<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIEducationAmbassadorApplication extends Model
{
    protected $table = 'ai_education_ambassador_applications';
    protected $fillable = [
        'application_reference',
        'full_name',
        'email',
        'phone_whatsapp',
        'employed_by_educational_institution',
        'institution_type',
        'institution_name',
        'city',
        'county',
        'current_position',
        'tenure',
        'leadership_access',
        'leadership_types',
        'decision_maker_details',
        'introduction_plan',
        'status',
        'admin_notes',
        'reviewed_at',
    ];

    protected $casts = [
        'employed_by_educational_institution' => 'boolean',
        'leadership_types' => 'array',
        'reviewed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::created(function (self $application): void {
            $application->updateQuietly([
                'application_reference' =>
                    'AEA-' . now()->format('Y') . '-' . str_pad((string) $application->id, 4, '0', STR_PAD_LEFT),
            ]);
        });
    }
}
