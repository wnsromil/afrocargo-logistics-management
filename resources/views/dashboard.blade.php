<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-light">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="row">

            <!-- <div class="d-flex justify-content-between align-items-center">
                        <div class="row"> -->
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-3 g-4 ">

                    <!-- <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4"> -->


                    <!-- First Row (4 Columns) -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">

                                <!-- <div class="dash-widget-header col-md-12 "> -->
                                <div class="col-md-8">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Today’s Orders</p>
                                        <div class="dash-counts countFontSize2">
                                            254
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Orders</p>
                                        <div class="dash-counts countFontSize2">
                                            354
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <h5 class="fontSize fw-medium text-dark">Ready for Shipping</h5>
                                        <div class="dash-counts countFontSize2">
                                            236
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">In Transit</p>
                                        <div class="dash-counts countFontSize2">
                                            216
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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

                </div>
            </div>

            <!-- Second Row (4 Columns) -->
            <!-- ----------------- 5th -------------------- -->
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-3 g-4 ">

                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontpize fw-medium">Delivered</p>
                                        <div class="dash-counts countFontSize2">
                                            189
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Customers</p>
                                        <div class="dash-counts countFontSize2">
                                            220
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">New Customers</p>
                                        <div class="dash-counts countFontSize2">
                                            20
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Drivers</p>
                                        <div class="dash-counts countFontSize2">
                                            80
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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

                </div>
            </div>


            <!-- ----------------- Row 3rd ------------------ -->
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-3 g-4">


                    <!-- ------------------------- 9th card --------------------------->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Warehouses</p>
                                        <div class="dash-counts countFontSize2">
                                            189
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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

                    <!-- -------------------------10th --------------------------- -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Vehicles</p>
                                        <div class="dash-counts countFontSize2">
                                            240
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Earnings</p>
                                        <div class="dash-counts countFontSize2">
                                            $125650
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Today Earnings</p>
                                        <div class="dash-counts countFontSize2">
                                            4500
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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

                </div>
            </div>

            <!-- ------------------- Row 4th ------------------------ -->
            <div class="col-md-12">
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <!-- ------------------------- 13th card --------------------------->
                    <div class="col-md-3 col-sm-6">
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">Total Supply</p>
                                        <div class="dash-counts countFontSize2">
                                            450
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
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
                        <div class="card innerCards inovices-card w-100 setCard h-75">
                            <div class="d-flex flex-row justify-content-between">
                                <!-- <div class="dash-widget-header col-md-12"> -->
                                <div class="col-md-8 float-left">
                                    <div class="dash-count">
                                        <p class="fontSize fw-medium">New Supply</p>
                                        <div class="dash-counts countFontSize2">
                                            30
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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

                </div>
            </div>
        </div>

    </div>
    <!-- </div>
    </div> -->
    <!-- ------------------------------------------------------------------------------- -->
    <!-- ------------------------ Cards ------------------------------ -->

    <div class="row">

        <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
            <h5 class='cardh5Size'>Latest Container</h5>
            <button class="btn buttoncolor btn-lg px-4 text-light cardh5Size" type="button">See All</bitton>
        </div>


        <div class="col-md-12">
            <div class="row row-cols-1 row-cols-md-3 row-cols-sm-2 g-4 justify-content-between">
                <!-- --------------------------- 1st -------------------------------- -->

                <div class="col-md-5 col-xl-3 col-sm-6">
                    <div class="card innerCards inovices-card w-100 setCard setCardSize">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="col-md-8 justify-content-start p-3 pe-1">
                                <p><span class="opacity-75 font13">Seal No : </span><strong>KG 2114</strong></p>
                                <h5 class='text-black countFontSize'>Xl Container</h5>
                                <div class="cardFontSize mt-2">
                                    <span class="opacity-75">Total Order :
                                    </span><strong>120</strong><br>
                                    <span class="opacity-75">Total Amt : </span><strong>$2220</strong><br>
                                    <span class=" text-success">Received Amt : </span><strong>$1520</strong><br>
                                    <span class="text-danger">Due Amt : </span><strong>$700</strong><br>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="my-3">
                                    <div class="status-toggle float-end me-3">
                                        <input id="rating_1" class="check" type="checkbox">
                                        <label for="rating_1" class="checktoggle tog checkbox-bg">checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ----------------- 2nd ----------------- -->


                <div class="col-md-5 col-xl-3 col-sm-6">
                    <div class="card innerCards inovices-card w-100 setCard setCardSize checkbox-cardBg">
                        <div class="d-flex flex-row justify-content-between">

                            <div class="col-md-8 justify-content-start p-3 pe-1">
                                <p><span class="opacity-75 font13">Seal No : </span><strong>F2 172</strong></p>
                                <h5 class='text-black countFontSize'>Xl Container</h5>
                                <div class="cardFontSize mt-2">
                                    <span class="opacity-75">Total Order :
                                    </span><strong>120</strong><br>
                                    <span class="opacity-75">Total Amt : </span><strong>$2220</strong><br>
                                    <span class=" text-success">Received Amt : </span><strong>$1520</strong><br>
                                    <span class="text-danger">Due Amt : </span><strong>$700</strong><br>
                                </div>
                            </div>

                            <div class="col-4 justify-content-end">
                                <div class="my-3">
                                    <div class="status-toggle float-end me-3">
                                        <input id="rating_2" class="check" type="checkbox" checked="">
                                        <label for="rating_2" class="checktoggle tog checkbox-bg">checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- --------------------------------- 3rd ------------------------------------- -->
                <div class="col-md-5 col-xl-3 col-sm-6">
                    <div class="card innerCards inovices-card w-100 setCard setCardSize">
                        <div class="d-flex flex-row justify-content-between">

                            <div class="col-md-8 justify-content-start p-3 pe-1">
                                <p><span class="opacity-75 font13">Seal No : </span><strong>F2 172</strong></p>
                                <h5 class='text-black countFontSize'>Xl Container</h5>
                                <div class="cardFontSize mt-2">
                                    <span class="opacity-75">Total Order :
                                    </span><strong>120</strong><br>
                                    <span class="opacity-75">Total Amt : </span><strong>$2220</strong><br>
                                    <span class=" text-success">Received Amt : </span><strong>$1520</strong><br>
                                    <span class="text-danger">Due Amt : </span><strong>$700</strong><br>
                                </div>
                            </div>

                            <div class="col-4 justify-content-end">
                                <div class="my-3">
                                    <div class="status-toggle float-end me-2">
                                        <input id="rating_3" class="check" type="checkbox">
                                        <label for="rating_3" class="checktoggle tog checkbox-bg">checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- --------------------------------------- 4th ---------------------------------- -->
                <div class="col-md-5 col-xl-3 col-sm-6">
                    <div class="card innerCards inovices-card w-100 setCard setCardSize">
                        <div class="d-flex flex-row justify-content-between">

                            <div class="col-md-8 justify-content-start p-3 pe-1 cardFontSize">
                                <p><span class="opacity-75 font13">Seal No : </span><strong>NF
                                        3501</strong></p>
                                <h5 class='text-black countFontSize'>Xl Container</h5>
                                <div class="cardFontSize mt-2">
                                    <span class="opacity-75">Total Order :
                                    </span><strong>120</strong><br>
                                    <span class="opacity-75">Total Amt : </span><strong>$2220</strong><br>
                                    <span class=" text-success">Received Amt : </span><strong>$1520</strong><br>
                                    <span class="text-danger">Due Amt : </span><strong>$700</strong><br>
                                </div>
                            </div>

                            <div class="col-4 justify-content-end">
                                <div class="my-3">
                                    <div class="status-toggle float-end me-3">
                                        <input id="rating_4" class="check" type="checkbox">
                                        <label for="rating_4" class="checktoggle tog checkbox-bg">checkbox</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ---------------------------------- card ends ----------------------------------------------------- -->


    <!-- ---------------------------- Bar Graph / Pie Chart ---------------------- -->

    <div class="row">
        <h5 class='cardh5Size mb-3'>Analytics</h5>
        <div class="col-xl-6 d-flex">
            <div class="card shadow-box flex-fill p-0">

                <div class="d-flex justify-content-between align-items-center p-4">
                    <h5 class="cardh5Size">Users Analytics</h5>

                    <div class="main">
                        <h5 class='cardAnalyticsSize'>Customers and Drivers Analytics</h5>
                    </div>
                </div>
                <hr class="border border-dark border-2 opacity-25 mt-0">
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


                <div class="card-body">
                    <div id="s-col"></div>
                </div>
            </div>
        </div>

        <!-- -------------------------- pie chart ---------------------------- -->

        <div class="col-xl-6 d-flex">
            <div class="card shadow-box flex-fill p-0">

                <div class="d-flex justify-content-between align-items-center p-4">
                    <h5 class="cardh5Size">Payment Analytics</h5>

                    <div class="main">
                        <h5 class='cardAnalyticsSize'>Earning Analytics</h5>
                    </div>
                </div>
                <hr class="border border-dark border-2 opacity-25 mt-0">
                </hr>

                <div class="card-body">
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

    <div class="row">
        <div class="col-sm-12">
            <div class="dash-title">
                <h5 class="order-title cardh5Size">Latest Orders</h5>
            </div>
            <div class="card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-stripped table-hover datatable">
                            <thead class="thead-light backColor">
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Maury Cambling</span>

                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#40906</a>
                                    </td>

                                    <td>12/28/2023</td>
                                    <td>Medium</td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>
                                    <td>$167.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- 2 -->
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Torin Cavaney</span>

                                        </h2>
                                    </td>
                                    <td>

                                        <a href="invoice-details.html" class="invoice-link">#4987</a>
                                    </td>

                                    <td>03/19/2024</td>
                                    <td><span>Short</span></td>


                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:orange;"></i>Pending</td>
                                    <td>$863.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Gwyn Axan</span>
                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#91515</a>
                                    </td>

                                    <td>10/27/2023</td>
                                    <td><span>Short</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:orange;"></i>Pending</td>

                                    <td>$617.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Charisse Pemberton</span>

                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#88163</a>
                                    </td>

                                    <td>08/15/2024</td>
                                    <td><span>Large</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>

                                    <td>$751.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Naville Fellis</span>

                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#46997</a>
                                    </td>

                                    <td>12/02/2023</td>
                                    <td><span>Medium</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>

                                    <td>$356.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Sustte Clementi</span>
                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#33633</a>
                                    </td>

                                    <td>08/29/2023</td>
                                    <td><span>Short</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>

                                    <td>$940.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Harriet Scougal</span>

                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#39473</a>
                                    </td>

                                    <td>04/16/2024</td>
                                    <td><span>Medium</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>

                                    <td>$125.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Bendix Doyie</span>
                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#86451</a>
                                    </td>
                                    <td>01/05/2024</td>
                                    <td><span>Large</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>

                                    <td>$759.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Jalene tailby</span>
                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#14598</a>
                                    </td>
                                    <td>05/06/2024</td>
                                    <td><span>Medium</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:red;"></i>Canceled</td>

                                    <td>$300.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="opacity-75">
                                    <td>
                                        <h2 class="table-avatar">
                                            <span>Nedi Holtham</span>
                                        </h2>
                                    </td>
                                    <td>
                                        <a href="invoice-details.html" class="invoice-link">#21931</a>
                                    </td>
                                    <td>08/09/2024</td>
                                    <td><span>Large</span></td>
                                    <td><i class="fa fa-stop pe-1" data-bs-toggle="tooltip" title="fa fa-stop"
                                            style="color:orange;"></i>Pending</td>

                                    <td>$456.00</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="btn-action-icon" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h tooltipped" data-position="top"
                                                    data-tooltip="fa fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                <a class="dropdown-item" href="edit-invoice.html"><i
                                                        class="far fa-edit me-2"></i>Edit</a>
                                                <a class="dropdown-item" href="invoice-details.html"><i
                                                        class="far fa-eye me-2"></i>View</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#view_modal"><i
                                                        class="far fa-eye me-2"></i>View
                                                    Delivery Challans</a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#delete_modal"><i
                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-send me-2"></i>Send</a>
                                                <a class="dropdown-item" href=""><i
                                                        class="fe fe-download me-2"></i>Download</a>
                                                <a class="dropdown-item" href="add-credit-notes.html"><i
                                                        class="fe fe-file-text me-2"></i>Convert
                                                    to Sales Return</a>
                                                <a class="dropdown-item" href=""><i class="fe fe-copy me-2"></i>Clone as
                                                    Invoice</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagi-dash">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- </div> -->

    </div>
    </div>
    </div>



    <!-- ---------------------------------------------------------------------------------------------------- -->






    <!-- <script>
    // rating_1

    const card = document.getElementById('card');
    const toggle = document.getElementById('toggle');

    toggle.addEventListener('change', ()=>{
        if(toggle.checked){
            card.style.backgroundColor = "green";
        }else{
            card.style.backgroundColor = "blue";
        }
    });


    
</script> -->
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->

    <!-- DataTables JS -->
    <!-- <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

</x-app-layout>