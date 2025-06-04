<x-app-layout>

    <x-slot name="header">
        Add Template
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Template</p>
        </div>
    </x-slot>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer addTemplateForm mb-3">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Template Title<i class="text-danger">*</i></label>
                        <input type="text" name="templateTitle" class="form-control inp" placeholder="Enter Template Title">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Template Category<i class="text-danger">*</i></label>
                        <select name="TemplateCategory" class="form-control inp select2">
                            <option disabled hidden selected value="">Select Template Category</option>
                            <option value="Category 1">Category 1</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                            <option value="Category 4">Category 4</option>
                            <option value="Category 5">Category 5</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-block mb-1">
                        <label class="foncolor" for="templateTitle">Type<i class="text-danger">*</i></label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Email</label> <input class="form-check-input mt-0" type="radio" value="email" name="templateName">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Text/SMS</label> <input class="form-check-input mt-0" type="radio" value="textorsms" name="templateName">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-block mb-3 d-flex align-items-center">
                                <label class="foncolor mb-0 pt-0 me-3 col3A" for="templateTitle">Whatsapp</label> <input class="form-check-input mt-0" type="radio" value="whatsapp" name="templateName">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Primary Langugae (English)</label>
                        <textarea name="primaryLanguageEditor" id="primaryLanguageEditor" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateTitle">Secondary Langugae (Espanish)</label>
                        <textarea name="secondaryLanguageEditor" id="secondaryLanguageEditor" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="input-block mb-0">
                    <label class="foncolor" for="status">Status <i class="text-danger">*</i></label>
                    <div class="status-toggle">
                        <span>Active</span>
                        <input id="rating_1" class="check" type="checkbox" value="Active">
                        <label for="rating_1" class="checktoggle checkbox-bg"></label>
                        <span class="inactive">Inactive</span>
                    </div>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="col-md-6">
                <div class="add-customer-btns text-end">
                    <button type="button" onclick="redirectTo('{{route('admin.template_category.index') }}')" class="btn btn-outline-primary custom-btn">Cancel</button>
                    <button type="submit" class="btn btn-primary" onclick="redirectTo('{{route('admin.template_category.index') }}')">Submit</button>

                </div>
            </div>
        </div>
    </form>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function toggleContainerFields() {
                let selectedValue = $('#vehicle_type').val();

                if (selectedValue === '1') {
                    $('.seal-no-field').show();
                    $('.container-no-1-field').show();
                    $('.container-no-2-field').show();
                    $('.container-size-field').show();
                    $('.vehicle-number-field').hide();
                } else {
                    $('.seal-no-field').hide();
                    $('.container-no-1-field').hide();
                    $('.container-no-2-field').hide();
                    $('.container-size-field').hide();
                    $('.vehicle-number-field').show();
                }
            }

            toggleContainerFields(); // On page load
            $('#vehicle_type').on('change', toggleContainerFields); // On dropdown change
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let statusToggle = document.getElementById("status");
            let activeText = document.getElementById("activeText");
            let inactiveText = document.getElementById("inactiveText");

            function updateTextColor() {
                if (statusToggle.checked) {
                    activeText.classList.add("bold");
                    inactiveText.classList.remove("bold");
                } else {
                    activeText.classList.remove("bold");
                    inactiveText.classList.add("bold");
                }
            }
            updateTextColor();
            statusToggle.addEventListener("change", updateTextColor);
        });

    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#primaryLanguageEditor'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#secondaryLanguageEditor'))
            .catch(error => {
                console.error(error);
            });

    </script>

</x-app-layout>
