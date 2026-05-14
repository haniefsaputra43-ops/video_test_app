<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Video - {{ $video->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.video.update', $video->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Video</label>
                        <input 
                            type="text" 
                            name="judul" 
                            value="{{ old('judul', $video->judul) }}"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 @error('judul') border-red-500 @enderror" 
                            required>
                        @error('judul')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Video Saat Ini</label>
                        <p class="text-sm text-gray-600 mb-3">
                            <a href="{{ asset('storage/' . $video->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ basename($video->file_path) }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ganti File Video (Opsional)</label>
                        <input 
                            type="file" 
                            name="video_file" 
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 @error('video_file') border-red-500 @enderror" 
                            accept="video/mp4,video/quicktime,video/x-msvideo">
                        <p class="text-xs text-gray-500 mt-1">Format: MP4, MOV, AVI | Maksimal: 20MB</p>
                        @error('video_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md shadow hover:bg-blue-700 transition">
                            Simpan Perubahan
                        </button>
                        <a 
                            href="{{ route('admin.video') }}" 
                            class="bg-gray-400 text-white px-6 py-2 rounded-md shadow hover:bg-gray-500 transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
