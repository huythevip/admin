<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MemberController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:members',
            'password' => 'required|min:3|max:60|confirmed',
        ]);

        $newMember = new Member;
        $newMember->name = $request->name;
        $newMember->email = $request->email;
        $newMember->password = Hash::make($request->password);
        $newMember->bio = $request->bio;
        $newMember->activated = false;

        //Process upload file:
        if ( $request->hasFile('uploadFile') ){
            $profilePicture = $request->file('uploadFile');
            $fileName = 'Profile_Picture'.'.'.$profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('storage/profile_pictures/'.$request->email), $fileName);

            $newMember->profile_picture = 'storage/profile_pictures/'.$request->email.'/'.$fileName;
        };

        $token = md5($request->name.'activationToken');
        $newMember->remember_token = $token;
        $newMember->save();



        //Send registration email containing token to verify:

        $confirmationLink = '<a href="http://localhost:8000/register/token='.$token.'">link</a>';
        $emailBody = '<b>Congratulations</b> on joining us!<br>Please click the following '.$confirmationLink.
            ' to finish your registration';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'huy.thevip@gmail.com';                 // SMTP username
            $mail->Password = 'hellokitty123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('huy.thevip@gmail.com', 'My Diary');
            $mail->addAddress($request->email, $request->name);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Confirm your registration, '.$request->name;
            $mail->Body    = $emailBody;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            return redirect('/');
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }


    }

    public function activateMember($token) {
        if (Member::where('remember_token', $token)->first() ){

            $member = Member::where('remember_token', $token)->first();

            if ( !$member->activated ){

                $member->activated = true;
                $member->save();
                $_SESSION['username'] = $member->name;
                $_SESSION['userid'] = $member->id;

                return redirect('/');

            } else {
                //Say that user already activated and need to login.
                $message = 'activated & need to login';
                return redirect('/')->with('message', $message);
            };
        } else {

            //Say that activation token invalid.
            $message = 'token invalid';
            return redirect('/')->with('message', $message);
        };
    }

    public function showResetForm(){
        return view('auth.forgot_password');
    }

    public function logOut() {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['userid']);
        setcookie('username');
        return redirect('/');
    }

    public function resetPassword(request $request){
        $userEmail = $request->email;
        $token = md5($userEmail.'resetpassword');

        //Save user email + token into Reset Password table
        DB::table('password_resets')->insert([
            [
                'email' => $request->email,
                'token' => $token
            ]
        ]);

        $resetPasswordLink = '<a href="http://localhost:8000/reset_password/token='.$token.'">link</a>';
        $emailBody = 'Please click the following '.$resetPasswordLink.
            ' to reset your password';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'huy.thevip@gmail.com';                 // SMTP username
            $mail->Password = 'hellokitty123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('huy.thevip@gmail.com', 'My Diary');
            $mail->addAddress($request->email);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reset password confirmation, '.$request->name;
            $mail->Body    = $emailBody;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
            return redirect('/');
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    }

    public function showUpdatePasswordForm($token){
        if ( DB::table('password_resets')->where('token', '=', $token)->first() ){
            $user = DB::table('password_resets')->where('token', '=', $token)->first();
            return view('auth.update_password', [
                'user' => $user,
            ]);
        } else {
            return redirect('/');
        };

        //Say that token not found
        return redirect('/');
    }

    public function updatePassword(request $request, $token){
        $this->validate($request, [
            'password' => 'required|min:5|max:60|confirmed',
        ]);

        if ( DB::table('password_resets')->where('token', '=', $token)->first() ){

            //Delete user information in Reset Password table.
            DB::table('password_resets')->where('token', '=', $token)->delete();

            //Update new password:
            $userEmail = $request->email;
            $user = Member::where('email', $userEmail)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/');
        };
    }

}
