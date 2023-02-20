<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ url('admin/ckeditor/ckeditor.js') }}"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" >
    <!-- Styles -->
    <link href="{{ url('admin/css/filemanager.css')}}" rel="stylesheet" >
    <link href="{{ url('admin/css/custom.css') }}" rel="stylesheet">
    <link href="{{ url('admin/css/core.css') }}" rel="stylesheet">
    <link href="{{ url('admin/css/style.css') }}" rel="stylesheet" >
    <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet" />
</head>
<body>
    <div class="main-wrapper">
        @yield('content')
    </div>
    <script src="{{ url('admin/js/core.js') }}"></script>
    <script src="{{ url('admin/js/feather.min.js')}}"></script>
    <script src="{{ url('admin/js/template.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="{{url('admin/js/filemanager.js')}}"></script>

    @yield('script')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" integrity="sha512-hievggED+/IcfxhYRSr4Auo1jbiOczpqpLZwfTVL/6hFACdbI3WQ8S9NCX50gsM9QVE+zLk/8wb9TlgriFbX+Q==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            $('#toggle-event').change(function() {
                if($(this).prop('checked')){
                    var status = 1;
                }else{
                    var status = 0;
                }
                var token = "{{csrf_token()}}";
                var url = "{{route('site.status')}}";
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {status:status, _token: token},
                    success: function (data) {

                    }
                });
            })
        })
    </script>
</body>
</html>
