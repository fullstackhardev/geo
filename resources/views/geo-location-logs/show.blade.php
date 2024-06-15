@extends('layout')

<div class="container mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-4 text-center mt-8">
        <a class="underline mx-4" href="{{ route('welcome') }}">↩</a>
        You are here on earth 🌍
    </h2>

    <div class="flex items-center justify-center ">
        <div class="w-full max-w-md p-4 rounded-lg shadow-md">
            <ul class="list-disc space-y-2">
                <li>Country: <span class="font-bold">{{ $geoInfo['country'] }}</span></li>
                <li>City: <span class="font-bold">{{ $geoInfo['city'] }}</span></li>
                <li>Region: <span class="font-bold">{{ $geoInfo['region'] }}</span></li>
                <li>Latitude: <span class="font-bold">{{ $geoInfo['latitude'] }}</span></li>
                <li>Longitude: <span class="font-bold">{{ $geoInfo['longitude'] }}</span></li>
            </ul>
        </div>
    </div>
    {{-- {{ $geoInfo['country'] }} --}}
</div>
