<?php

namespace App\Http\Controllers;

use App\PasswordSecurity;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;
//use PragmaRX\Google2FALaravel\Google2FA;
// use PragmaRX\Google2FALaravel\Support\Authenticator;


class PasswordSecurityController extends Controller
{
    //
    public function show2faForm(){

        if (Auth::guest()){
            return redirect('/');
        }

        $user = Auth::user();

        $google2FaUrl= '';

        if (count($user->passwordSecurity)){
            $google2Fa = new Google2FA();
            $google2Fa->setAllowInsecureCallToGoogleApis(true);
            $google2FaUrl = $google2Fa->getQRCodeGoogleUrl(
                'Codehacking',
                $user->email,
                $user->passwordSecurity->google2fa_secret
            );

        }
        $data = array(
            'user' => $user,
            'google2FaUrl' => $google2FaUrl
        );
        return view('auth.google2fa', compact('data')); // ->with('data', $data);
    }

    public function generate2faSecretCode(Request $request){
        $user = Auth::user();
        $google2Fa = new Google2FA();
        PasswordSecurity::create([
            'user_id' => $user->id,
            'google2fa_enable' => 0,
            'google2fa_secret' => $google2Fa->generateSecretKey()
        ]);
        return redirect('/2fa')->with('success','Success! You secret key has been generated! Please verify to enable.');
    }

    public function enable2fa(Request $request){

        $user = Auth::user();
        $google2Fa = new Google2FA();
        $secret = $request->input('verifyCode');
        $valid = $google2Fa->verifyKey($user->passwordSecurity->google2fa_secret, $secret);
        if($valid) {
            $user->passwordSecurity->google2fa_enable = 1;
            $user->passwordSecurity->save();
            return redirect('/2fa')->with('success','Success! 2FA has been enabled for your account.');
        } else {
            return redirect('/2fa')->with('failed','Failed! 2FA has NOT been enabled for your account. Invalid code, please try again!');
        }
    }

    public function disable2fa(Request $request){
        $user = Auth::user();
        if (!(Hash::check($request->get('currentPassword'), $user->password))) {
            return redirect('/2fa')->with('failed','Failed! 2FA has NOT been disabled for your account. Invalid password, please try again!');
        } else {
            $user->passwordSecurity->google2fa_enable = 0;
            $user->passwordSecurity->save();
            return redirect('/2fa')->with('success','Success! 2FA has been disabled for your account.');
        }
    }
}
