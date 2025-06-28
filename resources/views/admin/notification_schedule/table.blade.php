<div class="card-table">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-stripped table-hover datatable">
                <thead class="thead-light">
                    <tr>
                        <th>Sn no.</th>
                        <th>Notification ID</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Notification For</th>
                        <th>Date/Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $index => $notification)
                        <tr class="alignt">
                            <td>{{ $serialStart + $index + 1 }}</td>
                            <td>{{ $notification->unique_id ?? '-' }}</td>
                            <td>{{ $notification->title }}</td>
                            <td>{{ $notification->message }}</td>
                            <td>{{ $notification->notification_for }}</td>
                            <td>{{ \Carbon\Carbon::parse($notification->notification_datetime)->format('d-m-Y h:i A') }}
                            </td>
                            <td>
                                <div class="container">
                                    <img src="{{ asset('assets/img/checkbox.png') }}">
                                    {{ $notification->status }}
                                </div>
                            </td>
                            <td>
                                <div class="dropdown dropdown-action container">
                                    <a href="#" class="btn-action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul>
                                            <li>
                                                <form
                                                    action="{{ route('admin.notification_schedule.destroy', $notification->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="dropdown-item"
                                                        onclick="deleteData(this,'Wait! Are you sure you want to remove this notification?')"><i
                                                            class="far fa-trash-alt me-2"></i>Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
<div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
    <div class="col-md-6 d-flex p-2 align-items-center">
        <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
        <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example"
            id="pageSizeSelect">
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
        </select>
        <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
    </div>
    <div class="col-md-6">
        <div class="float-end">
            <div class="bottom-user-page mt-3">
                {!! $notifications->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>