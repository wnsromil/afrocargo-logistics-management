<x-app-layout>
    <x-slot name="header">
        Signature Management
    </x-slot>

    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Signature</p>
        </div>
    </x-slot>

    <form action="{{ route('admin.signature.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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
                                    <option {{ old('warehouse_name') == $warehouse->id ? 'selected' : '' }}
                                        value="{{ $warehouse->id }}">{{ $warehouse->warehouse_name }}</option>
                                @endforeach
                            </select>
                            @error('warehouse_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 me-sm-2">
                        <div class="input-block mb-3">
                            <label for="tracking_number" class="colours"> Signature Name<i
                                    class="text-danger">*</i></label>
                            <input type="text" name="signature_name" class="form-control"
                                value="{{ old('signature_name') }}" placeholder="Enter Signature Name">
                            @error('signature_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 me-sm-2">
                        <label class="fw-bold mb-2">Choose Signature Type</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="signature_type" id="selectImage"
                                value="image" checked>
                            <label class="form-check-label" for="selectImage">Select Image</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="signature_type" id="drawSignature"
                                value="draw">
                            <label class="form-check-label" for="drawSignature">Draw Signature</label>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div id="imageUploadSection">
                        <div class="col-md-6 me-sm-2">
                            <div class="input-block">
                                <label class="table-content col737 fw-medium">Signature Image <i
                                        class="text-danger">*</i></label>
                                <div class="input-block mb-3 service-upload img-size2 mb-0">
                                    <span id="upload_signature_image">
                                        <svg width="65" height="37" viewBox="0 0 65 37" fill="none" style="color:black;"
                                            xmlns="http://www.w3.org/2000/svg"
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
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg>
                                        <h6 class="drop-browse align-center">Upload Image</h6>
                                    </span>

                                    <input type="file" id="signature_image" name="img" class="form-control"
                                        accept="image/*">
                                    <div id="preview" class="mt-2">
                                    </div>
                                </div>
                                @error('img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('signature_drawn')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Signature Canvas -->
                    <div id="drawSignatureSection" style="display:none;">
                        <div class="col-md-6 me-sm-2">
                            <canvas id="signaturePad" width="600" height="200"
                                style="border:1px dashed #ccc; width:100%;"></canvas>
                            <input type="hidden" name="signature_drawn" id="signatureDrawnData">

                            <br>
                            <button type="button" class="btn btn-sm btn-secondary mt-2"
                                onclick="clearCanvas()">Clear</button>
                        </div>
                    </div>

                </div>
                <div class="add-customer-btns text-end">
                    <button type="button" onclick="redirectTo('{{ route('admin.signature.index') }}')"
                        class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            </div>
        </div>
    </form>
    @section('script')
        <script>
            // Toggle between image upload and draw section
            $('input[name="signature_type"]').on('change', function () {
                if ($(this).val() === 'image') {
                    $('#imageUploadSection').show();
                    $('#drawSignatureSection').hide();
                } else {
                    $('#imageUploadSection').hide();
                    $('#drawSignatureSection').show();
                }
            });

            // Image Preview
            document.getElementById('signature_image').addEventListener('change', function (event) {
                const preview = document.getElementById('preview');
                preview.innerHTML = '';
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.classList.add('mt-2', 'img-thumbnail');
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Canvas Signature Drawing
            let canvas = document.getElementById("signaturePad");
            let ctx = canvas.getContext("2d");
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
                document.getElementById("signatureDrawnData").value = "";
            }

            function saveCanvasData() {
                const dataURL = canvas.toDataURL();
                document.getElementById("signatureDrawnData").value = dataURL;
            }
        </script>
    @endsection
</x-app-layout>