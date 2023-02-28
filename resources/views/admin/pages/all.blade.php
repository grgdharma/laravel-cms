@extends('layouts.admin.app')
@section('title','Page | Lists')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">

		<div class="card">
   			<div class="card-header">
                <a href="javascript:void(0);" class="header-tab active"> Pages </a>
                <a href="{{route('system.page.create')}}" class="header-tab" > Add New </a>
                @include('admin.includes.alert')
            </div>
            <div class="card-body">
               
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width:50px;">SN</th>
                                <th>Title</th>
                                <th style="width:100px;">Template</th>
                                <th style="width:100px;">Status</th>
                                <th style="width:100px;">Sort Order</th>
                                <th style="width:100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($pages) > 0)
                                @php $i=1 @endphp
                                @foreach($pages as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->title}}</td>
                                    <td> <span style="text-transform: capitalize;">{{$value->template}}</span> </td>
                                    
                                    <td>
                                        @if($value->status == 1)
                                            <i style="color: green;" class="fa fa-check-circle" aria-hidden="true"></i>
                                        @else
                                            <i style="color: red;" class="fa fa-times" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <td><span>{{$value->sort_order}}</span></td>
                                    <td>
                                        <a href="{{route('page.detail',$value->slug)}}" target="_blank" class="custom-btn edit"> <i class="fa fa-eye"></i></a>
                                        <a href="{{route('system.page.edit',$value->id)}}" class="custom-btn edit"> <i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0);" class="custom-btn delete" onclick="return checkDelete({{$value->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <form id="delete-{{$value->id}}" action="{{ route('system.page.delete', $value->id) }}" method="POST" style="display:none">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else 
                                <tr><td colspan="7">Not found.</td></tr>
                            @endif
                        </tbody>
                    </table>
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