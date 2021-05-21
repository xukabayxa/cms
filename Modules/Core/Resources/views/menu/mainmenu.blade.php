@php
    $route=\Request::route()->getName();
@endphp

<ul class="nav nav-sidebar" data-nav-type="accordion">

    @if(count($mainMenuEloquent) > 0)
    <li class="nav-item-header">
        <div class="text-uppercase font-size-xs line-height-xs">Main</div>
        @foreach($mainMenuEloquent as $menuElement)
            @if($menuElement->permission == '' || Auth::user()->hasPermissionTo($menuElement->permission) )
                @if( !($menuElement->parent) )
                    <li class="nav-item @if($menuElement->children->count() > 0) nav-item-submenu @if($menuElement->hasChildActive()) nav-item-expanded nav-item-open @endif @endif">
                        @if($menuElement->children->count() > 0)
                            @include('core::.menu.collapse-menu-element',[
                                'name' => $menuElement->getLabelLang(),
                                'id' => $menuElement->label,
                                'icon' => $menuElement->icon,
                                'url' => $menuElement->url
                            ])
                            <ul class="nav nav-group-sub" data-submenu-title="{{ $menuElement->getLabelLang() }}">
                                @include('core::menu.limainmenu',[
                                    'mainMenuEloquent' => $menuElement->children,
                                    'parent_id' => $menuElement->id,
                                ])
                            </ul>
                        @else
                            @include('core::menu.menu-element',[
                                'name' => $menuElement->getLabelLang(),
                                'icon' => $menuElement->icon,
                                'url' => $menuElement->url,
                                'visibility' => $menuElement->visibility,
                                'route_name' => $menuElement->route_name
                            ])
                        @endif
                    </li>
                @endif
            @endif
        @endforeach
    </li>
    @endif

    @if(count($settingMenuEloquent) > 0)
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Hệ thống</div>
            @foreach($settingMenuEloquent as $menuElement)
                @if($menuElement->permission == '' || Auth::user()->hasPermissionTo($menuElement->permission) )
                    @if( !($menuElement->parent) )
                        <li class="nav-item @if($menuElement->children->count() > 0) nav-item-submenu @if($menuElement->hasChildActive()) nav-item-expanded nav-item-open @endif @endif">
                            @if($menuElement->children->count() > 0)
                                @include('core::menu.collapse-menu-element',[
                                    'name' => $menuElement->getLabelLang(),
                                    'id' => $menuElement->label,
                                    'icon' => $menuElement->icon,
                                    'url' => $menuElement->url
                                ])
                                <ul class="nav nav-group-sub" data-submenu-title="{{ $menuElement->getLabelLang() }}">
                                    @include('core::menu.limainmenu',[
                                        'mainMenuEloquent' => $menuElement->children,
                                        'parent_id' => $menuElement->id
                                    ])
                                </ul>
                            @else
                                @include('core::menu.menu-element',[
                                    'name' => @trans($menuElement->getLabelLang()),
                                    'icon' => $menuElement->icon,
                                    'url' => $menuElement->url,
                                    'visibility' => $menuElement->visibility,
                                    'route_name' => $menuElement->route_name
                                ])
                            @endif
                        </li>
                    @endif
                @endif
            @endforeach
        </li>
    @endif
</ul>
