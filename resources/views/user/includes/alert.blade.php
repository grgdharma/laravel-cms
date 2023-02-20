@if(Session::has('success'))
<span class="text-success"><i class="fa fa-info-circle" aria-hidden="true"></i>{{ Session::get('success') }}</span>
@endif
@if(Session::has('error'))
<span class="text-danger"> <i class="fa fa-info-circle" aria-hidden="true"></i>{{ Session::get('error') }}</span>
@endif
@if(Session::has('warning'))
<span class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i>{{ Session::get('warning') }}</span>
@endif