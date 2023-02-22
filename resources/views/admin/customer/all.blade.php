@extends('layouts.admin.app')
@section('title','System | Customer')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">

		<div class="card">
   			<div class="card-header">
                <a href="javascript:void(0);" class="header-tab active" > Users </a>
                @include('admin.includes.alert')
            </div>
            <div class="card-body">
               
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Verification code</th>
                                <th>Status</th>
                                <th>Register Date</th>
                                <th>Provider</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($customer) > 0)
                                @foreach($customer as $value)
                                <tr>
                                    <td>{{$page++}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->mobile}}</td>
                                    <td>{{$value->verification_code}}</td>
                                    <td>
                                    	@if($value->email_verified_at == NULL)
                                    		<span style="color: red">Not Verified</span>
                                    	@else 
                                    		<span style="color: green">Verified</span>
                                    	@endif
                                    </td>
                                    <td>
                                    	{{date('M j, Y h:i A', strtotime($value->created_at))}}
                                    </td>
                                    <td>{{$value->provider}}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="custom-btn delete" onclick="return checkDelete({{$value->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <form id="delete-{{$value->id}}" action="{{route('admin.dashboard.user.delete',$value->id)}}" method="POST" style="display:none">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else 
                            <tr><td colspan="9">Not found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 15px;">
                    <span>Showing {{$starting}} to {{$page -1}} of {{$total}}</span>
                    {{$customer->links()}}
                </div>
               
            </div>
   		</div>

    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	function checkDelete(id){
        var x = confirm('Are you sure want to delete it?');
        if(x){
            document.getElementById('delete-'+id).submit();
        }
    }
</script>
@endsection