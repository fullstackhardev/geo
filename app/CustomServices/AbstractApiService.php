<?php

namespace App\CustomServices;

use App\Models\GeoLocationLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AbstractApiService
{
    public function getIpGeoLocation($ipAddress)
    {
        $url = "https://ipgeolocation.abstractapi.com/v1";
        $params = [
            'api_key' => config('services.abstract_api.key'),
            'ip_address' => $ipAddress
        ];

        try {
            $response = Http::get($url, $params);

            if ($response->successful()) {
                $responseBody = $response->json();

                GeoLocationLog::create([
                    'ip_address' => $responseBody['ip_address'],
                    'country' => $responseBody['country'],
                    'region' => $responseBody['region'],
                    'city' => $responseBody['city'],
                    'latitude' => $responseBody['latitude'],
                    'longitude' => $responseBody['longitude'],
                ]);
            }

            if ($response->failed()) {
                Log::debug("IP Geo Location failed for $ipAddress", [
                    'response' => $response,
                    'status' => $response->status()
                ]);
            }

            return $responseBody;
        } catch (\Exception $e) {

            info("IP Geo location log for $ipAddress", [
                'response' => $response,
                'exception_message' => $e->getMessage()
            ]);

            return $e->getMessage();
        }
    }
}
