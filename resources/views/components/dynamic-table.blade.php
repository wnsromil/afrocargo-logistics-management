@props([
    'items' => [],
    'columns' => [],
    'actions' => [],
    'pagination' => null,
    'emptyMessage' => 'No records found.',
    'perPageOptions' => [10, 20, 50, 100],
    'currentPerPage' => 10,
])

<div class="card-table">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        @foreach($columns as $column)
                            <th>{{ $column['label'] }}</th>
                        @endforeach
                        @if(count($actions) > 0)
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            @foreach($columns as $column)
                                <td>
                                    @if(isset($column['format']) && $column['format'] === 'html')
                                        {!! $column['value']($item) !!}
                                    @elseif(isset($column['value']))
                                        {{ $column['value']($item) }}
                                    @else
                                        {{ data_get($item, $column['key']) ?? '-' }}
                                    @endif
                                </td>
                            @endforeach
                            
                            @if(count($actions) > 0)
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                @foreach($actions as $action)
                                                    @if(!isset($action['condition']) || $action['condition']($item))
                                                        <li>
                                                            <a class="dropdown-item {{ $action['class'] ?? '' }}" 
                                                               href="{{ $action['url']($item) }}"
                                                               @foreach($action['attributes'] ?? [] as $attr => $value)
                                                                   {{ $attr }}="{{ $value }}"
                                                               @endforeach
                                                            >
                                                                @if(isset($action['icon']))
                                                                    <i class="{{ $action['icon'] }} me-2"></i>
                                                                @endif
                                                                {{ $action['label'] }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + (count($actions) > 0 ? 1 : 0) }}" class="px-4 py-4 text-center text-gray-500">
                                {{ $emptyMessage }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($pagination)
    <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
        <div class="col-md-6 d-flex p-2 align-items-center">
            <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
            <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example" id="pageSizeSelect">
                @foreach($perPageOptions as $option)
                    <option value="{{ $option }}" {{ $currentPerPage == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
        </div>
        <div class="col-md-6">
            <div class="float-end">
                <div class="bottom-user-page mt-3">
                    {!! $pagination->appends(['per_page' => request('per_page', $currentPerPage)])->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endif