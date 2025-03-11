<x-app-layout>
    <x-slot name="header">
        Add Role
    </x-slot>

    <x-slot name="cardTitle">
        <p class="fw-semibold fs-5 text-dark">Add Role</p>
    </x-slot>
    <div class="border-bottom"></div>

    <!-- <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="input-block mb-3">
            <label class="required">Role Name</label>
            <ul class="form-group-plus css-equal-heights">
                <li>
                    <select class="select">
                        <option>Select Role</option>
                        <option>Driver</option>
                        <option>Warehouse Manager</option>
                    </select>
                </li>
            </ul>
        </div>
    </div> -->
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label class="required">Role Name</label>
        <select class="form-select opacity-75" id="inputGroupSelect01">
            <option>Select Role</option>
            <option>Driver</option>
            <option>Warehouse Manager</option>
            </select>
    </div>

    <div class="cardTitle my-3">
        <p class="fw-semibold fs-5 text-dark">Permissions</p>
    </div>

    <div class="input-group mb-3 no-border col-6">
        <div class="input-group-text">
            <input class="form-check-input mt-0 no-border" type="checkbox" value=""
                aria-label="Checkbox for following text input">
        </div>
        <input type="text" class="form-control" aria-label="Text input with checkbox">
    </div>


</x-app-layout>