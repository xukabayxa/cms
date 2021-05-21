<a href="{{ $url }}" title="{{ $name }}" class="nav-link {{ isset($visibility) && !$visibility ? 'disabled' : '' }} {{ Request::route()->getName() }}
@if(strpos(Request::route()->getName(), $route_name)  !== false || strpos(Request::fullUrl(), $route_name)  !== false || (strpos(Request::route()->getName(), 'categories')  !== false && strpos($route_name, Request::get('type')))) active @endif">
    @if(isset($icon))
        <i class="{{ $icon  }}"></i>
    @endif
    <span>{{ $name }}</span>
</a>