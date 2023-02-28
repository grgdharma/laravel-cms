<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
    </div>
    <div class="modal-body">
        <form autocomplete="off" method="POST" action="{{route('system.authorization.update',$id)}}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $edit->name }}" placeholder="Name" required >
            </div>
            <div class="form-group">
                <select class="form-control" name="parent_id">
                    <option value="">Choose Parent</option>
                    @php
                    $menu_lists = getSideMenu();
                    @endphp
                    @if(count($menu_lists) > 0)
                        @foreach ($menu_lists as $menu)
                            <option value="{{ $menu['id'] }}" {{$edit->parent_id == $menu['id'] ?'selected':''}} >{{ $menu['name'] }}</option>
                            @if(count($menu['child_list']) > 0)
                                @foreach ($menu['child_list'] as $child)
                                    <option value="{{ $child['id'] }}" {{$edit->parent_id == $child['id'] ?'selected':''}} > --- {{ $child['name'] }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="route" value="{{ $edit->route_url }}" placeholder="Route URL">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="route_name" value="{{ $edit->route_name }}" placeholder="Route Name" >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="icon" value="{{ $edit->icon }}" placeholder="Icon Name" >
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="sort_order" value="{{ $edit->sort_order}}" placeholder="Sorting Order">
            </div>
            <div class="form-group">
                <select class="form-control" name="status">
                    <option value="0" {{$edit->status == 0 ?'selected':''}} >Disabled</option>
                    <option value="1" {{$edit->status == 1 ?'selected':''}}>Enabled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-default">{{ __('Submit') }}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
    </div>
</div>