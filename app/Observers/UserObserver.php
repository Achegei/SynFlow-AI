<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserObserver
{
    public function saving(User $user)
    {
        if ($user->isDirty('location') && $user->location) {
            $response = Http::get('https://nominatim.openstreetmap.org/search', [
                'q' => $user->location,
                'format' => 'json',
                'limit' => 1,
            ]);

            if ($response->successful() && isset($response[0])) {
                $user->latitude = $response[0]['lat'];
                $user->longitude = $response[0]['lon'];
            }
        }
    }
}
