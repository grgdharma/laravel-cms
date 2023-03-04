@extends('layouts.admin.app')
@section('title','System | Authorization')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">

		<div class="card">
   			<div class="card-header custom-header">
                <a href="javascript:void(0);" class="header-tab active" >Permission</a>  
                <a class="header-tab" href="javascript:void(0);" data-toggle="modal" data-target="#addModal" class="btn "> Add New </a>
                @include('admin.includes.alert')
                <input class="form-control" id="myInputAll" type="text" placeholder="Search.." style="float:right;width:20%; " >
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th style="width: 10px;">Status</th>
                                <th style="width: 10px;">Order</th>
                                <th style="width: 10px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTableAll">
                            @php
                                $i=1;
                            @endphp
                            @if(count($permission) > 0)
                                @foreach($permission as $value)
                                <tr id="permission-{{$value['id']}}" class="permission-row">
                                    <td><strong>{{ $i }}. {{$value['name']}}</strong></td>
                                    <td>
                                        @foreach($role as $data)
                                            @if(in_array($data->id, $value['role_id']))
                                                <input type="checkbox" value="{{$data->id}}" checked="" name="role_id[]">{{$data->name}}
                                            @else
                                                <input type="checkbox" value="{{$data->id}}" name="role_id[]">{{$data->name}}
                                            @endif 
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($value['status'] == 1)
                                        <i style="color: green;" class="fa fa-check-circle" aria-hidden="true"></i>
                                        @else 
                                        <i style="color: red;" class="fa fa-times" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <td>{{$value['sort_order']}}</td>
                                    <td>
                                        <a class="custom-btn permission-update" data-id="{{$value['id']}}" href="javascript:void(0);" ><i class="fa fa-refresh" aria-hidden="true"></i></a> 
                                        <a class="custom-btn edit" href="javascript:void(0);" data-toggle="modal" data-target="#editModal" id="{{$value['id']}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                        <a class="custom-btn delete" href="javascript:void(0);" onclick="return checkDelete({{$value['id']}})" ><i class="fa fa-trash" aria-hidden="true"></i></a> 
                                        <form id="delete-{{$value['id']}}" action="{{ route('system.authorization.delete', $value['id']) }}" method="POST" style="display:none">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                        </form>
                                    </td>
                                </tr>
                                @if(count($value['child_list']) > 0)
                                    @foreach ($value['child_list'] as $child)
                                    <tr id="permission-{{$child['id']}}" class="permission-row">
                                        <td><small> <i data-feather="corner-down-right"></i> {{$value['name']}}<i data-feather="chevron-right"></i>{{$child['name']}} </small></td>
                                        <td>
                                            @foreach($role as $data)
                                                @if(in_array($data->id, $child['role_id']))
                                                    <input type="checkbox" value="{{$data->id}}" checked="" name="role_id[]">{{$data->name}}
                                                @else
                                                    <input type="checkbox" value="{{$data->id}}" name="role_id[]">{{$data->name}}
                                                @endif 
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($child['status'] == 1)
                                            <i style="color: green;" class="fa fa-check-circle" aria-hidden="true"></i>
                                            @else 
                                            <i style="color: red;" class="fa fa-times" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                        <td>{{$child['sort_order']}}</td>
                                        <td>
                                            <a class="custom-btn permission-update" data-id="{{$child['id']}}" href="javascript:void(0);" ><i class="fa fa-refresh" aria-hidden="true"></i></a> 
                                            <a class="custom-btn edit" href="javascript:void(0);" data-toggle="modal" data-target="#editModal" id="{{$child['id']}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                            <a class="custom-btn delete" href="javascript:void(0);" onclick="return checkDelete({{$child['id']}})" ><i class="fa fa-trash" aria-hidden="true"></i></a> 
                                            <form id="delete-{{$child['id']}}" action="{{ route('system.authorization.delete', $child['id']) }}" method="POST" style="display:none">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                    @if(count($child['child_child_list']) > 0)
                                    @foreach ($child['child_child_list'] as $child_list)
                                    <tr id="permission-{{$child_list['id']}}" class="permission-row">
                                        <td><small> <i data-feather="corner-down-right"></i> {{$value['name']}}<i data-feather="chevron-right"></i>{{$child['name']}}<i data-feather="chevron-right"></i>{{$child_list['name']}} </small></td>
                                        <td>
                                            @foreach($role as $data)
                                                @if(in_array($data->id, $child_list['role_id']))
                                                    <input type="checkbox" value="{{$data->id}}" checked="" name="role_id[]">{{$data->name}}
                                                @else
                                                    <input type="checkbox" value="{{$data->id}}" name="role_id[]">{{$data->name}}
                                                @endif 
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($child_list['status'] == 1)
                                            <i style="color: green;" class="fa fa-check-circle" aria-hidden="true"></i>
                                            @else 
                                            <i style="color: red;" class="fa fa-times" aria-hidden="true"></i>
                                            @endif
                                        </td>
                                        <td>{{$child_list['sort_order']}}</td>
                                        <td>
                                            <a class="custom-btn permission-update" data-id="{{$child_list['id']}}" href="javascript:void(0);" ><i class="fa fa-refresh" aria-hidden="true"></i></a> 
                                            <a class="custom-btn edit" href="javascript:void(0);" data-toggle="modal" data-target="#editModal" id="{{$child_list['id']}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                            <a class="custom-btn delete" href="javascript:void(0);" onclick="return checkDelete({{$child_list['id']}})" ><i class="fa fa-trash" aria-hidden="true"></i></a> 
                                            <form id="delete-{{$child_list['id']}}" action="{{ route('system.authorization.delete', $child_list['id']) }}" method="POST" style="display:none">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endforeach
                                @endif
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            @else 
                                <tr><td colspan="4">Not found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                {{ $pagination->links() }}
            </div>
   		</div>
       
    </div>
