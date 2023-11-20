<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EpinTransfer\UpdateTransferRequest;
use App\Models\Epin;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpinTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('epin')
            ->with('epin')
            ->withCount('epin')
            ->latest()
            ->get();
        // dd($users);
        return view('admin.transfer.index', ['users' => $users]);
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // dd($user);
        $users = User::whereNotIn('id', [$user->id, 1])->get();
        return view('admin.transfer.edit', ['user' => $user->load('epin'), 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransferRequest $request, User $user)
    {
        // dd($user);
        // dd("done");
        $validator = $request->validated();
        // dd($validator);
        $epin = Epin::where('id', $validator['epin_id'])->first();
        $epin['user_id'] = $validator['user_id'];
        $epin->update();
        $data = [
            'from' => Auth::id(),
            'epin_id' => $validator['epin_id'],
            'to' => $validator['user_id'],
            'reason' => $validator['reason'],
        ];
        // dd($data);
        Transfer::create($data);
        return to_route('admin.transfer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function userdetails(Request $request)
    {
        // dd($user);
        $users = User::where('id',$request->id)->first();
        return response()->json($users);
    }

}
