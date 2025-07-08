<x-app-layout>
    <x-slot name="header">Signature Management</x-slot>

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
                <!-- Warehouse Name -->
                <div class="col-md-6 me-sm-2">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="warehouse_name">Warehouse Name <i class="text-danger">*</i></label>
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
                        <label for="signature_name" class="colours">Signature Name <i class="text-danger">*</i></label>
                        <input type="text" name="signature_name" class="form-control"
                            value="{{ old('signature_name', $editData->signature_name) }}"
                            placeholder="Enter Signature Name">
                        @error('signature_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Signature Type Selection -->
                <div class="col-md-6 me-sm-2">
                    <label class="fw-bold mb-2">Choose Signature Type</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="signature_type" id="selectImage"
                            value="image" checked>
                        <label class="form-check-label" for="selectImage">Upload Image</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="signature_type" id="drawSignature"
                            value="draw">
                        <label class="form-check-label" for="drawSignature">Draw Signature</label>
                    </div>
                </div>

                @php
                    $signatureType = old('signature_type', $editData->signature_type ?? 'image');
                    $imgStyle = $signatureType === 'image' ? 'max-width: 400px; height: auto;' : 'max-width: 100%; height: auto;';
                @endphp

                <!-- Image Upload Section -->
                <div class="col-md-6 me-sm-2" id="imageUploadSection">
                    <label>Signature Image<i class="text-danger">*</i></label>
                    <div class="input-block mb-3 service-upload img-size2 mb-0">
                        <img id="inventory_img_preview"
                            src="{{ !empty($editData->signature_file) ? asset($editData->signature_file) : '' }}"
                            alt="Inventory Image"
                            class="img-thumbnail mb-2 {{ empty($editData->signature_file) ? 'd-none' : '' }}"
                            style="{{ $imgStyle }}">
                        <input type="file" name="img" id="inventory_image" class="d-none">
                        <div>
                            <img src="{{ asset('assets/img/edit (1).png') }}" alt="Edit" style="cursor: pointer;"
                                onclick="openImagePicker()">
                            <img src="{{ asset('assets/img/dlt (1).png') }}" alt="Delete" style="cursor: pointer;"
                                onclick="removeImage()">
                        </div>
                        <input type="hidden" name="delete_img" id="delete_img" value="0">
                    </div>
                </div>

                <!-- Draw Signature Section -->
                <div class="col-md-6 me-sm-2" id="drawSignatureSection" style="display: none;">
                    <label>Draw Signature<i class="text-danger">*</i></label>
                    <canvas id="signaturePad" width="600" height="200"
                        style="border:1px dashed #ccc; width:100%;"></canvas>
                    <input type="hidden" name="signature_drawn" id="signatureDrawnData">
                    <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="clearCanvas()">Clear</button>
                </div>

                @error('signature_drawn')
                    <span class="text-danger">The signature is required.</span>
                @enderror

                <div class="add-customer-btns text-end mt-3">
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
                document.getElementById('delete_img').value = '0';
            });

            function removeImage() {
                document.getElementById('inventory_img_preview').src = '';
                document.getElementById('inventory_img_preview').classList.add('d-none');
                document.getElementById('inventory_image').value = '';
                document.getElementById('delete_img').value = '1';
            }

            // Toggle Signature Type
            document.querySelectorAll('input[name="signature_type"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    const imageSection = document.getElementById('imageUploadSection');
                    const drawSection = document.getElementById('drawSignatureSection');
                    if (this.value === 'image') {
                        imageSection.style.display = 'block';
                        drawSection.style.display = 'none';
                    } else {
                        imageSection.style.display = 'none';
                        drawSection.style.display = 'block';
                    }
                });
            });

            // Canvas Signature Drawing
            const canvas = document.getElementById("signaturePad");
            const ctx = canvas.getContext("2d");
            let drawing = false;

            canvas.addEventListener("mousedown", function (e) {
                drawing = true;
                ctx.beginPath();
                ctx.moveTo(e.offsetX, e.offsetY);
            });

            canvas.addEventListener("mousemove", function (e) {
                if (drawing) {
                    ctx.lineTo(e.offsetX, e.offsetY);
                    ctx.stroke();
                }
            });

            canvas.addEventListener("mouseup", function () {
                drawing = false;
                saveCanvasData();
            });

            canvas.addEventListener("mouseleave", function () {
                drawing = false;
            });

            function clearCanvas() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                document.getElementById("signatureDrawnData").value = '';
            }

            function saveCanvasData() {
                const dataURL = canvas.toDataURL();
                document.getElementById("signatureDrawnData").value = dataURL;
            }
        </script>
    @endsection
</x-app-layout>