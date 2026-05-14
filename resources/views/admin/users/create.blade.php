<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah User Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 @error('name') border-red-500 @enderror" 
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 @error('email') border-red-500 @enderror" 
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input 
                            type="password" 
                            name="password"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 @error('password') border-red-500 @enderror" 
                            required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <input 
                            type="password" 
                            name="password_confirmation"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" 
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select 
                            name="role"
                            class="w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 @error('role') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Role --</option>
                            <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md shadow hover:bg-blue-700 transition">
                            Simpan
                        </button>
                        <a 
                            href="{{ route('admin.users.index') }}" 
                            class="bg-gray-400 text-white px-6 py-2 rounded-md shadow hover:bg-gray-500 transition">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
