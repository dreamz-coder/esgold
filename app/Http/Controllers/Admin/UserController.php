<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\WalletTransferRequest;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->latest()->get();
        return view('admin.user.index', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validator = $request->validated();
        $admin = User::where('id', 1)->first();
        if ($validator['referred_by'] == NULL) {
            $user = User::create($validator);
            $admin->wallet += 500;
            $admin->update();
        } else {
            $userFound = User::where('referral_code', $validator['referred_by'])->first();
            $usersCount = User::where('referred_by', $validator['referred_by'])->count();

            if (isset($userFound)) {
                if (($usersCount < 3) && ($userFound->level == 0)) {
                    $user = User::create($validator);
                    $latestCount = User::where('referred_by', $validator['referred_by'])->count();
                    if ($latestCount == 3) {
                        $userFound->level += 1;
                        $userFound->wallet += 150;
                        $userFound->update();
                        $admin->wallet += 350;
                        $admin->update();
                        $this->updateReferral($userFound);
                    } else {
                        $userFound->wallet += 150;
                        $userFound->update();
                        $admin->wallet += 350;
                        $admin->update();
                        $this->updateReferral($userFound);
                    }
                } else {
                    return back()->withErrors(['limit_reached' => 'The limit has been reached']);
                }
            } else {
                return back()->withErrors(['wrong_referral' => 'Wrong referral code']);
            }
        }

        $user->assignRole($validator['role']);
        session()->flash('success', 'Thank you for registering in Esgold Your user ID is ' . $user->user_id);
        return to_route('admin.user.index');
    }

    public function updateReferral($userFound)
    {
        $admin = User::where('id', 1)?->first();
        $memberCount = 3;
        $referrer = User::where('referral_code', $userFound?->referred_by)->first();

        if ($referrer) {

            // Level 2
            if ($referrer?->level == 1) {
                $referrer->wallet += 100;
                $referrer->update();
                $admin->wallet += 250;
                $admin->update();
                $referredUsersCount = User::where('referred_by', $referrer?->referral_code)->where('level', 1)->count();
                if ($referredUsersCount == $memberCount) {
                    $referrer->level += 1;
                    $referrer->update();
                }
            } elseif (isset($referrer)) {
                $referrer->wallet += 100;
                $referrer->update();
                $admin->wallet += 250;
                $admin->update();
            }
            // Level 3
            $headReferrer2 = User::where('referral_code', $referrer?->referred_by)->first();
            if ($headReferrer2 && $headReferrer2?->level == 2) {
                $headReferrer2->wallet += 60;
                $headReferrer2->update();
                $admin->wallet += 190;
                $admin->update();
                $headReferrer2Count = User::where('referred_by', $headReferrer2?->referral_code)->where('level', 2)->count();
                if ($headReferrer2Count == $memberCount) {
                    $headReferrer2->level += 1;
                    $headReferrer2->update();
                }
            } elseif (isset($headReferrer2)) {
                $headReferrer2->wallet += 60;
                $headReferrer2->update();
                $admin->wallet += 190;
                $admin->update();
            }
            // Level 4
            $headReferrer3 = User::where('referral_code', $headReferrer2?->referred_by)->first();
            if ($headReferrer3 && $headReferrer3?->level == 3) {
                $headReferrer3->wallet += 50;
                $headReferrer3->update();
                $admin->wallet += 140;
                $admin->update();
                $headReferrer3Count = User::where('referred_by', $headReferrer3?->referral_code)->where('level', 3)->count();
                if ($headReferrer3Count == $memberCount) {
                    $headReferrer3->level += 1;
                    $headReferrer3->update();
                }
            } elseif (isset($headReferrer3)) {
                $headReferrer3->wallet += 50;
                $headReferrer3->update();
                $admin->wallet += 140;
                $admin->update();
            }
            // Level 5
            $headReferrer4 = User::where('referral_code', $headReferrer3?->referred_by)->first();
            if ($headReferrer4 && $headReferrer4?->level == 4) {
                $headReferrer4->wallet += 40;
                $headReferrer4->update();
                $admin->wallet += 100;
                $admin->update();
                $headReferrer4Count = User::where('referred_by', $headReferrer4?->referral_code)->where('level', 4)->count();
                if ($headReferrer4Count == $memberCount) {
                    $headReferrer4->level += 1;
                    $headReferrer4->update();
                }
            } elseif (isset($headReferrer4)) {
                $headReferrer4->wallet += 40;
                $headReferrer4->update();
                $admin->wallet += 100;
                $admin->update();
            }
            // Level 6
            $headReferrer5 = User::where('referral_code', $headReferrer4?->referred_by)->first();
            if ($headReferrer5 && $headReferrer5?->level == 5) {
                $headReferrer5->wallet += 30;
                $headReferrer5->update();
                $admin->wallet += 70;
                $admin->update();
                $headReferrer5Count = User::where('referred_by', $headReferrer5?->referral_code)->where('level', 5)->count();
                if ($headReferrer5Count == $memberCount) {
                    $headReferrer5->level += 1;
                    $headReferrer5->update();
                }
            } elseif (isset($headReferrer5)) {
                $headReferrer5->wallet += 30;
                $headReferrer5->update();
                $admin->wallet += 70;
                $admin->update();
            }
            // Level 7
            $headReferrer6 = User::where('referral_code', $headReferrer5?->referred_by)->first();
            if ($headReferrer6 && $headReferrer6?->level == 6) {
                $headReferrer6->wallet += 20;
                $headReferrer6->update();
                $admin->wallet += 50;
                $admin->update();
                $headReferrer6Count = User::where('referred_by', $headReferrer6?->referral_code)->where('level', 6)->count();
                if ($headReferrer6Count == $memberCount) {
                    $headReferrer6->level += 1;
                    $headReferrer6->update();
                }
            } elseif (isset($headReferrer6)) {
                $headReferrer6->wallet += 20;
                $headReferrer6->update();
                $admin->wallet += 50;
                $admin->update();
            }
            // Level 8
            $headReferrer7 = User::where('referral_code', $headReferrer6?->referred_by)->first();
            if ($headReferrer7 && $headReferrer7?->level == 7) {
                $headReferrer7->wallet += 10;
                $headReferrer7->update();
                $admin->wallet += 40;
                $admin->update();
                $headReferrer7Count = User::where('referred_by', $headReferrer7?->referral_code)->where('level', 7)->count();
                if ($headReferrer7Count == $memberCount) {
                    $headReferrer7->level += 1;
                    $headReferrer7->update();
                }
            } elseif (isset($headReferrer7)) {
                $headReferrer7->wallet += 10;
                $headReferrer7->update();
                $admin->wallet += 40;
                $admin->update();
            }
            // Level 9
            $headReferrer8 = User::where('referral_code', $headReferrer7?->referred_by)->first();
            if ($headReferrer8 && $headReferrer8?->level == 8) {
                $headReferrer8->wallet += 8;
                $headReferrer8->update();
                $admin->wallet += 32;
                $admin->update();
                $headReferrer8Count = User::where('referred_by', $headReferrer8?->referral_code)->where('level', 8)->count();
                if ($headReferrer8Count == $memberCount) {
                    $headReferrer8->level += 1;
                    $headReferrer8->update();
                }
            } elseif (isset($headReferrer8)) {
                $headReferrer8->wallet += 8;
                $headReferrer8->update();
                $admin->wallet += 32;
                $admin->update();
            }
            // Level 10
            $headReferrer9 = User::where('referral_code', $headReferrer8?->referred_by)->first();
            if ($headReferrer9 && $headReferrer9?->level == 9) {
                $headReferrer9->wallet += 6;
                $headReferrer9->update();
                $admin->wallet += 26;
                $admin->update();
                $headReferrer9Count = User::where('referred_by', $headReferrer9?->referral_code)->where('level', 9)->count();
                if ($headReferrer9Count == $memberCount) {
                    $headReferrer9->level += 1;
                    $headReferrer9->update();
                }
            } elseif (isset($headReferrer9)) {
                $headReferrer9->wallet += 6;
                $headReferrer9->update();
                $admin->wallet += 26;
                $admin->update();
            }
            // Level 11
            $headReferrer10 = User::where('referral_code', $headReferrer9?->referred_by)->first();
            if ($headReferrer10 && $headReferrer10?->level == 10) {
                $headReferrer10->wallet += 5;
                $headReferrer10->update();
                $admin->wallet += 21;
                $admin->update();
                $headReferrer10Count = User::where('referred_by', $headReferrer10?->referral_code)->where('level', 10)->count();
                if ($headReferrer10Count == $memberCount) {
                    $headReferrer10->level += 1;
                    $headReferrer10->update();
                }
            } elseif (isset($headReferrer10)) {
                $headReferrer10->wallet += 5;
                $headReferrer10->update();
                $admin->wallet += 21;
                $admin->update();
            }
            // Level 12
            $headReferrer11 = User::where('referral_code', $headReferrer10?->referred_by)->first();
            if ($headReferrer11 && $headReferrer11?->level == 11) {
                $headReferrer11->wallet += 4;
                $headReferrer11->update();
                $admin->wallet += 17;
                $admin->update();
                $headReferrer11Count = User::where('referred_by', $headReferrer11?->referral_code)->where('level', 11)->count();
                if ($headReferrer11Count == $memberCount) {
                    $headReferrer11->level += 1;
                    $headReferrer11->update();
                }
            } elseif (isset($headReferrer11)) {
                $headReferrer11->wallet += 4;
                $headReferrer11->update();
                $admin->wallet += 17;
                $admin->update();
            }
            // Level 13
            $headReferrer12 = User::where('referral_code', $headReferrer11?->referred_by)->first();
            if ($headReferrer12 && $headReferrer12?->level == 12) {
                $headReferrer12->wallet += 3;
                $headReferrer12->update();
                $admin->wallet += 14;
                $admin->update();
                $headReferrer12Count = User::where('referred_by', $headReferrer12?->referral_code)->where('level', 12)->count();
                if ($headReferrer12Count == $memberCount) {
                    $headReferrer12->level += 1;
                    $headReferrer12->update();
                }
            } elseif (isset($headReferrer12)) {
                $headReferrer12->wallet += 3;
                $headReferrer12->update();
                $admin->wallet += 14;
                $admin->update();
            }
            // Level 14
            $headReferrer13 = User::where('referral_code', $headReferrer12?->referred_by)->first();
            if ($headReferrer13 && $headReferrer13?->level == 13) {
                $headReferrer13->wallet += 2;
                $headReferrer13->update();
                $admin->wallet += 12;
                $admin->update();
                $headReferrer13Count = User::where('referred_by', $headReferrer13?->referral_code)->where('level', 13)->count();
                if ($headReferrer13Count == $memberCount) {
                    $headReferrer13->level += 1;
                    $headReferrer13->update();
                }
            } elseif (isset($headReferrer13)) {
                $headReferrer13->wallet += 2;
                $headReferrer13->update();
                $admin->wallet += 12;
                $admin->update();
            }
            // Level 15
            $headReferrer14 = User::where('referral_code', $headReferrer13?->referred_by)->first();
            if ($headReferrer14 && $headReferrer14?->level == 14) {
                $headReferrer14->wallet += 0;
                $headReferrer14->update();
                $admin->wallet += 0;
                $admin->update();
                $headReferrer14Count = User::where('referred_by', $headReferrer14?->referral_code)->where('level', 14)->count();
                if ($headReferrer14Count == $memberCount) {
                    $headReferrer14->level += 1;
                    $headReferrer14->update();
                }
            } elseif (isset($headReferrer13)) {
                $headReferrer13->wallet += 0;
                $headReferrer13->update();
                $admin->wallet += 0;
                $admin->update();
            }
        }
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
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //dd($request->all());
        if($request->password == null || $request->password == ''){
            $user->password = '12345678';
            $user->save();
        }
        else{
            $user->password = $request->password;
            $user->save();
        }
        $user->update($request->validated());
        return to_route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

    public function walletTransfer(WalletTransferRequest $request, User $user)
    {
        $validator = $request->validated();
        if ($validator['method'] == 'add') {
            $user->wallet += $validator['amount'];
            $user->update();
            TransactionHistory::create([
                'user_id' => $user->id,
                'amount' => $validator['amount'],
                'notes' => $validator['notes'],
                'method' => $validator['method']
            ]);
        } else {
            $user->wallet -= $validator['amount'];
            $user->update();
            TransactionHistory::create([
                'user_id' => $user->id,
                'amount' => $validator['amount'],
                'notes' => $validator['notes'],
                'method' => $validator['method']
            ]);
        }
        return back();
    }
}
