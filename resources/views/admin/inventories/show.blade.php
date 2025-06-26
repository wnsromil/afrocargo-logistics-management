<x-app-layout>
    <x-slot name="header">
        {{ __('Inventory Detail') }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="head">Item ID - {{$inventories->unique_id ?? "-"}}</p>
    </x-slot>

    <section class="mt-4">
        <div class="row px-4">

            <div class="col-md-12 col-sm-12 mb-4 d-flex align-items-center mb-4 text-dark">
                @if (!empty($inventories->img))
                    <img src="{{ asset($inventories->img) }}" alt="Inventory Image" class="inventory-img">
                @else
                    <span style="margin-right: 10px;">No Image Available</span>
                @endif
                <div>
                    <h5 class="label fw-semibold fs_18">Item Name</h5>
                    <p class="fs_18">{{$inventories->name ?? "-"}}</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Inventory Type</h6>
                    <p>{{$inventories->inventary_sub_type ?? "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Barcode Code</h6>
                    <p>{{$inventories->barcode_have ?? "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Warehouse Name</h6>
                    <p>{{$inventories->warehouse->warehouse_name ?? "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Created At</h6>
                    <p>{{$inventories->created_at ? $inventories->created_at->format('m/d/Y') : "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Cost Price</h6>
                    <p>{{$inventories->price ?? "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Quality</h6>
                    <p>{{$inventories->in_stock_quantity ?? "-"}}</p>
                </div>
            </div>
            @if ($inventories->inventary_sub_type == "Supply")
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Low Stock Warning</h6>
                        <p>{{$inventories->low_stock_warning ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Minimum Order Limit</h6>
                        <p>{{$inventories->minimum_order_limit ?? "-"}}</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Retail Price</h6>
                        <p>{{number_format($inventories->retail_vaule_price ?? 0, 2)}}</p>
                    </div>
                </div>
            @endif

            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Package Type</h6>
                    <p>{{$inventories->package_type ?? "-"}}</p>
                </div>
            </div>
            @if ($inventories->inventary_sub_type == 'Ocean Cargo' || $inventories->inventary_sub_type == 'Air Cargo')
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Shipping Price</h6>
                        <p>${{ number_format($inventories->retail_shipping_price ?? 0, 2) }}</p>
                    </div>
                </div>
            @endif
            <div class="col-md-8 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Description</h6>
                    <p class="pe-5">{{$inventories->description ?? "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Default Driver App</h6>
                    <p>{{$inventories->driver_app_access ?? "-"}}</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="basic-info-detail">
                    <h6>Created At </h6>
                    <p>
                        {{ $inventories->created_at ? $inventories->created_at->format('m/d/Y') : "-"}}
                    </p>
                </div>
            </div>
        </div>
        <hr>
        @if ($inventories->inventary_sub_type == 'Ocean Cargo' || $inventories->inventary_sub_type == 'Air Cargo')
            <div class="row px-4">
                <div class="col-md-12 col-sm-12 mb-4 mb-2">
                    <h4 class="cargo-title text-dark">Ocean Cargo/Air Cargo</h4>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Country</h6>
                        <p>{{$inventories->country ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>State</h6>
                        <p>{{$inventories->state ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>City</h6>
                        <p>{{$inventories->city ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>State/Zone</h6>
                        <p>{{$inventories->state_zone ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Weight (kg)</h6>
                        <p>{{$inventories->weight ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Item Length (inch)</h6>
                        <p>{{$inventories->item_length_inch ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Item Width (inch)</h6>
                        <p>{{$inventories->width ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Item Height (inch)</h6>
                        <p>{{$inventories->height ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Weight Price</h6>
                        <p>{{$inventories->weight_price ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Volume (L*W*H)</h6>
                        <p>{{$inventories->volume_total ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Volume Price(1*1*1)</h6>
                        <p>{{$inventories->volume_price ?? "-"}}</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Factor</h6>
                        <p>{{$inventories->factor ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Insurance</h6>
                        <p>{{$inventories->insurance_have ?? "-"}}</p>
                    </div>
                </div>
                @if($inventories->insurance_have == "Yes")
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="basic-info-detail">
                            <h6>Insurance</h6>
                            <p>{{$inventories->insurance ?? "-"}}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        @if ($inventories->inventary_sub_type == 'Supply')
            <div class="row px-4">
                <div class="col-md-12 col-sm-12 mb-4 mb-2">
                    <h4 class="cargo-title text-dark">Supply</h4>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Country</h6>
                        <p>{{$inventories->country ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>State</h6>
                        <p>{{$inventories->state ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>City</h6>
                        <p>{{$inventories->city ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Weight (kg)</h6>
                        <p>{{$inventories->weight ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Item Length (inch)</h6>
                        <p>{{$inventories->item_length_inch ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Item Width (inch)</h6>
                        <p>{{$inventories->width ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Item Height (inch)</h6>
                        <p>{{$inventories->height ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Volume (L*W*H)</h6>
                        <p>{{$inventories->volume_total ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail d-flex align-items-center">
                        <h6 class="me-2">Color</h6>
                        @if($inventories->color)
                            <div
                                style="width: 20px; height: 20px; background-color: {{ strtolower($inventories->color) }}; border: 1px solid #ccc; margin-right: 8px;">
                            </div>
                            <p class="mb-0">{{ $inventories->color }}</p>
                        @else
                            <p class="mb-0">-</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Open</h6>
                        <p>{{$inventories->open ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Capacity</h6>
                        <p>{{$inventories->capacity ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Un Rating</h6>
                        <p>{{$inventories->un_rating ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Model Number</h6>
                        <p>{{$inventories->model_number ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Qty on hand</h6>
                        <p>{{$inventories->qty_on_hand ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Retail Value Price</h6>
                        <p>{{$inventories->retail_vaule_price ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Value Price</h6>
                        <p>{{$inventories->value_price ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Last Cost Received</h6>
                        <p>{{$inventories->last_cost_received ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Re-order Point</h6>
                        <p>{{$inventories->re_order_point ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Re-order Quantity</h6>
                        <p>{{$inventories->re_order_quantity ?? "-"}}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Last Date Received</h6>
                        <p>{{$inventories->last_date_received ? $inventories->last_date_received->format('m/d/Y') : "-"}}
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="basic-info-detail">
                        <h6>Tax</h6>
                        <p>{{$inventories->tax_percentage . "%" ?? "-"}}</p>
                    </div>
                </div>
            </div>
        @endif

    </section>

</x-app-layout>