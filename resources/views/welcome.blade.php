<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{getTitle()}} | Coming Soon ! </title>
        <meta property="og:title" content="" />
        <meta property="og:description" content="" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .child-content{
                margin: auto;
                text-align: center;
            }
            .child-content span{
                font-weight: 600;
            }
            ul li{
                list-style: none;
            }
            a{
                border: 1px solid #61b10a;
                color: #61b10a;
                padding: 5px 15px;
                border-radius: 35px;
                margin-right: 5px;
            }
            a:hover{
                text-decoration: none;
                -webkit-transition: all 0.4s ease;
                -moz-transition: all 0.4s ease;
                transition: all 0.4s ease;
                color: #fff;
                background: #27cec4;
                border-color: #27cec4;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @php 
                    $coming_soon_image = get_general_setting('coming_soon_image')?getImageURL(get_general_setting('coming_soon_image')): asset('admin/image/default-logo.png');
                @endphp
                <div class="text-center" style="margin-bottom:15px;display: inline-block;">
                    <img src="{{ $coming_soon_image }}" class="img-fluid" style="width: 250px;">
                    <h2>Coming Soon!</h2>
                    <p>Our website is currently undergoing scheduled maintenance.<br>We Should be back shortly. Thank you for your patience.</p> 
                </div>
                <div class="child-content">
                    @php 
                    $site_facebook = config('generals.site_facebook');
                    $site_instagram = config('generals.site_instagram');
                    @endphp
                    <ul>
                        <li>
                            <a target="_blank" href="{{$site_facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook </a> 
                            <a target="_blank" href="{{$site_instagram  }}"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
