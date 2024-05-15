<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() 
    {
        $roles = [
            [
                'id' => 'admin',
                'name' => 'Admin',
            ],
            [
                'id' => 'user',
                'name' => 'User',
            ]
        ];
        $users = User::all();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:users,email',
                'password' => 'required',
                'role' => 'required'
            ],
            [
                'name.required' => 'name harus diisi!',
                'name.max' => 'name maksimal 255 karakter!',
                'email.required' => 'Email harus diisi!',
                'email.max' => 'Email maksimal 255 karakter!',
                'email.unique' => 'Email sudah terdaftar!',
                'password.required' => 'Password harus diisi!',
                'role.required' => 'Roles harus diisi!'
            ]
        );
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Tambah User!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'role' => 'required'
        ], [
            'name.required' => 'name harus diisi!',
            'name.max' => 'name maksimal 255 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.max' => 'Email maksimal 255 karakter!',
            'role.required' => 'Roles harus diisi!'
        ]);

        $user = User::where('id', $id)->first();
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ];

        if ($request->has('password') && !empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Edit User!');
        }
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Hapus User!');
        }
    }
}
