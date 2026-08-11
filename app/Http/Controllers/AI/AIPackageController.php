<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AIPackageController extends Controller
{
    /**
     * Display available AI learning packages.
     */
    public function index(): View
    {
        $packages = Package::where('active', true)
            ->with('course')
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();

        return view('ai.packages.index', [
            'packages' => $packages,
        ]);
    }


    /**
     * Select an AI learning package.
     */
    public function select(Package $package): RedirectResponse
    {
        abort_unless($package->active, 404);


        /*
        |--------------------------------------------------------------------------
        | Package must belong to a course
        |--------------------------------------------------------------------------
        */

        if (!$package->course_id) {
            return redirect()
                ->route('ai.packages')
                ->with(
                    'error',
                    'This AI package is not connected to a course.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Save selected package
        |--------------------------------------------------------------------------
        */

        session()->put([
            'selected_ai_package_id' => $package->id,
            'selected_ai_course_id'   => $package->course_id,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Existing authenticated learner
        |--------------------------------------------------------------------------
        */

        if (Auth::check()) {

            return redirect()->route(
                'ai.payment.create',
                $package->id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | New learner
        |--------------------------------------------------------------------------
        */

        return redirect()->route('register');
    }
}