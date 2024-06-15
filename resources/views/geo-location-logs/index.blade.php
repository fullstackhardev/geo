@extends('layout')

<div class="container mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-4 text-center mt-8">
        <a class="underline mx-4" href="{{ route('welcome') }}">↩</a>
        Geo Location Logs
    </h2>

    <div class="overflow-auto rounded-md shadow" style="height: 90vh">

        <table class="w-full table-auto mx-auto border-t border-gray-200 dark:border-gray-700  bg-gray-800 text-white">
            <thead>
                <tr class="text-left border-b text-gray-600 dark:text-gray-400  border-gray-200">
                    <th class="py-4 px-6">#</th>
                    <th class="py-4 px-6">IP Address</th>
                    <th class="py-4 px-6">Country</th>
                    <th class="py-4 px-6">Region</th>
                    <th class="py-4 px-6">City</th>
                    <th class="py-4 px-6">Latitude</th>
                    <th class="py-4 px-6">Longitude</th>
                    <th class="py-4 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($geoLocationLogs as $geoLocationLog)
                    <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="py-4 px-6">{{ $loop->iteration }}</td>
                        <td class="py-4 px-6">{{ $geoLocationLog->ip_address }}</td>
                        <td class="py-4 px-6">{{ $geoLocationLog->country }}</td>
                        <td class="py-4 px-6">{{ $geoLocationLog->region }}</td>
                        <td class="py-4 px-6">{{ $geoLocationLog->city }}</td>
                        <td class="py-4 px-6">{{ $geoLocationLog->latitude }}</td>
                        <td class="py-4 px-6">{{ $geoLocationLog->longitude }}</td>
                        <td class="py-4 px-6">
                            <a href="{{ route('geo-location-log.show', $geoLocationLog) }}" title="View">👀</a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center py-4">
                        <td colspan="6">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
