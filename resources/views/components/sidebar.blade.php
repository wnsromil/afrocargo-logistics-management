<ul class="sidebar-vertical mt-5">
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
                                    <img src="{{ asset($submenu->icon) }}" alt="{{ $submenu->title }}">
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
</ul>