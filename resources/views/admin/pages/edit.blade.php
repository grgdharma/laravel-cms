@extends('layouts.admin.app')
@section('title','Page | Edit')
@section('content')
@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
		<div class="card">
   			<div class="card-header">
                <a href="{{route('admin.catalog.page')}}" class="header-tab "> Pages </a>
                <a href="javascript:void(0);" class="header-tab active" > Edit </a>
                @include('admin.includes.alert')
            </div>
            <div class="card-body">
                
                <form autocomplete="off" method="post" action="{{route('admin.catalog.page.update',$id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $page->title }}" placeholder="Title" required="">
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea rows="10" id="information-description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description">{!! $page->description !!}</textarea>
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ $page->meta_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Keywords" name="meta_keywords">{{ $page->meta_keywords }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input id="sort-order" type="number" class="form-control" name="sort_order" value="{{ $page->sort_order }}" placeholder="Order">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option value="1" {{$page->status == 1 ?'selected':''}} >Enable</option>
                                                    <option value="0" {{$page->status == 0 ?'selected':''}} >Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="file-wrapper" style="background-image: url('{{getImageURL($page->image)}}');" >
                                <!-- add img -->
                                <a href="javascript:void(0)" data-target-id="info" id="thumb-image" class="button-image class-custom-file" ><i class="fa fa-picture-o" aria-hidden="true"></i> Choose file</a>
                                <input type="hidden" name="feature_image" value="{{$page->image}}" id="input-image-name-info" />
                                <!-- /add img -->
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="form-control" name="parent_id" >
                                            <option value="">Select parent</option>
                                            @if(count($page_lists) > 0)
                                                @foreach ( $page_lists as $parent)
                                                    <option value="{{ $parent->id }}" {{$page->parent_id == $parent->id?'selected':''}} >{{ $parent->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select class="form-control" name="template" required="">
                                            <option value="">Select template</option>
                                            <option value="default" {{$page->template =='default'?'selected':''}} >Default</option>
                                        </select>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('Update') }}</button>
                </form>
     
            </div>
   		</div>
    </div>
</div>
@endsection
@section('script')
<script>
    var common = {
        height: 100,
        toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
            },
            {
            "name": "paragraph",
            "groups": ["list"]
            },
            {
            "name": "document",
            "groups": ["mode"]
            },
            
            {
            "name": "styles",
            "groups": ["styles"]
            }
        ],
        removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
    };
    CKEDITOR.replace( 'information-description',common);
</script>
@endsection