<x-app-layout>

    <x-slot name="header">
        New Bill of Lading Detail
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Edit Bill of Lading Detail</p>
        </div>
    </x-slot>

    <div class="container">
        <form action="{{ route('admin.lading_details.update', $billOfLadingDetail->id) }}" method="POST" enctype="multipart/form-data" id="lading_details">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 col-sm-12 col-lg-6 border border-secondary px-0">
                    <div class="responsiveness">
                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Shipper/Exporter</th>
                            </tr>
                            <tr>
                                <td class="border-0">
                                    <select class="form-control inp select2 @error('shipperDetails_id') is-invalid @enderror" id="shipperDetails_id" name="shipperDetails_id" data-old="{{ old('shipperDetails_id', $billOfLadingDetail->shipperDetails_id) }}">
                                        <option disabled hidden {{ old('shipperDetails_id', $billOfLadingDetail->shipperDetails_id) ? '' : 'selected' }}>Select Shipper</option>
                                        @foreach ($billOfLadings->where('type','Shipper')->values() as $billOfLading)
                                            <option value="{{ $billOfLading->id ?? '' }}" {{ old('shipperDetails_id', $billOfLadingDetail->shipperDetails_id) == $billOfLading->id ? 'selected' : '' }}>{{ $billOfLading->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('shipperDetails_id')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                    <div class="border border-primary p-2 mt-2" id="shipperDetails"
                                        data-old-company="{{ old('shipper_company', optional($billOfLadingDetail->shipperDetails)->company) }}"
                                        data-old-fullname="{{ old('shipper_fullname', optional($billOfLadingDetail->shipperDetails)->name) }}"
                                        data-old-address="{{ old('shipper_address', optional($billOfLadingDetail->shipperDetails)->address) }}"
                                        data-old-city="{{ old('shipper_city', optional($billOfLadingDetail->shipperDetails)->city) }}"
                                        data-old-state="{{ old('shipper_state', optional($billOfLadingDetail->shipperDetails)->state) }}"
                                    >
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Company: </div>
                                            <div class="col-md-9 col-sm-6" id="company">{{ old('shipper_company', optional($billOfLadingDetail->shipperDetails)->company) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">FullName: </div>
                                            <div class="col-md-9 col-sm-6" id="fullname">{{ old('shipper_fullname', optional($billOfLadingDetail->shipperDetails)->name) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Address: </div>
                                            <div class="col-md-9 col-sm-6" id="address">{{ old('shipper_address', optional($billOfLadingDetail->shipperDetails)->address) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">City: </div>
                                            <div class="col-md-9 col-sm-6" id="city">{{ old('shipper_city', optional($billOfLadingDetail->shipperDetails)->city) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">State: </div>
                                            <div class="col-md-9 col-sm-6" id="state">{{ old('shipper_state', optional($billOfLadingDetail->shipperDetails)->state) }}</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Consignee</th>
                            </tr>
                            <tr>
                                <td class="border-0">
                                    <select class="form-control inp select2 @error('consigneeDetails_id') is-invalid @enderror" id="consigneeDetails_id" name="consigneeDetails_id" data-old="{{ old('consigneeDetails_id', $billOfLadingDetail->consigneeDetails_id) }}">
                                        <option disabled hidden {{ old('consigneeDetails_id', $billOfLadingDetail->consigneeDetails_id) ? '' : 'selected' }}>Select Consignee</option>
                                        @foreach ($billOfLadings->where('type','Consignee')->values() as $billOfLading)
                                            <option value="{{ $billOfLading->id ?? '' }}" {{ old('consigneeDetails_id', $billOfLadingDetail->consigneeDetails_id) == $billOfLading->id ? 'selected' : '' }}>{{ $billOfLading->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('consigneeDetails_id')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                    <div class="border border-primary p-2 mt-2" id="consigneeDetails"
                                        data-old-company="{{ old('consignee_company', optional($billOfLadingDetail->consigneeDetails)->company) }}"
                                        data-old-fullname="{{ old('consignee_fullname', optional($billOfLadingDetail->consigneeDetails)->name) }}"
                                        data-old-address="{{ old('consignee_address', optional($billOfLadingDetail->consigneeDetails)->address) }}"
                                        data-old-city="{{ old('consignee_city', optional($billOfLadingDetail->consigneeDetails)->city) }}"
                                        data-old-state="{{ old('consignee_state', optional($billOfLadingDetail->consigneeDetails)->state) }}"
                                    >
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Company: </div>
                                            <div class="col-md-9 col-sm-6" id="company">{{ old('consignee_company', optional($billOfLadingDetail->consigneeDetails)->company) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">FullName: </div>
                                            <div class="col-md-9 col-sm-6" id="fullname">{{ old('consignee_fullname', optional($billOfLadingDetail->consigneeDetails)->name) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">Address: </div>
                                            <div class="col-md-9 col-sm-6" id="address">{{ old('consignee_address', optional($billOfLadingDetail->consigneeDetails)->address) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">City: </div>
                                            <div class="col-md-9 col-sm-6" id="city">{{ old('consignee_city', optional($billOfLadingDetail->consigneeDetails)->city) }}</div>
                                        </div>
                                        <div class="row mb-1">
                                            <div class="col-md-3 col-sm-6 text-blue">State: </div>
                                            <div class="col-md-9 col-sm-6" id="state">{{ old('consignee_state', optional($billOfLadingDetail->consigneeDetails)->state) }}</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">NotifyParty</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control @error('notify_party') is-invalid @enderror" rows="6" name="notify_party">{{ old('notify_party', $billOfLadingDetail->notify_party) }}</textarea>
                                    @error('notify_party')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Pier</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control @error('pier') is-invalid @enderror" rows="3" name="pier">{{ old('pier', $billOfLadingDetail->pier) }}</textarea>
                                    @error('pier')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table">
                            <tr>
                                <td class="col-md-6 col-lg-6 col-sm-12 br-1 p-0">
                                    <table class="table form-section">
                                        <tr>
                                            <th class="thead-light thead_2">Vessel</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control inp @error('vessel') is-invalid @enderror" name="vessel" value="{{ old('vessel', $billOfLadingDetail->vessel) }}" />
                                                @error('vessel')
                                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="thead-light thead_2">Port of dischard</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control inp @error('port_of_dischard') is-invalid @enderror" name="port_of_dischard" value="{{ old('port_of_dischard', $billOfLadingDetail->port_of_dischard) }}" />
                                                @error('port_of_dischard')
                                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="col-md-6 col-lg-6 col-sm-12 bl-1 p-0">
                                    <table class="table form-section">
                                        <tr>
                                            <th class="thead-light thead_2">Port of loading</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control inp @error('port_of_loading') is-invalid @enderror" name="port_of_loading" value="{{ old('port_of_loading', $billOfLadingDetail->port_of_loading) }}" />
                                                @error('port_of_loading')
                                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="thead-light thead_2">Place of delivery</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control inp @error('place_of_delivery') is-invalid @enderror" name="place_of_delivery" value="{{ old('place_of_delivery', $billOfLadingDetail->place_of_delivery) }}" />
                                                @error('place_of_delivery')
                                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 col-lg-6 border border-secondary px-0">
                    <div class="form-section responsiveness">
                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Document No</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control inp @error('document_no') is-invalid @enderror" name="document_no" value="{{ old('document_no', $billOfLadingDetail->document_no) }}" />
                                    @error('document_no')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Expert Referent</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control @error('expert_referent') is-invalid @enderror" rows="3" name="expert_referent">{{ old('expert_referent', $billOfLadingDetail->expert_referent) }}</textarea>
                                    @error('expert_referent')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Forwarding Agent-Reference</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control inp @error('forwarding_agent_reference') is-invalid @enderror" name="forwarding_agent_reference" value="{{ old('forwarding_agent_reference', $billOfLadingDetail->forwarding_agent_reference) }}" />
                                    @error('forwarding_agent_reference')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Point and Country Of origin</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control @error('point_and_country_of_origin') is-invalid @enderror" rows="3" name="point_and_country_of_origin">{{ old('point_and_country_of_origin', $billOfLadingDetail->point_and_country_of_origin) }}</textarea>
                                    @error('point_and_country_of_origin')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Domestic Routing/Export Instruction</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control @error('domestic_routing_export_instruction') is-invalid @enderror" rows="6" name="domestic_routing_export_instruction">{{ old('domestic_routing_export_instruction', $billOfLadingDetail->domestic_routing_export_instruction) }}</textarea>
                                    @error('domestic_routing_export_instruction')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>

                        <table class="table form-section">
                            <tr>
                                <th class="thead-light thead_2">Delivery agent</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea class="form-control @error('delivery_agent') is-invalid @enderror" rows="6" name="delivery_agent">{{ old('delivery_agent', $billOfLadingDetail->delivery_agent) }}</textarea>
                                    @error('delivery_agent')
                                        <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row border border-secondary border-top-0">
                <div class="form-section responsiveness px-0">
                    <table class="table form-section">
                        <tr>
                            <th colspan="3" class="thead-light thead_2">Particulars Furnished by Shipper</th>
                        </tr>
                        <tr>
                            <th class="thead-light thead_2">Mark and no</th>
                            <th class="thead-light thead_2 border border-secondary border-bottom-0">No of packages</th>
                            <th class="thead-light thead_2">Desc of packages</th>
                        </tr>
                        <tr>
                            <td>
                                <textarea class="form-control @error('mark_and_no') is-invalid @enderror" rows="6" name="mark_and_no">{{ old('mark_and_no', $billOfLadingDetail->mark_and_no) }}</textarea>
                                @error('mark_and_no')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </td>
                            <td>
                                <textarea class="form-control @error('no_of_packages') is-invalid @enderror" rows="6" name="no_of_packages">{{ old('no_of_packages', $billOfLadingDetail->no_of_packages) }}</textarea>
                                @error('no_of_packages')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </td>
                            <td>
                                <textarea class="form-control @error('desc_of_packages') is-invalid @enderror" rows="6" name="desc_of_packages">{{ old('desc_of_packages', $billOfLadingDetail->desc_of_packages) }}</textarea>
                                @error('desc_of_packages')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                                <input type="hidden" name="email">
                            </td>
                        </tr>
                    </table>
                </div>
                {{-- <div class="form-section responsiveness px-0">
                    <table class="table form-section">
                        <tr>
                            <th class="thead-light thead_2 border border-secondary border-bottom-0">Delivery By</th>
                            <th class="thead-light thead_2 border border-secondary border-bottom-0">Comment</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <p>ARRIVED DATE:_____________Time:_________</p>
                                    <p>UNLOADED DATE:_____________Time:_________</p>
                                    <p>CHECKED BY:____________________</p>
                                    <p>CHECKED BY:____________________</p>
                                    <p>PLACE IN SHIP ON DOCK LOCATION____________________</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <p>For Master</p>
                                    <p>BY_________</p>
                                    <p>Receiving clear</p>
                                    <p></p>
                                    <p>Date___________________</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div> --}}
            </div>
            <div class="row">
                <div class="form-section responsiveness px-0">
                    <table class="table form-section">
                        <tr>
                            <th class="thead-light thead_2 border border-secondary border-bottom-0">DeliveryList</th>
                        </tr>
                        <tr>
                            <td>
                                <textarea class="form-control @error('delivery_list') is-invalid @enderror" rows="6" name="delivery_list">{{ old('delivery_list', $billOfLadingDetail->delivery_list) }}</textarea>
                                @error('delivery_list')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            
        </form>
    </div>


    <hr>
    <div class="px-2">
        <div class="row g-3 align-items-center mb-3">
            <div class="col-auto">
                <input type="text" id="email_id" class="form-control" placeholder="Enter Email" value="{{ old('email_id') }}">
            </div>
            <div class="col-auto">
                <label for="email_id" class="col-form-label">Email</label>
            </div>
        </div>
        <button id="email_6" class="btn btn-outline-secondary btn-sm" onclick="redirectTo('{{ route('admin.lading_details.index') }}')" data-bs-dismiss="modal">Cancel</button>
        <a href="{{ route('lading_details.billOfLadingPdf',$billOfLadingDetail->id) }}" class="btn btn-outline-secondary btn-sm" target="blank">Print</a>
        <button class="btn btn-primary btn-sm" id="saveform"><i class="fa-regular fa-file-lines pe-2"></i>Save</button>
    </div>



    @section('script')
    <script src="{{asset('js/lading_details.js')}}"></script>
    <script>
        $('#email_id').on('input', function() {
            var email = $(this).val();
            $('input[name="email"]').val(email);
        });
    </script>
    @endsection

</x-app-layout>