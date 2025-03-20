<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light leading-tight">
            {{ __('Change Password') }}
        </h2>
    </x-slot>

    <section>
        <div class="content-page-header mt-n5 d-block">
            <h5 class="setting-menu">{{ __('Change Password') }}</h5>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="form-group row mb-4">
                <label class="col-md-3 foncolor">Current Password <span class="text-danger">*</span> </label>
                <div class="col-md-5">
                    <div class="position-relative">
                        <input type="password" class="form-control inp" id="current-password" name="current_password" placeholder="Enter Current Password">
                        <span toggle="#current-password" class="ti ti-eye field-icon toggle-password"></span>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-md-3 foncolor">New Password <span class="text-danger">*</span> </label>
                <div class="col-md-5">
                    <div class="position-relative">
                        <input type="password" class="form-control inp" id="new_password" name="password" placeholder="Enter New Password">
                        <span toggle="#new_password" class="ti ti-eye field-icon toggle-password"></span>
                    </div>
                </div>
            </div>
            <div class="form-group row mb-4">
                <label class="col-md-3 foncolor">Confirm New Password <span class="text-danger">*</span> </label>
                <div class="col-md-5">
                    <div class="position-relative">
                        <input type="password" class="form-control inp" id="confirm_password" name="password_confirmation" placeholder="Enter Confirm New Password">
                        <span toggle="#confirm_password" class="ti ti-eye field-icon toggle-password"></span>
                    </div>
                </div>
            </div>

            <div class="btn-path text-staart mt-5">
                <button class="btn btn-primary me-2" type="submit">Update</button>
                <a href="#" class="btn btn-cancel btn-outline-dark ">Cancel</a>
            </div>
            {{-- <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" />
                <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div> --}}

            {{-- <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
            </div> --}}

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
