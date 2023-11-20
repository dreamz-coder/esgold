<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawlHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    //
    public function index()
    {


            $withdraw = WithdrawlHistory::with('user')->where('status',0)->latest()->get();
            //dd($withdraw);

            return view('admin.withdraw.withdrawrequest', ['withdraw' => $withdraw]);
    }
    public function userdetails(Request $request){
        $id = $request->id;
       // dd($id);
        $user = WithdrawlHistory::with('user')->where('withdrawl_histories.id',$id)->first();
        //dd($user);
        $view = view('admin.withdraw.form',['user'=>$user])->render();
        return response()->json(['view' =>$view]);
    }
    public function store(Request $request){
   // dd($request);
        $auth = Auth::user()->id;
        $withdraw = WithdrawlHistory::where('id',$request->user_id)->first();
        //dd($withdraw);
        $withdraw->status = $request->input('status');
        $withdraw->reason = $request->reason;
        $withdraw->update();
        if($request->status == 1){
            $user = User::where('id',$withdraw->user_id)->first();
           // dd($user);
            $user['wallet'] = $user->wallet - $withdraw->amount;
            $user->update();
           $admin_wallet = User::where('id',$auth)->first();
           $admin_wallet['tax_amount'] = $admin_wallet->tax_amount + $withdraw->tax;
           $admin_wallet->update();
        }
        return response()->json(['status' =>'true']);
    }
    public function useraccept(){
        $withdraw = WithdrawlHistory::with('user')->where('status',1)->latest()->get();
        //dd($withdraw);

        return view('admin.withdraw.accept', ['withdraw' => $withdraw]);
    }
    public function userreject(){
        $withdraw = WithdrawlHistory::with('user')->where('status',2)->latest()->get();
        //dd($withdraw);

        return view('admin.withdraw.reject', ['withdraw' => $withdraw]);
    }
}
