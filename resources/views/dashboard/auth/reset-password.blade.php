@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="auth-card">
                <div class="p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="text-primary fs-4"><i class="bi bi-key"></i></div>
                        <div>
                            <div class="h5 mb-0 fw-semibold">Reset password</div>
                            <div class="auth-muted small">Choose a new password</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $email) }}"
                                class="form-control @error('email') is-invalid @enderror" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm new password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check2-circle me-1"></i> Reset password
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center auth-muted small mt-3">
                <a href="{{ route('admin.login') }}" class="auth-link text-decoration-none">Back to login</a>
            </div>
        </div>
    </div>
</div>
@endsection
