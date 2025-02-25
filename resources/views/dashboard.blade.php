<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-light">
            {{ __('Admin Dashboard') }}
    </h2>
    </x-slot>
    <div>
			
    <div class="row">
        <div class="col-xl-12 d-flex">
              
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="row">
                            <!-- First Row (4 Columns) -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">

                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Today’s Order</h5>
											<div class="dash-counts countFontSize">
												<b>254</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="48" height="48" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11.5V32.5L19.6667 43V22M1 11.5L19.6667 1L38.3333 11.5M1 11.5L19.6667 22M38.3333 11.5V22M38.3333 11.5L19.6667 22M43 36H26.6667M26.6667 36L33.6667 29M26.6667 36L33.6667 43" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>

                            <!-- --------- 2nd -------------- -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Total Orders</h5>
											<div class="dash-counts countFontSize">
												<b>354</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 29.75L13.5 37.25V51M1 29.75L13.5 22.25L26 29.75M1 29.75V43.5L13.5 51M26 29.75V43.5M26 29.75L38.5 37.25M26 29.75L38.5 22.25M26 29.75V16M26 43.5L13.5 51M26 43.5L38.5 51M13.5 37.3625L26 29.7875M38.5 37.25V51M38.5 37.25L51 29.75M38.5 22.25L51 29.75M38.5 22.25V8.5M51 29.75V43.5L38.5 51M26 16L13.5 8.5L26 1L38.5 8.5M26 16L38.5 8.5M13.5 8.57507V22.2126" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>
                
            <!--  ---------- 3rd --------------------- -->
                     <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Ready for Shipping</h5>
											<div class="dash-counts countFontSize">
												<b>216</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="48" height="48" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 10.0625V26.9375L16 35.375V18.5M1 10.0625L16 1.625L31 10.0625M1 10.0625L16 18.5M31 10.0625V18.5M31 10.0625L16 18.5M21.625 29.75H34.75M34.75 29.75L29.125 24.125M34.75 29.75L29.125 35.375" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>

            <!-- -------------- 4th -------------------- -->


            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">In Transit</h5>
											<div class="dash-counts countFontSize">
												<b>216</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="80" height="50" viewBox="0 0 65 44" fill="none" xmlns="http://www.w3.org/2000/svg">

<path d="M31.0526 9.68421L45.5263 18.3684V34.2895M31.0526 9.68421L45.5263 1L60 9.68421V25.6053L45.5263 34.2895M31.0526 9.68421V25.6053L45.5263 34.2895M45.5263 18.4987L60 9.72767M19.4737 8.23684H5M19.4737 16.9211H10.7895M19.4737 25.6053H16.5789" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"/>

<defs>
<filter id="filter0_d_584_13544" x="0" y="0" width="80" height="50" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
<feFlood flood-opacity="0" result="BackgroundImageFix"/>
<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
<feOffset dy="4"/>
<feGaussianBlur stdDeviation="2"/>
<feComposite in2="hardAlpha" operator="out"/>
<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_584_13544"/>
<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_584_13544" result="shape"/>
</filter>
</defs>
</svg>


										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>
                
                            <!-- Second Row (4 Columns) -->
            <!-- ----------------- 5th -------------------- -->
                
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Delivered</h5>
											<div class="dash-counts countFontSize">
												<b>189</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="47" height="53" viewBox="0 0 43 49" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M13.6143 44.7333H6.46667C5.01682 44.7333 3.62635 44.1574 2.60115 43.1322C1.57595 42.107 1 40.7165 1 39.2667V6.46667C1 5.01682 1.57595 3.62635 2.60115 2.60115C3.62635 1.57595 5.01682 1 6.46667 1H28.3333C29.7832 1 31.1737 1.57595 32.1988 2.60115C33.224 3.62635 33.8 5.01682 33.8 6.46667V28.3333M25.6 42L31.0667 47.4667L42 36.5333M11.9333 11.9333H22.8667M11.9333 22.8667H17.4" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>
                
        <!-- -------------- 6th-------------------- -->

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Total Customers</h5>
											<div class="dash-counts countFontSize">
                                            <b>220</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="49" height="49" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.9444 44V41.6111C12.9444 40.344 13.4478 39.1287 14.3438 38.2327C15.2398 37.3367 16.4551 36.8333 17.7222 36.8333H27.2778C28.5449 36.8333 29.7602 37.3367 30.6562 38.2327C31.5522 39.1287 32.0556 40.344 32.0556 41.6111V44M34.4444 17.7222H39.2222C40.4894 17.7222 41.7046 18.2256 42.6006 19.1216C43.4966 20.0176 44 21.2329 44 22.5V24.8889M1 24.8889V22.5C1 21.2329 1.50337 20.0176 2.39938 19.1216C3.29539 18.2256 4.51063 17.7222 5.77778 17.7222H10.5556M17.7222 24.8889C17.7222 26.156 18.2256 27.3713 19.1216 28.2673C20.0176 29.1633 21.2329 29.6667 22.5 29.6667C23.7671 29.6667 24.9824 29.1633 25.8784 28.2673C26.7744 27.3713 27.2778 26.156 27.2778 24.8889C27.2778 23.6217 26.7744 22.4065 25.8784 21.5105C24.9824 20.6145 23.7671 20.1111 22.5 20.1111C21.2329 20.1111 20.0176 20.6145 19.1216 21.5105C18.2256 22.4065 17.7222 23.6217 17.7222 24.8889ZM29.6667 5.77778C29.6667 7.04492 30.17 8.26017 31.066 9.15618C31.9621 10.0522 33.1773 10.5556 34.4444 10.5556C35.7116 10.5556 36.9268 10.0522 37.8228 9.15618C38.7188 8.26017 39.2222 7.04492 39.2222 5.77778C39.2222 4.51063 38.7188 3.29539 37.8228 2.39938C36.9268 1.50337 35.7116 1 34.4444 1C33.1773 1 31.9621 1.50337 31.066 2.39938C30.17 3.29539 29.6667 4.51063 29.6667 5.77778ZM5.77778 5.77778C5.77778 7.04492 6.28115 8.26017 7.17716 9.15618C8.07316 10.0522 9.28841 10.5556 10.5556 10.5556C11.8227 10.5556 13.0379 10.0522 13.934 9.15618C14.83 8.26017 15.3333 7.04492 15.3333 5.77778C15.3333 4.51063 14.83 3.29539 13.934 2.39938C13.0379 1.50337 11.8227 1 10.5556 1C9.28841 1 8.07316 1.50337 7.17716 2.39938C6.28115 3.29539 5.77778 4.51063 5.77778 5.77778Z" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>

             <!-- ---------------- 7th ------------ -->
             <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">New Customers</h5>
											<div class="dash-counts countFontSize">
											<b>20</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="41" height="48" viewBox="0 0 37 44" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 39.2052V34.9601C1 32.7084 1.89448 30.549 3.48667 28.9568C5.07886 27.3646 7.23834 26.4701 9.49004 26.4701H14.7963M28.5947 39.2052C27.4688 39.2052 26.3891 38.7579 25.593 37.9618C24.7969 37.1657 24.3497 36.086 24.3497 34.9601C24.3497 33.8343 24.7969 32.7546 25.593 31.9585C26.3891 31.1624 27.4688 30.7151 28.5947 30.7151M28.5947 39.2052C29.7205 39.2052 30.8003 38.7579 31.5964 37.9618C32.3925 37.1657 32.8397 36.086 32.8397 34.9601C32.8397 33.8343 32.3925 32.7546 31.5964 31.9585C30.8003 31.1624 29.7205 30.7151 28.5947 30.7151M28.5947 39.2052V42.3889M28.5947 30.7151V27.5314M35.0279 31.2458L32.2707 32.8376M24.9206 37.0827L22.1614 38.6745M22.1614 31.2458L24.9206 32.8376M32.2707 37.0827L35.03 38.6745M5.24502 9.49004C5.24502 11.7417 6.1395 13.9012 7.73169 15.4934C9.32388 17.0856 11.4834 17.9801 13.7351 17.9801C15.9868 17.9801 18.1462 17.0856 19.7384 15.4934C21.3306 13.9012 22.2251 11.7417 22.2251 9.49004C22.2251 7.23834 21.3306 5.07886 19.7384 3.48667C18.1462 1.89448 15.9868 1 13.7351 1C11.4834 1 9.32388 1.89448 7.73169 3.48667C6.1395 5.07886 5.24502 7.23834 5.24502 9.49004Z" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>


        <!-- --------------------- 8th ----------------------------- -->

        <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Total Drivers</h5>
											<div class="dash-counts countFontSize">
                                            <b>80</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="30" height="54" viewBox="0 0 26 50" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 40C4 41.1819 4.23279 42.3522 4.68508 43.4442C5.13738 44.5361 5.80031 45.5282 6.63604 46.364C7.47177 47.1997 8.46392 47.8626 9.55585 48.3149C10.6478 48.7672 11.8181 49 13 49C14.1819 49 15.3522 48.7672 16.4442 48.3149C17.5361 47.8626 18.5282 47.1997 19.364 46.364C20.1997 45.5282 20.8626 44.5361 21.3149 43.4442C21.7672 42.3522 22 41.1819 22 40C22 38.8181 21.7672 37.6478 21.3149 36.5558C20.8626 35.4639 20.1997 34.4718 19.364 33.636C18.5282 32.8003 17.5361 32.1374 16.4442 31.6851C15.3522 31.2328 14.1819 31 13 31C11.8181 31 10.6478 31.2328 9.55585 31.6851C8.46392 32.1374 7.47177 32.8003 6.63604 33.636C5.80031 34.4718 5.13738 35.4639 4.68508 36.5558C4.23279 37.6478 4 38.8181 4 40Z" fill="white"/>
