<?php
// app/Services/GeocodingService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodingService
{
    public static function geocode($location)
    {
        if (!$location) {
            return null;
        }

        $response = Http::get('https://nominatim.openstreetmap.org/search', [
            'q' => $location,
            'format' => 'json',
            'limit' => 1,
        ]);

        if ($response->successful() && !empty($response[0])) {
            return [
                'lat' => $response[0]['lat'],
                'lng' => $response[0]['lon'],
            ];
        }

        return null;
    }
}
