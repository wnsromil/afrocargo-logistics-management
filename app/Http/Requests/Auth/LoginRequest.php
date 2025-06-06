<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Warehouse;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'warehouse_code' => ['required_if:id,manager', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // ✅ Warehouse Code Optional Validation
        if ($this->filled('warehouse_code')) {
            $warehouse = Warehouse::where('warehouse_code', $this->input('warehouse_code'))->first();

            if (!$warehouse) {
                throw ValidationException::withMessages([
                    'warehouse_code' => 'Invalid warehouse code.',
                ]);
            }

            // ✅ User Ka Warehouse ID Check Karna
            $user = User::where('email', $this->input('email'))
                ->where('warehouse_id', $warehouse->id)
                ->where('role', 'warehouse_manager')
                ->first();

            if (!$user) {
                throw ValidationException::withMessages([
                    'warehouse_code' => 'Warehouse code is not assigned to you.',
                ]);
            }

            // 🔒 Check if manager is Inactive
            if ($user->status === 'Inactive') {
                throw ValidationException::withMessages([
                    'email' => 'Your account is inactive. Please contact admin.',
                ]);
            }
        }

        // ✅ Email & Password Validate Karna
        if (!Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }



    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
