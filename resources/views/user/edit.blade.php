@extends('layouts.user.app')
@section('title', getTitle().' | My Account')
@section('content')
@include('user.includes.sidebar')
<div class="page-wrapper">
    @include('user.includes.topbar')
    <div class="page-content">
        <div class="card">
            <div style="padding: 11px;">
                @include('user.includes.alert')
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="profile-sidebar">
                            <div class="profile-usertitle">
                                <div class="user-name">
                                    {{Auth::user()->name}}
                                </div>
                                <div class="user-email">
                                <i class="fa fa-envelope"></i> {{Auth::user()->email}}
                                </div>
                                <div class="user-mobile">
                                <i class="fa fa-mobile" ></i> {{Auth::user()->mobile}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="profile-content">
                            <div class="header-title">
                                <h2>Edit Profile</h2>
                            </div>
                            <form autocomplete="off" id="edit-profile-action-form" method="POST" action="{{route('user.dashboard.update',Auth::user()->id)}}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="form_group">
                                            <input type="text" placeholder="Full Name" name="full_name" value="{{ Auth::user()->name }}" class="form-control @error('full_name') is-invalid @enderror">
                                            @error('full_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form_group">
                                            <input type="text" name="address" class="form-control" value="{{Auth::user()->address}}" placeholder="Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form_group">
                                            <select id="country" class="form_select form-control" name="country">
                                                <option value="" >Country</option>
                                                <option value="1" {{Auth::user()->country==1?'selected':''}} >Nepal</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="form_group">
                                            <select id="city" class="form_select form-control" name="city" >
                                                <option value="" >City</option>
                                                <option value="1" {{Auth::user()->city==1?'selected':''}} >Kathmandu</option>
                                                <option value="2" {{Auth::user()->city==2?'selected':''}} >Bhaktapur</option>
                                                <option value="3" {{Auth::user()->city==3?'selected':''}} >Lalitpur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <div class="form_group">
                                            <div class="file-wrapper profile-picture" style="background-image: url('{{getImageURL(Auth::user()->avatar)}}');width: 150px;" >
                                                <!-- add img -->
                                                <a href="javascript:void(0)" data-target-id="profile-pic" id="thumb-image" class="button-image class-custom-file"><i class="fa fa-picture-o" aria-hidden="true"></i> Profile </a>
                                                <input type="hidden" name="profile_pic" value="{{Auth::user()->avatar}}" id="input-image-name-profile-pic" />
                                                <!-- /add img -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit-password" class="form-group" >
                                    <strong> <label class="text-success"><i class="fa fa-key" aria-hidden="true"></i> Edit Password </label></strong>
                                </div>
                                <div id="change-password" style="display:none" >
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form_group">
                                                <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form_group">
                                                <input type="password" name="new_password" class="form-control" placeholder="New Password">
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="form_group">
                                    <button type="submit" class="btn btn-default btn-process">Update</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $("#edit-password").click(function(){
            $("#change-password").toggle('slow');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click",".btn-process",function(e){
            e.preventDefault();
            $('#edit-profile-action-form').submit();
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Loading');
            return true;
        });
    })
</script>
@endsection