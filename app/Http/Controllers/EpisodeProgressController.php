<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeProgressController extends Controller
{
    public function markWatched(Episode $episode, Request $request)
    {
        $user = $request->user();

        $user->episodes()->syncWithoutDetaching([
            $episode->id => ['watched' => true]
        ]);

        return response()->json(['status' => 'success']);
    }

    public function toggle(Episode $episode)
    {
        $user = auth()->user();

        // Check if record exists
        $watched = $user->episodes()
                        ->where('episode_id', $episode->id)
                        ->first();

        if ($watched && $watched->pivot->watched) {
            // Unmark as watched
            $user->episodes()->updateExistingPivot($episode->id, ['watched' => false]);
        } else {
            // Mark as watched
            $user->episodes()->syncWithoutDetaching([$episode->id => ['watched' => true]]);
        }

        return back();
    }
}
