@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="auth-card">
                <div class="p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="text-primary fs-4"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="h5 mb-0 fw-semibold">Forgot password</div>
                            <div class="auth-muted small">We will email you a password reset link</div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-send me-1"></i> Send reset link
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
