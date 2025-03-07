<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <section>
        <div class="content-page-header">
            <h5 class="setting-menu textSize fw-semibold">Update Profile</h5>
        </div>
        <!-- <div class="col-md-12 d-flex justify-content-between">
            <div class="col-md-4">
            <div class="upload-profile me-2">
                    <div class="profile-img">
                        <img id="blah" class="avatar"
                            src="{{ asset('assets/img/profiles/Ellipse 14.png') }}"
                            alt="profile-img">
                    </div>
                </div>
            </div>
        </div> -->


        <!-- <form id="profileForm" action="{{ route('profile.upload_pic') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-picture">
                <div class="upload-profile me-2">
                    <div class="profile-img">
                        <img id="blah" class="avatar"
                            src="{{ asset('assets/img/profiles/Ellipse 14.png') }}"
                            alt="profile-img">
                    </div>
                </div>
                <div class="img-upload">
                    <label class="btn btn-primary">
                        Upload new picture <input type="file" name="profile_pic" id="profile_pic" hidden>
                    </label>
                    <p class="mt-1">Logo Should be minimum 152 * 152 Supported File format JPG, PNG, SVG</p>
                </div>
            </div>
        </form> -->

        <div class="row">
            <div class="col-md-12 d-flex flex-row justify-content-between flex-wrap">

                <div class="col-md-4 px-3">
                    <form id="profileForm" action="{{ route('profile.upload_pic') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="upload-profile me-2 align-items-center mt-4">
                            <label class="profile-img avatar avatar-xxl profileImg profile-cover-avatar"
                                for="avatar_upload">
                                <img class="avatar-img" src="{{ asset('assets/img/profiles/Ellipse 14.png') }}"
                                    alt="Profile Image" id="blah">
                                <input type="file" id="avatar_upload">

                                <span class="avatar-edit iconResize">
                                    <i class="fe fe-edit avatar-uploader-icon shadow-soft"></i>
                                </span>

                                <input type="file" id="avatar_upload">
                                <span class="avatar-trash iconResize bg-danger">
                                    <i class="fe fe-trash-2 avatar-uploader-icon shadow-soft"></i>
                                </span>
                            </label>
                        </div>

                        <!-- <div class="img-upload">
                    <label class="btn btn-primary">
                        Upload new picture <input type="file" name="profile_pic" id="profile_pic" hidden>
                    </label>
                    <p class="mt-1">Logo Should be minimum 152 * 152 Supported File format JPG, PNG, SVG</p>
                </div> -->

                    </form>
                </div>


                <div class="col-md-8 flex-item">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="row ">

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3 profileUpdateFont">
                                    <p class="profileUpdateFont required">Name</p>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control" placeholder="Enter First Name" required>
                                    <span class="error text-danger">@error('name') {{ $message }} @enderror</span>
                                </div>

                            </div>
                            <!-- <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control"
                            readonly placeholder="Enter Email Address">
                        <span class="error text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                </div> -->


                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Email</p>
                                    <input type="text" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-control" readonly placeholder="Enter Last Name" required>
                                    <span class="error text-danger">@error('email') {{ $message }} @enderror</span>
                                </div>
                            </div>


                            <!--   <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>contact No 1</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control"
                            placeholder="Enter Mobile Number">
                        <span class="error text-danger">@error('phone') {{ $message }} @enderror</span>
                    </div>
                </div>

               <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>contact No 2</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control"
                            placeholder="Enter Mobile Number">
                        <span class="error text-danger">@error('phone') {{ $message }} @enderror</span>
                    </div>
                </div> -->

                            <!-- <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Contact No. 1</p>
                                    <input type="text" id="mobile_code" name="phone"
                                        value="{{ old('phone', $user->phone) }}" class="form-control" placeholder=""
                                        required>
                                    <span class="error text-danger">@error('phone') {{ $message }} @enderror</span>
                                </div>
                            </div> -->

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Contact No. 1</p>
                                    <input type="text" id="mobile_code" name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="form-control" placeholder="" required>
                                    <span class="error text-danger">@error('phone') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Contact No. 2</p>
                                    <input type="text" id="mobile_code2" name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="form-control" placeholder="" required>
                                    <span class="error text-danger">@error('phone') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Country</p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>USA</option>
                                        <option value="1">Australia</option>
                                        <option value="2">India</option>
                                        <option value="3">China</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">State</p>
                                    <select class="form-select">
                                        <option selected>Alabama</option>
                                        <option>Washington</option>
                                        <option>Washington</option>
                                        <option>Washington</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">City</p>
                                    <select class="form-select">
                                        <option selected>Huntsville</option>
                                        <option>City 1</option>
                                        <option>City 2</option>
                                        <option>City 3</option>
                                        <option>City 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Zip Code</p>
                                    <input type="text" class="form-control" placeholder="Enter Your Zip Code">
                                </div>
                            </div>


                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont required">Address 1</p>
                                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                        class="form-control" placeholder="Enter your Address">
                                    <span class="error text-danger">@error('address') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <p class="profileUpdateFont">Address 2</p>
                                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                        class="form-control" placeholder="Enter your Address">
                                    <span class="error text-danger">@error('address') {{ $message }} @enderror</span>
                                </div>
                            </div>


                            {{-- <div class="col-lg-12">
                                <div class="form-title">
                                    <h5>Address Information</h5>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-12">
                                <div class="input-block mb-3">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Enter your Address">
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>Country</label>
                                    <input type="text" class="form-control" placeholder="Enter your Country">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>State</label>
                                    <input type="text" class="form-control" placeholder="Enter your State">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>City</label>
                                    <input type="text" class="form-control" placeholder="Enter your City">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="input-block mb-3">
                                    <label>Postal Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Your Postal Code">
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="btn-path text-end">
                                    <a href="javascript:void(0);"
                                        class="btn btn-cancel btn-outline-dark me-3">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <script>
        document.getElementById('profile_pic').addEventListener('change', function (event) {
            let file = event.target.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('blah').src = e.target.result; // Image preview
                };
                reader.readAsDataURL(file);

                // Form automatically submit kare
                document.getElementById('profileForm').submit();
            }
        });
    </script>

</x-app-layout>