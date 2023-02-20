<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item">
            <input id="toggle-event" type="checkbox" data-toggle="toggle" data-width="80" data-height="5" data-onstyle="default" data-on="Online" data-off="Offline"  {{ config("generals.site_status")==1?'checked':''}} >
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}" target="_blank" title="Your Store"><i data-feather="globe"></i></a>
            </li>
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i data-feather="user"></i> {{ Auth::guard('admin')->user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column">
                        <div class="info">
                            <p class="name font-weight-bold mb-0">{{ Auth::guard('admin')->user()->name }}</p>
                            <p class="email text-muted mb-3">{{ Auth::guard('admin')->user()->email }}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">                               
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</nav>