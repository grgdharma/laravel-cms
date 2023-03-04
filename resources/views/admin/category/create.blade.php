@extends('layouts.admin.app')
@section('title','Create | '. get_general_setting('site_title'))
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">

		<div class="card">
   			<div class="card-header">
                <a href="{{route('system.post.category')}}" class="header-tab "> Categories </a>
                <a href="javascript:void(0);" class="header-tab active" > Add New </a>
                @include('admin.includes.alert')
            </div>
            <div class="card-body">
                <form autocomplete="off" method="post" action="{{route('system.post.category.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea id="category-name" rows="1" class="form-control" placeholder="Title" name="title" required>{{ old('title') }}</textarea>
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea id="description" rows="5" class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Description" name="meta_description">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Meta Keywords" name="meta_keywords">{{ old('meta_keyword') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input id="sort-order" min="0" type="number" class="form-control" name="sort_order" value="{{ old('sort_order') }}" placeholder="Order">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                <a href="javascript:void(0);" data-target-id="post-category-thumb" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail</a>
                                <input type="hidden" name="thumbnail" value="" id="input-image-name-post-category-thumb" />
                                <!-- /add img -->
                            </div>
                            <label>Image Size: 1200 X 1800px </label>
                            <div class="file-wrapper" >
                                <!-- add img -->
                                <a href="javascript:void(0);" data-target-id="post-category" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Feature Image</a>
                                <input type="hidden" name="feature_image" value="" id="input-image-name-post-category" />
                                <!-- /add img -->
                            </div>
                            <label>Image Size: 800 X 524px </label>
                        </div> 
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('Save') }}</button>
                </form>
     
            </div>
   		</div>   
        
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#category-name").on("keyup", function() {
            var child_child = $(this).val().toLowerCase();
            child_child = child_child.replace(/\s+/g, '-');
            var final = child_child;
            $("#category-slug").val(final);
        });
      
    });
</script>
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
    CKEDITOR.replace( 'description',common);
</script>
@endsection