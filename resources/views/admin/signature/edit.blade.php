<x-app-layout>
    <x-slot name="header">
        Signature Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Update Signature</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.signature.update', $editData->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group-customer customer-additional-form">
            <div class="row">
                <div class="row">
                    <!-- Warehouse Name -->
                    <div class="col-md-6 me-sm-2">
                        <div class="input-block mb-3">
                            <label class="foncolor" for="warehouse_name">Warehouse Name <i
                                    class="text-danger">*</i></label>
                            <select name="warehouse_name" class="form-control inp select2">
                                <option value="">Select Warehouse Name</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ $editData->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                        {{ $warehouse->warehouse_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('warehouse_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Signature Name -->
                    <div class="col-md-6 me-sm-2">
                        <div class="input-block mb-3">
                            <label for="tracking_number" class="colours">Signature Name <i
                                    class="text-danger">*</i></label>
                            <input type="text" name="signature_name" class="form-control"
                                value="{{ old('signature_name', $editData->signature_name) }}"
                                placeholder="Enter Signature Name">
                            @error('signature_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Signature Image -->
                    <div class="col-md-6 me-sm-2">
                        <div class="input-block">
                            <label>Signature Image</label>
                            <div class="input-block mb-3 service-upload img-size2 mb-0">
                                <!-- Preview Image -->
                                <img id="inventory_img_preview"
                                    src="{{ !empty($editData->signature_file) ? $editData->signature_file : '' }}"
                                    alt="Inventory Image"
                                    class="img-thumbnail mb-2 {{ empty($editData->signature_file) ? 'd-none' : '' }}"
                                    style="max-width: 150px; height: auto;">

                                <!-- Hidden File Input -->
                                <input type="file" name="img" id="inventory_image" class="d-none">

                                <!-- Action Icons -->
                                <div>
                                    <img src="{{ asset('assets/img/edit (1).png') }}" alt="Edit"
                                        style="cursor: pointer;" onclick="openImagePicker()">
                                    <img src="{{ asset('assets/img/dlt (1).png') }}" alt="Delete"
                                        style="cursor: pointer;" onclick="removeImage()">
                                </div>

                                <!-- Delete Flag -->
                                <input type="hidden" name="delete_img" id="delete_img" value="0">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add-customer-btns text-end">
                    <button type="button" onclick="redirectTo('{{ route('admin.signature.index') }}')"
                        class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>

    @section('script')
        <script>
            function openImagePicker() {
                document.getElementById('inventory_image').click();
            }

            document.getElementById('inventory_image').addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('inventory_img_preview');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    preview.style.display = 'inline-block';
                    preview.style.maxWidth = '150px';
                    preview.style.height = 'auto';
                };
                reader.readAsDataURL(file);

                // Reset delete flag
                document.getElementById('delete_img').value = '0';
            });

            function removeImage() {
                const preview = document.getElementById('inventory_img_preview');
                const fileInput = document.getElementById('inventory_image');
                const deleteInput = document.getElementById('delete_img');

                preview.src = '';
                preview.classList.add('d-none');
                fileInput.value = '';
                deleteInput.value = '1';
            }
        </script>
    @endsection

</x-app-layout>