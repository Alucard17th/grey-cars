@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="auth-card">
                <div class="p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="text-primary fs-4"><i class="bi bi-shield-lock"></i></div>
                        <div>
                            <div class="h5 mb-0 fw-semibold">Admin login</div>
                            <div class="auth-muted small">Sign in to manage cars and reservations</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                required
                                autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <a class="auth-link small text-decoration-none" href="{{ route('admin.password.request') }}">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center auth-muted small mt-3">
                <a href="{{ route('home') }}" class="auth-link text-decoration-none">Back to website</a>
            </div>
        </div>
    </div>
</div>
@endsection
