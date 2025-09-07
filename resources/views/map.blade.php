@extends('layouts.app')

@section('title', 'Community Map - SynFlow AI')

@section('content')
    <style>
        #map {
            height: 70vh;
            width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1),
                        0 2px 4px -2px rgb(0 0 0 / 0.1);
            margin-top: 2rem;
        }
    </style>

    <div class="max-w-7xl mx-auto space-y-8 py-8">
        <header class="text-center space-y-2">
            <h1 class="text-4xl font-bold text-gray-900">Community Map</h1>
            <p class="text-gray-600">See where members of SynFlow AI are joining from 🌍</p>
        </header>

        <main>
            <div id="map"></div>
        </main>
    </div>
@endsection

{{-- Pass users data from Laravel to JS --}}
@isset($users)
    <script>
        const users = @json($users);
    </script>
@else
    <script>
        const users = [];
    </script>
@endisset

<!-- Leaflet CSS/JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- MarkerCluster plugin -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Initialize map
        //const map = L.map('map').setView([-1.286389, 36.817223], 6); // Center on Kenya by default
        const map = L.map('map').setView([20, 0], 2); // Full world view


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Red marker
        const redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Create a cluster group
        const markers = L.markerClusterGroup({
                iconCreateFunction: function (cluster) {
                    return L.divIcon({
                        html: `<div style="
                                    background: #e3342f;
                                    color: white;
                                    border-radius: 50%;
                                    padding: 10px;
                                    font-size: 14px;
                                    font-weight: bold;
                                    text-align: center;
                                    line-height: 30px;
                                    width: 40px;
                                    height: 40px;
                                    ">
                                    ${cluster.getChildCount()}
                            </div>`,
                        className: 'custom-cluster-icon',
                        iconSize: [40, 40]
                    });
                }
            });
        // Add markers
        users.forEach(user => {
            if (user.latitude && user.longitude) {
                const marker = L.marker([user.latitude, user.longitude], { icon: redIcon })
                    .bindPopup(`<strong>${user.name}</strong><br>${user.location ?? ''}`);
                markers.addLayer(marker);
            }
        });

        // Add clusters to map
        map.addLayer(markers);

    });
</script>