<path d="M11 40C11 40.5304 11.2107 41.0391 11.5858 41.4142C11.9609 41.7893 12.4696 42 13 42C13.5304 42 14.0391 41.7893 14.4142 41.4142C14.7893 41.0391 15 40.5304 15 40C15 39.4696 14.7893 38.9609 14.4142 38.5858C14.0391 38.2107 13.5304 38 13 38C12.4696 38 11.9609 38.2107 11.5858 38.5858C11.2107 38.9609 11 39.4696 11 40Z" fill="white"/>
<path d="M13 42V49V42Z" fill="white"/>
<path d="M11 40L4.25 38L11 40Z" fill="white"/>
<path d="M15 40L21.75 38L15 40Z" fill="white"/>
<path d="M1 37V33C1 30.8783 1.84285 28.8434 3.34315 27.3431C4.84344 25.8429 6.87827 25 9 25H17C19.1217 25 21.1566 25.8429 22.6569 27.3431C24.1571 28.8434 25 30.8783 25 33V37M13 49C11.8181 49 10.6478 48.7672 9.55585 48.3149C8.46392 47.8626 7.47177 47.1997 6.63604 46.364C5.80031 45.5282 5.13738 44.5361 4.68508 43.4442C4.23279 42.3522 4 41.1819 4 40C4 38.8181 4.23279 37.6478 4.68508 36.5558C5.13738 35.4639 5.80031 34.4718 6.63604 33.636C7.47177 32.8003 8.46392 32.1374 9.55585 31.6851C10.6478 31.2328 11.8181 31 13 31C14.1819 31 15.3522 31.2328 16.4442 31.6851C17.5361 32.1374 18.5282 32.8003 19.364 33.636C20.1997 34.4718 20.8626 35.4639 21.3149 36.5558C21.7672 37.6478 22 38.8181 22 40C22 41.1819 21.7672 42.3522 21.3149 43.4442C20.8626 44.5361 20.1997 45.5282 19.364 46.364C18.5282 47.1997 17.5361 47.8626 16.4442 48.3149C15.3522 48.7672 14.1819 49 13 49ZM13 49V42M11 40C11 40.5304 11.2107 41.0391 11.5858 41.4142C11.9609 41.7893 12.4696 42 13 42M11 40C11 39.4696 11.2107 38.9609 11.5858 38.5858C11.9609 38.2107 12.4696 38 13 38C13.5304 38 14.0391 38.2107 14.4142 38.5858C14.7893 38.9609 15 39.4696 15 40M11 40L4.25 38M13 42C13.5304 42 14.0391 41.7893 14.4142 41.4142C14.7893 41.0391 15 40.5304 15 40M15 40L21.75 38M5 9C5 11.1217 5.84285 13.1566 7.34315 14.6569C8.84344 16.1571 10.8783 17 13 17C15.1217 17 17.1566 16.1571 18.6569 14.6569C20.1571 13.1566 21 11.1217 21 9C21 6.87827 20.1571 4.84344 18.6569 3.34315C17.1566 1.84285 15.1217 1 13 1C10.8783 1 8.84344 1.84285 7.34315 3.34315C5.84285 4.84344 5 6.87827 5 9Z" stroke="#203A5F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>

            <!-- ----------------- Row 3rd--------------- 9th ------------------ -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Total Warehouses</h5>
											<div class="dash-counts countFontSize">
                                            <b>189</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="41" height="39" viewBox="0 0 37 35" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 34V8.76471L18.5 1L36 8.76471V34M20.4444 18.4706H28.2222V34H8.77778V22.3529H20.4444M20.4444 34V16.5294C20.4444 16.0146 20.2396 15.5208 19.8749 15.1568C19.5103 14.7928 19.0157 14.5882 18.5 14.5882H14.6111C14.0954 14.5882 13.6008 14.7928 13.2362 15.1568C12.8715 15.5208 12.6667 16.0146 12.6667 16.5294V22.3529" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>

            <!-- -------------------------10th --------------------------- -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Total Vehicles</h5>
											<div class="dash-counts countFontSize">
                                            <b>240</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="47" height="47" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.5 42C18.8079 42 16.1422 41.4698 13.655 40.4395C11.1678 39.4093 8.90791 37.8993 7.00431 35.9957C5.10071 34.0921 3.59069 31.8322 2.56047 29.345C1.53025 26.8578 1 24.1921 1 21.5C1 18.8079 1.53025 16.1422 2.56047 13.655C3.59069 11.1678 5.10071 8.90791 7.00431 7.00431C8.90791 5.10071 11.1678 3.59069 13.655 2.56047C16.1422 1.53025 18.8079 1 21.5 1C24.1921 1 26.8578 1.53025 29.345 2.56047C31.8322 3.59069 34.0921 5.10071 35.9957 7.00431C37.8993 8.90791 39.4093 11.1678 40.4395 13.655C41.4698 16.1422 42 18.8079 42 21.5C42 24.1921 41.4698 26.8578 40.4395 29.345C39.4093 31.8322 37.8993 34.0921 35.9957 35.9957C34.0921 37.8993 31.8322 39.4093 29.345 40.4395C26.8578 41.4698 24.1921 42 21.5 42ZM21.5 42V26.0556M16.9444 21.5C16.9444 22.7082 17.4244 23.8669 18.2787 24.7213C19.1331 25.5756 20.2918 26.0556 21.5 26.0556M16.9444 21.5C16.9444 20.2918 17.4244 19.1331 18.2787 18.2787C19.1331 17.4244 20.2918 16.9444 21.5 16.9444C22.7082 16.9444 23.8669 17.4244 24.7213 18.2787C25.5756 19.1331 26.0556 20.2918 26.0556 21.5M16.9444 21.5L1.56944 16.9444M21.5 26.0556C22.7082 26.0556 23.8669 25.5756 24.7213 24.7213C25.5756 23.8669 26.0556 22.7082 26.0556 21.5M26.0556 21.5L41.4306 16.9444" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>

            <!-- ------------------------- 11th ------------------- -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Total Earning</h5>
											<div class="dash-counts countFontSize">
                                                <b>$125650</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="58" height="47" viewBox="0 0 54 43" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M41.4444 12.5556V6.77778C41.4444 5.24542 40.8357 3.77582 39.7522 2.69227C38.6686 1.60873 37.199 1 35.6667 1H6.77778C5.24542 1 3.77582 1.60873 2.69227 2.69227C1.60873 3.77582 1 5.24542 1 6.77778V24.1111C1 25.6435 1.60873 27.1131 2.69227 28.1966C3.77582 29.2802 5.24542 29.8889 6.77778 29.8889H12.5556M12.5556 18.3333C12.5556 16.801 13.1643 15.3314 14.2478 14.2478C15.3314 13.1643 16.801 12.5556 18.3333 12.5556H47.2222C48.7546 12.5556 50.2242 13.1643 51.3077 14.2478C52.3913 15.3314 53 16.801 53 18.3333V35.6667C53 37.199 52.3913 38.6686 51.3077 39.7522C50.2242 40.8357 48.7546 41.4444 47.2222 41.4444H18.3333C16.801 41.4444 15.3314 40.8357 14.2478 39.7522C13.1643 38.6686 12.5556 37.199 12.5556 35.6667V18.3333ZM27 27C27 28.5324 27.6087 30.002 28.6923 31.0855C29.7758 32.169 31.2454 32.7778 32.7778 32.7778C34.3101 32.7778 35.7797 32.169 36.8633 31.0855C37.9468 30.002 38.5556 28.5324 38.5556 27C38.5556 25.4676 37.9468 23.998 36.8633 22.9145C35.7797 21.831 34.3101 21.2222 32.7778 21.2222C31.2454 21.2222 29.7758 21.831 28.6923 22.9145C27.6087 23.998 27 25.4676 27 27Z" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>
                <!-- ------------------------- 12th -------------------------- -->
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card inovices-card w-100 setCard h-80">
                                    <div class="d-flex flex-row">
                                    <div class="dash-widget-header col-md-12">
										<div class="col-md-8 float-left">
										<div class="dash-count">
											<h5 class="fontSize">Today’s Earning</h5>
											<div class="dash-counts countFontSize">
												<b>4500</b>
											</div>
                                        </div>
										</div>
                                    <div class="col-md-4">
                                    <span class="dash-widget-icon col-md-6 float-end">
                                    <svg width="53" height="37" viewBox="0 0 49 33" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M40.1667 16.5H40.1928M8.83333 16.5H8.85945M16.6667 16.5C16.6667 18.5554 17.492 20.5267 18.961 21.9801C20.43 23.4335 22.4225 24.25 24.5 24.25C26.5775 24.25 28.57 23.4335 30.039 21.9801C31.508 20.5267 32.3333 18.5554 32.3333 16.5C32.3333 14.4446 31.508 12.4733 30.039 11.0199C28.57 9.56651 26.5775 8.75 24.5 8.75C22.4225 8.75 20.43 9.56651 18.961 11.0199C17.492 12.4733 16.6667 14.4446 16.6667 16.5ZM1 6.16667C1 4.79638 1.5502 3.48222 2.52955 2.51328C3.50891 1.54434 4.8372 1 6.22222 1H42.7778C44.1628 1 45.4911 1.54434 46.4704 2.51328C47.4498 3.48222 48 4.79638 48 6.16667V26.8333C48 28.2036 47.4498 29.5178 46.4704 30.4867C45.4911 31.4557 44.1628 32 42.7778 32H6.22222C4.8372 32 3.50891 31.4557 2.52955 30.4867C1.5502 29.5178 1 28.2036 1 26.8333V6.16667Z" stroke="#203A5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

										</span>
									</div>
                                </div>                                 
                                </div>
                                </div>
                            </div>
            <!-- ------------------------------------------------------------------------------- -->
          <!-- ------------------------ Cards ------------------------------ -->

          <div class="row textColor">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">      
                            <h5 class='cardh5Size'>Latest Container</h5>
                               <button class="btn buttoncolor btn-lg px-4 text-light cardh5Size" type="button">See All</bitton>                         
                        </div>

				<div class="d-flex flex-row justify-content-between align-items-center col-md-12 p-3 flex-wrap">
                    <div class="row">
                    <!-- --------------------------- 1st -------------------------------- -->
                        <div clas="col-lg-3 col-md-6 col-sm-12">
							<div class="card setCard setCardSize" id="card">								
                                <div class="d-flex flex-row text-dark">
                                    <div class="col-md-8 justify-content-start p-3">
                                        <p><span class="opacity-75">Seal No : </span><strong>KG 2114</strong></p>
                                        <h5 class='text-black countFontSize'>Xl Container</h5>
                                        <p class="mt-2"><span class="opacity-75">Total Order : </span><strong>120</strong></p>
                                        <p><span class="opacity-75">Total Amt : </span><strong>$2220</strong></p>
                                        <p><span class=" text-success">Received Amt : </span><strong>$1520</strong></p>
                                        <p><span class="text-danger">Due Amt : </span><strong>$700</strong></p>
                                    </div>

                                <div class="col-4">
                                <div class="my-3">
                                <div class="status-toggle ms-4">
                <input id="rating_3" class="check" type="checkbox" >
                <label for="rating_3" class="checktoggle checkbox-bg">checkbox</label>
            </div>
									</div>   
                                    <div class='mt-5 mb-0'>
                                        <!-- <svg width="101" height="100" viewBox="0 0 101 55" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="120" height="64" transform="matrix(-1 0 0 1 120 0)" fill="url(#pattern0_584_13467)" fill-opacity="0.58"/>
                                            <defs>
                                            <pattern id="pattern0_584_13467" patternContentUnits="objectBoundingBox" width="1" height="3">
                                            <use xlink:href="#image0_584_13467" transform="matrix(0.00104167 0 0 0.00195312 0.233333 0)"/>
                                            </pattern>
                                            <image id="image0_584_13467" width="512" height="612" preserveAspectRatio="none" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAN1wAADdcBQiibeAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAACAASURBVHic7d15lF1lme/x3zk1ZKxKJTEThATCJOFEcEbtbgfgBWkFpK9rCWqvbul76cHpsmwFQfreth1Am7bVZRttXLdbRdS+NgjY8MYroiIBQYEcwiCEDISMlVSSSio1nXP/OCckJJWk9tnv3u/e+/1+1qoVQep5n3XqPCe/evdUqtfrQjzVarVP0jTffbhQLpffvnjx4rt89wEASFbZdwMAACB9BAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAtTuu4EiGBwcXNjW1lby3YcLfX19/YsXL/bdBgAgYaV6ve67BwAAkDIOAQAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAE65D4AK1asuKBUKi2IWXdZpVJ5Nk6Bxx577A/L5fLpMftAdHdWKpV1vpsAACTrkABQKpU+LOm8OEVLpdKlkmIFgHK5/F5JV8SpgejK5fLbJREAAKDgOAQAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECADrkPAAAAIahWq6t99+BKuVy+YPHixSujfA8BAAAQqoW+G3CoM+o3cAgAAIAAEQAAAAgQAQAAgAARAAAACBABAACAABEAAAAI0CGXAdbr9Z+XSqW+OEVrtdqaON/f9BtJPQ7qIIJ6vb7Bdw9FU61WTyyVSq+NU6NWq61ZsmTJ/XFqrFy5cm69Xn9LnBqIrl6vP1OpVB7y3QdwsEMCwJIlSz7vo5GDVSqVmyTd5LsPwIFz6/X6v8QpUCqVvi8pVgCQdGa9Xv9ezBqIbqkkAgAyh0MAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAE6JD7AAAAEIJyufxK3z24smPHjqeifg8BAAAQpMWLFz/iuwefOAQAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiMsAgYTV6/W1pVLp7pg1Yl+uNDo6uiVuH2jJ474bAMZSqtfrvnsAAAAp4xAAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAEKB23w0AQF5Uq9UOSR+R9NVKpbLXdz9AHOwAAMD4fUrSFyT9rlqtvt53M0AcpXq97rsHAMi8arX6SkkPav/O6aikf5R0XaVSGfTWGNAiAgAAHEVz6/8hSa8Y4/9+QtKfVyqVB9LtCoiHQwAAcHTXauy//CXpNEn3VavVz1er1Qkp9gTEwg4AABzBGFv/R/KEpD+rVCoPJtsVEB8BAAAO4yhb/4czqsaJgv+LcwOQZRwCAIDDO9LW/+G0SbpK0m+r1epr3bcEuMEOAACMoVqtnqnG1n9HjDKjkm6Q9L/ZDUDWEAAA4CDNrf/fSDrDUcnH1Tg34CFH9YDYOAQAAIe6Ru7+8pek0yUtr1arn6lWq50O6wItYwcAAA7gaOv/SNgNQCYQAACgKYGt/8MZkXS9pL+vVCpDCa8FjIlDAACwn+ut/8Npb671cLVafXUK6wGHYAcAACRVq9VJkp6WND/lpdkNgBfsAACApEqlMiDpTEm3pLz0vt2Ah6rV6qtSXhsBYwcAAA5SrVYvkfQ1SXNSXnpE0uclfZrdACSNAAAAY6hWqzMlfUXSpR6Wf0zSn1QqlWc8rI1AEAAA4Aiq1eq7JP2L0t8N6JV0UaVSuS/ldREIAgAAHIXH3YBNkiqVSmVryusiAJwECABHUalUeiuVymWS3qXGX8ppmSPpxhTXQ0DYAQCACKrV6gw1dgMuS2nJYUnHViqVLSmth0CwAwAAEVQqlW2VSuW9ki6WtDGFJTvU2HkAnCIAAEALKpXKbWo85Oe7KSx3UgprIDAEAABoUXM34H1KfjfgmARrI1AEAACI6YDdgO8ktER7QnURMAIAADjQ3A14v6SLJG3w3Q9wNAQAAHCoUqn8WMnuBgBOEAAAwLFKpbK9uRtwodgNQEYRAAAgIZVK5XZJf++7D2AsBAAAAAJEAAAAIEAEAAAAAjSua0t7ly76Y0lvkfRqSa+U1JNgTwCQlg2SHpb0W0m3z7xi1UOe+wFSc8QA0Lt00SxJX5d0STrtAECq5kl6R/Pr2t6li74o6bqZV6wa9NsWkLzDHgLoXbrotZKq4i9/AGEoS/q4pId7ly6a57sZIGljBoDepYsmS7pZ0ux02wEA706X9K++mwCSdrgdgOvF06cAhOuC3qWLLvfdBJCkQwJA79JF8yX9jYdeACBLPue7ASBJY+0AvEZSKe1GACBjZvUuXXS87yaApIwVAF6dehcAkE18HqKwxgoAS1LvAgCyic9DFNZYAWBi6l0AQDbxeYjC4lbAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEqD2JolNPmqfOGV1JlAaAcdmzbqv2btjmuw0gsxIJACqXVWpvS6Q0AIxHqcwjTYAj4RAAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAFq993A4exZu0WDW3bEqjHp2JmaOHd6rBp7N27XwPreWDUmzJqmyQtmxaoxtK1fu5/bGKtGR/dkTT35mFg1RvcMaucT62LVKHe2a9qS42PVqI/W1PfIqlg1JGn6q0+KXaPvkVWqj9Zi1Zi2ZKHKnR2xaux8Yp1G9wzGqjH15GPU0T05Vo3dz23U0Lb+WDUmL5ilCbOmxaoB4MgyGwDqw6OqDQ7HqxHzQ3lfjdh9DI/G76MWv4/a8Ej8Pur12H04kZU+JNUGh+O/1+rx+6gPjcR/TWrxZ6aWkdkFcGQcAgAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBA7b4bAICsqu49YdFFVy4/P06NL5hJp79hflusPjbsqs37g5h95MzKvhvPWuu7iaIjAADAYdy3p/JuSe+OVWPtiOIGgJVba38k6Y9iFcmXayR91ncTRcchAABA1szx3UAICAAAgKwhAKSAAAAAyBoCQAoIAACArCEApIAAAADIGgJACggAAICsmdFz5fIO300UHQEAAJBFs303UHQEAABAFs313UDREQAAAFnEeQAJIwAAALKIAJAwAgAAIIsIAAkjAAAAsogAkDACAAAgiwgACSMAAACyiACQMAIAACCLCAAJIwAAALKI+wAkjAAAAMiiGT1XLm/33USREQAAAFlUErcDThQBAACQVZwHkCACAAAgqwgACSIAAACyigCQIAIAACCrCAAJIgAAALKKAJAgAgAAIKu4F0CCCAAAgKxiByBBBAAAQFYRABJEAAAAZBUBIEEEAABAVs3suXJ5m+8miooAAADIqrKkWb6bKCoCAAAgyzgMkBACAAAgywgACSEAAACyjACQEJ61DAAFMGlS5+a2cnnYdx8ulEql0YkTO3ZNnjRhT3t72xTf/RQVAQAACuC8t57Z19ZWPsV3Hwn4he8GiopDAACALON2wAkhAAAAsoxzABJCAAAAZBk7AAkhAAAAsowdgIQQAAAAWTbz8ns4YT0JBAAAQJZxO+CEEAAAAFnHeQAJIAAAALKO8wASQAAAAGQdASABBAAAQNZxCCABBAAAQNaxA5AAAgAAIOvYAUgAAQAAkHXsACSAAAAAyDp2ABJAAAAAZB07AAkgAAAAsm7G5feow3cTRUMAAABkXUnSbN9NFA0BAACQB5wH4BgBAACQB5wH4BgBAACQB+wAOEYAAADkATsAjhEAAAB5wA6AYwQAAEAesAPgGAEAAJAH7AA4RgAAAOQBOwCOEQAAAHnADoBjBAAAQB70XH6PJvhuokgIAACAvOAwgEMEAABAXhAAHCIAAADygvMAHCIAAADygh0AhwgAAIC8YAfAIQIAACAv2AFwiAAAAMgLdgAcIgAAAPKCHQCHCAAAgLxgB8AhAgAAIC/YAXCIAAAAyIvuy+/RJN9NFAUBAACQJ+wCOEIAAADkCecBOEIAAADkCTsAjrT7bgAAEN9zazdvmDpl4gbffSRtV/9Al946z3cbhUAAAIACeLS6+s2+e0jJzyQCgAscAgAA5AmHABwhAAAA8oQA4AgBAACQJwQARwgAAIA8IQA4QgAAAOQJAcARAgAAIE+6e65cPtF3E0VAAAAA5A27AA4QAAAAeUMAcIAAAADIGwKAAwQAAEDeEAAcIAAAAPJmtu8GioAAAADIG3YAHCAAAADyhgDgAAEAAJA3BAAHCAAAgLwhADjQ7rsBAAAimt9z5fL3SFon6XlJL/TdeNaw555yhwAAAMibLknfO+Cfaz1XLt+k/YFg358H/m9CwkEIAACAvCtLmtf8et1h/htCwkEIAACAEBASDkIAAACgIaiQQAAAAGD8ChMSCAAAALiVi5BAAAAAIH3eQwIBAACAbEo0JBAAAADIr/GGhB/23XjWew7+RgAAUFxlST1j/UsAABAYAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAAByux9ANqnTlTnaHesGm2TOmP30TapU50vi9dH+9SJ8fuY0BG/jynx+yi3t8Xuo9zRFrsPlUux+3Clc2a36rVavCLl+Fm8o2eKyjHf86WO+B8JHV2TYtdwMbsuHN9T1jld8V6Tl7+M37OQTZkNABPm9GjCnEMuW0xd54wudc7o8t2G2rsmqavrWN9tqDyhQ12n+O+jVC5nog9JmnrSPN8tSJImL5ztuwVJ0sR5MzQxGy9JbG9a0K5XLIwfnIEsIpoCABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABCgzN4HAADQsGuw7rsFtOjYeTN02inzY9XYuLlP1SfWOupoPwIAAGTc070x7zQJbyZ0dmha9+RYNXb1Dzjq5qU4BAAAGfdU76jvFlBABAAAyLAdg3Wt2s4OANwjAABAhn3x14MaZgMACSAAAEBG/XTViO55bsR3GygoAgAAZNA9q0f0xV8P+m4DBcZVAACQIbsG67px+aCWPctv/khWIgFgdPdeDbezuQDAn9HB4dg1Nuyq6/H1yR+A37G3rqd7R/VUb01Pba1pzzDX/SN5iQSAgfW9Gljfm0RpAEjNz54b1g0PJnMNNuAbv6YDABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABCgse4DsDP1LgAgg/pr8Z7jDmzYvF27H4h3S+e9e4ccdfNSYwWARyS9O5HVACBHVu5d6LsF5NzAwJAGBpL5CzyusQ4BPJx6FwCQQdXBE3y3ACRmrADwkKS9aTcCAFmyemiuto5M890GkJhDAsDMK1b1SrrGQy8AkAl1lfSpTR/w3QaQqMNdBfAlSb9MsxEAyIrv9p2jX++p+G4DSNSYAWDmFatqkt4n6YF02wEAv36y6/W6fstlvtsAEnfY+wDMvGLVWklvknS1pGyewggAjmwb7daHXviIPvTCR7SnNsF3O0DiSvV6/aj/Ue/SRceqEQZes6s2+S3PD896beKdAUDCNo1M12N7T9RjA4v00MCp2sV1/yiuu/tuPOv8A//FuALAgXquXH6mpN+57AoAACTqkADArYABAAgQAQAAgAARAAAACBABAACAABEAAAAIEAEAAIAAEQAAAAhQu+8GQlKq19Qxulsdw7vUMbJLnc0/O0b6VaqPaLi9q/HV0aWh9qkabu/WcMdU1Urh/phK9RF1jvQ3X7P+l7xu9VK5+ZpNbb5mXS/+c71EtkW2MP/RMf/JCvedlYLJezepZ+cT6un/vSYMbVfHyG5J0W68JEkjbZM03NGlnVMWaXv3y7Vr8vEFfYPX1bV7rabvelLd/c+qc3iH2kcHWqhT0nD7ZA119GhH18na3nWadk+a57xb4EiY/6iY/7RxJ0Cn9r2Bn9D0nU9owtD2RFYZaZukvq5TtL37NO2YepJq5c5E1klDuTasabufVc/OJzV911NqH9mdyDpDHdO0vfu0gn+Awi/mPyrmP1XcCjgJ0/qf1YwdKxJ9Ax9OrdSunVNP1Pbu07S15xWq52C7sFSvacaOFZqxc6Wm9T+jcm041fX3fYBum1ZRX9epqa6N4mH+o2H+vSEAuDRl4Hkt2GjVtXu171YkSYMdPXp+ztnq7XmFpJLvdsY0fedKHbdpmSYO9vpuRZLUP2m+1s012jXleN+tIGeY/+iYf68IAC5MHNqm+ZuWacaOx323MqY9E+dq3VyjHVNP8t3Ki7r2rNFxG62m7lnnu5Ux9XWdqnVzz9XAhNm+W0HGMf/RMf+ZQACIo2Nkt47Z/HPN3v6QSvVR3+0c1c6pJ2rdHOP1BJiJg1t13Car6Tuf9NbDeNVLZW3tOVPrZ79NQx3dvttBxjD/0TXmf5mm73zCWw/jFcD8EwBaUarXNG/rLzVvyy/VVhvy3U5EJfX2LNGauW/XSPuU1FZtqw3quI1Ws7Y/rFK9ltq6LtTKHdo48w1aP/utqpfafLcDz5j/6Jj/TDokAGT/jBHP2kb36qR1P9S0/t/7bqVFdc3se0xTd6/V7xe+V3smzkl8xQlD23TKmu9q0uCWxNdKQrk2rGO2/EJde9bo9wsu1UjbZN8twRPmPzrmPz+CvBZivCYO9er0Vd/I8fDvN2G4T6et+mbiW3Hdu1fp9GeX5nb4D9S1e41Of/brmrx3k+9W4AHzHx3zny8EgMPo7l+lxc9+QxMHt/puxZm22pBOXnuLjtlybyL152x7QKeu/vcWb96RTROGmh+cu7J/DgPcYf6jY/7zhwAwhjm9D+jUNcV6I+9X1/xN/08nrvuhs+tvS/VRHf/C7Vr4wp25O943Hm21IZ285ns6ZssvfLeCFDD/0TD/+cU5AAco1WtauOFOzd72G9+tJG7mjhWaOLRNTy+8TMPtXS3XaR/do5PX3pKZa6GTU9f8TT/VpMHNWnXsxbm44QqiYf6jY/7zjR2AAyzYeFcQw7/PlIH1OnX1t1v+TaBUH9XJa74XwPDvN7PvMZ2w/jbfbSABzH80zH/+EQCaZm97SHN6l/tuI3WT927Uoud/pFYeUnL8C7era88a901l3Mv6HtW8rb/y3QYcYv6Z//Eq0vwTACR17V6thRvu9N2GNzN2Pq5jN0c7MWhO73LN2v7bhDrKvuM2LlPPrqd8twEHmH/mP6qizH/wAWDC0HadvPaWXNzZK0nHbr5H03euHNd/293/rBZsvCvhjrKurhPX/YcmDW723QhiYP4bmP+oijH/xTiToUVttUGdsua7ah/dk+ayI5Kek7RB0sbmnxskDUmaJ2lu8895ko6XlNLtu+o68fkfaeWiGdozce5h/6uJQ9t00rofpH2274Ck1dr/Wu37atP+12rf1wmSOtJoat/75/ETryj0zUKKivk/EPMfVRHmP+AAkGqC2y3pLkm3SbrDWjuuB4UbYzolnS3pYkkXqvHhkJhybUgnr7m58YYe47ahjTf8d9K6PGqLpDsk3SppmbV2XIsaY7olXaDGa/Z2SYne1HvC0HadtPb7eur4Py3abUMLjvk/GPMfXd7nP9hnAczpXa6FG36S9DK/knSDGm/gvXEKGWNKkl4v6a8kvU8JHr7Z3n2afr/g0kP+/Qnr/1Oztif+o/+BpK9Kus9aG+vXjOYH6FslfUzSOQ56O6z1s9+m9bPfkuQScIj5PzzmP7qczD8PA5IaSfaMp/4pya2/JyVdZa1N5HoRY8wZkq6XdF4S9SVp5aK/UP/kBS/+8+S9m1R55mtq5WzhcfqFpL+11j6YRHFjzHlqvGZnJFF/tNypx075qIbbpyZRHg4x/0fH/EeTk/k/JAAEeRLgvC2/TGr4t0r6S0lLkhp+SbLWPmqtPV/SuZJWJLHGgo32Jf88f9MyJTT8T0u60Fr75qSGX5KstXdLepWkP1Pj+KFTbbUhHbv5567LIgHM/9Ex/9Hkdf6DCwCdI7s0t/f+JEo/Juk11tql1tqRJBY4mLX2p2psC37Pde2pe9a++OCQ7t3PqWfX066XkBrH+F5jrb09ieIHs9bWrLX/psYHwQOu68/a/pAmDvW6LguHmP/xYf6jy+P8BxcAjt30M2f3wD7ArZLeZK1N/a4Y1toBa+1lkq6W5PTU3OM2LVOpPqrjDvptwJEbJF1krd2VRPEjsdZulPQWSd9xWbdUr2n+xp+6LAnHmP/xY/6jyeP8BxUAJg1u0cv6nJ++8BlJl1hr+10XjsJa+3lJF0lyNlATB7dq4Qt3asrAelclJWlQ0p9aaz8R9ySfOKy1e62175d0lRzubc7Y+bimDjzvqhwcYv6jYf6jy9v8BxUAjttoXV+/+gVr7bXW2sTOjInCWnuHpP8mydldTWb1Ob/b1westd92XbRV1trrJV3rsmZCvzEhpvkblzH/ETH/0eVp/oMJAFMGNri+deOdaqTHTLHWWklXuqrn+APzc9bam10WdMFa+1k5PI7atXu1unevclUODkwZ2OD6me7Mf3TMf8YEEwCm73zcZbmVki7zuYV1JNbaL0v6V999HOTHkq7x3cQRfECSs0fBzdgxvtuqIh3Mv3fMfwYFFACecFVqh6R3Wmt3uiqYkL+W9GvfTTQ9Iem9WdkqHUvzRi0XS9rkol7PrieV4DXTiIj594r5z6ggAsDEoW2aNLjFVbnPWmszv79jrR2W9EFl4134Ud8nSY2HtfYFSde5qNU5vFNTBl5wUQoxMf/eMf8ZFUQA6HGX/tdK+rKrYkmz1v5OCVwjHNGy5nHJvLhJjd9YYpu+0+kxZ7SI+feK+c+wIAKAw5N/PhX3nt4eXKvGk8Z8qEv6uKe1W2KtHZWjk7t63J50hhYx/8z/eIU2/4UPAO2jezR1zzoXpR6V4xtHpMFa+5ykr3ta/jvW2kc8rd0ya+2PJf0ybp3JezdpwtC4HvyGhDD/zH9UIc1/4QNAz86nXF3K8pWsnvU7Dv/sad0veVrXBSevmeNLzxAR8y+J+W9FEPPf7ruBpE3rf8ZFmZoa961uiTHm9ZLeFbOHR621LR3Ps9auMsaskLQkZg9RrLPWtnwXEWPMxZLOitnDf1lr723xe+9W465lE+I0MK3/GW2c+YY4JRAD88/8t/i9Qcx/4QPAhOEdLso8aK2Nc3nIKyV9ImYP31e8E3puU7ofAHGfhna+pCti1uiT1NIHgLW23xhzT7OPlnUOOXn/oUXM/4uY/whCmf/CHwLoGHFya+zEHu2ZolsLvl4SYv/cHb3/0CLm/0XMf3SFn//CB4DOYSc/gFQeV5kka+3DktJ6SkXLyTtjYv/c20cHknj6HMaJ+W9g/ltS+PkvdABoHx1QqR770dyjcnRdaAZUU1rnybSeiZ4ka+16SbFP4+0Yyfw9UAqJ+T8E8x9BCPNf6ADQ4Sb9b8zx2b8H21CwddIQ+3ZenSNZv2tsMTH/h2D+oyv0/Bc6ADh64Z0+DNuzjQVbJw2xf/6O/iJCRMz/IZj/6Ao9/4UOAI5e+Ozf0Hn8+A0gOge/AWT3A6DImP9DMP/RFXr+Cx0AHL3wfABkd500xP75Z/k3gCJj/g/B/EdX6PmPfB+AvhvPekRSKYFenDPmuk9K+ozvPhC2eVt/9YUVN1+Xq3uiFwHzjyzI8vwXegdAbtL7MQ5qZMW8gq2TBhc//yL9FpknzP9LMf/RFXr+CQBHxwdAdtdJQ6E/AAqO+X8p5j+6Qs8/AeDojnVQIyvmFmydNLj4+Wf2A6DgmP+XYv6jK/T8EwCObq4xpiivE78BRFfo3wAKjvl/KeY/ukLPf1He2GOy1m5T44lOcbRJOs1BO1lQSWmdlxtjcv+gKWPMsZKmOyhVpLOic4P5PwTzH0EI81/oANDkIn2900ENr4wxr5Y0P6XleiS9OaW1kuTi577dWjvgoA5aw/yL+W9R4eefADA+Fzmo4dvFBV8vCS5+7pnd/gsE89/A/EdX+PnP/TbNOKyV9KaYNV5njJkT45ngv5N0fcweHo35/Wl/iF0k6UMxvv8uNZ4qFsf9rX6jMWaqpLfGXF+S1jiogdYx/w3MfwShzH8IAcBKujRmjbKkd0i6qaUGrH1A0gMxe2iZMWaRpCUpL3ucMeZV1trftvLN1tpb5feZ4udJmuCgjnVQA61j/pn/VgQx/yEcArhDjUd6xvWhHJ8N/BFP637U07ouuHrNfH6IgfmXmP9WBDH/eX1Dj5u1dqukXzsodYak9zmokypjzAmS/tLT8u8zxpzpae2WGWMulPSHDko9Yq3N9BZg0TH/zH9UIc1/4QNA022O6nzaGDPRUa20/IOkTk9rlyTd4Gntlhhj2iR93lG5TKf/gDD/fjD/GUcAiGaBpA87qpU4Y8wrFf/4Z1znGmOM5x6iuFzurvvO/AdAIJh/f5j/DCvV63XfPaTCGPO4pMUOSu2Q9Cpr7SoHtRJjjOmQ9HNJb/TciiQ9Iel11tp+340ciTHmGEm/lTTHQbnV1toTHNSBA8y/V8x/RoWyAyC5+y1gmqTbjTHdjuol5WvKxvBLjUT9XWNMZh8j3dzavVVuhl/KQfoPDPPvD/OfUSEFgP9wWGuxpJuzelawMebDkv7Cdx8HuVDZfjb7tyS91mG9HzqshfiYf7+Y/wzKLbDrDQAACQBJREFU5Bs4Cc3rUW93WPKP5e5kEWeax9tudFjSxSVU+1xtjLnMYT0njDGflNtjpT+11ro48xyONOf/xw5LMv/RhTL/y/Iy/8EEgKar5PYN/bfGmH/IytaWMeYdavym0+aw7Lcc1pKkbxlj3u+4ZsuMMZ9Q40xpV+qSPuGwHty5Wsx/VMx/NHU1/p7JhWBOAtzHGPNNud8eu1XS+32e5GKMuUqNLTaXoe5JSa+QdJ/cbo9JjcuDrrbW1hzXHZfmMb9vyv213bdYa32feY3DYP4jYf6jy9X8h7YDIEl/J8n105kulnSfMWah47pHZYyZZIy5WdLn5P7nebW1dljSxx3XVbPmbcaYrgRqH5ExZq4aZ0i7Hv5hSdc4rgm3mP/xY/6jyd38B7cDIEnGmM9I+mQCpbdKulbSTdbakQTqv4Qx5hw1jvclcZ/vX1trX3yIijHmTkkXJLDO05I+Zq11eX7GmJonbb1fjQ/LeQks8VVrbZwHoCAFzP+4MP/R5W7+Q9wBkBpP5tqaQN2XSfq6pBXGmMSevmWMOcMYc5ekZUruIR8Hp/6rJCWxXXeKpB8bY+41xrwugfqSJGPMeWpc4/t/lMzw90v6dAJ14R7zf3TMfzS5nP8gdwCkFy+V+eeEl/mVGse6lllr98Yp1DzR6PWS/kqNraskw9t/WmsvGaOHb0n68wTXlaQfSPqqpPviHh80xnSq8UjPj0k6x0FvR/J31tq/T3gNOML8HxHzH10u5z/kAFBW4+Sdd6aw3G41nm99m6Q7rLXbx/NNzTfw2WocY7xQ0tzEOtxvtRp37doyRj/dajzW9OUp9LFFjSe53arGB+i4jts2e7xAjdfs7ZLSuGHLzyWZ5vFS5ADzf1irxfxH9XPldP6DDQCS1DwB5X5Jp6e47Iik5yRtkLSx+ecGSUNqbE3Nbf45T9Lxkqak2Fu/pDdaa1cc7j8wxpwk6UFJ01PrqnHS1mrtf632fbVp/2u17+sESR0p9rZKjQ/M3hTXhAPM/yGY/+hyPf9BBwDpxcdl/kbSTN+9eFaX9C5r7VFvmdo8+eguub3eOI92SXqDtfZx342gNcz/i5j/6HI//6GeBPgia+1zkv5EjUs4QnbteIZfkqy1P5V0ZcL9ZF1N0mV5Hn4w/wdg/qMpxPwHHwAkyVp7r6QP+u7Do5uttZ+N8g3W2i9LuimhfvLgamvtHb6bQHzMP/PfgkLMPwGgyVr7DUlf8d2HB79R4xnYrfhrNc50Ds23rbU3+G4C7jD/LWH+c44A8FL/U9JS302k6H5J72j1EiVr7ZAaZ9ve67SrbLtZ0n/33QQSwfxHwPznX/AnAY7FGPNBSf8kqd13Lwn6N0lXWGsH4xYyxnSo8dvTFbG7yq66pGustZ/z3QiSxfxHw/znFwHgMIwxZ6vxTOc0L3dJQ03SJ6y1X3Rd2BjzN5K+pOJ9cPZLeq+11uXjZJFhzH90zH/+EACOwBhzshrPEE/jxhdp2CnpUmvtT5JawBjzNjU+OGcktUbKVku68EjXRqOYmP/omP98IQAchTFmmqRbJJ3vu5eYnlXjjbwy6YWMMSeq8cG5OOm1EvZLSZdYa5O4bzxygPmPjvnPD04CPApr7Q5J71DjKV/envcdQ03Sv6txt6rEh1+SrLXPSjpLjROqEn8qWgIGJH1W0tlFHn4cHfMfHfOfH+wARGCMmS3pOkn/Q+nebrJVd6lxvO8xXw0YY14u6fOSEns6mkOjapwcdZ21dr3vZpAtzH90zfn/nBpXC2RdcPNPAGhB837Yn5X0bt+9HMbDkj5urf2Z70b2Mcb8gRpPRnuD714O4w5JV+X9zl5IHvMfHfOfTQSAGJrPr75B0pt999K0StI1kr5vrc3kD9YYc4kavxGc4ruXpgfU+LD8he9GkC/Mf3TMf7YQABwwxpwr6T1qPFp0VsrL75G0TNKPJN3SvDlHphlj2tV4vS6RdJ6kySm30CvpTkk/sNbemfLaKBjmPxrmPzsIAA41nzH+JjWOd10saVFCS21WY8vqNkV4VnYWGWMmSTpXjXMEkvwAXaXG63WbpF9Za0cTWgeBYv6jY/79IgAkyBizRI0PggvUeE71LEW/8qKmxsA/L+keNd7A91traw5bzYQDPkAvknSOpOPU2vXEI2o8L3y1pLsl3WatrTpqExgX5j8a5j99BIAUGWPaJM2RNK/5dcwB/7tDjTftC82v9c0/N1lr83gpjRPGmAmS5mr/63Tg16j2v14Hfm3O6jFQhIv5j475TxYBAACAAHEjIAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAACRAAAACBABAAAAAJEAAAAIEAEAAAAAkQAAAAgQAQAAAAC1O67AQDIs2q1erakjphl7q1UKgMx+3ijpO6YfaRhoFKp3Ou7CRAAACCu/ytpWswaJ0haHbPG1ySdEbNGGtZIOt53E+AQAAAAQSIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABavfdAADk3ApJXTFrDDno4ykHNdLwgu8G0FCq1+u+ewAAACnjEAAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAECACAAAAASIAAAAQIAIAAAABIgAAABAgAgAAAAEiAAAAEKB23w0gPdVqtV3S1JhlRiuVyq6YfZQldcfsA9ENVyqV3b6bAJANBICwnCPpv2LWeFTSmTFrLJD0XMwaiO5uSef7bgJANnAIAACAABEAAAAIEAEAAIAAEQAAAAgQAQAAgAARAAAACBABAACAABEAAAAIEAEAAIAAEQAAAAgQAQAAgAARAAAACBABAACAABEAAAAIEAEAAIAAEQAAAAjQ/wfbG1FCX5+xzgAAAABJRU5ErkJggg=="/>
                                            </defs>
                                        </svg> -->
                                    </div>
                                </div>
                            </div>
						</div>

							</div>
