<x-app-layout>
    <x-slot name="header">
        {{ __('Bill of Lading') }}
    </x-slot>


    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.bill_of_lading.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Shipper/Consignee
                    </div>
                </a>
            </div>
        </div>
    </div>


    <x-slot name="cardTitle">
        <p class="head fw-semibold fs-4">Bill of Lading</p>
        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="searchInput"
                            name="search" value="">
                        {{-- <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button> --}}
                    </div>
                </form>
            </div>
            <div class="mt-2">
                <button type="button"
                    class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>

    </x-slot>


    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive table-height border border-dark mt-3">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light border-bottom border-dark">
                            <tr>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">#</th>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">Type</th>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">Company</th>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">Name</th>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">Address</th>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">Telephone</th>
                                <th class="fs_14 fw-semibold maxmax-width text-truncate">City</th>
                                <th
                                    class="fs_14 fw-semibold maxmax-width text-truncate bg-transparent table-last-column">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cardFontSize border-dark">
                                <td class="cardFontSize text-dark border-dark">TBL-000002</td>
                                <td class="cardFontSize text-dark border-dark">Consignee</td>
                                <td class="cardFontSize text-dark border-dark">Ivoirien Cargo</td>
                                <td class="cardFontSize text-dark border-dark">Harouan</td>
                                <td class="cardFontSize text-dark border-dark">
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Rue 17 Avenue 21">Rue 17 Avenue 21</p>
                                </td>
                                <td class="cardFontSize text-dark border-dark">+225 0707070707 <br> +1 464 08 08 0123
                                </td>
                                <td class="cardFontSize text-dark border-dark">SinSinati</td>

                                <td class="cardFontSize text-dark border-dark">
                                    <div class="d-flex">
                                        <a href="#"><i class="far fa-edit me-2"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal"><i class="far fa-trash-alt ms-1"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cardFontSize">TBL-000001</td>
                                <td class="cardFontSize">Shipper</td>
                                <td class="cardFontSize">Ivoirien Cargo</td>
                                <td class="cardFontSize">Jack Sperrow</td>
                                <td class="cardFontSize text-truncate">
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="36 rio town 17 Avenue 21">36 rio town 17 Avenue 21</p>
                                </td>
                                <td class="cardFontSize text-truncate">+1 0707070707 <br> +1 464 08 08 0123</td>
                                <td class="cardFontSize">Abidjan</td>
                                <td class="cardFontSize text-dark">
                                    <div class="d-flex">
                                        <a href="#"><i class="far fa-edit me-2"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal"><i class="far fa-trash-alt ms-1"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="row col-md-12 d-flex mt-4 p-2 input-box align-items-center">
            <div class="col-md-6 d-flex p-2 align-items-center">
                <h3 class="profileUpdateFont fw-medium me-2">Show</h3>
                <select class="form-select input-width form-select-sm opacity-50" aria-label="Small select example"
                    id="pageSizeSelect">
                    <option value="10" {{ request('per_page', 10)==10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page')==20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                </select>
                <h3 class="profileUpdateFont fw-medium ms-2">Entries</h3>
            </div>
            <div class="col-md-6">
                <div class="float-end">
                    <div class="bottom-user-page mt-3">
                        {!! $vehicles->appends(['per_page' => request('per_page')])->links('pagination::bootstrap-5')
                        !!}
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.activate, .deactivate').on('click', function () {
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: "{{ route('admin.vehicle.status', '') }}/" + id
                , type: 'POST'
                , data: {
                    _token: '{{ csrf_token() }}'
                    , status: status
                }
                , success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success'
                            , title: 'Status Updated'
                            , text: response.success
                        });

                        location.reload();
                    }
                }
            });
        });

    </script>
</x-app-layout>