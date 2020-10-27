{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body class="passport-authorize">
    <div class="container">
        
    </div>
</body>
</html> --}}

@extends('sso.app')

@section('content')
    <style>
        .client-class {
            height: 100px;
            background-image: url('{{ is_null($client->rgroup->image) ? '/img/rg-placeholder.png' : $client->rgroup->image }}');
            background-color: #cccccc;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .btn {
            border-radius: 25px;
        }
    </style>

    <div class="row h-60">
        <div class="col-md-12 my-auto">
            <div class="row my-auto">
                <div class="col-md col-lg"></div>
                <div class="col-md-7 col-lg-5">
                    <div class="card card-login">
                        <div class="card-body">
                            <h3>Authorization Request</h3>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4 client-class mb-2">                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>
                            <!-- Scope List -->
                            @if (count($scopes) > 0)
                                <div class="scopes">
                                        <p class="mb-0"><strong>This application will be able to:</strong></p>

                                        <ul>
                                            @foreach ($scopes as $scope)
                                                <li>{{ $scope->description }}</li>
                                            @endforeach
                                        </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                        @csrf
    
                                        <input type="hidden" name="state" value="{{ $request->state }}">
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                        <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                        <button type="submit" class="btn btn-dark w-100">Authorize</button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                        @csrf
                                        @method('DELETE')
    
                                        <input type="hidden" name="state" value="{{ $request->state }}">
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                        <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                        <button class="btn btn-secondary w-100">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md col-lg"></div>
            </div>
        </div>
    </div>
@endsection