<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
class PagesController extends Controller
{
    public function gate()
    {
        if ( isset($_COOKIE['username']) ){
            if ( Member::where('remember_token', $_COOKIE['username'])->first() ){
                $member = Member::where('remember_token', $_COOKIE['username'])->first();
                $_SESSION['username'] = $member->name;
                return view('pages.gate');
            }
        };
        return view('pages.gate');
    }

    public function about(){
        session_start();
        return view('pages.about');
    }

    public function contact(){
        session_start();
        return view('pages.contact');
    }

}
