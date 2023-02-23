<div class="footer">
    @php
        $footer_menu = getNavMenu('footer');
    @endphp
    @if(count($footer_menu) > 0)
    <ul>
        @foreach ($footer_menu as $menu)
            <li><a href="{{ route('page.detail', $menu['slug']) }}"> {{ $menu['title'] }}</a></li>
        @endforeach
    </ul>
    @endif
    <div class="copy-right">
        <span> {{ siteCopyright() }}</span>
    </div>
</div>