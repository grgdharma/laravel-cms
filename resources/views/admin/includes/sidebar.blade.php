<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('system.dashboard') }}" class="sidebar-brand">
            {{ getTitle() }}
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body ps">
        <ul class="nav">
            {{-- Main Category --}}
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('system.dashboard') }}" class="nav-link">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            {{-- Dynamic Menu --}}
            @foreach(getSideMenu() as $menu)
                <li class="nav-item nav-category"> {{ $menu['name'] }} </li>
                @foreach($menu['child_list'] as $child)
                    <li class="nav-item">
                        <a href="{{ route($child['route_name']) }}" class="nav-link">
                            <i data-feather="{{ $child['icon'] }}"></i>
                            <span class="link-title">{{ $child['name'] }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach

            {{-- Logout --}}
            <li class="nav-item">
                <a class="nav-link" href="#" 
                   onclick="event.preventDefault(); document.getElementById('logout-form-side').submit();">
                    <i data-feather="log-out"></i>
                    <span class="link-title"> Logout </span>
                </a>
                <form id="logout-form-side" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>