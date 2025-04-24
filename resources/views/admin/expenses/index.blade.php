<x-app-layout>
    <x-slot name="header">
        {{ __('All Expenses') }}
    </x-slot>
    <x-slot name="cardTitle">
        <p class="head">All Expenses</p>

        <div class="d-flex align-items-center justify-content-end mb-0">
            <div class="usersearch d-flex">
                <div class="">
                    <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary buttons"
                        style="background:#203A5F">
                        <i class="ti ti-circle-plus me-2 text-white"></i>
                        Add Expense
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <form action="{{ route('admin.expenses.index') }}" method="GET">
        <div class="row gx-3 inputheight40">
            <div class="col-md-3 mb-3">
                <label for="searchInput">Search</label>
                <div class="inputGroup height40 position-relative">
                    <i class="ti ti-search"></i>
                    <input type="text" id="searchInputExpense" class="form-control height40 form-cs"
                        placeholder="Search" name="search" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>By Warehouse</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected" style="color:#737B8B">Select Warehouse</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label>Date</label>
                <div class="daterangepicker-wrap cal-icon cal-icon-info bordered">
                    <input type="text" class="btn-filters form-cs inp bookingrange"
                        placeholder="02-21-2024 - 02-21-2024" />
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>By Category</label>
                <select class="js-example-basic-single select2">
                    <option selected="selected" style="color:#737B8B">Select Category</option>
                </select>
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btnf me-2">Search</button>
                    <a href="{{ route('admin.expenses.index') }}"><button
                            class="btn btn-outline-danger btnr">Reset</button></a>
                </div>
            </div>
        </div>
    </form>
    <div class="card-table">
        <div class="card-body">
            <div class="table-responsive smpadding mt-5">
                <table class="table table-stripped table-hover datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>S. No.</th>
                            <th>User</th>
                            <th>Warehouse Name</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($expenses as $key => $expense)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $expense->creatorUser->name ?? '--' }}</td>
                                <td>{{ $expense->warehouse->warehouse_name ?? '--' }}</td>
                                <td>{{ \Carbon\Carbon::parse($expense->date)->format('m-d-Y') }}</td>
                                <td>{{ $expense->category ?? '--' }}</td>
                                <td>${{ $expense->amount ?? '--' }}</td>
                                <td>
                                    @if ($expense->img)
                                        <img src="{{ asset($expense->img) }}" alt="Expense Image" style="max-width: 50px;">
                                    @else
                                        <img src="../assets/images/userPlaceholderImg.png" alt="Default Image"
                                            style="max-width: 50px;">
                                    @endif
                                </td>
                                <td>{{ $expense->description ?? '--' }}</td>
                                <td>
                                    <div class="statusFor {{ $expense->status == 'Active' ? 'active' : 'inactive' }}">
                                        <p>{{ $expense->status }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="btn-action-icon fas" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.expenses.edit', $expense->id) }}">
                                                        <i class="far fa-edit me-2"></i>Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.expenses.show', $expense->id) }}">
                                                        <i class="far fa-eye me-2"></i>View
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>