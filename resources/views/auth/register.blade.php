@extends('base')
@section('title', 'Register')
@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Welcome to My Diary</h1>
            <h3>Please fill in your information</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
                {{ csrf_field()  }}
                <div class="form-group">
                    <label for="inputName">Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Your name">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Your email">
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Your password">
                </div>
                <div class="form-group">
                    <label for="inputPasswordConfirmation">Confirm your password</label>
                    <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Retype your password">
                </div>
                <div class="form-group">
                    <label for="inputBio">Tell us about your self:</label>
                    <textarea class="form-control" rows="5" id="inputBio" name="bio"></textarea>
                </div>
                <div class="form-group">
                    <label for="inputFile">Select profile picture:</label>
                    <input type="file" name="uploadFile" id="inputFile">
                </div>
                <button type="submit" class="btn btn-info btn-block">Register</button>
            </form>
        </div>
    </div>
@endsection