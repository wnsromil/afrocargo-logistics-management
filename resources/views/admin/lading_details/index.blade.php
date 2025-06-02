<x-app-layout>
    <x-slot name="header">
        {{ __('Bill of Lading Detail') }}
    </x-slot>


    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                <a href="{{ route('admin.lading_details.create') }}" class="btn btn-primary buttons">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Shipper/Consignee
                    </div>
                </a>
            </div>
        </div>
    </div>


    <x-slot name="cardTitle">
        <p class="head fw-semibold fs-4">Bill of Lading Detail</p>
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
                                <th class="fw-semibold fs_14 text-start px-3 maxmax-width text-truncate">Consignee Name
                                </th>
                                <th class="fs_14 fw-semibold text-start px-3 maxmax-width text-truncate">Consignee
                                    Address</th>
                                <th class="fs_14 fw-semibold text-start px-3 maxmax-width text-truncate">Consignee
                                    Telephone</th>
                                <th class="fs_14 fw-semibold text-start px-3 maxmax-width text-truncate">Shipper Name
                                </th>
                                <th class="fs_14 fw-semibold text-start px-3 maxmax-width text-truncate">Shipper Address
                                </th>
                                <th class="fs_14 fw-semibold text-start px-3 maxmax-width text-truncate">Shipper
                                    Telephone</th>
                                <th
                                    class="fs_14 fw-semibold text-start px-3 maxmax-width text-truncate  bg-transparent table-last-column">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="cardFontSize">
                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    Harouan</td>
                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    Rue 17 Avenue 21</td>
                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    +225 07 07 0707</td>
                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    Sacko</td>
                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Rue 17 Avenue 21">366 Concord Ave</p>
                                </td>
                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    +1 646-468-4135</td>

                                <td
                                    class="cardFontSize text-dark text-start border-dark px-3 maxmax-width text-truncate">
                                    <div class="d-flex">
                                        <a href="#"><i class="far fa-edit me-2"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#delete_modal"><i class="far fa-trash-alt ms-1"></i></a>
                                    </div>
                                </td>

                                <!-- <td class="cardFontSize text-dark border-dark">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                        <i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td> -->
                            </tr>
                            <tr>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate">Harouan</td>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate">Rue 17 Avenue 21
                                </td>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate">+225 07 07 0707</td>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate">Sacko</td>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate text-truncate">
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="36 rio town 17 Avenue 21">366 Concord Ave</p>
                                </td>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate text-truncate">+1
                                    646-468-4135</td>
                                <td class="cardFontSize text-start px-3 maxmax-width text-truncate text-dark px-0">
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