@extends('layouts.app',['title' => 'Register'])
@section('library')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection
@section('content')
    <div class="container py-3 text-light">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="card-title text-center mb-5">
                            <span class="fw-bolder fs-3">Hello, Welcome to</span>
                            <a href="/" class="netplix-logo fs-2">Netplix</a>
                        </div>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <div class="d-flex align-items-center form-input-box px-3 py-3">
                                    <label for="name" class="form-label">Username</label>
                                    <input type="text" class="text-light form-input @error('name')is-invalid @enderror"
                                        name="username" placeholder="Enter your username" value="{{ old('username') }}">
                                </div>
                                @error('username')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center form-input-box px-3 py-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="text-light form-input @error('email')is-invalid @enderror"
                                        name="email" placeholder="Enter your email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center form-input-box px-3 py-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password"
                                        class="text-light form-input @error('password')is-invalid @enderror" name="password"
                                        placeholder="Enter your password">
                                </div>
                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center form-input-box px-3 py-3">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <input type="password"
                                        class="text-light form-input @error('confirm-password')is-invalid @enderror"
                                        name="confirm-password" placeholder="Enter your confirm password">
                                </div>
                                @error('confirm-password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-auth w-100 text-light">Register <i
                                    class="fas fa-arrow-right"></i></button>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="footer-auth">Already have an account?<a href="{{ route('show-login') }}"
                                    class="auth-link"> Login
                                    now!<a></p>
                        </div>

                    </div>
                    </p>
                </div>

            </div>
        </div>
    </div>

@endsection
