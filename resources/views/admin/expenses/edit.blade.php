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
        Edit Expenses
    </x-slot>

    <x-slot name="cardTitle">
        <p class="subhead me-sm-4">Edit Expenses</p>
    </x-slot>

    <div>
        <form id="expenses" action="{{ route('admin.expenses.update', $expense->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group-customer customer-additional-form">
                <div class="row mt-0 g-3 align-items-stretch">
                    <div class="col-md-6 mt-sm-0 mt-3">
                        <div class="borderset">
                            <div class="row gx-3 gy-2">

                                <div class="col-md-12 mb-1">
                                    <label class="foncolor" for="company_name"> Expenses ID</label>
                                    <input type="text" class="form-control inp" style="background: #ececec;"
                                        placeholder="" value="{{ $expense->unique_id }}" readonly>
                                </div>

                                @php $role_id = Auth::user()->role_id; @endphp

                                @if($role_id == 2 || $role_id == 4)
                                    <div class="col-md-12 mb-1">
                                        <label class="foncolor" for="warehouse"> Warehouse <i
                                                class="text-danger">*</i></label>
                                        <input type="text" class="form-control" value="{{ $warehouses[0]->warehouse_name }}"
                                            readonly style="background-color: #e9ecef; color: #6c757d;">
                                        <input type="hidden" name="warehouse" value="{{ $warehouses[0]->id }}">
                                    </div>
                                @else
                                    <div class="col-md-12 mb-1">
                                        <label class="foncolor" for="warehouse"> Warehouse <i
                                                class="text-danger">*</i></label>
                                        <select id="warehouse" class="js-example-basic-single select2 form-control"
                                            name="warehouse">
                                            <option value="">Select Warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ $expense->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->warehouse_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warehouse') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                @endif

                                <div class="col-md-12 mb-1">
                                    <label> Date <i class="text-danger">*</i></label>
                                    <div class="daterangepicker-wrap cal-icon cal-icon-info">
                                        <input type="text" name="edit_expense_date" readonly
                                            style="cursor: pointer; background-color: #ffffff;"
                                            class="btn-filters form-cs inp inputbackground"
                                            value="{{ \Carbon\Carbon::parse($expense->date)->format('m/d/Y') }}"
                                            placeholder="MM-DD-YYYY" />
                                        <input type="text" class="form-control inp inputs text-center timeOnlyInput"
                                            readonly value="{{$expense->time}}" name="currentTIme">
                                        @error('edit_expense_date') <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label> Description <i class="text-danger">*</i></label>
                                    <input type="text" class="form-control inp" name="description"
                                        value="{{ $expense->description }}" placeholder="Enter Description" />
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                @if($role_id == 2 || $role_id == 4)
                                    <div class="col-md-12 mb-1">
                                        <label class="foncolor">User</label>
                                        <select class="js-example-basic-single select2" name="user_id">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ $expense->creator_user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
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
                                        <label class="foncolor">Container</label>
                                        <select class="js-example-basic-single select2" name="container_id">
                                            <option value="">Select Container</option>
                                            @foreach ($containers as $container)
                                                <option value="{{ $container->id }}" {{ $expense->container_id == $container->id ? 'selected' : '' }}>{{ $container->container_no_1 }}</option>
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
                                    <label class="foncolor" for="Category">Currency <i class="text-danger">*</i></label>
                                    <select id="currency_select" class="form-control select2" name="currency">
                                        <option value="" {{ old('currency', $expense->currency ?? '') == '' ? 'selected' : '' }}>Select Currency</option>
                                        @foreach (setting()->warehouseContries() as $country )
                                                <option value="{{ $country['currency'] }}" {{ $expense->currency == $country['currency'] ? 'selected' : '' }}>
                                                    {{ $country['name'] }} - {{ $country['currency'] }}
                                                </option>
                                        @endforeach
                                    </select>
                                    @error('currency')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label> Amount <i class="text-danger">*</i></label>
                                    <input type="number" class="form-control inp" name="amount"
                                        value="{{ $expense->amount }}" placeholder="Enter Amount" />
                                    @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-sm-0 mt-3">
                        <div class="borderset">
                            <div class="row gx-3 gy-2">
                                <div class="col-md-12 mb-1">
                                    <label class="foncolor">Expense Category <i class="text-danger">*</i></label>
                                    <select class="js-example-basic-single select2" name="category">
                                        <option value="">Select Category</option>
                                        <option value="Expense" {{ $expense->category == 'Expense' ? 'selected' : '' }}>
                                            Expense</option>
                                        <option value="Deposit" {{ $expense->category == 'Deposit' ? 'selected' : '' }}>
                                            Deposit</option>
                                    </select>
                                    @error('category') <small class="text-danger">{{ $message }}</small> @enderror
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
                                            class="form-check-input mt-0" type="radio" 
                                            {{ $expense->type == 'Expense' ? 'checked' : '' }}
                                            value="Expense" name="type">
                                    </div>
                                </div>
                                    <div class="col-md-3">
                                        <div class="input-block mb-3 d-flex">
                                            <label class="foncolor mb-0 pt-0 me-2 col3A">Income</label> <input
                                                class="form-check-input mt-0"
                                                 {{ $expense->type == 'Income' ? 'checked' : '' }}
                                                type="radio" value="Income" name="type">
                                        </div>
                                    </div>
                                      @error('type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                                 </div>

                                <div class="col-md-12 mb-1">
                                    <div class="d-flex align-items-center justify-content-center pt-4">
                                        <label class="foncolor me-3">Image</label>
                                        <div class="avtarset oneonly" style="position: relative;">
                                            <img id="preview_image" class="avtars"
                                                src="{{ $expense->img ? asset($expense->img) : asset('assets/img.png') }}"
                                                alt="avatar">
                                            <input type="file" id="file_image" name="image" accept="image/*"
                                                style="display: none;" onchange="previewImage(this, 'preview_image')">
                                            <div class="divedit">
                                                <img class="editstyle" src="{{ asset('assets/img/edit (1).png') }}"
                                                    alt="edit" style="cursor: pointer;"
                                                    onclick="document.getElementById('file_image').click();">
                                                <img class="editstyle" src="{{ asset('assets/img/dlt (1).png') }}"
                                                    alt="delete" style="cursor: pointer;"
                                                    onclick="removeImage('preview_image', 'file_image')">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-1">
                                    <label class="foncolor">Creator User Name <i class="text-danger">*</i></label>
                                    <input type="text" readonly class="form-control inp"
                                        value="{{ $expense->creator_user->name ?? Auth::user()->name }}">
                                    <input type="hidden" name="creator_id"
                                        value="{{ $expense->creator_id ?? Auth::user()->id }}">
                                </div>

                                <div class="col-md-12 mb-1">
                                    <div class="ptop d-flex align-items-end justify-content-between">
                                        <div class="input-block">
                                            <label class="foncolor" for="status">Status</label>
                                            <div class="status-toggle">
                                                <span>Active</span>
                                                <input id="status" class="check" type="checkbox" name="status" {{ $expense->status == 'Inactive' ? 'checked' : '' }}>
                                                <label for="status" class="checktoggle checkbox-bg togc"></label>
                                                <span>Inactive</span>
                                            </div>
                                        </div>
                                        <input type="hidden" id="selected_user_id"
                                            value="{{ $expense->creator_user_id ?? '' }}">
                                            <input type="hidden" id="delete_img"  name="delete_img"
                                            value="No">
                                        <input type="hidden" id="selected_container_id"
                                            value="{{ $expense->container_id ?? '' }}">
                                        <div class="add-customer-btns">
                                            <a href="{{ route('admin.expenses.index') }}"
                                                class="btn btn-outline-primary custom-btn">Cancel</a>
                                            @can('has-dynamic-permission', 'expenses.edit')
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            @endcan
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(input.files[0]);
                 document.getElementById('delete_img').value = "No";
            }
        }

        function removeImage(previewId, inputId) {
            console.log("gfdgfdg");
            document.getElementById(previewId).src = "{{ asset('assets/img.png') }}";
            document.getElementById(inputId).value = '';
             document.getElementById('delete_img').value = "Yes"; 
        }
    </script>
    <script>
        $(document).ready(function () {
            const warehouseSelect = $('#warehouse');
            const userSelect = $('select[name="user_id"]');
            const containerSelect = $('select[name="container_id"]');

            const selectedUserId = $('#selected_user_id').val();
            const selectedContainerId = $('#selected_container_id').val();

            function loadUsersAndContainers(warehouseId) {
                if (!warehouseId) return;

                // Load Users
                $.ajax({
                    url: `/api/user-by-warehouse/${warehouseId}`,
                    type: 'GET',
                    success: function (response) {
                        userSelect.empty().append('<option value="">Select User</option>');
                        $.each(response.users, function (_, user) {
                            let selected = user.id == selectedUserId ? 'selected' : '';
                            userSelect.append(`<option value="${user.id}" ${selected}>${user.name}</option>`);
                        });
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });

                // Load Containers
                $.ajax({
                    url: `/api/container-by-warehouse/${warehouseId}`,
                    type: 'GET',
                    success: function (response) {
                        containerSelect.empty().append('<option value="">Select Container</option>');
                        $.each(response.vehicles, function (_, container) {
                            let selected = container.id == selectedContainerId ? 'selected' : '';
                            containerSelect.append(`<option value="${container.id}" ${selected}>${container.container_no_1}</option>`);
                        });
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Page Load API Call
            const initialWarehouseId = warehouseSelect.val();
            if (initialWarehouseId) {
                loadUsersAndContainers(initialWarehouseId);
            }

            // On Warehouse Change
            warehouseSelect.on('change', function () {
                // Clear selected IDs when warehouse changes
                $('#selected_user_id').val('');
                $('#selected_container_id').val('');
                loadUsersAndContainers($(this).val());
            });
        });
    </script>
</x-app-layout>