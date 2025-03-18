<?php
echo "<link rel='stylesheet' href='./css/admin/select2.css' />";
?>
<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>



    <x-slot name="cardTitle">


        <div class="d-flex align-items-end justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="mt-2">
                    <a href="{{ route('admin.customer.create') }}" class="btn btn-primary buttons">
                        <img class="imgs" src="assets/images/Vector.png">
                        Add Users
                    </a>
                </div>
            </div>
        </div>





        <x-slot name="cardTitle">
            <p class="head">All Users</p>
            <div class="usersearch d-flex">
                <div class="top-nav-search" style="width:191px; height:33px">
                    <form>
                        <input type="text" class="form-control" style="width:157px; height:31px;margin-left:30px;"
                            placeholder="Search">

                    </form>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-primary refeshuser "><a class="btn-filters"
                            href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Refresh"><span><i class="fe fe-refresh-ccw"></i></span></a></button>
                </div>
            </div>
        </x-slot>
        <div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive mt-3">

                        <table class="table tables table-stripped table-hover datatable ">
                            <thead class="thead-light">

                                <tr>
                                    <th>Sn no.</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Warehouse</th>
                                    <th>Container No.</th>
                                    <th>License_ID</th>
                                    <th>phone</th>
                                    <th>present address</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $index => $customer)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>
                                  <h2 {{-- class="table-avatar" --}}>
                                <a href="{{ route('admin.customer.show', $customer->id) }}"
                                    class="avatar avatar-sm me-2">
                                    @if ($customer->profile_pic)
                                    <img class="avatar-img rounded-circle"
                                        src="{{ asset($customer->profile_pic) }}" alt="license">
                                    @else
                                    <p>No Image</p>
                                 @endif
                                </a>
                                </h2>
                                </td>
                                <td>{{ ucfirst($customer->name ?? '') }}</td>
                                <td>{{ $customer->email ?? '-' }}</td>
                                <td>{{ $customer->warehouse->warehouse_name ?? '-' }}</td>
                                <td>-</td>
                                <td>{{ $customer->license_number ?? '-' }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td>{{ $customer->address ?? '-' }}</td>
                                <td><span class="badge {{$customer->status=='Active' ? 'bg-success-light':'bg-danger-light'}}">{{$customer->status ?? '-'}}</span>
                                <td class="text-end">

                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.customer.edit', $customer->id).'?page='.request()->page ?? 1 }}">
                                                <i class="far fa-edit me-2"></i>Update
                                            </a>
                                            {{-- <a class="dropdown-item" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#delete_modal"
                                                        data-id="{{ $customer->id }}">
                                                        <i class="far fa-trash-alt me-2"></i>Delete
                                                    </a> --}}
                                            <a class="dropdown-item"
                                                href="{{ route('admin.customer.show', $customer->id) }}">
                                                <i class="far fa-eye me-2"></i>View
                                            </a>
                                        </div>
                                    </div>

                                </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">No users found.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>

                            </table>

                            <div class="bottom-user-page mt-3">
                                {!! $customers->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Items Modal -->
            <div class="modal custom-modal fade" id="delete_modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-body confirmationpopup">
                            <div class="form-header">
                                <p class="popupc">Do you want to delete this customer?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" data-bs-dismiss="modal"
                                            class="w-100 btn btn-outline-primary custom-btn">Cancel</button>
                                    </div>
                                    <div class="col-6">
                                        <!-- 🛑 Delete Button - API Call Karega -->
                                        <button type="button" class="w-100 btn btn-primary paid-continue-btn customerpopup"
                                            id="confirmDelete">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Delete Items Modal -->
            @section('script')
            @endsection
    </x-app-layout>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let deleteId = null;

            // 🔹 Delete button click par modal open hone se pehle ID store kare
            document.querySelectorAll('[data-bs-target="#delete_modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    deleteId = this.getAttribute('data-id'); // User ID ko store kare
                    console.log("Selected ID:", deleteId); // Debug ke liye
                });
            });

            // 🔹 Delete Confirm Button par API call kare
            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (deleteId) {
                    fetch(`/delete-customers/${deleteId}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Good job!",
                                    text: "Customer deleted successfully",
                                    icon: "success"
                                });

                                setTimeout(function() {
                                    location.reload(); // 2 second ke baad page refresh karega
                                }, 2000);

                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
