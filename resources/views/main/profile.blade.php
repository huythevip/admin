@extends('base')
@section('title', 'Personal Profile')
@section('css')

@endsection

@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Your personal information, {{ $_SESSION['username'] }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="thumbnail">
                        <a href="#">
                            @if ( !is_null($member->profile_picture) )
                                <img src="{{ $member->profile_picture }}" alt="Profile Picture" style="width:100%">
                                <div class="caption text-center">
                                    <p>{{ $member->name }}</p>
                                </div>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>Your username: {{ $member->name }}</h3>
                    <h3>Your email: {{ $member->email }}</h3>
                    <h3>Your bio: {{ $member->bio }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection