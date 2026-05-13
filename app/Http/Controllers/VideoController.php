<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // Halaman Dashboard Customer
    public function index() {
        $user = Auth::user();
        $videos = Video::all();
        // dd($videos);
        return view('dashboard', compact('videos'));
    }

    // Fungsi minta izin nonton
    public function requestAccess($id) {
        $permissions = Permission::where('user_id', Auth::id())->where('video_id', $id)->first();
        if($permissions && $permissions->status === 'pending') {
            return back()->with('error', 'Permintaan akses untuk video ini sedang diproses!');
        }
        if ($permissions->expires_at > now()) {
            return back()->with('success', 'Anda masih memiliki akses untuk video ini!');
        }
        Permission::create([
            'user_id' => Auth::id(),
            'video_id' => $id,
            'status' => 'pending'
        ]);
        return back()->with('success', 'Permintaan akses terkirim!');
    }

    // Fungsi memutar video (dengan proteksi waktu)
    public function watch($id) {
        $access = Permission::where('user_id', Auth::id())
            ->where('video_id', $id)
            ->where('status', 'approved')
            ->where('expires_at', '>', now()) // Proteksi: Jika waktu habis, akses tertutup
            ->first();

        if (!$access) {
            return redirect('/dashboard')->with('error', 'Akses ditolak atau durasi nonton sudah habis!');
        }

        $video = Video::find($id);
        return view('watch', compact('video'));
    }
}