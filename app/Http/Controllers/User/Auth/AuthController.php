<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login_form() {
        return view('user.auth.login');
    }

    public function login(Request $request) {
        $validation = $request->validate([
            'phone' => 'required',
        ]);

        $phone =  998 . preg_replace('/[^0-9]/ui', "", $request->input('phone'));
        $user = User::where('phone', $phone)->first();
        if(strlen($phone) != 12) {
            return back()->withErrors(['phone' => true]);
        } else {
//            $random_number = SmsService::sendSms($phone);
            $random_number = 111111;
            if($user != null) {
                User::where('id', $user->id)->update([
                    'sms_code' => $random_number,
                ]);
            } else {
                User::insert([
                    'phone' => $phone,
                    'sms_code' => $random_number,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
                $user = User::where('phone', $phone)->first();
            }

            return redirect()->route('auth.login_check', ['id' => $user->id])->with('sms_code_message', true);
        }
    }

    public  function login_check_form($id) {
        return view('user.auth.login_check', compact('id'));
    }

    public function login_check(Request $request) {
        $validation = $request->validate([
            'sms_code' => 'required',
            'id' => 'required',
        ]);
        $id = $request->input('id');
        $sms_code = $request->input('sms_code');
        $user = User::where('id', $id)->first();
        if($user->sms_code != $sms_code) {
            return back()->withErrors(['sms_code' => true]);
        } else {
            if($user->id == $id && $user->sms_code == $sms_code) {
                Auth::login($user);
                return redirect()->route('user.index');
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
