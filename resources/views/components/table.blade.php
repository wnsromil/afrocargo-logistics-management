<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                @endforeach
                @if (!empty($actions)) 
                    <th>Actions</th> 
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    @foreach ($columns as $column)
                        <td>
                            @if (isset($customFields[$column])) 
                                {!! $customFields[$column]($item[$column], $item) !!}
                            @else
                                {{ $item[$column] ?? '-' }}
                            @endif
                        </td>
                    @endforeach
                    @if (!empty($actions))
                        <td>
                            @foreach ($actions as $action)
                                @if ($action['label'] === 'Delete')
                                    <form action="{{ route($action['route'], $item['id']) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-{{ $action['class'] }} btn-sm" onclick="return confirm('Are you sure?')">
                                            <i class="{{ $action['icon'] }}"></i> {{ $action['label'] }}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route($action['route'], $item['id']) }}" class="btn btn-{{ $action['class'] }} btn-sm">
                                        <i class="{{ $action['icon'] }}"></i> {{ $action['label'] }}
                                    </a>
                                @endif
                            @endforeach
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination Links (Show only if $data is paginated) -->
    @if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-3">
            {{ $data->links() }}
        </div>
    @endif
</div>
