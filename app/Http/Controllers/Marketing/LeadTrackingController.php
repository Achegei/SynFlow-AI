<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Services\LeadTrackingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class LeadTrackingController extends Controller
{
    public function __construct(
        protected LeadTrackingService $tracking
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'event' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[a-z0-9_]+$/',
                ],
                'metadata' => [
                    'nullable',
                    'array',
                ],
            ]);

            $this->tracking->track(
                $validated['event'],
                $validated['metadata'] ?? []
            );

        } catch (Throwable $e) {
            report($e);
        }

        /*
         * Tracking must NEVER block the learner journey.
         *
         * Even if tracking fails, the browser receives
         * a successful response and can continue normally.
         */
        return response()->json([
            'success' => true,
        ]);
    }
}