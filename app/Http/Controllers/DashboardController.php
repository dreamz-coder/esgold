<?php

namespace App\Http\Controllers;

use App\Models\Epin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersCount = User::whereNot('id', 1)->get()->count();
        $epinsCount = Epin::get()->count();
        $user = Auth::user();
        $tax_amount = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();
       // dd($users);
        $walletBalance = $user->wallet;
        return view('admin.dashboard', [
            'usersCount' => $usersCount,
            'epinsCount' => $epinsCount,
            'walletBalance' => $walletBalance,
            'tax_amount' => $tax_amount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
