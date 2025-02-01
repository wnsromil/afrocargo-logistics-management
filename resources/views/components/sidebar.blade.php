<ul class="sidebar-vertical">
    @foreach ($items as $item)
            @if (!empty($item['submenu']) && is_array($item['submenu']))
            <li class="submenu {{ $item['active'] }}">
                <a href="{{ !empty($item['active']) ? $item['active']:'#' }}">
                    @if (!empty($item['icon']))
                        <img src="{{ $item['icon'] }}" alt="">
                    @endif
                    <span>{{ $item['title'] }}</span>
                </a>
                <ul style="display: none;" class="level{{$item['level'] ?? 1 }}">
                    @foreach ($item['submenu'] as $submenu)
                        <!-- You can add submenus here if needed -->
                        <li class="{{ $submenu['active'] ?? '' }}">
                            <a href="{{ !empty($submenu['route']) ? $submenu['route']:'#' }}">
                                @if (!empty($submenu['icon']))
                                    <img src="{{ $submenu['icon'] }}" alt="">
                                @endif
                                <span>{{ $submenu['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
            <li class="{{ !empty($item['active']) ? $item['active']:'#' }}">
                <a href="{{ !empty($item['route']) ? $item['route']:'#' }}">
                    @if (!empty($item['icon']))
                        <img src="{{ $item['icon'] }}" alt="">
                    @endif
                    <span>{{ $item['title'] }}</span>
                </a>
            @endif
        </li>
    @endforeach
</ul>
