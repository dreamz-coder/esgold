<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $usersCount = User::where('referred_by', $user->referral_code)->get()->count();
        $epinsCount = Epin::where('user_id', $user->id)->get()->count();
        $user = Auth::user();
        $walletBalance = $user->wallet;
        return view('user.dashboard', [
            'usersCount' => $usersCount,
            'epinsCount' => $epinsCount,
            'walletBalance' => $walletBalance
        ]);
    }
}
