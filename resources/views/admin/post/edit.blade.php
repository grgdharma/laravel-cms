@extends('layouts.admin.app')
@section('title','Update | '. get_general_setting('site_title'))
@section('content')
@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
		<div class="card">
   			<div class="card-header">
                <a href="{{route('admin.post')}}" class="header-tab "> Posts </a>
                <a href="javascript:void(0);" class="header-tab active" > Edit </a>
                 @include('admin.includes.alert')
            </div>
            <div class="card-body">
                
                <form autocomplete="off" method="post" action="{{route('admin.post.update',$edit->id)}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $edit->title }}" placeholder="Title" required="">
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
                                                       <option value="{{ $cat->id }}" {{$edit->category_id == $cat->id ?'selected':''}} >{{ $cat->title }}</option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea rows="1" class="form-control" placeholder="Sub Title" name="sub_title">{!! $edit->sub_title !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea rows="10" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description">{!! $edit->description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ $edit->meta_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Keywords" name="meta_keywords">{{ $edit->meta_keywords }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="video_url" value="{{ $edit->video_url }}" placeholder="Video URL">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option value="1" {{$edit->status == 1 ?'selected':''}} >Enable</option>
                                                    <option value="0" {{$edit->status == 0 ?'selected':''}} >Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="file-wrapper" style="background-image: url('{{getImageURL($edit->thumbnail)}}');" >
                                <!-- add img -->
                                <a href="javascript:void(0);" data-target-id="post-thumbnail" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail</a>
                                <input type="hidden" name="thumbnail" value="{{$edit->thumbnail}}" id="input-image-name-post-thumbnail" />
                                <!-- /add img -->
                            </div>
                            <label>Image Size: 500 X 261 px </label>
                            <div class="file-wrapper" style="background-image: url('{{getImageURL($edit->image)}}');" >
                                <!-- add img -->
                                <a href="javascript:void(0);" data-target-id="post" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Featured Image </a>
                                <input type="hidden" name="feature_image" value="{{ $edit->image }}" id="input-image-name-post" />
                                <!-- /add img -->
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