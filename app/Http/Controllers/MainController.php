<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Member;
class MainController extends Controller
{
    public function home(){
        return view('main.home',[
            'posts' => Post::all(),
        ]);
    }

    public function profile(){
        $memberId = $_SESSION['userid'];
        $member = Member::find($memberId);
        return view('main.profile', [
            'member' => $member,
        ]);
    }
}