</div>

                            <!-- ----------------- 2nd ----------------- -->
    <div clas="col-lg-3 col-md-6 col-sm-12">
<div class="card setCard setCardSize setBgColor">								
    <div class="d-flex flex-row text-dark">
  
        <div class="col-md-8 justify-content-start p-3">
            <p><span class="opacity-75">Seal No : </span><strong>2E 879</strong></p>
            <h5 class='text-black countFontSize'>Xl Container</h5>
            <p class="mt-2"><span class="opacity-75">Total Order : </span><strong>120</strong></p>
            <p><span class="opacity-75">Total Amt : </span><strong>$2220</strong></p>
            <p><span class=" text-success">Received Amt : </span><strong>$1520</strong></p>
            <p><span class="text-danger">Due Amt : </span><strong>$700</strong></p>
        </div>

    <div class="col-4">
    <div class="my-3">


<div class="status-toggle ms-4">
    <input id="rating_2" class="check" type="checkbox" checked="">
        <label for="rating_2" class="checktoggle checkbox-bg">checkbox</label>
</div>
        </div>
        <div class='mt-5 mb-0'>
            <!-- <svg width="101" height="100" viewBox="0 0 101 55" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="120" height="64" transform="matrix(-1 0 0 1 120 0)" fill="url(#pattern0_584_13467)" fill-opacity="0.58"/>
                <defs>
                <pattern id="pattern0_584_13467" patternContentUnits="objectBoundingBox" width="1" height="3">
                <use xlink:href="#image0_584_13467" transform="matrix(0.00104167 0 0 0.00195312 0.233333 0)"/>
                </pattern>
                <image id="image0_584_13467" width="512" height="612" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg> -->
        </div>
    </div>
