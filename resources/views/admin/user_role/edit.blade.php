<x-app-layout>
    <x-slot name="header">
        Manage Permissions for {{ $user->name }}
    </x-slot>

    <x-slot name="cardTitle">
        <p class="fw-semibold fs-5 text-dark">User Permissions</p>
    </x-slot>

    {{--
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
        <label class="required">Role Name</label>
        <select class="form-select border-dark border-1 opacity-75 bg-checkbox" id="inputGroupSelect01">
            <option>Select Role</option>
            <option>Warehouse Manager</option>
            <option>Driver</option>
        </select>
    </div>
    --}}

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label fw-semibold">ID</label>
            <input type="text" class="form-control border-dark opacity-75" value="{{ $user->unique_id ?? '' }}" readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">User Name</label>
            <input type="text" class="form-control border-dark opacity-75" value="{{ $user->name }}" readonly>
        </div>
        <div class="col-md-4">
            <label class="form-label fw-semibold">Last Name</label>
            <input type="text" class="form-control border-dark opacity-75" value="{{ $user->last_name ?? '' }}" readonly>
        </div>
        <div class="col-md-4 mt-3">
            <label class="form-label fw-semibold">Role</label>
            <input type="text" class="form-control border-dark opacity-75" value="{{ $user->role ?? '' }}" readonly>
        </div>
    </div>

    <div class="cardTitle my-3">
        <p class="fw-semibold fs-5 text-dark">Permissions</p>

    </div>
    <div class="mt-4 mb-2">
        <div class="form-check">
            <input type="checkbox" class="form-check-input border-dark opacity-75" id="check-all-permissions">
            <label class="form-check-label fw-semibold" for="check-all-permissions">Check All Permissions</label>
        </div>
    </div>


    <div class="border-bottom"></div>

    <form method="POST" action="{{ route('user-permissions.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group-customer customer-additional-form">
            <div class="row">
                @foreach($groupedPermissions as $resource => $permissions)

                <div class="mt-3 mb-2 px-2 py-1 permission-group">
                    <div class="input-group">
                        <div class="form-check text-checkbox">
                            <input type="checkbox" class="form-check-input border-dark opacity-75 parent-checkbox"
                                id="parent-{{ $resource }}" data-resource="{{ $resource }}">
                            <label class="form-check-label fw-medium mb-0" for="parent-{{ $resource }}">
                                {{ ucwords(str_replace('_', ' ', $resource)) }}
                            </label>
                        </div>
                    </div>

                    <div class="row col-md-12 d-flex my-2 ms-4 child-checkboxes">
                        @foreach($permissions as $permission)
                        @php
                        $action = explode('.', $permission->name)[1];
                        $checked = in_array($permission->name, $userPermissions) ? 'checked' : '';
                        @endphp

                        @php
                            $actionLength = strlen(str_replace('_', ' ', $action));
                            if ($actionLength <= 12) {
                                $colClass = 'col-2';
                            } elseif ($actionLength <= 35) {
                                $colClass = 'col-3';
                            } else {
                                $colClass = 'col-4';
                            }
                        @endphp
                        <div class="{{ $colClass }} px-1">
                            <div class="checkboxlable border border-dark opacity-75 bg-checkbox rounded p-1 pe-2 child-container">
                                <input type="checkbox"
                                    class="checkmark form-check-input border-dark opacity-75 mx-2 child-checkbox"
                                    name="permissions[]" value="{{ $permission->name }}" id="perm-{{ $permission->id }}"
                                    {{ $checked }} data-resource="{{ $resource }}">
                                <label class="custom_check primary fw_500" for="perm-{{ $permission->id }}">
                                    {{ str_replace('_', ' ', $action) }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save Permissions</button>
        </div>
    </form>

    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global Check All
            const checkAll = document.getElementById('check-all-permissions');
            checkAll.addEventListener('change', function () {
                const allChildCheckboxes = document.querySelectorAll('.child-checkbox');
                const allParentCheckboxes = document.querySelectorAll('.parent-checkbox');

                allChildCheckboxes.forEach(checkbox => {
                    checkbox.checked = checkAll.checked;
                    const parentDiv = checkbox.closest(".child-container");
                    if (checkAll.checked) {
                        parentDiv.classList.add('selected');
                    } else {
                        parentDiv.classList.remove('selected');
                    }
                });

                allParentCheckboxes.forEach(parent => {
                    parent.checked = checkAll.checked;
                    parent.indeterminate = false;
                });
            });

            // Automatically set Check All if all permissions are already selected
            const allChildCheckboxes = document.querySelectorAll('.child-checkbox');
            const allChecked = [...allChildCheckboxes].every(cb => cb.checked);
            checkAll.checked = allChecked;


            // Highlight checked permissions
            document.querySelectorAll('.child-checkbox').forEach(checkbox => {
                const parentDiv = checkbox.closest(".child-container");

                // Initial highlight
                if(checkbox.checked) {
                    parentDiv.classList.add('selected');
                    updateParentCheckbox(checkbox);
                }

                // Change handler
                checkbox.addEventListener('change', function() {
                    if(this.checked) {
                        parentDiv.classList.add('selected');
                    } else {
                        parentDiv.classList.remove('selected');
                    }
                    updateParentCheckbox(this);
                });
            });

            // Parent checkbox functionality
            document.querySelectorAll('.parent-checkbox').forEach(parentCheckbox => {
                const resource = parentCheckbox.dataset.resource;
                const childCheckboxes = document.querySelectorAll(`.child-checkbox[data-resource="${resource}"]`);

                // Set initial parent state
                updateParentCheckboxState(parentCheckbox, resource);

                // Parent checkbox change handler
                parentCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    childCheckboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                        const parentDiv = checkbox.closest(".child-container");
                        if(isChecked) {
                            parentDiv.classList.add('selected');
                        } else {
                            parentDiv.classList.remove('selected');
                        }
                    });
                });
            });

            // Update parent checkbox based on child states
            function updateParentCheckbox(childCheckbox) {
                const resource = childCheckbox.dataset.resource;
                const parentCheckbox = document.querySelector(`#parent-${resource}`);
                updateParentCheckboxState(parentCheckbox, resource);
            }

            function updateParentCheckboxState(parentCheckbox, resource) {
                const childCheckboxes = document.querySelectorAll(`.child-checkbox[data-resource="${resource}"]`);
                const checkedCount = document.querySelectorAll(`.child-checkbox[data-resource="${resource}"]:checked`).length;

                if(checkedCount === 0) {
                    parentCheckbox.checked = false;
                    parentCheckbox.indeterminate = false;
                } else if(checkedCount === childCheckboxes.length) {
                    parentCheckbox.checked = true;
                    parentCheckbox.indeterminate = false;
                } else {
                    parentCheckbox.checked = false;
                    parentCheckbox.indeterminate = true;
                }
            }
        });
    </script>
    @endsection

    <style>
        .selected {
            background-color: #e7f3ff;
            border-color: #86b7fe !important;
        }

        .child-container:hover {
            background-color: #f8f9fa;
        }

        .permission-group {
            margin-bottom: 1.5rem;
        }
    </style>
</x-app-layout>
