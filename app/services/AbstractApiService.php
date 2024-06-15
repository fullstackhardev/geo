<?php

namespace App\Services;

use App\Models\GeoLocationLog;
use Illuminate\Support\Facades\Http;

class AbstractApiService
{
    public function getIpGeoLocation($ipAddress = null)
    {
        $url = "https://ipgeolocation.abstractapi.com/v1";

        try {
            $response = Http::get($url, ['api_key' => config('services.abstract_api.key')]);
            $responseBody = $response->json();

            if ($response->successful()) {
                GeoLocationLog::create([
                    'ip_address' => $responseBody['ip_address'],
                    'country' => $responseBody['country'],
                    'region' => $responseBody['region'],
                    'city' => $responseBody['city'],
                    'latitude' => $responseBody['latitude'],
                    'longitude' => $responseBody['longitude'],
                ]);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
}
