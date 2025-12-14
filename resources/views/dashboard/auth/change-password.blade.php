@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="auth-card">
                <div class="p-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="text-primary fs-4"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <div class="h5 mb-0 fw-semibold">Change password</div>
                            <div class="auth-muted small">Update your account password</div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.change.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Current password</label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror" required autofocus>
                            @error('current_password')
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
                            <i class="bi bi-check2-circle me-1"></i> Update password
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center auth-muted small mt-3">
                <a href="{{ route('admin.cars.index') }}" class="auth-link text-decoration-none">Back to dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection
