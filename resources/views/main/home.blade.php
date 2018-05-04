@extends('base')
@section('title', 'Home')
@section('css')
<style>
    .add-margin-top {
        margin-top: 15px;
    }
    .likes {
        display: inline-block;
    }
</style>
@endsection
@section('body')
    <div class="row">
        <div class="col-md-12 text-center jumbotron">
            <h3>My Diary - Where your stories are heard</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8" id="generalPosts">
            @foreach( $posts as $post )
                <div class="row postContent">
                    <div class="col-md-12">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->body }}</p>
                    </div>
                </div>
                <div class="row postInfo">
                    <div class="col-md-9">
                        <i>Author: <span>{{ $post->member->name }}</span></i><br>
                        <i>Created at: <span>{{ date("F dS Y", strtotime($post->member->created_at)) }}</span></i>
                    </div>
                    <div class="col-md-3">
                        <p class="postID hidden">{{ $post->id }}</p>
                        <p class="likes">{{ !$post->like ? 0 : $post->like }}</p>
                        <button class="btn btn-primary btnLike"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Like</button>
                        <button class="btn btn-info btnLiked hidden"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Liked</button>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        <div class="col-md-4 jumbotron">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('posts.getCreate') }}" class="btn btn-success btn-block">
                        Create new post
                    </a>
                </div>
            </div>
            <div class="row add-margin-top">
                <div class="col-md-12">
                    <a href="{{ route('posts.index') }}" class="btn btn-info btn-block">
                        View your posts
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.btnLike').click( function(){
                $(this).addClass('hidden');
                $(this).siblings('.btnLiked').removeClass('hidden');

                var postId = $(this).siblings('.postID').text();
                $.ajax({
                    url: 'posts/like',
                    type: 'POST',
                    data: {postId},
                    dataType: 'JSON',
                    success: function(response){
                        alert(response['message']);
                    },
                });
                $oldLike = + $(this).siblings('.likes').text();
                $(this).siblings('.likes').text(1 + $oldLike);
            });
        })
    </script>
@endsection