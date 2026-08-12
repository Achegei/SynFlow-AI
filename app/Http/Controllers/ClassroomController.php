<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Package;
use Illuminate\View\View;

class ClassroomController extends Controller
{
    /**
     * Current production AI course.
     *
     * Institution registration does NOT grant access.
     * It only determines that the learner came through
     * the institution/revenue-sharing pathway.
     *
     * The learner must still pay for Course 1.
     */

    private const CURRENT_COURSE_ID = 1;

    /**
     * Display the classroom course listing.
     *
     * Access pathways:
     *
     * 1. Institution pathway
     *    - User has institution_id
     *    - This makes Course 5 visible in Classroom
     *    - It does NOT grant access
     *
     * 2. Permanent course access
     *    - Stored in course_user
     *
     * 3. AI subscription access
     *    - Stored in learning_access
     *    - Must be active
     *
     * 4. Available AI package courses
     *    - Used so learners can see courses that have
     *      active AI packages available.
     */
    public function index(): View
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | 1. Courses the user permanently owns
        |--------------------------------------------------------------------------
        */

        $ownedCourseIds = $user->courses()
            ->pluck('courses.id');


        /*
        |--------------------------------------------------------------------------
        | 2. Courses with active AI learning access
        |--------------------------------------------------------------------------
        */

        $aiCourseIds = $user->learningAccess()
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->pluck('course_id');


        /*
        |--------------------------------------------------------------------------
        | 3. Courses available through active AI packages
        |--------------------------------------------------------------------------
        |
        | These are visible as available courses.
        |
        | Visibility does NOT equal access.
        |
        */

        $packageCourseIds = Package::where('active', true)
            ->whereNotNull('course_id')
            ->pluck('course_id');


        /*
        |--------------------------------------------------------------------------
        | 4. Institution pathway
        |--------------------------------------------------------------------------
        |
        | Institution registration is ONLY used for:
        |
        | - identifying the institution
        | - revenue sharing
        | - showing the learner the current course
        |
        | It does NOT grant access.
        |
        | For the current production setup, Course 1 is
        | the course learners see.
        |--------------------------------------------------------------------------
        */

        $institutionCourseIds = collect();

        if ($user->institution_id) {
            $institutionCourseIds = Package::where('active', true)
                ->whereNotNull('course_id')
                ->pluck('course_id');
        }


        /*
        |--------------------------------------------------------------------------
        | 5. Combine all visible courses
        |--------------------------------------------------------------------------
        */

        $courseIds = $ownedCourseIds
            ->merge($aiCourseIds)
            ->merge($packageCourseIds)
            ->merge($institutionCourseIds)
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | 6. Load courses
        |--------------------------------------------------------------------------
        */

        $courses = Course::with([
            'modules.episodes'
        ])
            ->whereIn('id', $courseIds)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | 7. Calculate course state
        |--------------------------------------------------------------------------
        */

        foreach ($courses as $course) {

            /*
            |--------------------------------------------------------------------------
            | Progress
            |--------------------------------------------------------------------------
            */

            $totalEpisodes = $course->modules
                ->flatMap->episodes
                ->count();

            $course->progress_percentage = 0;


            /*
            |--------------------------------------------------------------------------
            | Permanent / institution course access
            |--------------------------------------------------------------------------
            */

            $course->has_institution_access = $user->courses()
                ->where('courses.id', $course->id)
                ->exists();


            /*
            |--------------------------------------------------------------------------
            | Active AI subscription access
            |--------------------------------------------------------------------------
            */

            $course->has_ai_access = $user->hasActiveLearningAccess(
                $course->id
            );


            /*
            |--------------------------------------------------------------------------
            | AI subscription history
            |--------------------------------------------------------------------------
            */

            $course->has_ai_history = $user->learningAccess()
                ->where('course_id', $course->id)
                ->exists();


            /*
            |--------------------------------------------------------------------------
            | Institution pathway
            |--------------------------------------------------------------------------
            |
            | This means the user registered through an institution.
            |
            | It does NOT mean the course has been paid for.
            |
            */

            $course->is_institution_pathway =
                !is_null($user->institution_id);


            /*
            |--------------------------------------------------------------------------
            | Overall access
            |--------------------------------------------------------------------------
            */

            $course->has_access =
                $course->has_institution_access ||
                $course->has_ai_access;
        }


        return view(
            'classroom.index',
            compact('courses')
        );
    }


    /**
     * Display a single course.
     */
    public function show($id)
    {
        $user = auth()->user();


        if (!$user) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in to access this course.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Load course
        |--------------------------------------------------------------------------
        */

        $course = Course::with([
            'modules.episodes',
            'modules.quizzes.questions',
            'modules.assignments'
        ])->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Determine AI subscription access
        |--------------------------------------------------------------------------
        */

        $learningAccess = $user->activeLearningAccess(
            $course->id
        );


        /*
        |--------------------------------------------------------------------------
        | ACTIVE AI ACCESS
        |--------------------------------------------------------------------------
        */

        if ($learningAccess) {

            $accessPath = 'ai';

        } else {

            /*
            |--------------------------------------------------------------------------
            | PERMANENT COURSE ACCESS
            |--------------------------------------------------------------------------
            |
            | This includes:
            |
            | - Institution-referred learner who has paid
            | - Normal course purchaser
            |
            */

            $hasCourseAccess = $user->courses()
                ->where('courses.id', $course->id)
                ->exists();


            if ($hasCourseAccess) {

                $accessPath = 'institution';

            } else {

                /*
                |--------------------------------------------------------------------------
                | EXPIRED AI ACCESS
                |--------------------------------------------------------------------------
                |
                | If the learner previously had AI access but it expired,
                | send them to the package selection page.
                |--------------------------------------------------------------------------
                */

                $expiredAiAccess = $user->learningAccess()
                    ->where('course_id', $course->id)
                    ->whereNotNull('expires_at')
                    ->where('expires_at', '<=', now())
                    ->exists();


                if ($expiredAiAccess) {

                    return redirect()
                        ->route('ai.packages')
                        ->with(
                            'error',
                            'Your AI learning package has expired. Please choose a new package to continue learning.'
                        );
                }


                /*
                |--------------------------------------------------------------------------
                | NO ACCESS YET
                |--------------------------------------------------------------------------
                |
                | IMPORTANT:
                |
                | We DO NOT redirect to purchase.course here.
                |
                | We allow the course-details Blade to display
                | the paywall.
                |
                | This is what allows an institution learner to:
                |
                | 1. See Course 5
                | 2. Open Course 5
                | 3. See the KES 10,000 paywall
                | 4. Pay
                | 5. Return with permanent access
                |
                */

                $accessPath =
                    $user->institution_id
                        ? 'institution_pending_payment'
                        : 'none';
            }
        }


        /*
        |--------------------------------------------------------------------------
        | COURSE CONTENT
        |--------------------------------------------------------------------------
        */

        $episodes = $course->modules
            ->flatMap
            ->episodes;


        $totalEpisodes = $episodes->count();


        $completedEpisodes = $episodes
            ->filter(
                fn ($episode) =>
                    $episode->is_completed
            )
            ->count();


        $course->progress_percentage =
            $totalEpisodes > 0
                ? ($completedEpisodes / $totalEpisodes) * 100
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Return classroom
        |--------------------------------------------------------------------------
        */

        return view(
            'classroom.course-details',
            compact(
                'course',
                'episodes',
                'accessPath',
                'learningAccess'
            )
        );
    }
}