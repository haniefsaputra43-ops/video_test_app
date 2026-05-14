<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  // Tampil daftar semua users
  public function index()
  {
    $users = User::all();
    return view('admin.users.index', compact('users'));
  }

  // Tampil form buat user baru
  public function create()
  {
    return view('admin.users.create');
  }

  // Simpan user baru ke database
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:6|confirmed',
      'role' => 'required|in:admin,customer',
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => $request->role,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
  }

  // Tampil form edit user
  public function edit($id)
  {
    $user = User::find($id);

    if (!$user) {
      return redirect('/admin/users')->with('error', 'User tidak ditemukan!');
    }

    return view('admin.users.edit', compact('user'));
  }

  // Update user ke database
  public function update(Request $request, $id)
  {
    $user = User::find($id);

    if (!$user) {
      return redirect('/admin/users')->with('error', 'User tidak ditemukan!');
    }

    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $id,
      'password' => 'nullable|string|min:6|confirmed',
      'role' => 'required|in:admin,customer',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
      $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui!');
  }

  // Hapus user dari database
  public function destroy($id)
  {
    $user = User::find($id);

    if (!$user) {
      return redirect('/admin/users')->with('error', 'User tidak ditemukan!');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
  }
}
