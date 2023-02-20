<div class="rightcolumn">
    <div class="card">
        @if(count($categories) > 0)
        <ul>
            @foreach ($categories as $category)
            <li><a href="{{ route('category.post', $category->slug) }}"> {{ $category->title }}</a></li>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="card">
        @php 
        $site_facebook = config('generals.site_facebook');
        $site_instagram = config('generals.site_instagram');
        @endphp
        <ul>
            <li>
                <a target="_blank" href="{{$site_facebook}}"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook </a> 
                <a target="_blank" href="{{$site_instagram  }}"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram </a>
            </li>
        </ul>
    </div>
</div>