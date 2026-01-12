<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // menampilkan halaman data user
    public function index(Request $request)
    {
        // arahkan ke halaman admin dengan data user
        $users = User::when($request->role, function ($query) use ($request) {
            $query->where('role', $request->role);
        })->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    // menampilkan halaman dashboard admin
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Method Menghapus User
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
