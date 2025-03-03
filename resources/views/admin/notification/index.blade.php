<x-app-layout>
    <x-slot name="header">
        {{ __('Notifications') }}
    </x-slot>

    <div class="nav">
        <nav class="navbar navbar-expand-lg">
            <div>
                <h4 class="text-dark textSize mainFontFamily">Notifications</h4>
            </div>
        </nav>

    </div>
    <div class=" float-end mt-2 me-3">
        <button class="btn btnColor font-weight-2 fw-light" type="button"><i
                class="fa-solid fa-check pe-2 iconSize"></i>Mark as Read</button>
    </div>

    <!-- ---------------------- msg ---------------------------------- -->

    <!-- ----------------  1  -------------------------- -->
    <div class="mainFontFamily fixContainer text-dark">

        <div class="shadow-box fontSize innerCards setTopBottomMargin">
            <div class="">
                <div class="d-flex innerContainer">
                    <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                        style="font-size:7.46px;"></i>

                    <div class="float-end ps-3 mainFontFamily">
                        <p class="fw-medium mb-1 ">
                            Order 2 Reached
                        </p>
                        <p class="card-text fw-regular">Your order has been reached to it's destination.</p>
                        <p class="opacity-50">Today at 9:42AM</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- --------------------------  2 --------------------------- -->
        <div class="shadow-box fontSize innerCards setTopBottomMargin">

            <div class="d-flex innerContainer">
                <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                    style="font-size:7.46px;"></i>
                <div class="float-end ps-3">

                    <p class="fw-medium mainFontFamily mb-1">
                        Pickup Request 1
                    </p>
                    <p class="card-text mainFontFamily">You have received a new pickup request from John Doe. The pickup
                        location is 123 Main Street, Los Angeles, CA 90001, USA.</p>
                    <p class="opacity-50 mainFontFamily">Today at 9:42AM</p>
                </div>
            </div>
        </div>
        <!-- ------------------------  3  --------------------------------- -->

        <div class="shadow-box fontSize innerCards setTopBottomMargin">
            <div class="">
                <div class="d-flex innerContainer">
                    <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                        style="font-size:7.46px;"></i>
                    <div class="float-end ps-3">

                        <p class="fw-medium mb-1">
                            Order 4 Reached
                        </p>
                        <p class="card-text">Your order has successfully reached to its destination. The delivery was
                            made to John Doe at 123 Main Street, Los Angeles, CA 90001, USA.
                        </p>
                        <p class="opacity-50">Today at 9:42AM</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ---------------------------  4  --------------------------- -->
        <div class="shadow-box fontSize innerCards setTopBottomMargin">
            <div class="">
                <div class="d-flex innerContainer">
                    <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                        style="font-size:7.46px;"></i>
                    <div class="float-end ps-3">

                        <p class="fw-medium mb-1">
                            Pickup Request 3
                        </p>
                        <p class="card-text">You have received a new pickup request from John Doe. The pickup location
                            is 123 Main Street, Los Angeles, CA 90001, USA.</p>
                        <p class="opacity-50">Today at 9:42AM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- --------------------------  5  --------------------------------- -->

        <div class="shadow-box fontSize innerCards setTopBottomMargin">
            <div class="">
                <div class="d-flex innerContainer">
                    <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                        style="font-size:7.46px;"></i>
                    <div class="float-end ps-3">

                        <p class="fw-medium mb-1">
                            Order 4 Reached
                        </p>
                        <p class="card-text">Your order has successfully reached to its destination. The delivery was
                            made to John Doe at 123 Main Street, Los Angeles, CA 90001, USA.</p>
                        <p class="opacity-50">Today at 9:42AM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ------------------------  6  ------------------------------------ -->

        <div class="shadow-box fontSize mt-4 innerCards setTopBottomMargin">
            <div class="">
                <div class="d-flex innerContainer">
                    <i class="fa fa-circle text-success float-start mt-2" data-bs-toggle="tooltip" title="fa fa-circle"
                        style="font-size:7.46px;"></i>

                    <div class="float-end ps-3">
                        <p class="fw-medium mb-1">
                            Pickup Request 3
                        </p>
                        <p class="card-text">You have received a new pickup request from John Doe. The pickup location
                            is 123 Main Street, Los Angeles, CA 90001, USA.</p>
                        <p class="opacity-50">Today at 9:42AM</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- --------------------------------------------------------------------------------------------------- -->


    <!-- <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Roles</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $user)
                <tr>
                    <td class="text-center text-muted">{{ ++$key }}</td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                        <label class="badge bg-success">{{ $v }}</label>
                        @endforeach
                    @endif
                    </td>
                    <td class="text-center">
                      
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
    {!! $data->links('pagination::bootstrap-5') !!}

    @section('script')
        
    @endsection -->




</x-app-layout>