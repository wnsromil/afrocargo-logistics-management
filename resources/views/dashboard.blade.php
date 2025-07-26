<x-app-layout>
    @section('style')
        <style>
            .card.mainCardGlobal:before {
                display: none;
            }
        </style>
        <style>
            .tab-btn.active {
                background-color: #007bff;
                color: white;
            }
            .custom-close {
                position: absolute;
                top: 10px;
                right: 10px;
              color: black !important;
            }
        </style>

    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-light">
            @php
                $role = auth()->user()->role;
                $roleTitle = match ($role) {
                    'admin' => 'Admin Dashboard',
                    'warehouse_manager' => 'Warehouse Manager Dashboard',
                    'customer' => 'Customer Dashboard',
                    'driver' => 'Driver Dashboard',
                    default => 'Dashboard',
                };
            @endphp
            {{ $roleTitle }}
        </h2>
    </x-slot>


    <div class="dashboardContent">
           @php
                $role_id = Auth::user()->role_id;
                $notificationRead = Auth::user()->notification_read;

                   $status = $notification->type ?? '';
                    $alertClass = 'alert-secondary'; // default

                    if (strpos($status, 'In transit') !== false) {
                        $alertClass = 'alert-primary'; // blue
                    } elseif (strpos($status, 'Custom Hold') !== false || strpos($status, 'Custom Hold') !== false) {
                        $alertClass = 'alert-warning'; // yellow/orange
                    } elseif (strpos($status, 'Custom Cleared') !== false || strpos($status, 'Custom Cleared') !== false) {
                        $alertClass = 'alert-success'; // green
                    }
            @endphp
            {{-- @if($notificationRead != 0)
            <div class="alert {{ $alertClass }} position-relative" role="alert">
                <h5 class="alert-heading">{{ $notification->title ?? "" }}</h5>
                <button type="button" id="closealerticon" class="btn-close custom-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <hr>
                <p>{{ $notification->message ?? "" }}</p>
            </div>
            @endif --}}
        <div class="row">
            @if($role_id == 2 || $role_id == 4)
                {{-- ✅ Readonly Input for Single Warehouse --}}
                <div class="col-md-4 mb-3">
                    <label class="foncolor" for="warehouse"> Warehouse <i class="text-danger">*</i></label>
                    <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}" readonly
                        style="background-color: #e9ecef; color: #6c757d;">
                    <input type="hidden" name="warehouse" id="hiddenWarehouseId" value="{{ $warehouses[0]->id }}">
                </div>
            @else
                <div class="col-sm-4 mb-3">
                    <label class="foncolor" for="warehouse"> Warehouse </label>
                    <div class="d-flex align-items-center">
                        <select id="warehouse" class="js-example-basic-single select2 form-control" name="warehouse"
                            style="" value="{{ old('warehouse') }}">
                            <option value="">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ old('warehouse') == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->warehouse_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-outline-danger btnr ms-2" onclick="resetForm()">Reset</button>
                    </div>
                    @error('warehouse')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif
            <!-- <div class="d-flex justify-content-between align-items-center">
                        <div class="row"> -->
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-3 g-4 dash-gap">

                    <!-- First Row (4 Columns) -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">

                                <!-- <div class="dash-widget-header col-md-12 "> -->
                                <div class="col-md-9">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Today’s Orders</p>
                                        <div class="dash-counts countFontSize2" id="todays-orders">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="42" height="42" viewBox="0 0 44 44" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 11.5V32.5L19.6667 43V22M1 11.5L19.6667 1L38.3333 11.5M1 11.5L19.6667 22M38.3333 11.5V22M38.3333 11.5L19.6667 22M43 36H26.6667M26.6667 36L33.6667 29M26.6667 36L33.6667 43"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- --------- 2nd -------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Service Orders</p>
                                        <div class="dash-counts countFontSize2" id="total-orders">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end p-1 ps-3">
                                        <svg width="50" height="50" viewBox="0 0 52 52" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 29.75L13.5 37.25V51M1 29.75L13.5 22.25L26 29.75M1 29.75V43.5L13.5 51M26 29.75V43.5M26 29.75L38.5 37.25M26 29.75L38.5 22.25M26 29.75V16M26 43.5L13.5 51M26 43.5L38.5 51M13.5 37.3625L26 29.7875M38.5 37.25V51M38.5 37.25L51 29.75M38.5 22.25L51 29.75M38.5 22.25V8.5M51 29.75V43.5L38.5 51M26 16L13.5 8.5L26 1L38.5 8.5M26 16L38.5 8.5M13.5 8.57507V22.2126"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!--  ---------- 3rd --------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <h5 class="fontSize fw-medium text-dark">Ready for Shipping</h5>
                                        <div class="dash-counts countFontSize2" id="ready-for-shipping">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end ps-4">
                                        <svg width="45" height="45" viewBox="0 0 36 37" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 10.0625V26.9375L16 35.375V18.5M1 10.0625L16 1.625L31 10.0625M1 10.0625L16 18.5M31 10.0625V18.5M31 10.0625L16 18.5M21.625 29.75H34.75M34.75 29.75L29.125 24.125M34.75 29.75L29.125 35.375"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- -------------- 4th -------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">In Transit</p>
                                        <div class="dash-counts countFontSize2" id="in-transit">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="80" height="50" viewBox="0 0 65 44" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <path
                                                d="M31.0526 9.68421L45.5263 18.3684V34.2895M31.0526 9.68421L45.5263 1L60 9.68421V25.6053L45.5263 34.2895M31.0526 9.68421V25.6053L45.5263 34.2895M45.5263 18.4987L60 9.72767M19.4737 8.23684H5M19.4737 16.9211H10.7895M19.4737 25.6053H16.5789"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" shape-rendering="crispEdges" />

                                            <defs>
                                                <filter id="filter0_d_584_13544" x="0" y="0" width="80" height="50"
                                                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                        result="hardAlpha" />
                                                    <feOffset dy="4" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_584_13544" />
                                                    <feBlend mode="normal" in="SourceGraphic"
                                                        in2="effect1_dropShadow_584_13544" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>


                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontpize fw-medium">Delivered</p>
                                        <div class="dash-counts countFontSize2" id="total-delivered">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="41" height="47" viewBox="0 0 43 49" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.6143 44.7333H6.46667C5.01682 44.7333 3.62635 44.1574 2.60115 43.1322C1.57595 42.107 1 40.7165 1 39.2667V6.46667C1 5.01682 1.57595 3.62635 2.60115 2.60115C3.62635 1.57595 5.01682 1 6.46667 1H28.3333C29.7832 1 31.1737 1.57595 32.1988 2.60115C33.224 3.62635 33.8 5.01682 33.8 6.46667V28.3333M25.6 42L31.0667 47.4667L42 36.5333M11.9333 11.9333H22.8667M11.9333 22.8667H17.4"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- -------------- 6th-------------------- -->

                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Customers</p>
                                        <div class="dash-counts countFontSize2" id="total-customers">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="43" height="43" viewBox="0 0 45 45" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.9444 44V41.6111C12.9444 40.344 13.4478 39.1287 14.3438 38.2327C15.2398 37.3367 16.4551 36.8333 17.7222 36.8333H27.2778C28.5449 36.8333 29.7602 37.3367 30.6562 38.2327C31.5522 39.1287 32.0556 40.344 32.0556 41.6111V44M34.4444 17.7222H39.2222C40.4894 17.7222 41.7046 18.2256 42.6006 19.1216C43.4966 20.0176 44 21.2329 44 22.5V24.8889M1 24.8889V22.5C1 21.2329 1.50337 20.0176 2.39938 19.1216C3.29539 18.2256 4.51063 17.7222 5.77778 17.7222H10.5556M17.7222 24.8889C17.7222 26.156 18.2256 27.3713 19.1216 28.2673C20.0176 29.1633 21.2329 29.6667 22.5 29.6667C23.7671 29.6667 24.9824 29.1633 25.8784 28.2673C26.7744 27.3713 27.2778 26.156 27.2778 24.8889C27.2778 23.6217 26.7744 22.4065 25.8784 21.5105C24.9824 20.6145 23.7671 20.1111 22.5 20.1111C21.2329 20.1111 20.0176 20.6145 19.1216 21.5105C18.2256 22.4065 17.7222 23.6217 17.7222 24.8889ZM29.6667 5.77778C29.6667 7.04492 30.17 8.26017 31.066 9.15618C31.9621 10.0522 33.1773 10.5556 34.4444 10.5556C35.7116 10.5556 36.9268 10.0522 37.8228 9.15618C38.7188 8.26017 39.2222 7.04492 39.2222 5.77778C39.2222 4.51063 38.7188 3.29539 37.8228 2.39938C36.9268 1.50337 35.7116 1 34.4444 1C33.1773 1 31.9621 1.50337 31.066 2.39938C30.17 3.29539 29.6667 4.51063 29.6667 5.77778ZM5.77778 5.77778C5.77778 7.04492 6.28115 8.26017 7.17716 9.15618C8.07316 10.0522 9.28841 10.5556 10.5556 10.5556C11.8227 10.5556 13.0379 10.0522 13.934 9.15618C14.83 8.26017 15.3333 7.04492 15.3333 5.77778C15.3333 4.51063 14.83 3.29539 13.934 2.39938C13.0379 1.50337 11.8227 1 10.5556 1C9.28841 1 8.07316 1.50337 7.17716 2.39938C6.28115 3.29539 5.77778 4.51063 5.77778 5.77778Z"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- ---------------- 7th ------------ -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">New Customers</p>
                                        <div class="dash-counts countFontSize2" id="new-customers">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="34.03" height="41.39" viewBox="0 0 37 44" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 39.2052V34.9601C1 32.7084 1.89448 30.549 3.48667 28.9568C5.07886 27.3646 7.23834 26.4701 9.49004 26.4701H14.7963M28.5947 39.2052C27.4688 39.2052 26.3891 38.7579 25.593 37.9618C24.7969 37.1657 24.3497 36.086 24.3497 34.9601C24.3497 33.8343 24.7969 32.7546 25.593 31.9585C26.3891 31.1624 27.4688 30.7151 28.5947 30.7151M28.5947 39.2052C29.7205 39.2052 30.8003 38.7579 31.5964 37.9618C32.3925 37.1657 32.8397 36.086 32.8397 34.9601C32.8397 33.8343 32.3925 32.7546 31.5964 31.9585C30.8003 31.1624 29.7205 30.7151 28.5947 30.7151M28.5947 39.2052V42.3889M28.5947 30.7151V27.5314M35.0279 31.2458L32.2707 32.8376M24.9206 37.0827L22.1614 38.6745M22.1614 31.2458L24.9206 32.8376M32.2707 37.0827L35.03 38.6745M5.24502 9.49004C5.24502 11.7417 6.1395 13.9012 7.73169 15.4934C9.32388 17.0856 11.4834 17.9801 13.7351 17.9801C15.9868 17.9801 18.1462 17.0856 19.7384 15.4934C21.3306 13.9012 22.2251 11.7417 22.2251 9.49004C22.2251 7.23834 21.3306 5.07886 19.7384 3.48667C18.1462 1.89448 15.9868 1 13.7351 1C11.4834 1 9.32388 1.89448 7.73169 3.48667C6.1395 5.07886 5.24502 7.23834 5.24502 9.49004Z"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>


                    <!-- --------------------- 8th ----------------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Drivers</p>
                                        <div class="dash-counts countFontSize2" id="total-drivers">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="24" height="48" viewBox="0 0 26 50" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4 40C4 41.1819 4.23279 42.3522 4.68508 43.4442C5.13738 44.5361 5.80031 45.5282 6.63604 46.364C7.47177 47.1997 8.46392 47.8626 9.55585 48.3149C10.6478 48.7672 11.8181 49 13 49C14.1819 49 15.3522 48.7672 16.4442 48.3149C17.5361 47.8626 18.5282 47.1997 19.364 46.364C20.1997 45.5282 20.8626 44.5361 21.3149 43.4442C21.7672 42.3522 22 41.1819 22 40C22 38.8181 21.7672 37.6478 21.3149 36.5558C20.8626 35.4639 20.1997 34.4718 19.364 33.636C18.5282 32.8003 17.5361 32.1374 16.4442 31.6851C15.3522 31.2328 14.1819 31 13 31C11.8181 31 10.6478 31.2328 9.55585 31.6851C8.46392 32.1374 7.47177 32.8003 6.63604 33.636C5.80031 34.4718 5.13738 35.4639 4.68508 36.5558C4.23279 37.6478 4 38.8181 4 40Z"
                                                fill="white" />
                                            <path
                                                d="M11 40C11 40.5304 11.2107 41.0391 11.5858 41.4142C11.9609 41.7893 12.4696 42 13 42C13.5304 42 14.0391 41.7893 14.4142 41.4142C14.7893 41.0391 15 40.5304 15 40C15 39.4696 14.7893 38.9609 14.4142 38.5858C14.0391 38.2107 13.5304 38 13 38C12.4696 38 11.9609 38.2107 11.5858 38.5858C11.2107 38.9609 11 39.4696 11 40Z"
                                                fill="white" />
                                            <path d="M13 42V49V42Z" fill="white" />
                                            <path d="M11 40L4.25 38L11 40Z" fill="white" />
                                            <path d="M15 40L21.75 38L15 40Z" fill="white" />
                                            <path
                                                d="M1 37V33C1 30.8783 1.84285 28.8434 3.34315 27.3431C4.84344 25.8429 6.87827 25 9 25H17C19.1217 25 21.1566 25.8429 22.6569 27.3431C24.1571 28.8434 25 30.8783 25 33V37M13 49C11.8181 49 10.6478 48.7672 9.55585 48.3149C8.46392 47.8626 7.47177 47.1997 6.63604 46.364C5.80031 45.5282 5.13738 44.5361 4.68508 43.4442C4.23279 42.3522 4 41.1819 4 40C4 38.8181 4.23279 37.6478 4.68508 36.5558C5.13738 35.4639 5.80031 34.4718 6.63604 33.636C7.47177 32.8003 8.46392 32.1374 9.55585 31.6851C10.6478 31.2328 11.8181 31 13 31C14.1819 31 15.3522 31.2328 16.4442 31.6851C17.5361 32.1374 18.5282 32.8003 19.364 33.636C20.1997 34.4718 20.8626 35.4639 21.3149 36.5558C21.7672 37.6478 22 38.8181 22 40C22 41.1819 21.7672 42.3522 21.3149 43.4442C20.8626 44.5361 20.1997 45.5282 19.364 46.364C18.5282 47.1997 17.5361 47.8626 16.4442 48.3149C15.3522 48.7672 14.1819 49 13 49ZM13 49V42M11 40C11 40.5304 11.2107 41.0391 11.5858 41.4142C11.9609 41.7893 12.4696 42 13 42M11 40C11 39.4696 11.2107 38.9609 11.5858 38.5858C11.9609 38.2107 12.4696 38 13 38C13.5304 38 14.0391 38.2107 14.4142 38.5858C14.7893 38.9609 15 39.4696 15 40M11 40L4.25 38M13 42C13.5304 42 14.0391 41.7893 14.4142 41.4142C14.7893 41.0391 15 40.5304 15 40M15 40L21.75 38M5 9C5 11.1217 5.84285 13.1566 7.34315 14.6569C8.84344 16.1571 10.8783 17 13 17C15.1217 17 17.1566 16.1571 18.6569 14.6569C20.1571 13.1566 21 11.1217 21 9C21 6.87827 20.1571 4.84344 18.6569 3.34315C17.1566 1.84285 15.1217 1 13 1C10.8783 1 8.84344 1.84285 7.34315 3.34315C5.84285 4.84344 5 6.87827 5 9Z"
                                                stroke="#203A5F" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>


                    <!-- ------------------------- 9th card --------------------------->
                    @if ($role_id == 1)
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Warehouses</p>
                                        <div class="dash-counts countFontSize2" id="total-warehouses">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="35" height="33.09" viewBox="0 0 37 35" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 34V8.76471L18.5 1L36 8.76471V34M20.4444 18.4706H28.2222V34H8.77778V22.3529H20.4444M20.4444 34V16.5294C20.4444 16.0146 20.2396 15.5208 19.8749 15.1568C19.5103 14.7928 19.0157 14.5882 18.5 14.5882H14.6111C14.0954 14.5882 13.6008 14.7928 13.2362 15.1568C12.8715 15.5208 12.6667 16.0146 12.6667 16.5294V22.3529"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- -------------------------10th --------------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Vehicles</p>
                                        <div class="dash-counts countFontSize2" id="total-vehicles">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="41" height="41" viewBox="0 0 43 43" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.5 42C18.8079 42 16.1422 41.4698 13.655 40.4395C11.1678 39.4093 8.90791 37.8993 7.00431 35.9957C5.10071 34.0921 3.59069 31.8322 2.56047 29.345C1.53025 26.8578 1 24.1921 1 21.5C1 18.8079 1.53025 16.1422 2.56047 13.655C3.59069 11.1678 5.10071 8.90791 7.00431 7.00431C8.90791 5.10071 11.1678 3.59069 13.655 2.56047C16.1422 1.53025 18.8079 1 21.5 1C24.1921 1 26.8578 1.53025 29.345 2.56047C31.8322 3.59069 34.0921 5.10071 35.9957 7.00431C37.8993 8.90791 39.4093 11.1678 40.4395 13.655C41.4698 16.1422 42 18.8079 42 21.5C42 24.1921 41.4698 26.8578 40.4395 29.345C39.4093 31.8322 37.8993 34.0921 35.9957 35.9957C34.0921 37.8993 31.8322 39.4093 29.345 40.4395C26.8578 41.4698 24.1921 42 21.5 42ZM21.5 42V26.0556M16.9444 21.5C16.9444 22.7082 17.4244 23.8669 18.2787 24.7213C19.1331 25.5756 20.2918 26.0556 21.5 26.0556M16.9444 21.5C16.9444 20.2918 17.4244 19.1331 18.2787 18.2787C19.1331 17.4244 20.2918 16.9444 21.5 16.9444C22.7082 16.9444 23.8669 17.4244 24.7213 18.2787C25.5756 19.1331 26.0556 20.2918 26.0556 21.5M16.9444 21.5L1.56944 16.9444M21.5 26.0556C22.7082 26.0556 23.8669 25.5756 24.7213 24.7213C25.5756 23.8669 26.0556 22.7082 26.0556 21.5M26.0556 21.5L41.4306 16.9444"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- ------------------------- 11th ------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Earnings</p>
                                        <div class="dash-counts countFontSize2" id="total-earnings">
                                            $0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="52" height="40.44" viewBox="0 0 54 43" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M41.4444 12.5556V6.77778C41.4444 5.24542 40.8357 3.77582 39.7522 2.69227C38.6686 1.60873 37.199 1 35.6667 1H6.77778C5.24542 1 3.77582 1.60873 2.69227 2.69227C1.60873 3.77582 1 5.24542 1 6.77778V24.1111C1 25.6435 1.60873 27.1131 2.69227 28.1966C3.77582 29.2802 5.24542 29.8889 6.77778 29.8889H12.5556M12.5556 18.3333C12.5556 16.801 13.1643 15.3314 14.2478 14.2478C15.3314 13.1643 16.801 12.5556 18.3333 12.5556H47.2222C48.7546 12.5556 50.2242 13.1643 51.3077 14.2478C52.3913 15.3314 53 16.801 53 18.3333V35.6667C53 37.199 52.3913 38.6686 51.3077 39.7522C50.2242 40.8357 48.7546 41.4444 47.2222 41.4444H18.3333C16.801 41.4444 15.3314 40.8357 14.2478 39.7522C13.1643 38.6686 12.5556 37.199 12.5556 35.6667V18.3333ZM27 27C27 28.5324 27.6087 30.002 28.6923 31.0855C29.7758 32.169 31.2454 32.7778 32.7778 32.7778C34.3101 32.7778 35.7797 32.169 36.8633 31.0855C37.9468 30.002 38.5556 28.5324 38.5556 27C38.5556 25.4676 37.9468 23.998 36.8633 22.9145C35.7797 21.831 34.3101 21.2222 32.7778 21.2222C31.2454 21.2222 29.7758 21.831 28.6923 22.9145C27.6087 23.998 27 25.4676 27 27Z"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- ------------------------- 12th -------------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Today Earnings</p>
                                        <div class="dash-counts countFontSize2" id="today-earnings">
                                            $0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="47" height="31.33" viewBox="0 0 49 33" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M40.1667 16.5H40.1928M8.83333 16.5H8.85945M16.6667 16.5C16.6667 18.5554 17.492 20.5267 18.961 21.9801C20.43 23.4335 22.4225 24.25 24.5 24.25C26.5775 24.25 28.57 23.4335 30.039 21.9801C31.508 20.5267 32.3333 18.5554 32.3333 16.5C32.3333 14.4446 31.508 12.4733 30.039 11.0199C28.57 9.56651 26.5775 8.75 24.5 8.75C22.4225 8.75 20.43 9.56651 18.961 11.0199C17.492 12.4733 16.6667 14.4446 16.6667 16.5ZM1 6.16667C1 4.79638 1.5502 3.48222 2.52955 2.51328C3.50891 1.54434 4.8372 1 6.22222 1H42.7778C44.1628 1 45.4911 1.54434 46.4704 2.51328C47.4498 3.48222 48 4.79638 48 6.16667V26.8333C48 28.2036 47.4498 29.5178 46.4704 30.4867C45.4911 31.4557 44.1628 32 42.7778 32H6.22222C4.8372 32 3.50891 31.4557 2.52955 30.4867C1.5502 29.5178 1 28.2036 1 26.8333V6.16667Z"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>


                    <!-- ------------------------- 13th card --------------------------->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Supply Orders</p>
                                        <div class="dash-counts countFontSize2" id="total-supply">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end  p-1 ps-3">
                                        <svg width="50" height="50" viewBox="0 0 52 52" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1 29.75L13.5 37.25V51M1 29.75L13.5 22.25L26 29.75M1 29.75V43.5L13.5 51M26 29.75V43.5M26 29.75L38.5 37.25M26 29.75L38.5 22.25M26 29.75V16M26 43.5L13.5 51M26 43.5L38.5 51M13.5 37.3625L26 29.7875M38.5 37.25V51M38.5 37.25L51 29.75M38.5 22.25L51 29.75M38.5 22.25V8.5M51 29.75V43.5L38.5 51M26 16L13.5 8.5L26 1L38.5 8.5M26 16L38.5 8.5M13.5 8.57507V22.2126"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- -------------------------14th --------------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">New Supply</p>
                                        <div class="dash-counts countFontSize2" id="new-supply">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg width="44" height="49" viewBox="0 0 44 49" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M43 12.75L22 1L1 12.75M43 12.75V36.25L22 48M43 12.75L22 24.5M22 48L1 36.25V12.75M22 48V24.5M1 12.75L22 24.5M12.0255 18.7556L31.9755 6.74448"
                                                stroke="#203A5F" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>


                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Cargo Orders</p>
                                        <div class="dash-counts countFontSize2" id="cargo-order">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55"
                                            viewBox="0 0 24 24" fill="none" stroke="#203A5F" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-ship">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1" />
                                            <path d="M4 18l-1 -5h18l-2 4" />
                                            <path d="M5 13v-6h8l4 6" />
                                            <path d="M7 7v-4h-1" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Air Orders</p>
                                        <div class="dash-counts countFontSize2" id="air-order">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            viewBox="0 0 24 24" fill="none" stroke="#203A5F" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-plane">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M16 10h4a2 2 0 0 1 0 4h-4l-4 7h-3l2 -7h-4l-2 2h-3l2 -4l-2 -4h3l2 2h4l-2 -7h3z" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
              

                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Expenses</p>
                                        <div class="dash-counts countFontSize2" id="total-expenses">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            viewBox="0 0 24 24" fill="none" stroke="#203A5F" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-dollar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M13 21h-7a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h12.5" />
                                            <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                            <path d="M19 21v1m0 -8v1" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards w-100 setCard">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-9 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Today Expenses</p>
                                        <div class="dash-counts countFontSize2" id="todays-expenses">
                                            0
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            viewBox="0 0 24 24" fill="none" stroke="#203A5F" stroke-width="1"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-dollar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M13 21h-7a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h12.5" />
                                            <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                            <path d="M19 21v1m0 -8v1" />
                                        </svg>
                                    </span>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
    <!-- </div>
    </div> -->
    <!-- ------------------------------------------------------------------------------- -->
    <!-- ------------------------ Cards ------------------------------ -->

    <div class="row">

        <div class="col-md-12 d-flex justify-content-between align-items-center mb-4 d-none"
            id="upcoming-container-header">
            <h5 class='cardh5Size fw-semibold'>Upcoming Container</h5>
            <!-- <button class="btn buttoncolor btn-lg px-4 text-light cardh5Size py-1" type="button">See All</button> -->
            <div class="col-auto">
                <a href="{{ route('admin.received.hub.list') }}"
                    class="btn-right btn btn-sm btn-primary rounded-3 align-center fs_18 fw-semibold px-4 py-1">
                    See All
                </a>
            </div>
        </div>

        <!-- --------------------------------upcoming Container Cards -------------------------------- -->
        <div class="col-md-12 d-none" id="upcoming-container-card">
            <div id="upcoming-container-list" class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4">
                @forelse ($upcomingContainers as $index => $upcomingContainer)
                    <div class="col-md-5 col-xl-3 col-sm-6">
                        <div style="background-size: 45px;"
                            class="card innerCards w-100 setCard setCardSize rounded 
                             {{ $upcomingContainer->container->status == 'Active' ? 'bg-selected1' : '' }}">
                            <div class="card2 d-flex flex-row justify-content-between">
                                <div class="col-md-9 justify-content-start p-2 ps-3 pe-1">
                                    <p class="font13 fw-medium"><span class="col737">Seal No :</span>
                                        {{$upcomingContainer->container->seal_no ?? "-"}}</p>
                                    <h5 class='text-black countFontSize fw-medium'>
                                        {{$upcomingContainer->container->container_no_1 ?? "-"}}
                                    </h5>
                                    <div class="cardFontSize mt-2 fw-medium">
                                        <span class="fw-regular col737">Total Order :</span>
                                        {{$upcomingContainer->no_of_orders ?? 0}}<br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p colspan="7" class="px-4 py-4 text-gray-500"></p>
                @endforelse
            </div>
        </div>

        <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
            <h5 class='cardh5Size fw-semibold'>Latest Container</h5>
            <!-- <button class="btn buttoncolor btn-lg px-4 text-light cardh5Size py-1" type="button">See All</button> -->
            <div class="col-auto">
                <a href="{{ route('admin.container.index') }}"
                    class="btn-right btn btn-sm btn-primary rounded-3 align-center fs_18 fw-semibold px-4 py-1">
                    See All
                </a>
            </div>
        </div>

        <!-- -------------------------------- Container Cards -------------------------------- -->
        <div class="col-md-12">
            <div id="container-list" class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4">
                @forelse ($latestContainers as $index => $latestContainer)
                    <div class="col-md-5 col-xl-3 col-sm-6">
                        <div style="background-size: 45px;"
                            class="card innerCards w-100 setCard setCardSize rounded 
                                        {{ $latestContainer->status == 'Active' ? 'bg-selected1 open_container_img' : 'close_container_img' }}">
                            <div class="card2 d-flex flex-row justify-content-between">
                                <div class="col-md-9 justify-content-start p-2 ps-3 pe-1">
                                    <p class="font13 fw-medium"><span class="col737">Seal No :</span>
                                        {{$latestContainer->seal_no ?? "-"}}</p>
                                    <h5 class='text-black countFontSize fw-medium'>
                                        {{$latestContainer->container_no_1 ?? "-"}}
                                    </h5>
                                    <div class="cardFontSize mt-2 fw-medium">
                                        <span class="fw-regular col737">Total Order :</span>
                                        {{$latestContainer->parcelsCount->first()->count ?? 0}}<br>

                                    </div>
                                </div>

                                <div class="col-3 justify-content-end mt-1">
                                    <div class="status-toggle float-end me-0">
                                        <input
                                            onclick="handleContainerClick('{{ $latestContainer->id }}', '{{ $latestContainer->container_no_1 }}', '{{ $latestContainer->warehouse_id }}')"
                                            id="rating_{{$latestContainer->id}}" class="toggle-btn1 check" type="checkbox" {{ $latestContainer->status == 'Active' ? 'checked' : '' }}>
                                        <label for="rating_{{$latestContainer->id}}" class="checktoggle tog checkbox-bg">checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p colspan="7" class="px-4 py-4 text-gray-500">No container found.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ---------------------------------- card ends ----------------------------------------------------- -->


    <!-- ---------------------------- Bar Graph / Pie Chart ---------------------- -->

    <div class="row">
        <h5 class='cardh5Size mb-3 fw-semibold'>Analytics</h5>
        <div class="col-xl-6 d-flex">
            <div class="card shadow-box flex-fill border-radius-6 p-0">

                <div class="d-flex justify-content-between align-items-center p-3">
                    <h5 class="cardh5Size fw-semibold">Users Analytics</h5>

                    <div class="main">
                        <h5 class='cardAnalyticsSize fw-medium'>Customers and Drivers Analytics</h5>
                    </div>
                </div>
                <hr class="border-bottom border-1 border-opacity-25 mt-0 mb-1">
                </hr>


                <!-- <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
										<div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
											<div>
												<span>Total Sales</span>
												<p class="h3 text-primary me-5">$1000</p>
											</div>
											<div>
												<span>Receipts</span>
												<p class="h3 text-success me-5">$1000</p>
											</div>
											<div>
												<span>Expenses</span>
												<p class="h3 text-danger me-5">$300</p>
											</div>
											<div>
												<span>Earnings</span>
												<p class="h3 text-dark me-5">$700</p>
											</div>
										</div>
									</div> -->
                <!-- <div id="sales_chart"></div> -->


                <div class="card-body p-0">
                    <div id="s-col"></div>
                </div>
            </div>
        </div>

        <!-- -------------------------- pie chart ---------------------------- -->

        <div class="col-xl-6 d-flex">
            <div class="card shadow-box flex-fill border-radius-6 p-0">

                <div class="d-flex justify-content-between align-items-center p-3">
                    <h5 class="cardh5Size fw-semibold">Payment Analytics</h5>

                    <div class="main">
                        <h5 class='cardAnalyticsSize fw-medium'>Earning Analytics</h5>
                    </div>
                </div>
                <hr class="border-bottom border-1 border-radius-6 border-opacity-25 mt-0 mb-1">
                </hr>

                <div class="card-body p-0">
                    <div id="s-line-area"></div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-6 d-flex">
							<div class="card flex-fill"> -->
        <!-- <div class="card">
									<div class="d-flex justify-content-between align-items-center">
										<h5 class="card-title">Invoice Analytics</h5> 
										
										<div class="dropdown main">
											<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
												Monthly
											</butto>
											
										</div>
									</div>
								</div>
								<div class="card-body">
									<div id="invoice_chart"></div>
									<div class="text-center text-muted">
										<div class="row">
											<div class="col-4">
												<div class="mt-4">
													<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> Invoiced</p>
													<h5>$2,132</h5>
												</div>
											</div>
											<div class="col-4">
												<div class="mt-4">
													<p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Received</p>
													<h5>$1,763</h5>
												</div>
											</div>
											<div class="col-4">
												<div class="mt-4">
													<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i> Pending</p>
													<h5>$973</h5>
												</div>
											</div>
										</div>-->
        <!-- </div> 
								</div>
							</div>
						</div> -->
    </div>


    <!-- ----------------------------- Table ---------------------------------------- -->

    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="dash-title">
                <h5 class='cardh5Size fw-semibold mb-4'>Latest Orders</h5>
            </div>
            <div class="mb-3">
                <ul class="d-flex Latest_Orders">
                    <li class="nav-item">
                        <a class="tab-btn btnBorder th-font col737 bg-light me-3 active" data-tab="Service_orders"
                            href="javascript:void(0);">
                            Service Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="tab-btn btnBorder th-font col737 bg-light me-3" data-tab="Supply_order"
                            href="javascript:void(0);">
                            Supply Order
                        </a>
                    </li>
                </ul>

            </div>
            <div class="tab-content-custom t-padding" id="Service_orders">
                <div class="card-table" id="ajexTable">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        {{-- <th><input type="checkbox" id="selectAll"></th> --}}
                                        <th>S.No</th>
                                        <th>Tracking ID</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Shipping Type</th>
                                        <th>Pickup Date</th>
                                        <th>Delivery Date</th>
                                        <th>Container ID</th>
                                        <th>From Warehouse</th>
                                        <th>To Warehouse</th>
                                        <th>Items</th>
                                        <th>Estimate cost</th>
                                        <th>Driver Name</th>
                                        <th>Vehicle Type</th>
                                        <th>Payment Status</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        {{-- <th>Warehouse</th> --}}
                                        <th>Status</th>
                                        <th>Pickup Type</th>
                                        <th>Delivery Type</th>
                                        <th>Status update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($serviceOrders as $index => $serviceOrder)
                                        <tr>
                                            <td> {{ $index + 1 }}</td>
                                            <td>{{ $serviceOrder->tracking_number ?? "-"}}</td>
                                            <td>
                                                <div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="td"><i
                                                                    class="me-2 ti ti-user"></i>{{$serviceOrder->pickupaddress->full_name ?? "--"}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i
                                                                    class="me-2 ti ti-phone"></i>{{$serviceOrder->pickupaddress->mobile_number ?? "--"}}
                                                                <br>
                                                                {{$serviceOrder->pickupaddress->alternative_mobile_number ?? "--"}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                                <p>{{$serviceOrder->pickupaddress->address ?? "--"}}<br>
                                                                    {{$serviceOrder->pickupaddress->pincode ?? "--"}} <br>
                                                                    {{$serviceOrder->pickupaddress->city->name ?? "--"}}
                                                                    {{$serviceOrder->pickupaddress->state->name ?? "--"}}
                                                                    {{$serviceOrder->pickupaddress->country->name ?? "--"}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="td"><i
                                                                    class="me-2 ti ti-user"></i>{{$serviceOrder->deliveryaddress->full_name ?? "--"}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i
                                                                    class="me-2 ti ti-phone"></i>{{$serviceOrder->deliveryaddress->mobile_number ?? "--"}}
                                                                <br>
                                                                {{$serviceOrder->deliveryaddress->alternative_mobile_number ?? "--"}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                                <p>{{$serviceOrder->deliveryaddress->address ?? "--"}}<br>
                                                                    {{$serviceOrder->deliveryaddress->pincode ?? "--"}} <br>
                                                                    {{$serviceOrder->deliveryaddress->city->name ?? "--"}}
                                                                    {{$serviceOrder->deliveryaddress->state->name ?? "--"}}
                                                                    {{$serviceOrder->deliveryaddress->country->name ?? "--"}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>{{ ucfirst($serviceOrder->transport_type) ?? '-' }}</div>
                                            </td>
                                            <td>
                                                <div>
                                                    {{ $serviceOrder->pickup_date ? \Carbon\Carbon::parse($serviceOrder->pickup_date)->format('m-d-Y') : '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    {{ $serviceOrder->delivery_date ? \Carbon\Carbon::parse($serviceOrder->delivery_date)->format('m-d-Y') : '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>{{$serviceOrder->container->unique_id ?? "--"}} </div>
                                            </td>
                                            <td>
                                                <div>{{$serviceOrder->warehouse->warehouse_name ?? "--"}} </div>
                                            </td>
                                            <td>
                                                <div>{{$serviceOrder->arrivedWarehouse->warehouse_name ?? "--"}} </div>
                                            </td>
                                            <td>
                                                <p class="overflow-ellpise" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{  $serviceOrder->descriptions ?? '-' }}">
                                                    {{  $serviceOrder->descriptions ?? '-' }}
                                                </p>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="row">Customer:</div>
                                                            <div class="row">Driver:</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row">
                                                                ${{ number_format($serviceOrder->customer_estimate_cost ?? 0, 2) }}
                                                            </div>
                                                            <div class="row">
                                                                ${{ number_format($serviceOrder->estimate_cost ?? 0, 2) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                            </td>
                                            <td>
                                                <div>{{ $serviceOrder->driver->name ?? "-"}}</div>
                                            </td>
                                            <td>
                                                <div>{{ $serviceOrder->driver_vehicle->vehicle_type ?? "-"}}</div>
                                            </td>
                                            @php
                                                $forValue = match ($serviceOrder->payment_status) {
                                                    'Unpaid' => 'unpaid_status',
                                                    'Paid' => 'status',
                                                    'Completed' => 'partial_status',
                                                    'Partial' => 'partial_status',
                                                    default => 'Unpaid',
                                                };
                                            @endphp
                                            <td>
                                                <label class="labelstatusy" for="{{ $forValue }}">
                                                    {{ $serviceOrder->payment_status ?? '-' }}
                                                </label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="row">Partial:</div>
                                                        <div class="row">Due:</div>
                                                        <div class="row">Total:</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            ${{ number_format($serviceOrder->partial_payment ?? 0, 2) }}
                                                        </div>
                                                        <div class="row">
                                                            ${{ number_format($serviceOrder->remaining_payment ?? 0, 2) }}
                                                        </div>
                                                        <div class="row">
                                                            ${{ number_format($serviceOrder->total_amount ?? 0, 2) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    {{ $serviceOrder->payment_type === 'COD' ? 'Cash' : ($serviceOrder->payment_type ?? '-') }}
                                                </div>
                                            </td>
                                            @php
                                                $status_class = $serviceOrder->status ?? null;
                                                $serviceOrderStatus = $serviceOrder->parcelStatus->status ?? null;
                                                $classValue = match ((string) $status_class) {
                                                    "1" => 'badge-pending',
                                                    "2" => 'badge-pickup',
                                                    "3" => 'badge-picked-up',
                                                    "4" => 'badge-arrived-warehouse',
                                                    "5" => 'badge-in-transit',
                                                    "8" => 'badge-arrived-final',
                                                    "9" => 'badge-ready-pickup',
                                                    "10" => 'badge-out-delivery',
                                                    "11" => 'badge-delivered',
                                                    "12" => 'badge-re-delivery',
                                                    "13" => 'badge-on-hold',
                                                    "14" => 'badge-cancelled',
                                                    "15" => 'badge-abandoned',
                                                    "21" => 'badge-picked-up',
                                                    "22" => 'badge-in-transit',
                                                    "23" => 'badge-pickup_re-schedule',
                                                    default => 'badge-pending',
                                                };

                                            @endphp
                                            <td>
                                                <label class="{{ $classValue }}" for="status">
                                                    {{ $serviceOrderStatus ?? '-' }}
                                                </label>
                                            </td>
                                            <td>
                                                <div>
                                                    {{ $serviceOrder->pickup_type === 'self' ? 'In Person' : ($serviceOrder->pickup_type === 'driver' ? 'Driver' : '-') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    {{ $serviceOrder->delivery_type === 'self' ? 'In Person' : ($serviceOrder->delivery_type === 'driver' ? 'Driver' : '-') }}
                                                </div>
                                            </td>
                                            <td>
                                                <li class="nav-item dropdown">
                                                    <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                        data-bs-toggle="dropdown">

                                                        <span class="user-content droparrow droparrow">
                                                            <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                        </span>
                                                    </a>
                                                    <div class="dropdown-menu menu-drop-user">
                                                        <div class="profilemenu">
                                                            <div class="subscription-menu">
                                                                <ul>
                                                                    @php
                                                                        // Assuming $serviceOrder->parcelStatus->id contains the ID of the current status
                                                                        $currentStatusId = $serviceOrder->parcelStatus->id ?? null;
                                                                    @endphp
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 1 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">Pending</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 2 ? 'active disabled-link-for-active-service' : ($currentStatusId == 1 || $currentStatusId == 23 ? '' : 'disabled-link') }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#Pick_up_with_driver"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            href="javascript:void(0);">
                                                                            Pick up with driver
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 3 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">Picked up</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item  {{ $currentStatusId == 4 ? 'active disabled-link-for-active-service' : ($currentStatusId == 3 ? '' : 'disabled-link') }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#arrived_warehouse"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            href="javascript:void(0);">
                                                                            Arrived at warehouse
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 5 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">In transit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 8 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">Arrived at final
                                                                            destination
                                                                            warehouse</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 9 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">Ready for pick up</a>
                                                                    </li>
                                                                    <li>
                                                                        <a onclick="{{ $currentStatusId == 9 ? 'fetchDeliveryDriversByParcelId(' . $serviceOrder->id . ')' : '' }}"
                                                                            class="dropdown-item {{ $currentStatusId == 21 ? 'active disabled-link-for-active-service' : ($currentStatusId == 9 ? '' : 'disabled-link') }}"
                                                                            data-bs-toggle="modal"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            data-bs-target="#ready_for_signature_pick_up"
                                                                            href="javascript:void(0);">
                                                                            Ready for self pick up
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a onclick="{{ $currentStatusId == 9 ? 'fetchDeliveryDriversByParcelId(' . $serviceOrder->id . ')' : '' }}"
                                                                            class="dropdown-item {{ $currentStatusId == 22 ? 'active disabled-link-for-active-service' : ($currentStatusId == 9 ? '' : 'disabled-link') }}"
                                                                            data-bs-toggle="modal"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            data-bs-target="#delivery_with_driver"
                                                                            href="javascript:void(0);">
                                                                            Assign delivery with driver
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 10 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">Out for delivery</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item  {{ $currentStatusId == 11 ? 'active disabled-link-for-active-service' : ($currentStatusId == 21 ? '' : 'disabled-link') }}"
                                                                            href="javascript:void(0);">Delivered</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 13 ? 'active disabled-link-for-active-service' : 'disabled-link' }}"
                                                                            href="javascript:void(0);">Custom hold</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item open-reschedule-pickup-modal {{ $currentStatusId == 11 || $currentStatusId == 14 ? 'disabled-link' : '' }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#Re_schedule_pickup"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            data-date="{{ $serviceOrder->pickup_date ? \Carbon\Carbon::parse($serviceOrder->pickup_date)->format('m/d/Y') : '' }}"
                                                                            href="javascript:void(0);">
                                                                            Re-schedule pickup
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item open-reschedule-delivery-modal {{ $currentStatusId == 11 || $currentStatusId == 14 ? 'disabled-link' : '' }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#Re_schedule_delivery"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            data-date="{{ $serviceOrder->delivery_date ? \Carbon\Carbon::parse($serviceOrder->delivery_date)->format('m/d/Y') : '' }}"
                                                                            href="javascript:void(0);">
                                                                            Re-schedule delivery
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item {{ $currentStatusId == 11 || $currentStatusId == 14 ? 'disabled-link' : '' }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#Cancelled"
                                                                            data-id="{{ $serviceOrder->id }}"
                                                                            href="javascript:void(0);">
                                                                            Cancelled
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </td>
                                            <td class="btntext">
                                                <a href="{{ route('admin.service_orders.show', $serviceOrder->id) }}">
                                                    <button class=orderbutton><img
                                                            src="{{asset(path: 'assets/img/ordereye.png')}}"></button></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No order found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-content-custom t-padding" id="Supply_order" style="display: none;">
                <div class="card-table" id="ajexTable">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Tracking ID</th>
                                        <th>From</th>
                                        <th>Warehouse Name</th>
                                        <th>Order Date</th>
                                        <th>Estimate cost</th>
                                        <th>Driver Name</th>
                                        <th>Vehicle Type</th>
                                        <th>Payment Status</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th>Status update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($supplyOrders as $index => $supplyOrder)
                                        <tr>
                                            <td> {{ $index + 1 }}</td>
                                            <td>{{ $supplyOrder->tracking_number ?? "-"}}</td>
                                            <td>
                                                <div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="td"><i
                                                                    class="me-2 ti ti-user"></i>{{$supplyOrder->deliveryaddress->full_name ?? "--"}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i
                                                                    class="me-2 ti ti-phone"></i>{{$supplyOrder->deliveryaddress->mobile_number ?? "--"}}
                                                                <br>
                                                                {{$supplyOrder->deliveryaddress->alternative_mobile_number ?? "--"}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="td"><i class="me-2 ti ti-map-pin"></i>
                                                                <p>{{$supplyOrder->deliveryaddress->address ?? "--"}}<br>
                                                                    {{$supplyOrder->deliveryaddress->pincode ?? "--"}} <br>
                                                                    {{$supplyOrder->deliveryaddress->city->name ?? "--"}}
                                                                    {{$supplyOrder->deliveryaddress->state->name ?? "--"}}
                                                                    {{$supplyOrder->deliveryaddress->country->name ?? "--"}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $supplyOrder->arrivedWarehouse->warehouse_name ?? "-"}}
                                            </td>
                                            <td>
                                                <div>
                                                    {{ $supplyOrder->created_at ? $supplyOrder->created_at->format('m-d-Y') : '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div>${{ number_format($supplyOrder->total_amount ?? 0, 2)   }}</div>
                                            </td>
                                            <td>
                                                <div>{{ $supplyOrder->arrivedDriver->name ?? "-"}}</div>
                                            </td>
                                            <td>
                                                <div>{{ $supplyOrder->arrivedDriverVehicle->vehicle_type ?? "-"}}</div>
                                            </td>
                                            @php
                                                $forValue = match ($supplyOrder->payment_status) {
                                                    'Unpaid' => 'unpaid_status',
                                                    'Paid' => 'status',
                                                    'Completed' => 'partial_status',
                                                    'Partial' => 'partial_status',
                                                    default => 'Unpaid',
                                                };
                                            @endphp
                                            <td>
                                                <label class="labelstatusy" for="{{ $forValue }}">
                                                    {{ $supplyOrder->payment_status ?? '-' }}
                                                </label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="row">
                                                        ${{ number_format($supplyOrder->total_amount ?? 0, 2) }}
                                                    </div>
                                                </div>
                                            </td>
                                            @php
                                                $classValue = match ((string) $supplyOrder->status) {
                                                    "1" => 'badge-pending',
                                                    "2" => 'badge-pickup',
                                                    "3" => 'badge-picked-up',
                                                    "4" => 'badge-arrived-warehouse',
                                                    "5" => 'badge-in-transit',
                                                    "8" => 'badge-arrived-final',
                                                    "9" => 'badge-ready-pickup',
                                                    "10" => 'badge-out-delivery',
                                                    "11" => 'badge-delivered',
                                                    "12" => 'badge-re-delivery',
                                                    "13" => 'badge-on-hold',
                                                    "14" => 'badge-cancelled',
                                                    "15" => 'badge-abandoned',
                                                    "21" => 'badge-picked-up',
                                                    "22" => 'badge-in-transit',
                                                    default => 'badge-pending',
                                                };
                                            @endphp
                                            <td>
                                                <div>
                                                    {{ $supplyOrder->payment_type === 'COD' ? 'Cash' : ($supplyOrder->payment_type ?? '-') }}
                                                </div>
                                            </td>
                                            <td>
                                                <label class="{{ $classValue }}" for="status">
                                                    {{ $supplyOrder->parcelStatus->status ?? '-' }}
                                                </label>
                                            </td>
                                            <td>
                                                <li class="nav-item dropdown">
                                                    <a class="amargin" href="javascript:void(0)" class="user-link  nav-link"
                                                        data-bs-toggle="dropdown">

                                                        <span class="user-content"
                                                            style="background-color:#203A5F;border-radius:5px;width: 30px;
                                                                                                                                                                                               height: 26px;align-content: center;">
                                                            <div><img src="{{asset('assets/img/downarrow.png')}}"></div>
                                                        </span>
                                                    </a>
                                                    <div class="dropdown-menu menu-drop-user">
                                                        <div class="profilemenu">
                                                            <div class="subscription-menu">
                                                                <ul>

                                                                    <li>
                                                                        <a class="dropdown-item {{ $supplyOrder->status == 1 ? '' : 'disabled-link-supply' }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delivery_with_driver"
                                                                            data-id="{{ $supplyOrder->id }}"
                                                                            href="javascript:void(0);">
                                                                            Assign delivery with driver
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </td>
                                            <td class="btntext">
                                                <button
                                                    onClick="redirectTo('{{route('admin.supply_orders.show', $supplyOrder->id)}}')"
                                                    class=orderbutton><img
                                                        src="{{asset('assets/img/ordereye.png')}}"></button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">No order found.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <input type="hidden" id="parcel_id_input_hidden" name="parcel_id_hidden" class="form-control" readonly>
            <input type="hidden" id="warehouse_id_input_hidden" name="warehouse_id_hidden" class="form-control"
                readonly>
            <input type="hidden" id="created_user_id_input_hidden" name="created_user_id_hidden" class="form-control"
                readonly value="{{ auth()->user()->id }}">
        </div>
    </div>

    <!-- Re-schedule delivery -->
    <div class="modal custom-modal signature-add-modal fade" id="Re_schedule_delivery" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Re-Schedule Delivery</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="Re_schedule_deliveryForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="Re_schedule_type" name="Re_schedule_type"
                                        class="form-control" readonly value="delivery">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Delivery date</label>
                                    <input type="text" name="percel_date" readonly style="cursor: pointer;"
                                        class="form-control inp" id="percel_delivery_date_input"
                                        placeholder="MM/DD/YYYY" />
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Re-schedule pickup -->
    <div class="modal custom-modal signature-add-modal fade" id="Re_schedule_pickup" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Re-Schedule Pickup</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="Re_schedule_pickupForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="Re_schedule_type" name="Re_schedule_type"
                                        class="form-control" readonly value="pickup">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Pickup date</label>
                                    <input type="text" name="percel_date" readonly style="cursor: pointer;"
                                        class="form-control inp" id="percel_pickup_date_input"
                                        placeholder="MM/DD/YYYY" />
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Cancelled -->
    <div class="modal custom-modal signature-add-modal fade" id="Cancelled" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Cancelled</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="cancelledForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="
                                    {{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Pick_up_with_driver -->
    <div class="modal custom-modal signature-add-modal fade" id="Pick_up_with_driver" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Pickup With Driver</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="pickupForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Warehouse<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" name="warehouse_id"
                                        onchange="fetchDriversBywarehouse(this.value)">
                                        <option selected="selected" value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="warehouseError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" id="warehousedriverDropdown"
                                        name="driver_id">
                                        <option selected="selected" value="">Select Pickup Man</option>
                                    </select>
                                    <div id="driverError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delivery_with_driver -->
    <div class="modal custom-modal signature-add-modal fade" id="delivery_with_driver" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class=" modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Assign delivery with driver</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="deliveryForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Warehouse<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" name="warehouse_id"
                                        onchange="fetchDeliveryDriversBywarehouse(this.value)">
                                        <option selected="selected" value="">Select Warehouse</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="deliverywarehouseError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" id="deliverywarehousedriverDropdown"
                                        name="driver_id">
                                        <option selected="selected" value="">Select delivery Man</option>
                                    </select>
                                    <div id="deliverydriverError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ready_for_signature_pick_up -->
    <div class="modal custom-modal signature-add-modal fade" id="ready_for_signature_pick_up" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class=" modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header text-start mb-0">
                        <div class="popuph">
                            <h4>Ready for self pick up</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('assets/img/cross.png') }}">
                </div>
                <form id="signaturedeliveryForm" method="POST">
                    @csrf
                    <!-- Parcel ID Input Field -->
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <input type="hidden" id="parcel_id_input" name="parcel_id" class="form-control"
                                        readonly>
                                    <input type="hidden" id="warehouse_id_input" name="warehouse_id"
                                        class="form-control" readonly>
                                    <input type="hidden" id="created_user_id_input" name="created_user_id"
                                        class="form-control" readonly value="{{ auth()->user()->id }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="table-content col737 fw-medium">Signature Image </label>
                                    <div class="input-block mb-3 service-upload img-size2 mb-0">
                                        <span id="upload_signature_pickup_img">
                                            <svg width="65" height="37" viewBox="0 0 65 37" fill="none"
                                                style="color:black;" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <rect width="65" height="37" fill="url(#pattern0_2250_39084)"
                                                    style="mix-blend-mode:luminosity" />
                                                <defs>
                                                    <pattern id="pattern0_2250_39084"
                                                        patternContentUnits="objectBoundingBox" width="1" height="1">
                                                        <use xlink:href="#image0_2250_39084"
                                                            transform="matrix(0.00877193 0 0 0.0154101 0 -0.000829777)" />
                                                    </pattern>
                                                    <image id="image0_2250_39084" width="114" height="65"
                                                        preserveAspectRatio="none"
                                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHIAAABBCAYAAAANM/B+AAAAAXNSR0IArs4c6QAADKNJREFUeF7tnQl4FEUWgP/JzISQCYfcCAYP8ECURQPrxaoshEMuRQ5FEVhQbkRYFFAJiAqiIgqCQU6RQ1AUBLkVFdHlEBdhl+UyUZArCCH3ZGbWN0WTkGt6MunOkC/1ff0lTGq6Xr2/X9WrV68ai8fj8VBaLlsNCD63242lFORly9AreCnIy5vfRelLQZaCLCEaKCHdKLXIUpAlRAMlpBulFlkKsoRooIR0o9QiS0EWjwZ+PwgnDkOm05z2bXaofi3UrGtOe4Vt5bKxyEM7YW0sxO0pbFcD+16dW6DVk3Dd7YHdx6hvBz1IEfCnjRYWjVUqKFcJrm0EoWFGqeTS+2akweEf4fwZ9fmj46Bhcw8Wi8UcAXS2EvQg/zgOk7tBZgbc2x0eGKizZ0VcbfV02PIh2ELhn0vgihpF3ECAtwtqkC6Xi7UzrGxZBH9poayhOIuMCrs3wL2PQqv+LqxWa3GKc0nbQQtStmQE5LTedn4/BP1nwDUNi1dvR36CGf2h5nUwaI7TCzIkJKR4hbrQetCCTE70EL/XydKYUFLOQ8xaCC9fvDpLSYSYVhBeDrrGZBB5sx1H+eCYK4sdpMcNp+Lg2J9WJ8uKo/tBlhhnT7rI9KRTrnw4aUkQs04psDiL94FqCWERcD4xBZulDBWrWb1Lk1o3qGXKlXWhaiRYTDZU00HK+m/Pl3BoBxw7CMdlTZiRE48He5ibirXTSDruIDXIQJaNgIgayZz9LQxnmhC71CrFIaohUOtB3ShocB/IetTIYhpIgbVmOuxYA2nJWV2qUBWq1YFq10CVq6B6HagS6SGisov09HRee9AYkImnQS4ZritdqU/FmkUKyJErkilTpgxJCVZOx1s48YsaWU5euOTeWpH6UW2hdX/jgJoCUuaWOcMhfq8aHhu3h1ubQfWrIbRsbiWKUOLoGAFSHJaNs+HAjqx2xXKaPaFkKqjkBVIcnrzWlOkpcOKIGn22r8I7z199K/R6HQRsURdTQE7tCUf/p8Jc/d713RGjQO77FuaNVCoMc0Cl2h7On7ZwPkF91n4o3NM1fxX7AzL7XeRBnjlATSORN8OgWUWN0YScnYM7IHaIisgMWwgRFX13wgiQMrRP7ASJCdCko5tWAzIvCrJtmZ0Ns9Q8N+wDtbzIqxQWpNwr6Sy82R2S/oB+0+Da23zrwZ8ahlvk7Gdg//dqfrj/cX2iGQFy5xew9CW4uqGHHpNzR9xXT7Wxc3VIgdGjQEBKzzfPU/Hi+vdAz9f06UJvLcNBjmsNyefgueX6nQojQH7+Dny9GJr38XBXl9wgD+208uEoK/WioO/bRW+RcsdT8SrcWL4yPL9KLyJ99QwH+cqDcPYEjF4BFavrF6qonZ3Pp8HXi+DvvT3c3S03yAPbrSweY+X6xtBnqjEgE36DSV3UAy0PdlEWw0FOeRxviO2ZhWptpacYYZG718OiGLiqvodeb+UGufJ1O7vXW7zea6unjAEpgY4pPaDW9TB0nh5N6K9jOEgt0NxtLNzWUp9gRoDEAxM7w5lj0Kilmxb9XIQ51CmJLQtsbFmoQjGysyGRmaJ2duR+u9bCkvHQKBoeidGnC721DAf51UJY8y787RFoO1ifWIaABA5uh1lPi6sOsp1YqZaHpAQL6alKroefgybt85cxUGdn1dvwzRJ4YJDaQSnKYjjIA/9Syqt7Ozz5jj7RjQIprR87AJvmwp6vsmSRjWrxqG+4o2D5AgX53iA4tAuenAp1G+vThd5ahoOUOOnYaBUEGLden1hGgtQkyEhVIbqy5cFRQZ9cgYIUPYg+RA9FHd0xHKSoaEJ7pTS9nmugIGW91qynPjj+1AoEpGQ6vPoQVKgGYz71p1V9dU0BOXcE/Oc76DkJ6jf1LVggIBc+D//eDHc+BA+O8N2WPzUCAbn3a5j/nDHBAOmDKSDXxcKmeRDdB5r39q26woJc9jJsX511/6J2KgIBueF92DAHmveC6L6+deBvDVNAyg7AB2Pg5r/BExN9i1gYkJ++Ad99rO59Wxs3u9ao5cRjE3zvaviWSNUIBOS8Z2HfN9DjVWhwr94W9dczBWTCUZjUGa6oCaMuKLsgEf0FqT3tIVboOs5FvSYuNs+z8e2iEKx26P+u2nUItAQCUotwSf9FD0VdTAEpQo9pBs40fR6bPyC3LofP3lTrws5j3dx4V9auxscv29m7xeLdAx08GyrX1q++uJ9h60dq4a6lbRQWpOa528Pg5c36ZfCnpuhMLsPfISDZZ7Kpq2cLRy/I7Z/DsldUdzuMcNMwOguipoQFI+38sttC5VpqH9ChYxtNRpC3e6mlQpN28PCowIZWbStPtq6k/0YU00B+NgW2LoN2Q6FpAZu30kk9IHdvhEUvKpW0Gewmql1uiPK39FQL84fZOH7YwlX1od90sJfJX5ViddP7qp0KrdzfA1r3K/wcKbsusvsi/Zb+G1VMsUjNeqLaQJfnC+6KL5CylJEljZTopzzc0angEz1JZyzMHmLn3Em45T54/IIV5yXFzEFweJcMwx6i2nlYN0M5TRJelLwbyaLLnrOTX6pH9nsvHgc/roOuL8DtrY3CqAzA8KFVUj0k5UPSPYYtKDzII7shdii4nNC0u5v7n8jbEnO2kPBrCO8PtiG5NE27QbshuWVYHAM/rofwCtB3WiYVqrvZvtLGF9MUzI7DQbxjf0G+0V3l70i/jT7VZThIVyaMvk8p75WvwGrLH2Z+FnnmKMwYoJymJh3ctBqoD6LWUvweKx88a0Vk6fQs/LVDlgxfLoAvZoKtDPSakknNuu6Lf9w0x8bWJSFeh0oC7v6A1PotCenSb6PzXQ0HKVqRvTjZkxs6VyX05lfyAimOyuxhygGRdWLbp/2DqLX13602PhqvoPSeDDfcqQLoC8eoGt1eUsuXnGXFJDt7Nqm8Hsn8G7VSpUP6Glp/3Qfv9FH9lX4bXUwB+dEEldfaeTQ0/nO+8QekeJvJZ+HW5h46jgzslOsPn9hYN1MNl41aqvlLSpshbqLa5v+ALB1rZ/82i/cheHG9PpA/fAYfT7rU+zUSpikgv1kKq6bC3Z2hwzB9ICd1dFxMaL6pqYfOLwQGUWt123I7G2KzMsRbDXTTpEPBVp58zsIbne1+gVwxGbatUPPrXZ2MRKjubQpIOTA6c6BkssGAGfpAjm/pQM6H1Gvi4ZEJRQNRaznxVAj7vw/hxjvdlKuSNSfmJ1lakoXXHvIP5LS+KjF7wEyVoGx0MQWkOCkS4fEV4cg+R46LdiBpGiOWOQmvULwvsPQXpDyA4uCJwyMRHem30cUUkNIJySKTbLLhH0L1a/LuVl4gR37iJCyieEGmJlmY7IdFyiGlt3pAtUgYscRohCYOrdLU+ljYOA/u6QLtny7ZICUGLLHgFr2hRZ8SBlJyXGUnICwcBsTmnSKZ3SLHRzu8a7dgGFr9cXYkN2hGP5CXSYz+FOTUmRnFtKFVOqPFHuUciMQ+5Uhd9iIgnRkuftmXwfzh4d4AQJ9pLq68Pvf6zgzlaG0c22/l/cFW71zX880U6twUij0092ksieLIJoEc3hHvXLx0s4qpIKVTa9+DzfNBIh6yw1CuiupqyjmI2+fh6H4XGc40qtSI8MZI88sQN0tB0s63i+1snmvxZsyf+j2JUHsYtW+0EVk/61h84imQuLLbDS3+oS4zi+kgpXPffaLmTHlyc9gkjkouqtTJoGZkOD+sxLtB/NhEF5ENiscq439W4T13psp9PR6fwum4UJLPyJs9Lj2xLMELSWuRvCGzS7GAlE5KEPvgTpA4qsAST7ZmPQmDZZKRkUFycjJ71lRl/Sz1lMtpqqqRHsIrmvMShpSzHk7GW4j7yeKNk8rbrxq0PoXD4SA0NJT0FBvH5bVqR1Qgv1ItvAeB8jrAawbUYgOZV+c0Z8fpdHpBysnlxLhaLH8Vks6owLWZRUJyEZXUBnP5Oke9MVYBabfbfcZazZRT2go6kAJTLFIgpqamIlDls5DkSO9Wk5zhMKPIyamoB8AZGu89Yi7wypYt64UpFimfBdPrzIIKpADSXpgkMDWgctROPpfLzCIvRZJLdjo0gAIxmF6YpOkj6EBqWWGZmZlea5RLfpdLy08xA6ZmcTabDbnEIuWS3wVuMFlj0A2tIpAGS7NMsUaBqFmkWVapWaP8FHhihZolBtuwGpQgs8PUnB+zIWoWnx2mtpEcjBCDFqQGU5szNSuVn9n/ZtQQqw2bGjT5qb1EMNiG1KCdI3PCyQlP+7dREC8q5sILdrNDNbrNQO4fdM5Ofp0xC2DO9oPVAnPJWfq/1QViB8Hz3cvGIoNHZcEpyf8B+MgFYD08AM4AAAAASUVORK5CYII=" />
                                                </defs>
                                            </svg>
                                            <h6 class="drop-browse align-center">Upload Image</h6>
                                        </span>

                                        <input type="file" id="self_pickup_img" name="img" class="form-control"
                                            accept="image/*">
                                        <div id="preview" class="mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Amount</label>
                                    <input type="number" name="amount" class="form-control inp"
                                        placeholder="Enter amount">
                                    <div id="amountError" class="text-danger small mt-1"></div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block">
                                    <label class="foncolor">Note</label>
                                    <input type="text" name="notes" class="form-control inp Note"
                                        placeholder="Enter note">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- cancel model -->
    <div class="modal custom-modal signature-add-modal fade" id="arrived_warehouse" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc">Has the order successfully arrived at the warehouse?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button data-bs-dismiss="modal" type="button" onclick="updatestatusarrivedwarehouse()"
                                    class="w-100 btn btn-primary paid-continue-btn customerpopup">
                                    Yes
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" data-bs-dismiss="modal"
                                    class=" w-100 btn btn-outline-primary custom-btn">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- re-schedule  pickup-->
    <div class="modal custom-modal signature-add-modal fade" id="reschedule_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Pickup Re-Schedule</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Pickup Man<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Delivery Man</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="colordate"> Date <i class="text-danger">*</i></label>
                                        <div class="daterangepicker-wrap cal-icon cal-icon-info popdate">
                                            <input type="text" class="btn-filters form-control form-cs inp "
                                                name="datetimes" placeholder="From Date - To Date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- reasonofaction  -->
    <div class="modal custom-modal signature-add-modal fade" id="reason_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Reason for Action</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Select Reason<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Reason</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- recieved warehouse -->
    <div class="modal custom-modal signature-add-modal fade" id="receivedwarehouse_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Recieved Warehouse</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">


                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Warehouse Name<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Warehouse</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- cancel container recieved -->
    <div class="modal custom-modal signature-add-modal fade" id="cancelcontainer_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body confirmationpopup">
                    <div class="form-header">

                        <p class="popupc">Do you want to cancel the Container Recieved by Hub?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">

                                <button type="submit" data-bs-dismiss="modal"
                                    class=" w-100 btn btn-outline-primary custom-btn">No</button>
                            </div>
                            <div class="col-6">
                                <button data-bs-dismiss="modal"
                                    class="w-100 btn btn-primary paid-continue-btn customerpopup"><a
                                        class="dropdown-items" href="javascript:void(0);" data-bs-toggle="modal"
                                        data-bs-target="#reason_modal">Yes</a>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- delivery reschedule -->
    <div class="modal custom-modal signature-add-modal fade" id="reschedule_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Delivery Re-Schedule</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">



                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block mb-3">
                                    <div class="col-12">
                                        <label class="foncolor">Delivery Man<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-12">
                                        <select class="js-example-basic-single select2">
                                            <option selected="selected">Select Delivery Man</option>
                                            <option></option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="colordate"> Date <i class="text-danger">*</i></label>
                                        <div class="daterangepicker-wrap cal-icon cal-icon-info popdate">
                                            <input type="text" class="btn-filters form-control form-cs inp "
                                                name="datetimes" placeholder="From Date - To Date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- return courier -->
    <div class="modal custom-modal signature-add-modal fade" id="returncourier_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Return to Courier</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">

                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- delivered courier -->
    <div class="modal custom-modal signature-add-modal fade" id="deliveredcourier_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header pb-0">
                    <div class="form-header  text-start mb-0">
                        <div class="popuph">
                            <h4>Delivered</h4>
                        </div>
                    </div>
                    <img class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        src="{{asset('assets/img/cross.png')}}">

                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">

                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="input-block ">
                                    <label class="foncolor">Note</label>
                                    <div class="input-block mb-0">
                                        <input type="Note" name="Note" class="form-control inp Note" placeholder="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" data-bs-dismiss="modal"
                            class="btn btn-outline-primary custom-btn">Cancel</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- ---------------------------------------------------------------------------------------------------- -->

    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        @if ($role_id == 2 || $role_id == 4)
            <script>
                document.addEventListener('DOMContentLoaded', async function () {
                    const warehouseId = document.getElementById('hiddenWarehouseId')?.value;
                    if (warehouseId) {
                        await fetchDashboardData(warehouseId);
                    }
                });
            </script>
        @else
            <script>
                document.addEventListener('DOMContentLoaded', async function () {
                    await fetchDashboardData();
                });
            </script>
        @endif

        <script>
              function handleContainerClick(containerId, containerNumber, warehouseId) {
                const checkbox = document.getElementById(`rating_${containerId}`);
                const isChecked = checkbox.checked;
                // Step 1: Fetch current active container
                axios.post('/api/vehicle/getAdminActiveContainer', {
                    warehouse_id: warehouseId
                }).then(response => {
                    const activeContainer = response.data.container;

                    let message = '';
                    let checkbox_status = '';

                    if (isChecked) {
                        message = `You are about to <b>OPEN</b> the container <b>${containerNumber}</b>`;
                        checkbox_status = "only_open";
                    } else {
                        message = `You are about to <b>CLOSE</b> the container <b>${containerNumber}</b>`;
                        checkbox_status = "only_close";
                    }

                    Swal.fire({
                        title: 'Are you sure?',
                        html: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, confirm',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.post('/api/vehicle/toggle-status', {
                                open_id: isChecked ? containerId : null,
                                close_id: !isChecked ? containerId : (activeContainer?.id ?? null),
                                checkbox_status: checkbox_status,
                                warehouseId: warehouseId,
                            })
                                .then((res) => {
                                    console.log(res.data.success);
                                    if (res.data.success) {
                                        Swal.fire('Success', 'Container status updated.', 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Error', res.data.message, 'error').then(() => {
                                            location.reload();
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error', 'Failed to update container status.', 'error');
                                });
                        } else {
                            location.reload(); // rollback visual state
                        }
                    });
                })
                    .catch(error => {
                        Swal.fire('Error', 'Failed to fetch current active container.', 'error');
                    });
            }

        </script>

        <script>
            async function fetchDashboardData(warehouseId = null) {
                try {
                    const url = `/api/dashboard-stats${warehouseId ? '?warehouse_id=' + warehouseId : ''}`;
                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                        }
                    });
                    const data = await response.json();
                    const role_id = {{ $role_id }};
                        if (role_id === 1) {
                            document.getElementById('total-warehouses').textContent = data.total_warehouses ? data.total_warehouses : 0;
                        }
                    document.getElementById('todays-orders').textContent = data.todays_orders ? data.todays_orders : 0;
                    document.getElementById('total-orders').textContent = data.total_orders ? data.total_orders : 0;
                    document.getElementById('ready-for-shipping').textContent = data.ready_for_shipping ? data.ready_for_shipping : 0;
                    document.getElementById('in-transit').textContent = data.in_transit ? data.in_transit : 0;
                    document.getElementById('total-delivered').textContent = data.delivered ? data.delivered : 0;
                    document.getElementById('total-customers').textContent = data.total_customers ? data.total_customers : 0;
                    document.getElementById('new-customers').textContent = data.new_customers ? data.new_customers : 0;
                    document.getElementById('total-drivers').textContent = data.total_drivers ? data.total_drivers : 0;
                    document.getElementById('total-vehicles').textContent = data.total_vehicles ? data.total_vehicles : 0;
                    document.getElementById('total-earnings').textContent =
                        '$' + (data.total_earnings ? Number(data.total_earnings).toLocaleString() : '0');
                    document.getElementById('today-earnings').textContent =
                        '$' + (data.today_earnings ? Number(data.today_earnings).toLocaleString() : '0');
                    document.getElementById('total-supply').textContent = data.total_supply ? data.total_supply : 0;
                    document.getElementById('new-supply').textContent = data.new_supply ? data.new_supply : 0;
                    document.getElementById('cargo-order').textContent = data.total_Cargo ? data.total_Cargo : 0;
                    document.getElementById('air-order').textContent = data.total_Air ? data.total_Air : 0;
                    document.getElementById('total-expenses').textContent =
                        '$' + (data.totalExpenses ? Number(data.totalExpenses).toLocaleString() : '0');
                    document.getElementById('todays-expenses').textContent =
                        '$' + (data.todaysExpenses ? Number(data.todaysExpenses).toLocaleString() : '0');
                    updateContainerCards(data.latest_containers || []);
                    updateUpcomingContainerCards(data.upcomingContainers || []);

                } catch (error) {
                    console.error('Error fetching dashboard data:', error);
                }
            }

            function updateContainerCards(containers) {
                const containerList = document.getElementById('container-list');
                containerList.innerHTML = ''; // purane cards hata do

                if (containers.length === 0) {
                    containerList.innerHTML = `<p class="px-4 py-4 text-center text-gray-500">No container found.</p>`;
                    return;
                }

                containers.forEach((container, index) => {
                    const isActive = container.status === 'Active';
                    const card = document.createElement('div');
                    card.className = 'col-md-5 col-xl-3 col-sm-6';

                    card.innerHTML = `
                                                            <div style="background-size: 45px;" class="card innerCards w-100 setCard setCardSize rounded ${isActive ? 'bg-selected1 open_container_img' : 'close_container_img'}">
                                                                <div class="card2 d-flex flex-row justify-content-between">
                                                                    <div class="col-md-9 justify-content-start p-2 ps-3 pe-1">
                                                                        <p class="font13 fw-medium">
                                                                            <span class="col737">Seal No :</span> ${container.seal_no ?? "-"}
                                                                        </p>
                                                                        <h5 class="text-black countFontSize fw-medium">
                                                                            ${container.container_no_1 ?? "-"}
                                                                        </h5>
                                                                        <div class="cardFontSize mt-2 fw-medium">
                                                                            <span class="fw-regular col737">Total Order :</span> ${container.parcels_count ?? 0}
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-3 justify-content-end mt-1">
                                                                        <div class="status-toggle float-end me-0">
                                                                            <input 
                                                                                onclick="handleContainerClick('${container.id}', '${container.container_no_1}', '${container.warehouse_id}')"
                                                                                id="rating_${container.id}" 
                                                                                class="toggle-btn1 check" 
                                                                                type="checkbox" 
                                                                                ${isActive ? 'checked' : ''}>
                                                                            <label for="rating_${container.id}" class="checktoggle tog checkbox-bg">checkbox</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        `;

                    containerList.appendChild(card);
                });
            }


            function updateUpcomingContainerCards(upcomingContainers) {
                const containerList = document.getElementById('upcoming-container-list');
                containerList.innerHTML = ''; // Remove existing cards
                if (upcomingContainers.length === 0) {
                    return;
                }
                document.getElementById('upcoming-container-header').classList.remove('d-none');
                document.getElementById('upcoming-container-card').classList.remove('d-none');
                upcomingContainers.forEach((container, index) => {
                    console.log(container);
                    const isActive = container.container.status === 'Active';
                    const card = document.createElement('div');
                    card.className = 'col-md-5 col-xl-3 col-sm-6';
                    card.innerHTML = `
                                                        <div style="background-size: 45px;" class="card innerCards w-100 setCard setCardSize rounded ${isActive ? 'bg-selected1 close_container_img' : 'close_container_img'}">
                                                            <div class="card2 d-flex flex-row justify-content-between">
                                                                <div class="col-md-9 justify-content-start p-2 ps-3 pe-1">
                                                                    <p class="font13 fw-medium">
                                                                        <span class="col737">Seal No :</span> ${container.container.seal_no ?? "-"}
                                                                    </p>
                                                                    <h5 class="text-black countFontSize fw-medium">
                                                                        ${container.container.container_no_1 ?? "-"}
                                                                    </h5>
                                                                    <div class="cardFontSize mt-2 fw-medium">
                                                                        <span class="fw-regular col737">Total Order :</span> ${container.no_of_orders ?? 0}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                            `;
                    containerList.appendChild(card);
                });
            }


            // ✅ Page Load ke time by default call
            document.addEventListener('DOMContentLoaded', function () {
                const warehouseSelect = document.getElementById('warehouse');

                let warehouseId = warehouseSelect && warehouseSelect.value ? warehouseSelect.value : null;
                //fetchDashboardData(warehouseId);

                // ✅ select2 ke liye jQuery ka change event use karo
                $(warehouseSelect).on('change', function () {
                    let selectedWarehouseId = $(this).val() ? $(this).val() : null;
                    fetchDashboardData(selectedWarehouseId);
                });
            });

        </script>

        <script>
            function resetForm() {
                window.location.href = "{{ route('admin.dashboard') }}";
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const tabButtons = document.querySelectorAll(".tab-btn");
                const tabContents = document.querySelectorAll(".tab-content-custom");

                tabButtons.forEach((btn) => {
                    btn.addEventListener("click", function () {
                        // Remove active class from all buttons
                        tabButtons.forEach((b) => b.classList.remove("active"));

                        // Hide all tab content
                        tabContents.forEach((content) => content.style.display = "none");

                        // Add active class to clicked button
                        this.classList.add("active");

                        // Show the related tab content
                        const tabId = this.getAttribute("data-tab");
                        document.getElementById(tabId).style.display = "block";
                    });
                });
            });
        </script>

        {{-- Service Order JS --}}
        <script>
            // Function to initialize daterangepicker on any input by ID
            function initDatePicker(inputId) {
                const input = $('#' + inputId);

                input.daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: false,
                    locale: {
                        format: 'MM/DD/YYYY'
                    },
                    minDate: moment().startOf("day") // prevent past date
                });

                input.on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY'));
                });
            }

            // Pickup modal open handler
            $(document).on('click', '.open-reschedule-pickup-modal', function () {
                const pickupDate = $(this).data('date'); // MM/DD/YYYY expected
                const input = $('#percel_pickup_date_input');

                if (pickupDate) {
                    input.val(pickupDate);
                    input.data('daterangepicker').setStartDate(moment(pickupDate, 'MM/DD/YYYY'));
                } else {
                    input.val('');
                    input.data('daterangepicker').setStartDate(moment()); // fallback to today only if date is null
                }
            });

            // Delivery modal open handler
            $(document).on('click', '.open-reschedule-delivery-modal', function () {
                const deliveryDate = $(this).data('date'); // MM/DD/YYYY expected
                const input = $('#percel_delivery_date_input');

                if (deliveryDate) {
                    input.val(deliveryDate);
                    input.data('daterangepicker').setStartDate(moment(deliveryDate, 'MM/DD/YYYY'));
                } else {
                    input.val('');
                    input.data('daterangepicker').setStartDate(moment()); // fallback to today only if date is null
                }
            });

            // Initialize both inputs on page load
            $(function () {
                initDatePicker('percel_pickup_date_input');
                initDatePicker('percel_delivery_date_input');
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#shipping_type').select2({
                    tags: false,
                    placeholder: 'Select shipping type',
                    allowClear: true,
                });

                $('#driver_id_sreach').select2({
                    tags: false,
                    placeholder: 'Select driver',
                    allowClear: true,
                });
            });
        </script>

        <script>
            function fetchDriversBywarehouse(warehouseId) {
                if (!warehouseId) {
                    // If nothing selected, clear dropdown
                    $('#warehousedriverDropdown').html('<option value="">Select Pickup Man</option>');
                    return;
                }

                $.ajax({
                    url: "/api/user-by-warehouse/" + warehouseId,
                    data: { role_id: 4 },
                    method: "GET",
                    success: function (response) {
                        // Clear existing options
                        let options = '<option value="">Select Pickup Man</option>';

                        // Loop through response (assuming it's an array of users)
                        response.users.forEach(function (driver) {
                            options += `<option value="${driver.id}">${driver.name}</option>`;
                        });

                        $('#warehousedriverDropdown').html(options);
                    },
                    error: function () {
                        alert("No driver found for the warehouse.");
                    }
                });
            }
            function fetchDeliveryDriversBywarehouse(warehouseId) {
                if (!warehouseId) {
                    // If nothing selected, clear dropdown
                    $('#warehousedriverDropdown').html('<option value="">Select Pickup Man</option>');
                    return;
                }

                $.ajax({
                    url: "/api/user-by-warehouse/" + warehouseId,
                    data: { role_id: 4 },
                    method: "GET",
                    success: function (response) {
                        // Clear existing options
                        let options = '<option value="">Select Pickup Man</option>';

                        // Loop through response (assuming it's an array of users)
                        response.users.forEach(function (driver) {
                            options += `<option value="${driver.id}">${driver.name}</option>`;
                        });

                        $('#deliverywarehousedriverDropdown').html(options);
                    },
                    error: function () {
                        alert("No driver found for the warehouse.");
                    }
                });
            }
            function updatestatusarrivedwarehouse() {
                let parcelId = $("#parcel_id_input_hidden").val();
                let created_user_id = $("#created_user_id_input_hidden").val();

                if (!parcelId) {
                    alert("Parcel ID is required.");
                    return;
                }
                // Show Loading Indicator
                $(".btn-primary").html("Processing...").prop("disabled", true);

                // Make AJAX POST Request
                $.ajax({
                    url: "/api/update-status-arrived-warehouse", // API endpoint
                    type: "POST",
                    data: {
                        parcel_id: parcelId,
                        created_user_id: created_user_id,
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRF token for Laravel
                    },
                    success: function (response) {
                        document
                            .querySelector("#arrived_warehouse .custom-btn")
                            .click();
                        Swal.fire({
                            title: "Good job!",
                            text: "Status changed successfully!",
                            icon: "success",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle Server-Side Validation Errors
                        let errors = xhr.responseJSON?.errors || {};
                    },
                    complete: function () {
                        // Re-enable Save Button
                        $(".btn-primary").html("Save").prop("disabled", false);
                    },
                });
            }
        </script>

        <script>
            document.getElementById('self_pickup_img').addEventListener('change', function (event) {
                const preview = document.getElementById('preview');
                preview.innerHTML = ''; // Clear previous previews
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.height = 'auto';
                        img.classList.add('mt-2', 'img-thumbnail');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                    $('#upload_signature_pickup_img').hide();
                }
            });

        </script>

         <script>
            document.getElementById("closealerticon").addEventListener("click", function () {
                const userId = {{ auth()->id() }};

                fetch("{{ url('/api/mark-as-read-notification') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ user_id: userId })
                })
                    .then(res => res.json())
                    .then(data => {
                      
                    })
                    .catch(err => {
                        console.error("API error:", err);
                    });
            });
        </script>

    @endsection
</x-app-layout>