
@section('content')
<h2 class="font-semibold text-xl text-light leading-tight">
    {{ __('Profile') }}
</h2>
@endsection

<x-app-layout>

   
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <section>


        <div class="content-page-header">
            <h5 class="setting-menu">Profile</h5>
        </div>
        <form id="profileForm" action="{{ route('profile.upload_pic') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-picture">
                <div class="upload-profile me-2">
                    <div class="profile-img">
                        <img id="blah" class="avatar"
                            src="{{ asset(auth()->user()->profile_pic ?? 'assets/img/profiles/avatar-10.jpg') }}"
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
        </form>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
            <div class="row">

                <div class="col-lg-12">
                    <div class="form-title">
                        <h5>General Information</h5>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control"
                            placeholder="Enter First Name">
                        <span class="error text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>

                </div>
                <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email', $user->email) }}" class="form-control"
                            readonly placeholder="Enter Email Address">
                        <span class="error text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>Phone No</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control"
                            placeholder="Enter Mobile Number">
                        <span class="error text-danger">@error('phone') {{ $message }} @enderror</span>

                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="input-block mb-3">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ old('address', $user->address) }}"
                            class="form-control" placeholder="Enter your Address">
                        <span class="error text-danger">@error('address') {{ $message }} @enderror</span>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="btn-path text-end">
                        {{-- <a href="javascript:void(0);" class="btn btn-cancel bg-primary-light me-3">Cancel</a> --}}
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>

            </div>
        </form>

    </section>
    <script>
        document.getElementById('profile_pic').addEventListener('change', function(event) {
            let file = event.target.files[0];
            
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('blah').src = e.target.result; // Image preview
                };
                reader.readAsDataURL(file);
    
                // Form automatically submit kare
                document.getElementById('profileForm').submit();
            }
        });
    </script>
</x-app-layout>