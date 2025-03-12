<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- start -->
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Create New User</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin.customer.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          <strong>Whoops!</strong> There were some problems with your input.<br><br>
                          <ul>
                             @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                             @endforeach
                          </ul>
                        </div>
                    @endif --}}
                    
                    <form method="POST" action="{{ route('admin.customer.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    <select name="roles" class="form-select select2_multiple" >
                                        @foreach ($roles as $value => $label)
                                            <option value="{{ $value }}">
                                                {{ $label }}
                                            </option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                            </div>
                        </div>
                    </form>

                    <!-- end -->
                </div>
            </div>
        </div>
    </div>

</x-app-layout>