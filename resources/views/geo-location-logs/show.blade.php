@extends('layout')

<div class="container mx-auto px-4 py-8">

    <h2 class="text-2xl font-bold mb-4 text-center mt-8">
        <a class="underline mx-4" href="{{ route('welcome') }}">↩</a>
        You are here on earth 🌍
    </h2>

    <div class="flex items-center justify-center ">
        <div class="w-full max-w-md p-4 rounded-lg shadow-md">
            @if (Arr::has($geoInfo, 'longitude') && Arr::has($geoInfo, 'latitude'))
                <ul class="list-disc space-y-2">
                    <li>Country: <span class="font-bold">{{ Arr::get($geoInfo, 'country') }}</span></li>
                    <li>City: <span class="font-bold">{{ Arr::get($geoInfo, 'city') }}</span></li>
                    <li>Region: <span class="font-bold">{{ Arr::get($geoInfo, 'region') }}</span></li>
                    <li>Latitude: <span class="font-bold">{{ Arr::get($geoInfo, 'latitude') }}</span></li>
                    <li>Longitude: <span class="font-bold">{{ Arr::get($geoInfo, 'longitude') }}</span></li>
                </ul>
            @else
                <p>Sorry! we could not find you from your ip.</p>
            @endif
        </div>
    </div>
    <div id="map" style="height: 400px"></div>

    <div class="flex items-center justify-center ">
        <div class="w-full max-w-md p-4 rounded-lg shadow-md py-4">
            <form action="{{ route('geo-location-log.create') }}" method="get">
                <input type="text" name="custom_ip" placeholder="Enter custom ip address"
                    style="width: 100%; padding: 10px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px;">
                <button type="submit"
                    style="background-color: #4CAF50; color: white; float:right; padding: 10px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                    🔍 Find</button>
            </form>
        </div>
    </div>
    {{-- {{ $geoInfo['country'] }} --}}
</div>

@section('scripts')
    <script>
        const latitude = {{ Arr::get($geoInfo, 'latitude') }};
        const longitude = {{ Arr::get($geoInfo, 'longitude') }};

        var map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('<b>Hello 👋!</b><br />You are here.').openPopup();
    </script>
@endsection
