<x-app-layout>
    @section('style')
        <style>
            .form-group-customer.customer-additional-form {
                border: 0;
                margin: 0;
            }
        </style>
    @endsection
    <x-slot name="header">
        Add New Expenses
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead me-sm-4">Add New Expenses </p>
    </x-slot>

    <div class="">

        <form id="expenses" action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group-customer customer-additional-form">
                <!-- first row end  -->
                <div class="row mt-0 g-3 align-items-stretch">
                    <div class="col-md-6 mt-sm-0 mt-3 align-items-stretch">
                        <div class="borderset">
                            <div class="row gx-3 gy-2">

                                @php
                                    $role_id = Auth::user()->role_id;
                                @endphp
                               
                                @if($role_id == 2 || $role_id == 4)
                                    {{-- ✅ Readonly Input for Single Warehouse --}}
                                    <div class="col-md-12 mb-1">
                                        <label class="foncolor" for="warehouse"> Warehouse <i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}"
                                            readonly style="background-color: #e9ecef; color: #6c757d;">
                                        <input type="hidden" name="warehouse" value="{{ $warehouses[0]->id }}">
                                    </div>
                                @else
                                    {{-- ✅ Select Dropdown for Multiple Warehouses --}}
                                    <div class="col-md-12 mb-1">
                                        <label class="foncolor" for="warehouse"> Warehouse <i class="text-danger">*</i></label>
                                        <select id="warehouse" class="js-example-basic-single select2 form-control" name="warehouse"
                                            style="" value="{{ old('warehouse') }}">
                                            <option value="">Select Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ old('warehouse') == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->warehouse_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warehouse')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endif
                               
                                <div class="col-md-12 mb-1">
                                    <label> Date <i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="text" name="expense_date" readonly style="cursor: pointer; background-color: #ffffff;"
                                            class="btn-filters  form-cs inp  inputbackground"
                                            value="{{ old('expense_date') }}" placeholder="MM-DD-YYYY" />
                                            <input type="text" class="form-control inp inputs text-center timeOnlyInput" readonly value="{{$time}}" name="currentTIme">
                                        @error('expense_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label> Description <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp" name="description" value="{{ old('description') }}"
                                        placeholder="Enter Description" />
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @if($role_id == 2 || $role_id == 4)
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="User">User</label>
                                    <select class="js-example-basic-single select2" name="user_id">
                                        <option selected="selected" value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="User">User</label>
                                    <select class="js-example-basic-single select2 form-control" name="user_id">
                                        <option value="">Select User</option>
                                        <!-- उपयोगकर्ता विकल्प AJAX के माध्यम से लोड होंगे -->
                                    </select>
                                </div>
                                @endif
                                @if($role_id == 2 || $role_id == 4)
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="Container">Container</label>
                                    <select class="js-example-basic-single select2" name="container_id" >
                                        <option selected="selected" value="">Select Container</option>
                                        @foreach ($containers as $container)
                                            <option value="{{ $container->id }}" {{ old('container_id') == $container->id ? 'selected' : '' }}>
                                                {{ $container->container_no_1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="Container">Container</label>
                                    <select class="js-example-basic-single select2 form-control" name="container_id">
                                        <option value="">Select Container</option>
                                     
                                    </select>
                                </div>
                                @endif

                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="Category">Currency <i
                                            class="text-danger">*</i></label>
                                          <select id="currency_select" class="form-control select2" name="currency">
                                              <option selected="selected" value="">Select Currency</option>
                                            <option value="BDT" {{ old('currency') == 'BDT' ? 'selected' : '' }}>Bangladesh - BDT</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>Belgium - EUR</option>
                                            <option value="KWD" {{ old('currency') == 'KWD' ? 'selected' : '' }}>Kuwait - KWD</option>
                                            <option value="XCD" {{ old('currency') == 'XCD' ? 'selected' : '' }}>Dominica - XCD</option>
                                            <option value="INR" {{ old('currency') == 'INR' ? 'selected' : '' }}>India - INR</option>
                                            <option value="DOP" {{ old('currency') == 'DOP' ? 'selected' : '' }}>Dominican Republic - DOP</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>Andorra - EUR</option>
                                            <option value="CLP" {{ old('currency') == 'CLP' ? 'selected' : '' }}>Chile - CLP</option>
                                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>United States - USD</option>
                                            <option value="DKK" {{ old('currency') == 'DKK' ? 'selected' : '' }}>Greenland - DKK</option>
                                            <option value="CVE" {{ old('currency') == 'CVE' ? 'selected' : '' }}>Cabo Verde - CVE</option>
                                            <option value="XOF" {{ old('currency') == 'XOF' ? 'selected' : '' }}>Côte d'Ivoire - XOF</option>
                                            <option value="XOF" {{ old('currency') == 'XOF' ? 'selected' : '' }}>Mali - XOF</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>European Union - EUR</option>
                                        </select>
                                    @error('currency')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label> Amount <i class="text-danger">*</i></label>
                                    <input type="number" class="form-control inp" name="amount" value="{{ old('amount') }}"
                                        placeholder="Enter Amount" />
                                    @error('amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm-0 mt-3 align-items-stretch">
                        <div class="borderset">
                            <div class="row gx-3 gy-2">
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="Category">Expense Category <i
                                            class="text-danger">*</i></label>
                                            <select class="js-example-basic-single select2" name="category">
                                                <option value="">Select Category</option>
                                                <option value="Expense" {{ old('category') == 'Expense' ? 'selected' : '' }}>Expense</option>
                                                <option value="Deposit" {{ old('category') == 'Deposit' ? 'selected' : '' }}>Deposit</option>
                                            </select>
                                    @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                 <div class="col-md-12 mb-1">
                                <div class="row justify-content-start">
                                <div class="col-md-2">
                                    <div class="input-block">
                                        <label class="foncolor m-0 p-0">Type<i class="text-danger">*</i></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-block mb-3 d-flex">
                                        <label class="foncolor mb-0 pt-0 me-2 col3A">Expense</label> <input
                                            class="form-check-input mt-0" type="radio" {{ old('type', 'Expense') === 'Expense' ? 'checked' : '' }} value="Expense" name="type">
                                    </div>
                                </div>
                                    <div class="col-md-3">
                                        <div class="input-block mb-3 d-flex">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A">Income</label> <input
                                                class="form-check-input mt-0" {{ old('type') === 'Income' ? 'checked' : '' }} type="radio" value="Income" name="type">
                                        </div>
                                    </div>
                                      @error('type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                                 </div>
                                <div class="col-md-12 mb-1">
                                    <div class="d-flex align-items-center justify-content-center pt-4">
                                        <label class="foncolor set me-3" for="img">Image</label>
                                        <div class="avtarset oneonly" style="position: relative;">
                                            <!-- Image Preview -->
                                            <img id="preview_image" class="avtars" src="{{ asset('assets/img.png') }}"
                                                alt="avatar">

                                            <!-- File Input (Hidden by Default) -->
                                            <input type="file" id="file_image" name="image"
                                                accept="image/png, image/jpeg" style="display: none;"
                                                onchange="previewImage(this, 'preview_image')">

                                            <div class="divedit">
                                                <!-- Edit Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}"
                                                    alt="edit" style="cursor: pointer;"
                                                    onclick="document.getElementById('file_image').click();">

                                                <!-- Delete Button -->
                                                <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}"
                                                    alt="delete" style="cursor: pointer;"
                                                    onclick="removeImage('preview_image', 'file_image')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="warehouse_name">Creator User Name <i
                                            class="text-danger">*</i></label>
                                    <input type="text" name="first_name" readonly class="form-control inp"
                                        placeholder="Enter First Name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="creator_id" value="{{ Auth::user()->id }}">

                                </div>
                                <div class="col-md-12 mb-1">
                                    <div class="ptop d-flex align-items-end">
                                        <div>
                                            <div class="input-block">
                                                <label class="foncolor" for="status">Status</label>

                                                <div class="status-toggle">
                                                    <span>Active</span>
                                                    <input id="status" class="check" type="checkbox" name="status" value="Active">
                                                    <label for="status" class="checktoggle checkbox-bg togc"></label>
                                                    <span class="">Inactive</span>
                                                </div>

                                            </div>
                                        </div>

                                        <div>
                                            <div class="add-customer-btns ">

                                                <button type="button"
                                                    class="btn btn-outline-primary custom-btn">Cancel</button>

                                                <button type="submit" class="btn btn-primary ">Submit</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        // Function to preview the selected image
        function previewImage(input, previewId) {
            const previewElement = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewElement.src = e.target.result; // Set the image source to the uploaded file
                };
                reader.readAsDataURL(input.files[0]); // Read the file as a data URL
            }
        }

        // Function to remove the image preview and clear the file input
        function removeImage(previewId, inputId) {
            const previewElement = document.getElementById(previewId);
            const fileInput = document.getElementById(inputId);

            // Reset the image preview to the default image
            previewElement.src = "{{ asset('assets/img.png') }}";

            // Clear the file input value
            fileInput.value = '';
        }
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#warehouse').on('change', function() {
            var warehouseId = $(this).val();
            if (warehouseId) {
                $.ajax({
                    url: `/api/user-by-warehouse/${warehouseId}`,
                    type: 'GET',
                    success: function(response) {
                        var userSelect = $('select[name="user_id"]');
                        userSelect.empty();
                        userSelect.append('<option value="">Select User</option>');
                        $.each(response.users, function(key, user) {
                            userSelect.append('<option value="' + user.id + '">' + user.name + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('select[name="user_id"]').empty().append('<option value="">Select User</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#warehouse').on('change', function() {
            var warehouseId = $(this).val();

            if (warehouseId) {
                // ✅ Fetch containers
                $.ajax({
                    url: `/api/container-by-warehouse/${warehouseId}`,
                    type: 'GET',
                    success: function(response) {
                        var containerSelect = $('select[name="container_id"]');
                        containerSelect.empty().append('<option value="">Select Container</option>');
                        $.each(response.vehicles, function(index, container) {
                            containerSelect.append('<option value="' + container.id + '">' + container.container_no_1 + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('select[name="container_id"]').empty().append('<option value="">Select Container</option>');
            }
        });
    });
</script>


</x-app-layout>