@extends('sso.app')

@section('content')
    <div class="row h-60">
        <div class="col-md-12 my-auto">
            <div class="row my-auto">
                <div class="col-md col-lg"></div>
                <div class="col-md-7 col-lg-5">
                    <div class="card ">
                        <div class="card-body">
                            <h3>SSO Login</h3>
                            <form action="{{ route('sso-authenticate') }}" method="post">
                                @csrf
                                <input type="hidden" name="stuff" value="" id="stuff">
                                <input type="email" name="email" id="email" class="form-control sso-inp" placeholder="Email Address">
                                <label for="email" class="sso-inp-label">Email</label>
                                <input type="password" name="password" id="password" class="form-control sso-inp" placeholder="Password">
                                <label for="password" class="sso-inp-label">Password</label>
                                
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
@endsection

@section('script')
    <script>
        window.onload = () => {
            for (let index = 0; index < 10; index++) {
                console.log('hello')
            }
        }
    </script>
@endsection