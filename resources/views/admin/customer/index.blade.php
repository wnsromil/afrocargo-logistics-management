<?php
   echo "<link rel='stylesheet' href='./css/admin/select2.css' />";
?>
<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <x-slot name="cardTitle">
        All Users

        <div class="d-flex align-items-end justify-content-end mb-1">
            <div class="usersearch d-flex">
                <div class="top-nav-search" >
                    <form>
                        <input type="text" class="form-control" style="width:250px; margin-left:60px;" placeholder="Search">

                    </form>
                </div>
                <div class="mt-2">
                    <button type="button" class="btn btn-dark refeshuser" style="border-radius:0px; padding:5px;"><img src="assets/images/refesh.svg"
                         style="width:25px;" alt=""></button>
                </div>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-stripped table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Sn no.</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>present address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                            <tr>
                                <td>
                                    {{ ++$index }}
                                </td>
                                <td>
                                    <h2 {{--class="table-avatar"--}}>
                                        <a href="profile.html" class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle"
                                                src="assets/img/profiles/avatar-14.jpg" alt="User Image">
                                        </a>
                                    </h2>
                                </td>

                                <td>{{ ucfirst($customer->name ?? '')}}</td>
                                <td><span>{{$customer->email ?? '-'}}</span></td>

                                <td><span>{{$customer->phone ?? '-'}}</span></td>

                                <td>{{$customer->address ?? '-'}}</td>
                                <td><span class="badge bg-success-light">{{$customer->status ?? '-'}}</span>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">No users found.</td>
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
    @section('script')
        
    @endsection
</x-app-layout>