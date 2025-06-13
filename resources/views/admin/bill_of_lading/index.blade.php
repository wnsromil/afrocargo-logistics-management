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
        <p class="head">Bill of Lading</p>
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
                                <th>Bill Id</th>
                                <th>Type</th>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Telephone</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>TBL-000002</td>
                                <td>Consignee</td>
                                <td>Ivoirien Cargo</td>
                                <td>Harouan</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="Rue 17 Avenue 21">Rue 17 Avenue 21</p>
                                </td>
                                <td>+225 0707070707 <br> +1 464 08 08 0123
                                </td>
                                <td>SinSinati</td>

                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>TBL-000001</td>
                                <td>Shipper</td>
                                <td>Ivoirien Cargo</td>
                                <td>Jack Sperrow</td>
                                <td>
                                    <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top" title="36 rio town 17 Avenue 21">36 rio town 17 Avenue 21</p>
                                </td>
                                <td>+1 0707070707 <br> +1 464 08 08 0123</td>
                                <td>Abidjan</td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class=" btn-action-icon fas" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="far fa-edit me-2"></i>Update</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
