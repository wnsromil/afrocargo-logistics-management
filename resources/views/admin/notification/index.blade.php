<x-app-layout>
    <x-slot name="header">
        {{ __('Notifications') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Notifications</p>

        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    <button class="btn btnColor font-weight-2 fw-light" type="button"><i
                class="fa-solid fa-check pe-2 iconSize"></i>Mark as Read</button>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- ---------------------- msg ---------------------------------- -->

    <!-- ----------------  1  -------------------------- -->
    <div class="mainFontFamily fixContainer text-dark">

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
                            {{@$notification->description ?? '--'}}
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