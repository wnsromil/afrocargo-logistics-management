<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Detail') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Inventory ID - TIT-000009</p>
    </x-slot>

    <section class="mt-4">
        <div class="row px-4">

            <div class="col-md-12 col-sm-12 mb-4 d-flex align-items-center mb-4 text-dark">
                <img src="/assets/img/products/washing_machine.webp" alt="Washing Machine"
                    class="inventory-img">
                <div>
                    <h5 class="label fw-semibold fs_18">Inventory Name</h5>
                    <p class="fs_18">Washing Machine</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Inventory Type</h6>
                    <p>Air</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Barcode Code</h6>
                    <p>Yes</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Name</h6>
                    <p>Tulsa Cargo</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Created At</h6>
                    <p>05-18-2025, 12:20 AM</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Cost Price</h6>
                    <p>-</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Quality</h6>
                    <p>25</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Low Stock Warning</h6>
                    <p>02</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Package Type</h6>
                    <p>Imported</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Retail/Shipping Price</h6>
                    <p>120.00</p>
                </div>
            </div>
            <div class="col-md-8 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Description</h6>
                    <p class="pe-5">Fully automatic and 7.2 ltr and Get water instict Lorem ipsum curen stock clearence full metalic
                        body, high power motor</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Default Driver App</h6>
                    <p>Yes</p>
                </div>
            </div>
        </div>

        <hr>

        <div class="row px-4">
             <div class="col-md-12 col-sm-12 mb-4 mb-2">
                    <div class="cargo-title text-dark">Ocean Cargo/Air Cargo</div>
                </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Country</h6>
                    <p>Yes</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>State/Zone</h6>
                    <p>100</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Weight (kg)</h6>
                    <p>20</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Item Length (inch)</h6>
                    <p>8.00</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Item Width (inch)</h6>
                    <p>12.00</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Item Height (inch)</h6>
                    <p>18.00</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Volume (l*b*h)</h6>
                    <p>1536.00</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Volume Price(1*1*1)</h6>
                    <p>11.00</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Factor</h6>
                    <p>5000</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Insurance</h6>
                    <p>2500.00</p>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>