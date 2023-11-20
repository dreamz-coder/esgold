<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\User\CheckLoginequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('user.auth.login');
    }

    public function loggedin(CheckLoginequest $request)
    {
        $validator = $request->validated();
        $user = User::where('user_id', $validator['user_id'])->first();

        if ($user && Auth::attempt(['user_id' => $validator['user_id'], 'password' => $validator['password']])) {
            return to_route('user.dashboard');
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }
    public function changepassword(Request $request){
        return view('changepassword');
    }
    public function changepassword_store(Request $request){
       // dd($request->all());
        $user = User::where('id',$request->user_id)->first();
        $user['password'] = $request->password;
        $user->save();
        session()->flash('success', 'Password Changed successfully ' . $user->user_id);
        return to_route('user.userlogout');
    }
    public function userlogout(Request $request)
{
   

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('userLogin');
}
}