</div>
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New</h4>
            </div>
            <div class="modal-body">
                <form autocomplete="off" method="POST" action="{{route('system.authorization.store')}}">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required >
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="parent_id">
                            <option value="">Choose Parent</option>
                            @php
                            $menu_lists = getSideMenu();
                            @endphp
                            @if(count($menu_lists) > 0)
                                @foreach ($menu_lists as $menu)
                                    <option value="{{ $menu['id'] }}">{{ $menu['name'] }}</option>
                                    @if(count($menu['child_list']) > 0)
                                        @foreach ($menu['child_list'] as $child)
                                            <option value="{{ $child['id'] }}"> --- {{ $child['name'] }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="route-url" type="text" class="form-control" name="route" value="{{ old('route') }}" placeholder="Route URL: click here" data-toggle="modal" data-target="#getRoutList" >
                    </div>
                    <div class="form-group">
                        <input id="route-name" type="text" class="form-control" name="route_name" value="{{ old('route_name') }}" placeholder="Route Name" >
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="Icon Name" >
                        <a class="route-list-btn" href="https://feathericons.com" target="_blank" > Icon name: click </a>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order') }}" placeholder="Sorting Order">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option value="1">Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">{{ __('Submit') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Route List Model -->
<div id="getRoutList" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
            </div>
            <div class="modal-body">
                @php
                    getRouteLists();
                @endphp
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
<!-- Edit Model -->
@endsection
@section('script')
<!-- update permission -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#myInputAll").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTableAll tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $(".permission-update").on("click",function(){
            var token = "{{csrf_token()}}";
            var path = "{{route('system.authorization.role.update')}}";
            var id = $(this).data("id");
            var val = [];
            $('#permission-'+id+' :checkbox:checked').each(function(i){
                val[i] = $(this).val();
            });
            $.ajax({
                url: path,
                type: 'post',
                dataType: 'json',
                data:{id:id,value:val,_token:token},
                beforeSend:function(xhr){
                    $('#permission-'+id+' .permission-update').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                complete: function() {
                    $('#permission-'+id+' .permission-update').html('<i class="fa fa-refresh"></i>');
                },
                success: function(data) {
                    $('#response-msg').html(data['message']);
                }
            });
        });
        $('#editModal').on('show.bs.modal', function(e) {
            var token = "{{csrf_token()}}";
            var path = "{{route('system.authorization.edit')}}";
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
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("tr.route-row").dblclick(function(){
            var route_url = $(this).data('url');
            var route_name = $(this).data('name');
            $('#route-url').val(route_url);
            $('#route-name').val(route_name);
            $('#getRoutList').modal('hide');
        });
    });
</script>

<script language="JavaScript" type="text/javascript">
    function checkDelete(id){
        var x = confirm('Are you sure want to delete it?');
        if(x){
            document.getElementById('delete-'+id).submit();
        }
    }
</script>
@endsection