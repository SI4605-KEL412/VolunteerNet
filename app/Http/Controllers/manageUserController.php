<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\manageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;
        $roleFilter = $request->role_filter;
        $statusFilter = $request->status_filter;

        $query = manageUser::query();

        if (strlen($katakunci)) {
            $query->where(function($q) use ($katakunci) {
                $q->where('name', 'like', "%$katakunci%")
                ->orWhere('email', 'like', "%$katakunci%")
                ->orWhere('phone', 'like', "%$katakunci%");
            });
        }

        if ($roleFilter && in_array($roleFilter, ['volunteer'])) {
            $query->where('role', $roleFilter);
        }

        if ($statusFilter && in_array($statusFilter, ['active', 'inactive', 'banned'])) {
            $query->where('status', $statusFilter);
        }

        $data = $query->orderBy('name', 'asc')->paginate($jumlahbaris);

        return view('manageUser.index')->with([
            'data' => $data,
            'katakunci' => $katakunci,
            'roleFilter' => $roleFilter,
            'statusFilter' => $statusFilter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manageUser.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:manageUser',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in([ 'volunteer'])],
            'skills' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'status' => ['nullable', Rule::in(['active', 'inactive', 'banned'])],
        ]);

        $user = manageUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'skills' => $request->skills ? explode(',', $request->skills) : null,
            'phone' => $request->phone,
            'status' => $request->status ?? 'active',
        ]);

        return redirect()->route('manageUser.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = manageUser::findOrFail($id);
        return view('manageUser.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = manageUser::findOrFail($id);
        return view('manageUser.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('manageUser')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(['volunteer'])],
            'skills' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'status' => ['required', Rule::in(['active', 'inactive', 'banned'])],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'skills' => $request->skills ? explode(',', $request->skills) : null,
            'phone' => $request->phone,
            'status' => $request->status,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        manageUser::where('id', $id)->update($data);

        return redirect()->route('manageUser.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        manageUser::where('id', $id)->delete();
        return redirect()->route('manageUser.index')->with('success', 'User deleted successfully.');
    }


}
