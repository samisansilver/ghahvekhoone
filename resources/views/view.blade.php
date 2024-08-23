@extends('main.master')

@section('content')
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="card-title text-center">{{ $place->type == 1 ? 'سفره خانه ' : 'قهوه خانه ' }}{{ $place->name }}</h1>
                    </div>
                    @foreach($place->photos as $photo)
                        <img class="w-auto" src="/../{{ $photo->path }}" alt="Uploaded Photo" width="300">
                    @endforeach
                    <div class="card-body mb-5">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>کشور:</strong> {{ $place->country }}</li>
                            <li class="list-group-item"><strong>شهر:</strong> {{ $place->city }}</li>
                            <li class="list-group-item"><strong>آدرس:</strong> {{ $place->address }}</li>
                            <li class="list-group-item"><strong>تلفن:</strong> {{ $place->phone }}</li>
                            <li class="list-group-item"><strong>اینستاگرام:</strong> <a href="https://instagram.com/{{ $place->instagram }}">{{ $place->instagram }}</a></li>
                        </ul>
                        <div class="col-md-8">
                            <p class="card-text mt-5 mb-5">{{ $place->description }}</p>
                        </div>
                        <div class="container">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('showonmap')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- jQuery -->
    <!-- CSS for map container -->
    <style>
        #map {
            height: 300px;
            width: 100%;
        }
    </style>
    <!-- Include your custom styles for the map here -->

    <!-- Include Leaflet library -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- Your other scripts and configurations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Define your initial latitude and longitude values (example)
            var latitude = {{ $place->latitude }};
            var longitude = {{ $place->longitude }};

            // Initialize the map
            var map = L.map('map').setView([latitude, longitude], 13);

            // Add your custom tile layer (replace URL and attribution with your own)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a marker to the map at the specified location
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Your Location'); // Optional: Add a popup with a message
        });
    </script>
@endsection
