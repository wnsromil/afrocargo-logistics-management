<x-app-layout>

    <x-slot name="header">
        Add Template Category
    </x-slot>


    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Add Template Category</p>
        </div>
    </x-slot>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group-customer customer-additional-form mb-3">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 me-sm-2">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templateCode">Code<i class="text-danger">*</i></label>
                        <input type="text" name="templateCode" readonly class="form-control inp" placeholder="Enter Full Name" value="TTC-000012">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 me-sm-2">
                    <div class="input-block mb-3">
                        <label class="foncolor" for="templatecategoryName">Name<i class="text-danger">*</i></label>
                        <input type="text" name="templatecategoryName" class="form-control inp" placeholder="Enter Template Category Name">
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

                if (selectedValue === 'Container') {
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

</x-app-layout>
