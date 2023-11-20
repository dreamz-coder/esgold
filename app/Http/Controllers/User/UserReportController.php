<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WithdrawlHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{
    public function accept(Request $request)
    {
        $user = Auth::user();
            $withdrawls = WithdrawlHistory::where('user_id', $user->id)
            ->where('status',1)
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
            ->latest()->get();
            return view('user.reports.accept', ['withdrawls' => $withdrawls,'from_date' =>$request->from_date,'to_date' =>$request->to_date]);

    }
    public function reject(Request $request)
    {
        $user = Auth::user();
            $withdrawls = WithdrawlHistory::where('user_id', $user->id)
            ->where('status',2)
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
            ->latest()->get();
            return view('user.reports.reject', ['withdrawls' => $withdrawls,'from_date' =>$request->from_date,'to_date' =>$request->to_date]);

    }
}
