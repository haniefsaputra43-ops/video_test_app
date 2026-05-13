<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ruang Nonton: {{ $video->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="bg-black rounded-lg overflow-hidden shadow-lg">
                    <video width="100%" height="auto" controls controlsList="nodownload">
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung tag video.
                    </video>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold">{{ $video->judul }}</h3>
                        <p class="text-sm text-gray-500">Status: <span class="text-green-600 font-semibold">Akses Terbuka</span></p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition">
                        Kembali ke Katalog
                    </a>
                </div>

                <div class="mt-4 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 text-sm">
                    <strong>Catatan:</strong> Sesuai kebijakan, tombol download telah dinonaktifkan. Silakan tonton video sebelum masa berlaku akses Anda habis.
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>