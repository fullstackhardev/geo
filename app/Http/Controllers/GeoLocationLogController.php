<?php

namespace App\Http\Controllers;

use App\Models\GeoLocationLog;
use App\CustomServices\AbstractApiService;
use Illuminate\Http\Request;

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
        $geoLocationService = new AbstractApiService();

        $geoInfo = $geoLocationService->getIpGeoLocation($request->ip());

        return view('geo-location-logs.show', [
            'geoInfo' => $geoInfo
        ]);
    }
}
