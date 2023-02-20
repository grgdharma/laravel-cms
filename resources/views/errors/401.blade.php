@extends('layouts.admin.app')
@section('title','Unauthorized | Permission denied')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
		<div class="card">
			<div class="card-header">401 | Unauthorized</div>
			<div class="card-body">
				<div>
					<strong>Route URL: </strong>{{Route::getFacadeRoot()->current()->uri()}}
					<br><br>
				</div>
        		<div class="title">Sorry, Permission denied, the page you are looking for. </div>
        	</div>
		</div>
    </div>
</div>
@endsection