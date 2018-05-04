@extends('base')
@section('title', 'Update Password')
@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Please fill in your new password</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('update_password', $user->token) }}" enctype="multipart/form-data">
                {{ csrf_field()  }}
                <input name="email" class="hidden" value="{{ $user->email }}">
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Your password">
                </div>
                <div class="form-group">
                    <label for="inputPasswordConfirmation">Confirm your password</label>
                    <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Retype your password">
                </div>
                <button type="submit" class="btn btn-info btn-block">Reset password</button>
            </form>
        </div>
    </div>
@endsection