<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('system.dashboard')}}" class="sidebar-brand">
        {{getTitle()}}
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body ps">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
            <a href="{{route('system.dashboard')}}" class="nav-link">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span class="link-title"> Dashboard</span>
            </a>
        </li>
        @php
            $menu_lists = getSideMenu();
        @endphp
        @foreach ($menu_lists as $menu)
            <li class="nav-item nav-category">{{ $menu['name'] }}</li>
            @if(count($menu['child_list']) > 0)
                @foreach ($menu['child_list'] as $child)
                    <li class="nav-item">
                        <a href="{{ route($child['route_name']) }}" class="nav-link">
                            <i data-feather="{{ $child['icon'] }}"></i>
                            <span class="link-title"> {{ $child['name'] }} </span>
                        </a>
                    </li>
                @endforeach
            @endif
        @endforeach
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form-side').submit();"><i data-feather="log-out"></i> <span class="link-title">{{ __('Logout') }} </span></a>
            <form id="logout-form-side" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
</nav>