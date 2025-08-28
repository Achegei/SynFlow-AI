@extends('layouts.app')
@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        #map {
            height: 70vh; /* Set a specific height for the map container */
            width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            /* Ensure the map is always centered and well-spaced */
            margin-top: 2rem;
        }
    </style>
</head>
<body class="p-4 md:p-8">
    <div class="max-w-7xl mx-auto space-y-8">
        <header class="text-center space-y-2">
            <h1 class="text-4xl font-bold text-gray-900">Community Map</h1>
            <p class="text-gray-600">Click anywhere on the map to mark your location and see others who have joined!</p>
            <!-- Display user ID after authentication -->
            <p id="userIdDisplay" class="text-sm font-semibold text-gray-500"></p>
        </header>

        <main>
            <div id="map"></div>
        </main>
    </div>

    <!-- Leaflet.js JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Firebase JS -->
    <script type="module">
        // Import Firebase modules
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInWithCustomToken, signInAnonymously } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, doc, onSnapshot, collection, addDoc } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // Global variables provided by the Canvas environment
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        // Leaflet.js marker icon for purple color
        const purpleIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        // Map and markers
        let map;
        const markers = {};
        let db, auth;
        let userId = 'anonymous';

        // Function to initialize Firebase and authenticate
        const initializeFirebase = async () => {
            if (Object.keys(firebaseConfig).length === 0) {
                console.error("Firebase config is not available. Check your environment.");
                document.getElementById('map').innerHTML = "<div class='text-center p-8 text-red-500'>Firebase is not configured. Please check the environment setup.</div>";
                return false;
            }

            const app = initializeApp(firebaseConfig);
            auth = getAuth(app);
            db = getFirestore(app);

            try {
                if (initialAuthToken) {
                    await signInWithCustomToken(auth, initialAuthToken);
                } else {
                    await signInAnonymously(auth);
                }
                userId = auth.currentUser?.uid || 'anonymous';
                document.getElementById('userIdDisplay').innerText = `Your User ID: ${userId}`;
                return true;
            } catch (error) {
                console.error("Error during Firebase authentication:", error);
                document.getElementById('map').innerHTML = "<div class='text-center p-8 text-red-500'>Authentication failed. Please check the console for details.</div>";
                return false;
            }
        };

        // Function to initialize the map
        const initializeMap = () => {
            map = L.map('map').setView([20, 0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add an event listener to the map to add a marker on click
            map.on('click', onMapClick);
        };

        // Function to handle map click and add a user's location
        const onMapClick = async (e) => {
            if (!db) {
                console.error("Database not initialized.");
                return;
            }

            const userLocation = {
                latitude: e.latlng.lat,
                longitude: e.latlng.lng,
                userId: userId,
                timestamp: new Date()
            };

            try {
                // Add a new document to the 'locations' collection in the public artifact path
                await addDoc(collection(db, `/artifacts/${appId}/public/data/locations`), userLocation);
                console.log("Location added successfully.");
            } catch (error) {
                console.error("Error adding document:", error);
            }
        };

        // Function to listen for real-time updates and add markers
        const setupRealtimeMarkers = () => {
            if (!db) {
                console.error("Database not initialized.");
                return;
            }
            const collectionRef = collection(db, `/artifacts/${appId}/public/data/locations`);

            // Listen for real-time updates to the locations collection
            onSnapshot(collectionRef, (snapshot) => {
                snapshot.docChanges().forEach((change) => {
                    const data = change.doc.data();
                    const docId = change.doc.id;
                    const latlng = [data.latitude, data.longitude];

                    if (change.type === "added") {
                        if (!markers[docId]) {
                            const marker = L.marker(latlng, { icon: purpleIcon }).addTo(map);
                            marker.bindPopup(`User: ${data.userId || 'Anonymous'}`);
                            markers[docId] = marker;
                        }
                    } else if (change.type === "removed") {
                        if (markers[docId]) {
                            map.removeLayer(markers[docId]);
                            delete markers[docId];
                        }
                    }
                });
            }, (error) => {
                console.error("Error fetching real-time data:", error);
                document.getElementById('map').innerHTML = "<div class='text-center p-8 text-red-500'>Error fetching data. Please check the console.</div>";
            });
        };

        window.onload = async () => {
            // First, initialize the map
            initializeMap();
            // Then, initialize Firebase and set up real-time listeners
            const isFirebaseReady = await initializeFirebase();
            if (isFirebaseReady) {
                setupRealtimeMarkers();
            }
        };
    </script>
@endsection