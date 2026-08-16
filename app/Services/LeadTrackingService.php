<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class LeadTrackingService
{
    /**
     * Record a meaningful lead activity.
     *
     * Tracking must NEVER interfere with the main application flow.
     */
    public function track(
            string $event,
            array $metadata = [],
            ?Request $request = null
        ): ?ActivityLog {
            try {
                $request ??= request();

                $eventKey = $this->eventKey(
                    $event,
                    $metadata,
                    $request
                );

                // Prevent accidental duplicate tracking events.
                $existing = ActivityLog::where('event_key', $eventKey)->first();

                if ($existing) {
                    return $existing;
                }

                return ActivityLog::create([
                    'visitor_id'   => $this->visitorId($request),
                    'user_id'      => auth()->id(),

                    'event'        => $event,
                    'route_name'   => $request->route()?->getName(),

                    'metadata'     => $metadata,

                    'utm_source'   => $this->utm($request, 'utm_source'),
                    'utm_medium'   => $this->utm($request, 'utm_medium'),
                    'utm_campaign' => $this->utm($request, 'utm_campaign'),
                    'utm_term'     => $this->utm($request, 'utm_term'),
                    'utm_content'  => $this->utm($request, 'utm_content'),

                    'referrer'     => $request->headers->get('referer'),
                    'landing_page' => $this->landingPage($request),

                    'ip_address'   => $request->ip(),
                    'user_agent'   => $request->userAgent(),

                    'event_key'    => $eventKey,
                ]);

            } catch (Throwable $e) {

                /*
                * Tracking is secondary functionality.
                *
                * If tracking fails, registration, enrollment,
                * payment, etc. must continue normally.
                */
                Log::warning('Lead tracking failed.', [
                    'event' => $event,
                    'error' => $e->getMessage(),
                ]);

                return null;
            }
        }
    /**
     * Get or create the anonymous visitor identifier.
     */
    protected function visitorId(Request $request): string
        {
            try {
                if ($request->hasSession()) {
                    $visitorId = $request->session()->get('lead_visitor_id');

                    if (!$visitorId) {
                        $visitorId = (string) \Illuminate\Support\Str::uuid();

                        $request->session()->put(
                            'lead_visitor_id',
                            $visitorId
                        );
                    }

                    return $visitorId;
                }
            } catch (Throwable $e) {
                Log::debug('Lead visitor session unavailable.', [
                    'error' => $e->getMessage(),
                ]);
            }

            /*
            * Fallback for requests without a session.
            *
            * Tracking must still never break the main request.
            */
            return (string) \Illuminate\Support\Str::uuid();
        }

    /**
     * Retrieve UTM information from the request/session.
     */
    protected function utm(
        Request $request,
        string $key
    ): ?string {
        $value = $request->query($key);

        if ($value !== null && $value !== '') {
            $request->session()->put(
                'lead_' . $key,
                $value
            );

            return $value;
        }

        return $request->session()->get(
            'lead_' . $key
        );
    }

    /**
     * Capture the first landing page.
     */
    protected function landingPage(Request $request): ?string
    {
        return $request->session()->get('lead_landing_page');
    }
    /**
     * Generate a deterministic key for useful duplicate protection.
     */
    protected function eventKey(
    string $event,
    array $metadata,
    Request $request
): string {
    $pageViewEvents = [
        'ai_assessment_viewed',
        'ai_assessment_step_viewed',
        'ai_learning_path_viewed',
        'ai_packages_viewed',
        'registration_viewed',
        'payment_page_viewed',
    ];

    if (in_array($event, $pageViewEvents, true)) {
        $pageUrl = $metadata['page_url']
            ?? $request->fullUrl();

        return hash(
            'sha256',
            implode('|', [
                $event,
                $request->session()->get('lead_visitor_id'),
                $pageUrl,
            ])
        );
    }

    // Keep the old behavior for events where
    // repeated occurrences may be legitimate.
    return hash(
        'sha256',
        implode('|', [
            $event,
            $request->session()->get('lead_visitor_id'),
            json_encode($metadata),
        ])
    );
}
}