</div>
</div>
</div>


<!-- --------------------------------- 3rd ------------------------------------- -->


<div clas="col-lg-3">
<div class="card setCard setCardSize">								
    <div class="d-flex flex-row text-dark">
  
        <div class="col-md-8 justify-content-start p-3">
            <p><span class="opacity-75">Seal No : </span><strong>F2 172</strong></p>
            <h5 class='text-black countFontSize'>Xl Container</h5>
            <p class="mt-2"><span class="opacity-75">Total Order : </span><strong>120</strong></p>
            <p><span class="opacity-75">Total Amt : </span><strong>$2220</strong></p>
            <p><span class=" text-success">Received Amt : </span><strong>$1520</strong></p>
            <p><span class="text-danger">Due Amt : </span><strong>$700</strong></p>
        </div>

    <div class="col-4">
        <div class="my-3">
            <div class="status-toggle ms-4">
                <input id="rating_3" class="check" type="checkbox" >
                <label for="rating_3" class="checktoggle checkbox-bg">checkbox</label>
            </div>
        </div>
        <div class='mt-5 mb-0'>
            <!-- <svg width="101" height="100" viewBox="0 0 101 55" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="120" height="64" transform="matrix(-1 0 0 1 120 0)" fill="url(#pattern0_584_13467)" fill-opacity="0.58"/>
                <defs>
                <pattern id="pattern0_584_13467" patternContentUnits="objectBoundingBox" width="1" height="3">
                <use xlink:href="#image0_584_13467" transform="matrix(0.00104167 0 0 0.00195312 0.233333 0)"/>
                </pattern>
                <image id="image0_584_13467" width="512" height="612" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg> -->
        </div>
    </div>
