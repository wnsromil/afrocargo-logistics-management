{{-- <ul class="sidebar-vertical">
    @foreach ($items as $item)
            @if (!empty($item['submenu']) && is_array($item['submenu']) && count($item['submenu']) > 0)
            <li class="submenu {{ !empty($item['active']) ? isActive($item['active'],'subdrop'):'' }}">
                <a href="{{ !empty($item['active']) ? isActive($item['active']):'#' }}">
                    @if (!empty($item['icon']))
                        <img src="{{ $item['icon'] }}" alt="">
                    @endif
                    <span>{{ $item['title'] }}</span>
                </a>
                <ul style="display: {{ !empty($item['active']) ? isActive($item['active'],'block','none'):'' }};" class="level{{$item['level'] ?? 1 }}">
                    @foreach ($item['submenu'] as $submenu)
                        <!-- You can add submenus here if needed -->
                        <li class="{{ !empty($submenu['active']) ? isActive($submenu['active']):'' }}">
                            <a href="{{ !empty($submenu['route']) && !in_array($submenu['route'],["#","''"]) ? route($submenu['route']):'#' }}">
                                @if (!empty($submenu['icon']))
                                    <img src="{{ $submenu['icon'] }}" alt="">
                                @endif
                                <span>{{ $submenu['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
            <li class="{{ !empty($item['active']) ? isActive($item['active']):''}}">
                <a href="{{ !empty($item['route']) && !in_array($item['route'],["#","''"]) ? route($item['route']):'#' }}">
                    @if (!empty($item['icon']))
                        <img src="{{ $item['icon'] }}" alt="">
                    @endif
                    <span>{{ $item['title'] }}</span>
                </a>
            @endif
        </li>
    @endforeach
</ul>
 --}}


 <ul class="sidebar-vertical">
    @foreach ($menus as $menu)
        @php
            $hasSubmenu = $menu->submenu->count() > 0;
        @endphp

        @if ($hasSubmenu)
            <li class="submenu {{  !empty($menu->active) ? isActive($menu->active,'subdrop') : '' }}">
                <a href="javascript:void(0)">
                    @if ($menu->icon)
                        <img src="{{ asset($menu->icon) }}" alt="{{ $menu->title }}">
                    @endif
                    <span>{{ $menu->title }}</span>
                </a>
                <ul style="display: {{ !empty($menu->active) ? isActive($menu->active,'block','none'):'' }}">
                    @foreach ($menu->submenu as $submenu)
                        <li class="{{ !empty($submenu->active) ? isActive($submenu->active) : '' }}">
                            <a href="{{ $submenu->route ? route($submenu->route) : 'javascript:void(0)' }}">
                                @if ($submenu->icon)
                                    <img src="{{ asset($submenu->icon) }}" alt="{{ $submenu->title }}">
                                @endif
                                <span>{{ $submenu->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="{{ !empty($menu->active) ? isActive($menu->active): '' }}">
                <a href="{{ $menu->route ? route($menu->route) : 'javascript:void(0)' }}">
                    @if ($menu->icon)
                        <img src="{{ asset($menu->icon) }}" alt="{{ $menu->title }}">
                    @endif
                    <span>{{ $menu->title }}</span>
                </a>
            </li>
        @endif
    @endforeach
</ul>
