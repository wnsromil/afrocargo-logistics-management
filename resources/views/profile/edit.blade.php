@push('head')
    <style>
        .avatar {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #e4e4e4;
            position: relative;
        }

        .image-upload {
            position: relative;
            display: inline-block;
        }

        .image-upload label {
            position: absolute;
            top: 10px;
            right: 50px;
            background-color: #23395d;
            color: white;
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
        }

        .image-upload .delete-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 8px;
            cursor: pointer;
        }
    </style>
@endpush

{{-- @section('content')
    <h2 class="font-semibold text-xl text-light leading-tight">
        {{ __('Profile') }}
    </h2>
@endsection --}}

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <section>
        <h3 style="margin-top: -30px">Update Profile</h3>
        <div class="container mt-5">
            <div class="d-flex align-items-start">
                <form id="profileForm" action="{{ route('profile.upload_pic') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="image-upload me-4">
                        @if (!empty($user->profile_pic) && is_string($user->profile_pic))
                            <img id="blah" class="avatar" src="{{ asset(@$user->profile_pic) }}" alt="profile-img">
                        @else
                            <img id="blah" class="avatar" src="{{ asset('assets/img/profiles/avatar-icon.png') }}"
                                alt="profile-img">
                        @endif
                        <label for="file-input">
                            <i class="fas fa-pencil-alt" id="profile_pic"></i>
                        </label>
                        <span class="delete-icon" onclick="deleteImage()">
                            <i class="fas fa-trash"></i>
                        </span>
                        <input id="file-input" type="file" name="profile_pic" style="display: none;"
                            onchange="readURL(this);">
                    </div>
                </form>
                <div class="w-100">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control" placeholder="Enter First Name">
                                <span class="error text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label>Email</label> <span class="text-danger">*</span>
                                <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control" readonly placeholder="Enter Email Address">
                                <span class="error text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                    </spa n>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Phone No</label> <span class="text-danger">*</span>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="form-control" placeholder="Enter Mobile Number">
                                <span class="error text-danger">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Country</label> <span class="text-danger">*</span>
                                <select name="country_id" id="country" class="form-control dropdown select2">
                                    <option value="" readonly>Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                            {{ $country->name ?? '--' }}</option>
                                    @endforeach
                                </select>
                                <span class="error text-danger">
                                    @error('country_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>State</label> <span class="text-danger">*</span>
                                <select name="state_id" id="state" class="form-control select2">
                                    <option value="">Select State</option>
                                </select>
                                <span class="error text-danger">
                                    @error('state_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>City</label> <span class="text-danger">*</span>
                                <select name="city_id" id="city" class="form-control select2">
                                    <option value="">Select City</option>
                                </select>
                                <span class="error text-danger">
                                    @error('city_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Pincode</label> <span class="text-danger">*</span>
                                <input type="text" name="pincode" value="{{ old('pincode', $user->pincode) }}"
                                    class="form-control" placeholder="Enter your Pincode">
                                <span class="error text-danger">
                                    @error('pincode')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label>Address</label> <span class="text-danger">*</span>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                    class="form-control" placeholder="Enter your Address">
                                <span class="error text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 float-end">
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-dark me-2">Cancel</a>
                            <button class="btn btn-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    {{-- jqury cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('blah').src = e.target.result;
                    setTimeout(() => {
                        document.getElementById('profileForm').submit();
                    }, 1000);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteImage() {
            // if (confirm('Are you sure you want to delete this image?')) {
            let form = document.getElementById('profileForm');
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_image';
            input.value = '1';
            form.appendChild(input);
            form.submit();
            // }
        }

        $(document).ready(function() {
            var selectedCountry = "{{ $user->country_id }}"; 
            var selectedState = "{{ $user->state_id }}"; 
            var selectedCity = "{{ $user->city_id }}";


            // Load States Automatically
            if (selectedCountry) {
                $.ajax({
                    url: "{{ url('api/get-states') }}/" + selectedCountry,
                    method: "GET",
                    success: function(response) {
                        // $('#state').append('<option value="">Select State</option>');
                        $.each(response, function(key, value) {
                            let selected = (value.id == selectedState) ? 'selected' : '';
                            $('#state').append(
                                `<option value="${value.id}" ${selected}>${value.name}</option>`
                                );
                        });

                        // 🔥 Automatically Load Cities When State is Selected
                        if (selectedState) {
                            loadCities(selectedState);
                        }
                    }
                });
            }

            //  On State Change Load Cities
            $('#state').on('change', function() {
                var stateId = $(this).val();
                loadCities(stateId);
            });

            function loadCities(stateId) {
                $.ajax({
                    url: "{{ url('api/get-cities') }}/" + stateId,
                    method: "GET",
                    success: function(response) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(response, function(key, value) {
                            let selected = (value.id == selectedCity) ? 'selected' : '';
                            $('#city').append(
                                `<option value="${value.id}" ${selected}>${value.name}</option>`
                                );
                        });
                    }
                });
            }
        });
    </script>
</x-app-layout>
