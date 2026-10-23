<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CourseEnrollmentService
{
    public function create(
        User $student,
        string $registrationContext,
        ?Institution $institution = null
    ): CourseEnrollment {
        if (!in_array($registrationContext, ['institution', 'other'], true)) {
            throw new InvalidArgumentException(
                'Invalid enrollment registration context.'
            );
        }

        $courseId = (int) config('enrollment.course_id');

        $course = Course::findOrFail($courseId);

        if ($registrationContext === 'institution') {
            if (!$institution || $institution->status !== 'active') {
                throw new InvalidArgumentException(
                    'Institutional enrollment requires an active institution.'
                );
            }

            if (!$institution->sales_executive_id) {
                throw new InvalidArgumentException(
                    'Institution has no assigned sales executive.'
                );
            }
        } elseif ($institution !== null) {
            throw new InvalidArgumentException(
                'Independent enrollment cannot have an institution.'
            );
        }

        return DB::transaction(function () use (
            $student,
            $course,
            $registrationContext,
            $institution
        ) {
            // Serialize enrollment creation for the same student.
            // Lock the existing user row before checking enrollment existence.
            User::query()
                ->whereKey($student->id)
                ->lockForUpdate()
                ->firstOrFail();

            $existing = CourseEnrollment::query()
                ->where('user_id', $student->id)
                ->where('course_id', $course->id)
                ->first();

            if ($existing) {
                return $existing;
            }

            return CourseEnrollment::create([
                'user_id' => $student->id,
                'course_id' => $course->id,
                'registration_context' => $registrationContext,
                'institution_id' => $institution?->id,
                'sales_executive_id' =>
                    $registrationContext === 'institution'
                        ? $institution->sales_executive_id
                        : null,
                'status' => 'pending',
            ]);
        });
    }
}
