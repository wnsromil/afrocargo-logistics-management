<x-app-layout>
    <x-slot name="header">
        {{ __('Bill of Lading Detail') }}
    </x-slot>


    <div class="d-flex align-items-center justify-content-end mb-1">
        <div class="usersearch d-flex">
            <div class="mt-2">
                @can('has-dynamic-permission', 'bill_of_landing_details_list.create')
                    <a href="{{ route('admin.lading_details.create') }}" class="btn btn-primary buttons">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle-plus me-2 text-white"></i>
                            Add New Bill
                        </div>
                    </a>
                @endcan
            </div>
        </div>
    </div>


    <x-slot name="cardTitle">
        <p class="head">Bill of Lading Detail</p>
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
        @include("admin.lading_details.table")
    </div>
</x-app-layout>