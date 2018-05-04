@extends('base')
@section('title', 'All posts')

@section('body')
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>All posts of {{ $_SESSION['username']  }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="20%">Title</th>
                    <th width="65%">Body</th>
                    <th width="15%">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ( $posts as $post )
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->body }}</td>
                            <td>
                                <button class="btn btn-info">Edit</button>
                                <button class="btn btn-warning">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection