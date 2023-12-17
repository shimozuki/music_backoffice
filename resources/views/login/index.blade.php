@extends('layouts.auth')

@section('title')
Login Page
@endsection

@section('container')
<div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">

            {{-- success alert from successful register --}}
            @if ( session('success') )
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                <strong>Register Done!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if ( session('loginFailed') )
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
                <strong>Something went wrong!</strong> {{ session('loginFailed') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card border-0 mt-5">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="mb-5">
                                    <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                </div>

                                <h6 class="h5 mb-0">Welcome back!</h6>
                                <p class="text-muted mt-2 mb-5">Enter your email address and password to access admin
                                    panel.</p>

                                <form method="POST" action="/login">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="example@gmail.com" autofocus required>

                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-theme">Login</button>
                                    <div class="d-flex justify-content-end">
                                        <a href="#l" class="forgot-link text-primary text-decoration-none">Forgot password?</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <img class="account-block rounded-right" src="{{ asset('assets/img/FUO9GzfaO0nqu8963UQ6_1641617545.jpeg')}}" alt="" width="100%">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

            <p class="text-muted text-center mt-3 mb-0">Don't have an account? <a href="/register" class="text-primary ml-1 text-decoration-none">Register</a></p>

            <!-- end row -->

        </div>
        <!-- end col -->
    </div>
    <!-- Row -->
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#error-alert').fadeTo(4000, 500).slideUp(500, function() {
            $('#error-alert').slideUp(500);
        });

        $('#success-alert').fadeTo(4000, 500).slideUp(500, function() {
            $('#success-alert').slideUp(500);
        });
    });
</script>
@endpush