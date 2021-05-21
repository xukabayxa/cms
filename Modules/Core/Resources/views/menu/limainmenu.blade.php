@foreach($mainMenuEloquent as $menuElement)
    @if($menuElement->visibility)
        @if($menuElement->permission == '' || Auth::user()->hasPermissionTo($menuElement->permission) )
            <li class="nav-item">
                @include('core::menu.menu-element',[
                    'name' => $menuElement->getLabelLang(),
                    'url' => $menuElement->url,
                    'visibility' => $menuElement->visibility,
                    'route_name' => $menuElement->route_name
                ])
            </li>
        @endif
    @endif
@endforeach

