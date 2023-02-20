@php 
$site_logo = get_general_setting('site_logo_web')?getImageURL(get_general_setting('site_logo_web')): asset('admin/image/default-logo.png');
@endphp
<a href="{{ URL::to('/') }}"><img src="{{$site_logo}}" class="img-fluid" style="width:200px;"></a>