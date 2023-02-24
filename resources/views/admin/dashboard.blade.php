@extends('layouts.admin.app')
@section('title','Dashboard')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                Welcome {{Auth::user()->name}}, you are logged in!  
            </div>
            @if($ip_address)
            <div class="col-md-12">
                <span>IP: {{ $ip_address }}</span><br>
                <span>Country Name: {{ $countryName }}</span><br>
                <span>Region Name: {{ $regionName }}</span><br>
                <span>City Name: {{ $cityName }}</span><br>
                <span>Latitude: {{ $latitude }}</span><br>
                <span>Longitude: {{ $longitude }}</span>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
