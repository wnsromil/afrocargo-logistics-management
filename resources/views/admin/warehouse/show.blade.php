<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Warehouse Details') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <h6 class=subhead>Warehouse Details</h6>
    </x-slot>
    <section class="mt-4">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Name</h6>
                    <p>Invio Cargo</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Code</h6>
                    <p>WH-001</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Contact No.</h6>
                    <p>+1 15541 54544</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Address</h6>
                    <p>22 Junior Avenue California, LA 30097</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Status</h6>
                    <p>Inactive</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
