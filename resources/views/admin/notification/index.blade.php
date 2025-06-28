<x-app-layout>
    <x-slot name="header">
        {{ __('Notifications') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Notifications</p>
        @php
            $notificationCount = auth()->user()->notification_read ?? 0;
        @endphp

        @if($notificationCount > 0)
            <div class="d-flex align-items-center justify-content-end mb-0">
                <div class="usersearch d-flex">
                    <div class="">
                        <button id="markAsReadBtn" class="btn btnColor font-weight-2 fw-light" type="button"><i
                                class="fa-solid fa-check pe-2 iconSize"></i>Mark as Read</button>
                    </div>
                </div>
            </div>
        @endif

    </x-slot>

    <div class="mainFontFamily text-dark">
        @forelse ($notifications as $notification)
            <div class="shadow-box fontSize innerCards setTopBottomMargin">
                <div class="">
                    <div class="d-flex innerContainer">
                        <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                            style="font-size:7.46px;"></i>

                        <div class="float-end ps-3 mainFontFamily">
                            <p class="fw-medium mb-1 ">
                                {{@$notification->title ?? '--'}}
                            </p>
                            <p class="card-text fw-regular">
                                {{@$notification->message ?? '--'}}
                            </p>
                            <p class="opacity-50">
                                {{$notification->created_at->diffForHumans() ?? '--'}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="fw-medium mb-1 ">
                No notification found!
            </p>
        @endforelse
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
    </div>

    @section('script')
        <script>
            document.getElementById("markAsReadBtn").addEventListener("click", function () {
                const userId = {{ auth()->id() }};

                fetch("{{ url('/api/mark-as-read-notification') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ user_id: userId })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                          window.location.reload();
                        }
                    })
                    .catch(err => {
                        console.error("API error:", err);
                    });
            });
        </script>

    @endsection
</x-app-layout>