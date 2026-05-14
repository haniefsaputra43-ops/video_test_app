<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman admin (Daftar video & Request dari customer)
    public function index()
    {
        $videos = Video::all();
        $requests = Permission::with(['user', 'video'])->where('status', 'pending')->get();
        return view('admin.upload', compact('videos', 'requests'));
    }

    // Fungsi Upload Video Asli
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'video_file' => 'required|mimes:mp4,mov,avi|max:20000', // Maksimal 20MB
        ]);

        $path = $request->file('video_file')->store('videos', 'public');

        Video::create([
            'judul' => $request->judul,
            'file_path' => $path
        ]);

        return back()->with('success', 'Video berhasil diupload!');
    }

    // Fungsi Menyetujui Akses dengan Batas Waktu
    public function approve(Request $request, $id)
    {
        // 1. Jalankan Validasi
        $request->validate([
            'durasi' => 'required|numeric|min:1', // Wajib diisi, harus angka, minimal 1
        ]);

        $p = Permission::find($id);

        // 2. Eksekusi Update
        $p->update([
            'status' => 'approved',
            'expires_at' => now()->addHours((int) $request->durasi),
        ]);

        return back()->with('success', 'Akses disetujui!');
    }

    public function video()
    {
        $videos = Video::all();
        return view('admin.video', compact('videos'));
    }

    // Fungsi tampil form edit video
    public function editVideo($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return redirect('/admin/video')->with('error', 'Video tidak ditemukan!');
        }

        return view('admin.edit', compact('video'));
    }

    // Fungsi update/simpan perubahan video
    public function updateVideo(Request $request, $id)
    {
        $video = Video::find($id);

        if (!$video) {
            return redirect('/admin/video')->with('error', 'Video tidak ditemukan!');
        }

        $request->validate([
            'judul' => 'required',
            'video_file' => 'nullable|mimes:mp4,mov,avi|max:20000', // Maksimal 20MB
        ]);

        $video->judul = $request->judul;

        // Jika ada file video baru, update file_path
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $video->file_path = $path;
        }

        $video->save();

        return back()->with('success', 'Video berhasil diperbarui!');
    }
}
