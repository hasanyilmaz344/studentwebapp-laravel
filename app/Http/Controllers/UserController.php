<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Arr;
use Response;

class UserController extends Controller
{
    public function loginscreen()
    {
        if (auth()->check()) {
            return redirect('studentlist');
        } else {
            return view('loginscreen');
        }
    }
    public function createuser()
    {
        return view('createuser');
    }
    public function createuserpost(Request $request)
    {
        $theuser      =           array(
            'name'        =>      $request->name,
            'email'         =>      $request->email,
            'password'         =>      Hash::make($request->password)
        );
        $user = User::create($theuser);
        if (!is_null($user)) {
            return view('loginscreen');
        } else {
            return "failed";
        }
    }
    public function loginuser(Request $request)
    {
        if (Auth::attempt(['name' =>  $request->name, 'password' => $request->password])) {
            return redirect('studentlist');
        } else {
            return "failed";
        }
    }
    public function logoutuser(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return view('loginscreen');
    }
    public function erisimyasak(Request $request)
    {
        return view('erisimyasak');
    }
    public function updateuserajax(Request $request)
    {
        $user = User::query()->find((auth()->user()->id));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json(['success' => 'basarili controller userupdateajax son satir']);
    }
}
