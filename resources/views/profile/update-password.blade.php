<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Change Password') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
        <div class="d-flex innertopnav">
            <p class="subhead pheads">Change Password</p>
        </div>
    </x-slot>

    <section>
        <div class="mt_n33">
            <p class="mt-1 h6 text-dark">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <!-- Current Password Field -->
            <div class="form-group row mb-4">
                <label class="col-md-3 foncolor">Current Password <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <div class="position-relative">
                        <input type="password" class="form-control inp" id="current-password" name="current_password"
                        value="{{ old('current_password') }}" placeholder="Enter Current Password">
                        <span toggle="#current-password" class="ti ti-eye field-icon toggle-password"></span>
                    </div>
                    @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- New Password Field -->
            <div class="form-group row mb-4">
                <label class="col-md-3 foncolor">New Password <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <div class="position-relative">
                        <input type="password" class="form-control inp" id="new_password" name="password"
                            placeholder="Enter New Password" value="{{ old('password') }}">
                        <span toggle="#new_password" class="ti ti-eye field-icon toggle-password"></span>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Confirm New Password Field -->
            <div class="form-group row mb-4">
                <label class="col-md-3 foncolor">Confirm New Password <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <div class="position-relative">
                        <input type="password" class="form-control inp" id="confirm_password" value="{{ old('confirm_password') }}"
                            name="password_confirmation" placeholder="Enter Confirm New Password">
                        <span toggle="#confirm_password" class="ti ti-eye field-icon toggle-password"></span>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="btn-path text-staart mt-5">
                <button class="btn btn-primary me-2" type="submit">Update</button>
                <a href="{{ route('profile.index') }}" class="btn btn-cancel btn-outline-dark">Cancel</a>
            </div>

            <!-- Success Message -->
            @if (session('status') === 'password-updated')
                <p class="text-success mt-3">Password updated successfully.</p>
            @endif
        </form>
    </section>
</x-app-layout>
<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("ti-eye-off");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
