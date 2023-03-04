@extends('layouts.admin.app')
@section('title','System | Administration')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">

		<div class="card">
   			<div class="card-header">
                <a href="javascript:void(0);" class="header-tab active"> Administration </a>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#addModal" class="header-tab"> Add New </a>
                @include('admin.includes.alert')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 10px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($admin) > 0)
                                @php $i=1; @endphp
                                @foreach($admin as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->role->name}}</td>
                                    @if($value->role_id !=1)
                                    <td>
                                        <a href="javascript:void(0);" id="{{$value->id}}" data-toggle="modal" data-target="#editModal"  class="custom-btn edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0);" class="custom-btn delete" onclick="return checkDelete({{$value->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <form id="delete-{{$value->id}}" action="{{route('system.administration.delete',$value->id)}}" method="POST" style="display:none">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                        </form>
                                    </td>
                                    @else
                                    <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
   		</div>
    </div>
</div>
<!-- Model -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" method="POST" action="{{route('system.administration.store')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required>
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                            <option value="">Role</option>
                            @foreach($role as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-default">{{ __('Submit') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Model -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- content -->
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
    $('#editModal').on('show.bs.modal', function(e) {
        var token = "{{csrf_token()}}";
        var path = "{{route('system.administration.edit')}}";
        var $modal = $(this);
        var model_id = e.relatedTarget.id;
        $.ajax({
            cache: false,
            type: 'post',
            url: path,
            data:{model_id:model_id,_token:token},
            success: function(data) {
                $modal.find('.modal-dialog').html(data);
            }
        });
    });
</script>
@endsection