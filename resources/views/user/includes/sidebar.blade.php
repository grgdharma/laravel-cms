<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('user.dashboard')}}" class="sidebar-brand">
            @if(Auth::user()->avatar)
            <img src="{{getImageURL(Auth::user()->avatar)}}" style="width:76px;">
            @else
                {{getTitle()}}
            @endif
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
            <a href="{{route('user.dashboard')}}" class="nav-link">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span class="link-title"> Dashboard</span>
            </a>
        </li>
        <!-- Catelog Section -->
        <li class="nav-item nav-category">Catelog</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i data-feather="info"></i>
            <span class="link-title">Link 1</span>
            </a>
        </li>
        <!-- Administration Section -->
        <li class="nav-item nav-category">System Administration</li>
        <li class="nav-item">
            <a href="{{ route('user.dashboard.edit') }}" class="nav-link">
                <i data-feather="user"></i>
                <span class="link-title"> Profile </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logout-form-side').submit();"><i data-feather="log-out"></i> <span class="link-title">{{ __('Logout') }} </span></a>
            <form id="logout-form-side" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>
</nav>