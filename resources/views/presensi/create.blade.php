@extends('layout.presensi')
{{-- link untuk map --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
     integrity="sha256-xwE1YAKPiAaF8A2p5WQPHF1v36M7xrj2jMgp3Uu3rPQ="
     crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
     integrity="sha256-vHs9GR+olNid/LtN68RMTuWAmFrdX2pbtwR9FO6F9io="
     crossorigin=""></script>

@section('header')
     <!-- App Header -->
     <div class="appHeader bg-primary text-light ">
        <div class="left">
            <a href="dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E - Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection

@section('content')
    <!-- App Capsule -->
    <div id="appCapsule automasi" style="margin-top: 4rem">
        <div class="row">
            <div class="col">
                <input type="hidden" name="lokasi" id="lokasi">
                <div class="webcam-capture"></div>
            </div>
        </div>
            <button class="btn btn-primary btn-block btn-masuk" type="submit">Masuk</button>
        <div class="row">
            <div class="col">
                <div id="map"></div>
            </div>
    </div>
    <!-- * App Capsule -->
@endsection

@push('MyScript')
<script>
    Webcam.set({
        height: 480,
        width: 640,
        image_format: 'jpeg',
        jpeg_quality: 80
    });
    Webcam.attach('.webcam-capture');
    
    var lokasi = document.getElementById('lokasi');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }

    function successCallback(position) {
        lokasi.value = position.coords.latitude + ", " + position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        var circle = L.circle([position.coords.latitude, position.coords.longitude], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    }

    function errorCallback(error) {
        console.error('Error getting location:', error);
        lokasi.value = "Unable to retrieve location";
    }
</script>
@endpush
