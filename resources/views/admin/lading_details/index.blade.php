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
                        Add New Bill
                    </div>
                </a>
            </div>
        </div>
    </div>


    <x-slot name="cardTitle">
        <p class="head">Bill of Lading Detail</p>
        <div class="usersearch d-flex usersserach">

            <div class="top-nav-search">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control forms" placeholder="Search" id="searchInput" name="search" value="">
                        {{-- <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button> --}}
                    </div>
                </form>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser d-flex justify-content-center align-items-center">
                    <a class="btn-filters d-flex justify-content-center align-items-center" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                        <span><i class="fe fe-refresh-ccw"></i></span>
                    </a>
                </button>
            </div>
        </div>

    </x-slot>


    <div id='ajexTable'>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Bill Id </th>
                                <th>Consignee Name </th>
                                <th>Consignee Address</th>
                                <th>Consignee Telephone</th>
                                <th>Shipper Name </th>
                                <th>Shipper Address </th>
                                <th>Shipper Telephone</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BLD-000001</td>
                                <td>Harouan</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="Rue 17 Avenue 21">Rue 17 Avenue 21</p>
                                </td>
                                <td>+225 07070707</td>
                                <td>Sacko</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="366 Concord Ave">366 Concord Ave</p>
                                </td>
                                <td> +1 6464684135</td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" {{ route('admin.lading_details.create') }}>
                                                        <i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                        <i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>BLD-000002</td>
                                <td>Rinne Agula</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="366, crown Markham Tulsa, Oklahoma USA">366, crown Markham Tulsa, Oklahoma USA</p>
                                </td>
                                <td>+225 121554552</td>
                                <td>Lucas Hobala</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="36 rio town 17 Avenue 21">366 Concord Ave</p>
                                </td>
                                <td>+1 6464682221</td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                        <i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                <<<<<<< Updated upstream <td class="cardFontSize text-start px-3 maxmax-width text-truncate text-truncate">+1
                                    646-468-4135</td>
                                    <td class="cardFontSize text-start px-3 maxmax-width text-truncate text-dark px-0">
                                        <div class="d-flex">
                                            <a href="{{ route('admin.lading_details.create') }}"><i class="far fa-edit me-2"></i></a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt ms-1"></i></a>
                                            =======
                            </tr>
                            <tr>
                                <td>BLD-000003</td>
                                <td>Lawrence Vitory</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="21, Cupa Doco farms, Old Verginia, Ohio">21, Cupa Doco farms, Old Verginia, Ohio</p>
                                </td>
                                <td>+1 2215456958</td>
                                <td>Huge Jackmen</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="36 rio town 17 Avenue 21">32B, Sunbun Arena, Mukuyoma, Lihano</p>
                                </td>
                                <td>+1 2215554746</td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                        <i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                        >>>>>>> Stashed changes
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <!-- <div class="mb-3">
                            <i class="bi bi-exclamation-circle" style="font-size: 48px; color: orange;"></i>
                        </div> -->
                    <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                        <div class="swal2-icon-content">!</div>
                    </div>
                    <h4 class="fw-bold mb-2">Are you sure?</h4>
                    <p class="mb-4 fs_18">You won't be able to revert this!</p>
                    <button type="button" class="btn btn-danger me-2 rounded-1">Yes, delete it!</button>
                    <button type="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.activate, .deactivate').on('click', function() {
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: "{{ route('admin.vehicle.status', '') }}/" + id
                , type: 'POST'
                , data: {
                    _token: '{{ csrf_token() }}'
                    , status: status
                }
                , success: function(response) {
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
