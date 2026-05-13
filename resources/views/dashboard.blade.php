<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Katalog Video Mediatama
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($videos as $video)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-4">{{ $video->judul }}</h3>
                    </div>
                    <div class="space-y-2">
                        <form action="{{ route('request.access', $video->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Minta Akses Nonton
                            </button>
                        </form>
                        <a href="{{ route('video.watch', $video->id) }}" class="block text-center w-full bg-gray-800 hover:bg-black text-white font-bold py-2 px-4 rounded">
                            Masuk Ruang Nonton
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>