<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
    public function showCreateForm() {
        return view('posts.create');
    }

    public function createNewPost(request $request) {

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->member_id = $_SESSION['userid'];
        $post->save();

        return redirect()->route('home');
    }

    public function index() {
        $memberID = $_SESSION['userid'];
        $allPosts = Post::where('member_id', $memberID)->get();

        return view('main.index', [
            'posts' => $allPosts,
        ]);
    }

    public function like(request $request){
        $post = Post::find($request->postId);
        $post->like += 1;
        $post->save();
        return json_encode([
            'message' => 'You liked this post'
        ]);
    }
}
