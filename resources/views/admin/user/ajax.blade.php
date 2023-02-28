 <!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
    </div>
    <div class="modal-body">
        <form autocomplete="off" method="POST" action="{{route('system.administration.update',$id)}}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $edit->name }}" placeholder="Name" required>
            </div>
            <div class="form-group">
                <select class="form-control @error('role') is-invalid @enderror" name="role" required>
                    <option value="">Role</option>
                    @foreach($role as $value)
                    <option value="{{$value->id}}" {{ $edit->role_id ==$value->id?'selected':'' }} >{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div id="edit-password" class="form-group" >
                <label><i class="fa fa-key" aria-hidden="true"></i> Edit Password </label>
            </div>
            <div id="change-password" style="display:none" >
                <div class="form-group">
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="" placeholder="Old Password" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="" placeholder="New Password" >
                </div>
            </div>
            
            <button type="submit" class="btn btn-default">{{ __('Update') }}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#edit-password").click(function(){
            $("#change-password").toggle('slow');
        });
    });
</script>