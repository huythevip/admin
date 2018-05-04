<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Hash;
use App\Post;
class LoginController extends Controller
{
    public function logIn(request $request){
        if ( Member::where('email', $request->email)->first() ){
            $member = Member::where('email', $request->email)->first();

            if (!$member->remember_token){
                //Say that user has not activated his/her account.
                return redirect('/');

            } else {

                if ( Hash::check($request->password, $member->password)){
                $_SESSION['username'] = $member->name;
                $_SESSION['userid'] = $member->id;

                //Check Remember me
                if ($request->rememberMe) {
                    setcookie('username', $member->remember_token, time() + 60 * 60 * 24 * 30);
                };

                //Say that user logged in successfully.
                return redirect()->route('home');
            };
            }

            //Say incorrect email or password
            return redirect('/');

        } else {
            //Say incorrect email or password
            return redirect('/');
        }
    }
}