</div>
</div>
</div>


<!-- --------------------------------------- 4th ---------------------------------- -->
<div clas="col-lg-3">
<div class="card setCard setCardSize">								
    <div class="d-flex flex-row text-dark">
  
        <div class="col-md-8 justify-content-start p-3 cardFontSize">
            <p><span class="opacity-75 cardFontSize">Seal No : </span><strong>NF 3501</strong></p>
            <h5 class='text-black countFontSize'>Xl Container</h5>
            <p class="mt-2"><span class="opacity-75">Total Order : </span><strong>120</strong></p>
            <p><span class="opacity-75">Total Amt : </span><strong>$2220</strong></p>
            <p><span class=" text-success">Received Amt : </span><strong>$1520</strong></p>
            <p><span class="text-danger">Due Amt : </span><strong>$700</strong></p>
        </div>

    <div class="col-4">
        <div class="my-3">
            <div class="status-toggle ms-4">
                <input id="rating_4" class="check" type="checkbox" >
                <label for="rating_4" class="checktoggle checkbox-bg">checkbox</label>
            </div>
        </div>
        <div class='mt-5 mb-0'>
            <!-- <svg width="101" height="100" viewBox="0 0 101 55" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect width="120" height="64" transform="matrix(-1 0 0 1 120 0)" fill="url(#pattern0_584_13467)" fill-opacity="0.58"/>
                <defs>
                <pattern id="pattern0_584_13467" patternContentUnits="objectBoundingBox" width="1" height="3">
                <use xlink:href="#image0_584_13467" transform="matrix(0.00104167 0 0 0.00195312 0.233333 0)"/>
                </pattern>
                <image id="image0_584_13467" width="512" height="612" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                </defs>
            </svg> -->
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
							<div class="card shadow flex-fill p-0">
								
									<div class="d-flex justify-content-between align-items-center p-4">
										<h5 class="cardh5Size">Users Analytics</h5>

										<div class="main">
											<h5 class='cardAnalyticsSize'>Customers and Drivers Analytics</h5>
										</div>
									</div>
                                    <hr class="border border-dark border-2 opacity-25 mt-0"></hr>
							
							
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
							<div class="card shadow flex-fill p-0">
								
									<div class="d-flex justify-content-between align-items-center p-4">
										<h5 class="cardh5Size">Payment Analytics</h5>

										<div class="main">
											<h5 class='cardAnalyticsSize'>Earning Analytics</h5>
										</div>
									</div>
                                    <hr class="border border-dark border-2 opacity-25 mt-0"></hr>                                 

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
                    
              
       <!-- ----------------------------------------------------------------------------------------- -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dash-title">
                                <h4 class="order-title">Latest Orders</h4>
                            </div>
                            <div class="card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-stripped table-hover datatable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>
                                                        Order ID
                                                    </th>
                
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                
                
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
                                                                    Invoice</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <span>Maury Cambling</span>
                
                                                        </h2>
                                                    </td>
                                                    <td>
                
                                                        <a href="invoice-details.html"
                                                            class="invoice-link">#4987</a>
                                                    </td>
                
                                                    <td>12/03/2024</td>
                                                    <td><span>Medium</span></td>
                
                
                                                    <td><span class="badge bg-success-light">Paid</span>
                                                    </td>
                                                    <td>$1,54,220</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="btn-action-icon"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"><i
                                                                    class="fas fa-ellipsis-v"></i></a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-end customer-dropdown">
                                                                <a class="dropdown-item"
                                                                    href="edit-invoice.html"><i
                                                                        class="far fa-edit me-2"></i>Edit</a>
                                                                <a class="dropdown-item"
                                                                    href="invoice-details.html"><i
                                                                        class="far fa-eye me-2"></i>View</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#view_modal"><i
                                                                        class="far fa-eye me-2"></i>View
                                                                    Delivery Challans</a>
                                                                <a class="dropdown-item"
                                                                    href="javascript:void(0);"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_modal"><i
                                                                        class="far fa-trash-alt me-2"></i>Delete</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-send me-2"></i>Send</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-download me-2"></i>Download</a>
                                                                <a class="dropdown-item"
                                                                    href="add-credit-notes.html"><i
                                                                        class="fe fe-file-text me-2"></i>Convert
                                                                    to Sales Return</a>
                                                                <a class="dropdown-item" href=""><i
                                                                        class="fe fe-copy me-2"></i>Clone as
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
</div>

</div>
</div>
<!-- </div> -->

            </div>
        </div>
    </div>

</div>

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

