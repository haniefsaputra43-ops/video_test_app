<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel Admin - Kelola Video
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-10">
                    <h3 class="text-lg font-bold mb-4">Upload Video Baru</h3>
                    <form action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block">Judul Video</label>
                            <input type="text" name="judul" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block">Pilih File Video (MP4)</label>
                            <input type="file" name="video_file" class="w-full border" accept="video/*" required>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow">Simpan & Upload</button>
                    </form>
                </div>

                <hr class="mb-10">

                <div>
                    <h3 class="text-lg font-bold mb-4">Daftar Video</h3>
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Judul Video</th>
                                <th class="border p-2">Link</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                            <tr>
                                <td class="border p-2">{{ $video->judul }}</td>
                                <td class="border p-2 text-center text-sm text-gray-600">
                                    {{ basename($video->file_path) }}
                                </td>
                                <td class="border p-2 text-center space-x-2">
                                    <a href="{{ route('admin.video.edit', $video->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600 transition inline-block">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.video.delete', $video->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah yakin ingin menghapus video ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center p-4 text-gray-500">Belum ada video.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>