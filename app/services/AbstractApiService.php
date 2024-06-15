<?php

namespace App\Services;

use App\Models\GeoLocationLog;
use Illuminate\Support\Facades\Http;

class AbstractApiService
{
    public function getIpGeoLocation()
    {
        $url = "https://ipgeolocation.abstractapi.com/v1";
        $params = [
            'api_key' => config('services.abstract_api.key'),
        ];


        try {
            $response = Http::get($url, $params);
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

            return $responseBody;
        } catch (\Exception $e) {

            info("IP Geo location log for " . $response['ip_address'], [
                'response' => $response,
                'exception-message' => $e->getMessage()
            ]);

            return $e->getMessage();
        }
    }
}
