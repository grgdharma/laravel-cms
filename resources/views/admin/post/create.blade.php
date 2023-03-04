@extends('layouts.admin.app')
@section('title','Create | '. get_general_setting('site_title'))
@section('content')
@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
		<div class="card">
   			<div class="card-header">
                <a href="{{route('system.post')}}" class="header-tab "> Posts </a>
                <a href="javascript:void(0);" class="header-tab active" > Add New </a>
                 @include('admin.includes.alert')
            </div>
            <div class="card-body">
                
                <form autocomplete="off" method="post" action="{{route('system.post.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Title" required="">
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="category">
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $cat)
                                                       <option value="{{ $cat->id }}">{{ $cat->title }}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea rows="1" class="form-control" placeholder="Sub Title" name="sub_title">{{ old('sub_title') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Keywords" name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="video_url" value="{{ old('video_url') }}" placeholder="Video URL">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="file-wrapper" >
                                <!-- add img -->
                                <a href="javascript:void(0);" data-target-id="post-thumb" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail </a>
                                <input type="hidden" name="thumbnail" value="" id="input-image-name-post-thumb" />
                                <!-- /add img -->
                            </div>
                            <label>Image Size: 500 X 261 px </label>
                            <div class="file-wrapper" >
                                <!-- add img -->
                                <a href="javascript:void(0);" data-target-id="post" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Featured Image </a>
                                <input type="hidden" name="feature_image" value="" id="input-image-name-post" />
                                <!-- /add img -->
                            </div>
                        </div>
                    </div>
                    <button type="submit" class=" btn btn-default"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('Save') }}</button>
                </form>
     
            </div>
   		</div>
    </div>
</div>
@endsection
@section('script')
<script>
    var common = {
        height: '400px',
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
    CKEDITOR.replace( 'description',common);
</script>
@endsection