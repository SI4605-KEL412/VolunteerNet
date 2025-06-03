<?php

namespace App\Http\Controllers;

use App\Models\manageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class manageUserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $katakunci = $request->input('katakunci');
        $roleFilter = $request->input('role_filter');

        $query = manageUser::query();

        // Search
        if ($katakunci) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('name', 'LIKE', "%{$katakunci}%")
                    ->orWhere('email', 'LIKE', "%{$katakunci}%");
            });
        }

        // Filter Role
        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        $users = $query->paginate(10);

        // Decode profiledetails into liked_portfolios array
        foreach ($users as $user) {
            $details = json_decode($user->profiledetails, true);
            $user->liked_portfolios = $details['liked_portfolios'] ?? [];
        }

        return view('manageusers.index', compact('users', 'katakunci', 'roleFilter'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('manageusers.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user,editor',
            'profiledetails' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = manageUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profiledetails' => $request->profiledetails,
        ]);

        return redirect()->route('manageusers.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified user
     */
    public function show($id)
    {
        $user = manageUser::findOrFail($id);

        // Decode profile details
        $details = json_decode($user->profiledetails, true);
        $user->liked_portfolios = $details['liked_portfolios'] ?? [];

        return view('manageusers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit($id)
    {
        $user = manageUser::findOrFail($id);
        return view('manageusers.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     */
    public function update(Request $request, $id)
    {
        $user = manageUser::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),
            ],
            'role' => 'required|in:admin,user,editor',
            'profiledetails' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'profiledetails' => $request->profiledetails,
            'updated_at' => now(),
        ];

        $user->update($userData);

        $updatedUserIds = Session::get('updated_user_ids', []);
        if (!in_array($user->user_id, $updatedUserIds)) {
            $updatedUserIds[] = $user->user_id;
        }
        Session::put('updated_user_ids', $updatedUserIds);

        return redirect()->route('manageusers.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy($id)
    {
        $user = manageUser::findOrFail($id);

        // Hapus notifikasi jika ada
        if (Schema::hasTable('notification')) {
            DB::table('notification')->where('user_id', $id)->delete();
        }

        // Hapus semua referensi user ini di tabel referralprogram
        if (Schema::hasTable('referralprogram')) {
            DB::table('referralprogram')->where('referrer_id', $id)->delete();
            DB::table('referralprogram')->where('referred_user_id', $id)->delete();
        }

        $user->delete();

        return redirect()->route('manageusers.index')
            ->with('success', 'User dan data terkait berhasil dihapus.');
    }

}
