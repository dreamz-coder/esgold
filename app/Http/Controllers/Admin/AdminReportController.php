<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\WithdrawlHistory;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function transfer(Request $request)
    {
       // dd($request->user_id);
        $transactions = TransactionHistory::when(request('from_date'), function ($query, $from_date) {
            $query->where(function ($query) use ($from_date) {
                $query->whereDate('created_at', '>=', $from_date);
            });
        })
        ->when(request('to_date'), function ($query, $to_date) {
            $query->where(function ($query) use ($to_date) {
                $query->whereDate('created_at', '<=', $to_date);
            });
        })
        ->when(request('user_id'), function ($query, $user_id) {
            $query->where(function ($query) use ($user_id) {
                $query->whereRelation('user','user_id', 'LIKE', "%$user_id%");
            });
        })
        ->latest()->with('user')->get();
        // // if($request->from_date != '' && $request->from_date != 'undefined')
        // // {
        // //     $transactions =  $transactions->whereDate('created_at', '>=', $request->from_date);
        // // }
        // if($request->to_date != '' && $request->to_date != 'undefined')
        // {
        //     $transactions =  $transactions->whereDate('created_at', '<=', $request->to_date);
        // }
        // if($request->user_id !='' && $request->user_id != "undefined"){

        //         $transactions =  $transactions->whereRelation('user','user_id', 'LIKE', "%esgold#00002%");
        // }

      // dd($transactions);
        return view('admin.report.transfer', ['transactions' => $transactions,'from_date' =>$request->from_date,'to_date' =>$request->to_date,'user'=>$request->user_id]);
    }
    public function accept(Request $request){
        $withdraw = WithdrawlHistory::with('user')->where('status',1)
        ->when(request('from_date'), function ($query, $from_date) {
            $query->where(function ($query) use ($from_date) {
                $query->whereDate('created_at', '>=', $from_date);
            });
        })
        ->when(request('to_date'), function ($query, $to_date) {
            $query->where(function ($query) use ($to_date) {
                $query->whereDate('created_at', '<=', $to_date);
            });
        })
        ->when(request('user_id'), function ($query, $user_id) {
            $query->where(function ($query) use ($user_id) {
                $query->whereRelation('user','user_id', 'LIKE', "%$user_id%");
            });
        })
        ->latest()->get();
        //dd($withdraw);

        return view('admin.report.accept', ['withdraw' => $withdraw,'from_date' =>$request->from_date,'to_date' =>$request->to_date,'user'=>$request->user_id]);
    }
    public function reject(Request $request){
        $withdraw = WithdrawlHistory::with('user')->where('status',2)
        ->when(request('from_date'), function ($query, $from_date) {
            $query->where(function ($query) use ($from_date) {
                $query->whereDate('created_at', '>=', $from_date);
            });
        })
        ->when(request('to_date'), function ($query, $to_date) {
            $query->where(function ($query) use ($to_date) {
                $query->whereDate('created_at', '<=', $to_date);
            });
        })
        ->when(request('user_id'), function ($query, $user_id) {
            $query->where(function ($query) use ($user_id) {
                $query->whereRelation('user','user_id', 'LIKE', "%$user_id%");
            });
        })
        ->latest()->get();
        //dd($withdraw);

        return view('admin.report.reject', ['withdraw' => $withdraw,'from_date' =>$request->from_date,'to_date' =>$request->to_date,'user'=>$request->user_id]);
    }
    public function member(Request $request){
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
        ->when(request('from_date'), function ($query, $from_date) {
            $query->where(function ($query) use ($from_date) {
                $query->whereDate('created_at', '>=', $from_date);
            });
        })
        ->when(request('to_date'), function ($query, $to_date) {
            $query->where(function ($query) use ($to_date) {
                $query->whereDate('created_at', '<=', $to_date);
            });
        })
        ->when(request('user_id'), function ($query, $user_id) {
            $query->where(function ($query) use ($user_id) {
                $query->where('user_id', 'LIKE', "%$user_id%");
            });
        })
        ->latest()->get();
        return view('admin.report.member', ['users' => $users,'from_date' =>$request->from_date,'to_date' =>$request->to_date,'user'=>$request->user_id]);
    }
    public function request_report(Request $request){
        $withdraw = WithdrawlHistory::with('user')->where('status',0)
        ->when(request('from_date'), function ($query, $from_date) {
            $query->where(function ($query) use ($from_date) {
                $query->whereDate('created_at', '>=', $from_date);
            });
        })
        ->when(request('to_date'), function ($query, $to_date) {
            $query->where(function ($query) use ($to_date) {
                $query->whereDate('created_at', '<=', $to_date);
            });
        })
        ->when(request('user_id'), function ($query, $user_id) {
            $query->where(function ($query) use ($user_id) {
                $query->whereRelation('user','user_id', 'LIKE', "%$user_id%");
            });
        })
        ->latest()->get();
        //dd($withdraw);

        return view('admin.report.request', ['withdraw' => $withdraw,'from_date' =>$request->from_date,'to_date' =>$request->to_date,'user'=>$request->user_id]);
    }

}
