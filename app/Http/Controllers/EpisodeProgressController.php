<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeProgressController extends Controller
{
    /**
     * Mark episode as watched (AJAX + YouTube auto-end)
     */
    public function markWatched(Episode $episode, Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        // Mark episode as watched
        $user->episodes()->syncWithoutDetaching([
            $episode->id => ['watched' => true]
        ]);

        // Check module completion if episode belongs to module
        if ($episode->module_id) {

            $module = $episode->module;

            if ($module && $module->isCompletedBy($user)) {

                $user->modules()->syncWithoutDetaching([
                    $module->id => [
                        'completed' => true,
                        'completed_at' => now()
                    ]
                ]);
            }
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Toggle watched status manually (button click)
     */
    public function toggle(Episode $episode)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->back();
        }

        // Check existing pivot record
        $watched = $user->episodes()
            ->where('episode_id', $episode->id)
            ->first();

        if ($watched && $watched->pivot->watched) {

            // Unmark as watched
            $user->episodes()->updateExistingPivot(
                $episode->id,
                ['watched' => false]
            );

        } else {

            // Mark as watched
            $user->episodes()->syncWithoutDetaching([
                $episode->id => ['watched' => true]
            ]);
        }

        // OPTIONAL: re-check module completion after toggle
        if ($episode->module_id) {

            $module = $episode->module;

            if ($module && $module->isCompletedBy($user)) {

                $user->modules()->syncWithoutDetaching([
                    $module->id => [
                        'completed' => true,
                        'completed_at' => now()
                    ]
                ]);

            } else {

                // If user unmarks a lesson → module should also uncomplete
                $user->modules()->updateExistingPivot(
                    $module->id,
                    ['completed' => false, 'completed_at' => null]
                );
            }
        }

        return back();
    }
}