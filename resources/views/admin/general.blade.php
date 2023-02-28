@extends('layouts.admin.app')
@section('title','General Setting')
@section('content')

@php
    $site_title             = config('generals.site_title');
    $site_email             = config('generals.site_email');
    $site_phone             = config('generals.site_phone');
    $site_address           = config('generals.site_address')?config('generals.site_address'):'Your address';
    $site_meta_title        = config('generals.site_meta_title');
    $site_meta_keyword      = config('generals.site_meta_keyword');
    $site_meta_description  = config('generals.site_meta_description');

    $site_facebook  = config('generals.site_facebook');
    $site_instagram = config('generals.site_instagram');
    
    $site_copyright         = config('generals.site_copyright');
    $site_featured_image    = config('generals.site_featured_image');
    $site_logo_web          =  config('generals.site_logo_web');
    $site_logo_web_footer   =  config('generals.site_logo_web_footer');
    $coming_soon_image      = config('generals.coming_soon_image');
    
    $file_storage_disk      =  config('generals.file_storage_disk');
@endphp

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
        <div class="card">
   			<div class="card-header">
                <a href="javascript:void(0);" class="header-tab active" > General Settings </a>
                @include('admin.includes.alert')
            </div>
            <div class="card-body">
                
                <form autocomplete="off" method="post" action="{{route('system.general.update')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="site_title" value="{{ $site_title }}" placeholder="Site Title">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="site_email" value="{{ $site_email }}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="site_phone" value="{{ $site_phone }}" placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
		                                    <div class="form-group">
		                                        <textarea id="address" rows="8" class="form-control" name="site_address" placeholder="Address" >{!! $site_address !!}</textarea>
                                            </div>
		                                </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control" placeholder="Meta Title" name="site_meta_title">{{ $site_meta_title }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control" placeholder="Keyword" name="site_meta_keyword">{{ $site_meta_keyword }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control" placeholder="Meta Description" name="site_meta_description">{{ $site_meta_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="site_facebook" value="{{ $site_facebook }}" placeholder="Facebook">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="site_instagram" value="{{ $site_instagram }}" placeholder="Instagram">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control" name="site_copyright" placeholder="Copyright" >{{ $site_copyright }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="header-title">
                                <h2>File Storage</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Storage Disk</label>
                                        <select class="form-control" name="file_storage_disk">
                                            <option value=""> Select </option>
                                            <option value="public" {{$file_storage_disk==='public'?'selected':''}}  > Public </option>
                                            <option value="s3" {{$file_storage_disk==='s3'?'selected':''}} > S3 (AWS) </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="file-wrapper" style="background-image: url('{{getImageURL($site_logo_web)}}');" >
                                        <!-- add img -->
                                        <a href="javascript:void(0)" data-target-id="web-logo" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Header Logo</a>
                                        <input type="hidden" name="site_logo_web" value="{{$site_logo_web}}" id="input-image-name-web-logo" />
                                        <!-- /add img -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="file-wrapper" style="background-image: url('{{getImageURL($site_logo_web_footer)}}');" >
                                        <!-- add img -->
                                        <a href="javascript:void(0)" data-target-id="web-logo-footer" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Footer Logo</a>
                                        <input type="hidden" name="site_logo_web_footer" value="{{$site_logo_web_footer}}" id="input-image-name-web-logo-footer" />
                                        <!-- /add img -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="file-wrapper" style="background-image: url('{{getImageURL($site_featured_image)}}');" >
                                        <!-- add img -->
                                        <a href="javascript:void(0);" data-target-id="featured" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Featured Image</a>
                                        <input type="hidden" name="site_featured_image" value="{{$site_featured_image}}" id="input-image-name-featured" />
                                        <!-- /add img -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="file-wrapper" style="background-image: url('{{getImageURL($coming_soon_image)}}');" >
                                        <!-- add img -->
                                        <a href="javascript:void(0)" data-target-id="web-coming-soon" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Coming Soon</a>
                                        <input type="hidden" name="coming_soon_image" value="{{$coming_soon_image}}" id="input-image-name-web-coming-soon" />
                                        <!-- /add img -->
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

    CKEDITOR.replace('address',common);
</script> 
@endsection