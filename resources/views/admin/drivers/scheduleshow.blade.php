<x-app-layout>
    @section('style')
        <style>
            .card.mainCardGlobal:before {
                display: none;
            }

            .card.mainCardGlobal>.card-body>.page-header {
                margin-bottom: -10px !important;
            }
            .card.mainCardGlobal.mb-0 .page-header .content-page-header {
    display: none;
}

        </style>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Schedule Availability') }}
        </h2>
    </x-slot>
    @section('content')
        <div class="content-page-header mb-4">
            <h5 class="setting-menu">Schedule Availability</h5>
        </div>
    @endsection

    <div class="text-end mt-n4">
        <a class="btn update btn-primary me-2" href="{{ route('admin.drivers.schedule', $user->id) }}"><i class="ti ti-edit"></i> Update
            Schedule</a>
    </div>
    <section>
        <div class="row align-items-center">
            <div class="col-md-12">
            <p class="subhead login-logo-font fw-semibold me-sm-5">Weekly Schedule</p>
            </div>
        </div>
    </section>
</x-app-layout>