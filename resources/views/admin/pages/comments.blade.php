@extends('layouts.admin.app')
@section('title','Comment | Lists')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">

		<div class="card">
            <div class="card-body">
               
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th style="width:50px;">SN</th>
                                <th>Title</th>
                                <th style="width:100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($comments) > 0)
                                @php $i=1 @endphp
                                @foreach($comments as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->post->title}}</td>
                                    <td>
                                        <a href="{{route('comments.show',$value->post_id)}}" class="custom-btn edit"> <i class="fa fa-eye"></i></a>
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