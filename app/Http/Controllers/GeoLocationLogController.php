<?php

namespace App\Http\Controllers;

use App\Models\GeoLocationLog;
use App\CustomServices\AbstractApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GeoLocationLogController extends Controller
{
    public function index(Request $request)
    {
        $geoLocationLogs = GeoLocationLog::all();

        return view('geo-location-logs.index', [
            'geoLocationLogs' => $geoLocationLogs
        ]);
    }

    public function create(Request $request)
    {
        $ip = $request->get('custom_ip');

        if ($request->has('custom_ip') && !$request->get('custom_ip')) {
            return 'kindly specify custom ip address';
        }

        if (!$ip) {
            $ip = $request->ip();
        }

        $cacheKey = "GEO_LOCATION_CACHE_KEY $ip";
        $geoInfo = [];

        if (Cache::has($cacheKey)) {
            $geoInfo = Cache::get($cacheKey);
        } else {
            $geoLocationService = new AbstractApiService();
            $geoInfo = $geoLocationService->getIpGeoLocation($ip);

            Cache::put($cacheKey, $geoInfo);
        }

        return view('geo-location-logs.show', [
            'geoInfo' => $geoInfo
        ]);
    }

    public function show(Request $request, GeoLocationLog $geoLocationLog)
    {
        return view('geo-location-logs.show', [
            'geoInfo' => $geoLocationLog
        ]);
    }
}
