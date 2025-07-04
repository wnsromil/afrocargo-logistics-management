{{-- <ul class="sidebar-vertical mt-5">
    @foreach ($menus as $menu)
        @php
            $hasSubmenu = $menu->submenu->count() > 0;
        @endphp

        @if ($hasSubmenu)
            <li class="submenu {{  !empty($menu->active) ? isActive($menu->active, 'subdrop') : '' }} mt-2">
                <a href="javascript:void(0)" class="{{  !empty($menu->active) ? isActive($menu->active) : '' }}">
                    @if ($menu->icon)
                        {!! $menu->icon !!}
                    @endif
                    <span>{{ $menu->title }}</span>
                </a>
                <ul class="mt-3" style="display: {{ !empty($menu->active) ? isActive($menu->active, 'block', 'none') : '' }};">
                    @foreach ($menu->submenu as $submenu)
                        <li class="{{ !empty($submenu->active) ? isActive($submenu->active) : '' }}">

                            <a
                                href="{{ $submenu->route && !in_array($submenu->route, ["#", "''"]) ? route($submenu->route) : 'javascript:void(0)' }}">
                                @if ($submenu->icon)
                                    <img class="iconSubmenu" src="{{ asset(path: $submenu->icon) }}" alt="{{ $submenu->title }}">
                                @endif
                                <span>
                                    <i class="fa fa-arrow-right tooltipped" data-position="top" data-tooltip="fa fa-arrow-right"></i>
                                    {{ $submenu->title }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="{{ !empty($menu->active) ? isActive($menu->active) : '' }} mt-2" style="font-size:50px;">
                <a href="{{ $menu->route && !in_array($menu->route, ["#", "''"]) ? route($menu->route) : 'javascript:void(0)' }}">
                    @if ($menu->icon)
                        {!! $menu->icon !!}
                    @endif
                    <span>{{ $menu->title }}</span>
                </a>
            </li>
        @endif
    @endforeach
</ul> --}}

<ul class="sidebar-vertical mt-5">
    @foreach ($menus as $menu)
        @php
            $hasSubmenu = $menu->submenu->count() > 0;
            // Check if user has permission for this menu (assuming $menu->permissions is array of permission names)
            // if($menu->permissions){
            //     dd($menu->permissions,auth()->user()->hasAnyPermission($menu->permissions));
            // }
            // $hasPermission = auth()->user()->role_id !=1 ? empty($menu->permissions) || auth()->user()->hasAnyPermission($menu->permissions):true;
            $hasPermission = true;
        @endphp

        @if ($hasPermission)
            @if ($hasSubmenu)
                <li class="submenu {{ !empty($menu->active) ? isActive($menu->active, 'subdrop') : '' }} mt-2">
                    <a href="javascript:void(0)" class="{{ !empty($menu->active) ? isActive($menu->active) : '' }}">
                        @if ($menu->icon)
                            {!! $menu->icon !!}
                        @endif
                        <span>{{ $menu->title }}</span>
                    </a>
                    <ul class="mt-3" style="display: {{ !empty($menu->active) ? isActive($menu->active, 'block', 'none') : '' }};">
                        @foreach ($menu->submenu as $submenu)
                            @php
                                // $submenuHasPermission = empty($submenu->permissions) || auth()->user()->hasAnyPermission($submenu->permissions);
                                $submenuHasPermission = true;
                            @endphp

                            @if ($submenuHasPermission)
                                <li class="{{ !empty($submenu->active) ? isActive($submenu->active) : '' }}">
                                    <a href="{{ $submenu->route && !in_array($submenu->route, ['#', "''"]) ? route($submenu->route) : 'javascript:void(0)' }}">
                                        @if ($submenu->icon)
                                            <img src="{{ asset($submenu->icon) }}" alt="{{ $submenu->title }}">
                                        @endif
                                        <span>
                                            <i class="fa fa-arrow-right tooltipped" data-position="top" data-tooltip="fa fa-arrow-right"></i>
                                            {{ $submenu->title }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="{{ !empty($menu->active) ? isActive($menu->active) : '' }} mt-2" style="font-size:50px;">
                    <a href="{{ $menu->route && !in_array($menu->route, ['#', "''"]) ? route($menu->route) : 'javascript:void(0)' }}">
                        @if ($menu->icon)
                            {!! $menu->icon !!}
                        @endif
                        <span>{{ $menu->title }}</span>
                    </a>
                </li>
            @endif
        @endif
    @endforeach
</ul>
