@extends('base')
@section('title', 'Authentication')

@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Welcome to My Diary</h1>
            <h3>Please login or register to continue</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#loginModal">Log in</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('register.get') }}" class="btn btn-info btn-block" id="buttonRegister">Register</a>
        </div>
    </div>

    {{--Login Modal--}}
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Log in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                <div class="modal-body">
                        <div class="form-group">
                            <label for="loginEmail">Email address</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="rememberMe">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ route('reset_password_form') }}" class="btn btn-info">Forgot password</a>
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection