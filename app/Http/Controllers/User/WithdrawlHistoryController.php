<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\User\UpdateUserAccountDetailsrequest;
use App\Http\Requests\User\Withdraw\StoreWithdrawRequest;
use App\Models\User;
use App\Models\WithdrawlHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawlHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->account_number != Null) {
            $withdrawls = WithdrawlHistory::where('user_id', $user->id)->latest()->get();
            return view('user.withdrawl_history.index', ['withdrawls' => $withdrawls]);
        } else {
            return view('user.user.account_details', ['user' => $user]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updateAccountDeatils(UpdateUserAccountDetailsrequest $request, User $user)
    {
        $user->update($request->validated());
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWithdrawRequest $request)
    {
       // dd($request->all());
        $validator = $request->validated();
        // dd($validator);
        $user = Auth::user();
        if ($user->wallet >= $validator['amount']) {
            WithdrawlHistory::create($validator);
            return back();
        } else {
            return back()->with('error', 'You don\'t have enough money to make this withdrawal.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WithdrawlHistory $withdrawlHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WithdrawlHistory $withdrawlHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WithdrawlHistory $withdrawlHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WithdrawlHistory $withdrawlHistory)
    {
        //
    }
}
