@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row h-60">
        <div class="col-md-12 my-auto">
            <div class="row my-auto">
                <div class="col-md col-lg"></div>
                <div class="col-md-7 col-lg-5">
                    <div class="card card-login">
                        <div class="card-body">
                            <h3>SSO Login</h3>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                {{-- <input type="hidden" name="stuff" value="" id="stuff"> --}}
                                <input type="email" name="email" id="email" class="form-control sso-inp  @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                                
                                @error('email')
                                    <span class="invalid-feedback text-right mb-2" role="alert">{{ $message }}</span>
                                @else
                                    <label for="email" class="sso-inp-label">Email</label>
                                @enderror
                                
                                <input type="password" name="password" id="password" class="form-control sso-inp  @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback text-right mb-2" role="alert">{{ $message }}</span>
                                @else
                                    <label for="password" class="sso-inp-label">Password</label>
                                @enderror
                                
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Password</a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-dark" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md col-lg"></div>
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
