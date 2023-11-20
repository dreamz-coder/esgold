<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Epin\StoreEpinRequest;
use App\Models\Epin;
use App\Models\User;
use Illuminate\Http\Request;

class EpinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $epins = Epin::with('user')->latest()->get();
        return view('admin.epin.index', ['epins' => $epins]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();
        return view('admin.epin.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEpinRequest $request)
    {
        $validatedData = $request->validated();
        $count = $validatedData['count'];
        $userId = $validatedData['user_id'];

        for ($i = 0; $i < $count; $i++) {
            // Generate a unique PIN code
            $uniqueIdentifier = uniqid(); // Generate a unique identifier
            $epinCode = 'EPIN#' . $uniqueIdentifier;
            Epin::create([
                'user_id' => $userId,
                'epin' => $epinCode,
            ]);
        }
        return to_route('admin.epin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Epin $epin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Epin $epin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Epin $epin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Epin $epin)
    {
        //
    }
}
