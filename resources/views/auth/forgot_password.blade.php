@extends('base')
@section('title', 'Forgot Password')
@section('css')

@endsection

@section('body')
    <form action="{{ route('reset_password') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group" style="width: 50%">
            <label for="resetEmail">Email address</label>
            <input type="email" class="form-control" id="resetEmail" name="email" placeholder="Enter email">
        </div>
        <button type="submit" class="btn btn-primary">Get reset password email</button>
    </form>
@endsection