<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%'.request('search').'%')
                      ->orWhere('email', 'like', '%'.request('search').'%');
            })
            ->paginate(10);

        return view('users.index', [
            'users' => $users,
            'i' => ($users->currentPage() - 1) * $users->perPage()
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,manager',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('users.index')
                ->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Error creating user: '.$e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,manager',
        ]);

        try {
            $user = User::findOrFail($id);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Error updating user: '.$e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Error deleting user: '.$e->getMessage());
        }
    }

    public function cetak_pdf()
    {
    	$users = User::all();
 
    	$pdf = PDF::loadview('users.pdf',['users'=>$users]);
    	return $pdf->stream('users-pdf');
    }
}