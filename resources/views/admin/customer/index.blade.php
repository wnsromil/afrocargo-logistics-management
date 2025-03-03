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
                    <a href="#" class="btn btn-primary buttons">
                    <img class="imgs"src="assets/images/Vector.png">  
                    Add Users
                    </a>
                </div>
            </div>
        </div>
    
  
  
  
  
    <x-slot name="cardTitle" >
       <p class="head">All Users</p>
       <div class="usersearch d-flex">
                <div class="top-nav-search" style="width:191px; height:33px">
                    <form >
                        <input type="text" class="form-control" style="width:157px; height:31px;margin-left:30px;" placeholder="Search">

                    </form>
                </div>
                <div class="mt-2">
                <button type="button" class="btn btn-primary refeshuser " ><a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip"
											data-bs-placement="bottom" title="Refresh"><span><i
													class="fe fe-refresh-ccw"></i></span></a></button>
                </div>
            </div>
    </x-slot>
    <div>
        <div class="card-table">
            <div class="card-body">
                <div class="table-responsive mt-3">

                    <table class="table table-stripped table-hover datatable ">
                        <thead class="thead-light">
                            <tr>
                                <th>Sn no.</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>present address</th>
                                <th>Status</th>
                                <th>phone</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $index => $customer)
                            <tr class="fontstyle">
                                <td>
                                    {{ ++$index }}
                                </td>
                                <td>
                                    <h2 {{--class="table-avatar"--}}>
                                        <a href="profile.html" class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle"
                                                src="assets/img/profiles/Image.png" alt="User Image">
                                        </a>
                                    </h2>
                                </td>

                                <td>{{ ucfirst($customer->name ?? '')}}</td>
                                <td><span>{{$customer->email ?? '-'}}</span></td>

                                <td><span>{{$customer->phone ?? '-'}}</span></td>

                                <td>{{$customer->address ?? '-'}}</td>
                                <td><span class="badge bg-success-light">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.4331 0C12.8051 0 13.9251 1.0759 13.9965 2.4304L14 2.5669V11.4331C14 12.8051 12.9241 13.9251 11.5696 13.9965L11.4331 14H2.5669C1.90972 14 1.27756 13.748 0.800663 13.2959C0.323762 12.8437 0.0384468 12.2258 0.00350008 11.5696L0 11.4331V2.5669C0 1.1949 1.0759 0.0749001 2.4304 0.00350008L2.5669 0H11.4331ZM9.5949 5.1051C9.46363 4.97387 9.28561 4.90015 9.1 4.90015C8.91438 4.90015 8.73637 4.97387 8.6051 5.1051L6.3 7.4095L5.3949 6.5051L5.3291 6.447C5.18841 6.33821 5.01158 6.28706 4.83453 6.30392C4.65749 6.32079 4.4935 6.40441 4.37587 6.53781C4.25825 6.6712 4.19581 6.84437 4.20124 7.02213C4.20667 7.1999 4.27956 7.36893 4.4051 7.4949L5.8051 8.8949L5.8709 8.953C6.00558 9.05748 6.17376 9.10922 6.34388 9.09852C6.514 9.08782 6.67436 9.01542 6.7949 8.8949L9.5949 6.0949L9.653 6.0291C9.75748 5.89442 9.80922 5.72624 9.79852 5.55612C9.78782 5.386 9.71542 5.22564 9.5949 5.1051Z" fill="#0FD354"/>
</svg>
                                {{$customer->status ?? '-'}}</span>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                            </tr>
                            @endforelse

                            <tr class="fontstyle">
                                <td>
                                    {{ ++$index }}
                                </td>
                                <td>
                                    <h2 {{--class="table-avatar"--}}>
                                        <a href="profile.html" class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle"
                                                src="assets/img/profiles/Image.png" alt="User Image">
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