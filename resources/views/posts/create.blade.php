@extends('base')
@section('title', 'Create new post')

@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Create new post for {{ $_SESSION['username']  }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="create" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Your post title">
                </div>
                <div class="form-group">
                    <label for="body">Post body</label>
                    <textarea class="form-control" id="body" name="body" placeholder="Your post body" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create new post</button>
            </form>
        </div>
    </div>
@endsection