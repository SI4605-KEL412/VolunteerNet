<?php

namespace App\Http\Controllers;

use App\Models\manageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class manageUserController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->input('katakunci');
        $roleFilter = $request->input('role_filter');

        $query = manageUser::query();

        if ($katakunci) {
            $query->where(function ($q) use ($katakunci) {
                $q->where('name', 'LIKE', "%{$katakunci}%")
                  ->orWhere('email', 'LIKE', "%{$katakunci}%");
            });
        }

        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        $users = $query->paginate(10);

        return view('manageusers.index', compact('users', 'katakunci', 'roleFilter'));
    }

    public function create()
    {
        return view('manageusers.create');
    }

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
            'profiledetails' => $request->profiledetails, // ✅ perbaikan
        ]);

        return redirect()->route('manageusers.index')
            ->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = manageUser::findOrFail($id);
        return view('manageusers.show', compact('user'));
    }

    public function edit($id)
    {
        $user = manageUser::findOrFail($id);
        return view('manageusers.edit', compact('user'));
    }

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

    public function destroy($id)
    {
        $user = manageUser::findOrFail($id);
        $user->delete();

        return redirect()->route('manageusers.index')
            ->with('success', 'User deleted successfully');
    }
}
