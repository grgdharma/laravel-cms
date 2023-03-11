@extends('layouts.admin.app')
@section('title','Dashboard')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 mb_30">
                Welcome {{Auth::user()->name}}, you are logged in!  
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 ">
                <div class="white_card mb_30 social_media_card">
                    <div class="white_card_header">
                        <div class="main-title">
                            <h3 class="m-0">Catelog</h3>
                            <span>System pages, posts and categories</span>
                        </div>
                    </div>
                    <div class="media_thumb ml_25">
                        <img src="{{ asset('admin/image/media.svg'); }}">
                    </div>
                    <div class="media_card_body">
                        <div class="media_card_list">
                            <div class="single_media_card">
                                <span>Posts</span>
                                <h3>{{ $total_posts }}</h3>
                            </div>
                            <div class="single_media_card">
                                <span>Comments</span>
                                <h3>{{ $total_comments }}</h3>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 ">
                <div class="white_card mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Visitors by Browser</h3>
                                <span>{{ $total_visitor }} Visitors</span>
                            </div>
                        </div>
                    </div>
                    <div id="visitor-info"></div>
                </div>
            </div>
            <div class="col-xl-4 ">
                <div class="white_card card_height_100 mb_30">
                    {{-- <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Visitors by Browser</h3>
                                <span> Visitors</span>
                            </div>
                        </div>
                    </div> --}}
                    <div>
                        <canvas id="myChart" style="width:100%;"></canvas>
                        <canvas id="myChart_1" style="width:100%;"></canvas>
                        <canvas id="myPieChart" style="width:100%;max-width:600px"></canvas>
                    </div>
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
            var url = "{{route('system.visitor.info', '')}}"+"/"+type;
            $.ajax({
                url: url,
                method: 'GET',
                beforeSend: function () {
                    $('#visitor-info').html('<div class="loader"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>'); 
                },
                success: function (data) {
                    $('#visitor-info').html(data.visitor_info);
                }
            });    
        }
    </script>
    <script>
        var xValues = ['SUN','MON','TUE','WED','THU',"FRI",'SAT'];
        var yValues = @json($daily_count);

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 0, max:10}}],
                },
                title: {
                    display: true,
                    text: "Daily Site visitors"
                }
            }
        });
    </script>
    <script>
        var xValues_1 = ['SUN','MON','TUE','WED','THU',"FRI",'SAT'];

        new Chart("myChart_1", {
            type: "line",
            data: {
                labels: xValues_1,
                datasets: [{ 
                    data: @json($daily_count),
                    borderColor: "green",
                    fill: false
                }, { 
                    data: [5,3,3,1,6,2,5],
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: "Monthly Site visitors"
                }
            }
        });
    </script>
    <script>
        var xValues_pie = ["Italy", "France", "Spain", "USA"];
        var yValues_pie = [55, 49, 44, 24];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9"
        ];

        new Chart("myPieChart", {
            type: "pie",
            data: {
                labels: xValues_pie,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues_pie
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Site visitors by country"
                }
            }
        });
    </script>

@endsection