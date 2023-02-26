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
            <div class="col-md-4">
                <table class="table table-bordered">
                    <tr><td>IP</td><td>:</td><td>{{ $ip_address }}</td></tr>
                    <tr><td> Country Name </td><td>:</td><td>{{ $countryName }}</td></tr>
                    <tr><td> Region Name </td><td>:</td><td>{{ $regionName }}</td></tr>
                    <tr><td> City Name </td><td>:</td><td>{{ $cityName }}</td> </tr>
                    <tr><td> Latitude </td><td>:</td><td>{{ $latitude }}</td> </tr>
                    <tr><td> Longitude </td><td>:</td><td>{{ $longitude }}</td> </tr>
                </table>
            </div>
            @endif
            <div class="col-md-4">
                <div id="visitor-info"> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(window).on('load', function (){
            getVisitorInfo('All');
        });
        function getVisitorInfo(type){
            var url = "{{route('visitor.info', '')}}"+"/"+type;
            $.ajax({
                url: url,
                method: 'GET',
                beforeSend: function () {
                    $('#visitor-info').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                },
                success: function (data) {
                    $('#visitor-info').html(data.visitor_info);
                }
            });    
        }
    </script>
@endsection