<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="font-semibold text-xl text-light leading-tight">
           
        </h2>
        <div>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">Edit Profile</a>
            <a href="{{ route('profile.password') }}" class="btn btn-warning">Update Password</a>
        </div>
    </div>
    <section>
        <div class="content-page-header">
            <h5 class="setting-menu">Profile</h5>
        </div>

        <div class="profile-picture text-center">
            <div class="upload-profile me-2">
                <div class="profile-img">
                    <img id="blah" class="avatar"
                        src="{{ asset(auth()->user()->profile_pic ?? 'assets/img/profiles/avatar-10.jpg') }}"
                        alt="profile-img">
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="form-title">
                    <h5>General Information</h5>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="info-block mb-3">
                    <label class="fw-bold">Name:</label>
                    <p>{{ $user->name }}</p>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="info-block mb-3">
                    <label class="fw-bold">Email:</label>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="info-block mb-3">
                    <label class="fw-bold">Phone No:</label>
                    <p>{{ $user->phone ?? 'Not Provided' }}</p>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="info-block mb-3">
                    <label class="fw-bold">Address:</label>
                    <p>{{ $user->address ?? 'Not Provided' }}</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
