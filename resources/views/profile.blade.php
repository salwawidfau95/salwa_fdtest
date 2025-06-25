@extends('layouts.app')

@section('content')

<!-- Tombol Back -->
    <a href="{{ route('dashboard') }}"
        class="absolute top-10 left-30 flex items-center gap-1 px-4 py-2 rounded-full bg-purple-100 shadow hover:bg-purple-200 border border-purple-300 transition text-sm font-medium text-purple-700 hover:text-purple-800">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back
    </a>

<div class="max-w-3xl mx-auto mt-4 px-6">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2a5 5 0 100 10A5 5 0 0010 2zM2 18a8 8 0 0116 0H2z" />
            </svg>
            Profil Saya
        </h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Info user -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 text-gray-700 text-sm">
            <div>
                <p class="font-semibold">Nama:</p>
                <p>{{ Auth::user()->name }}</p>
            </div>
            <div>
                <p class="font-semibold">Email:</p>
                <p>{{ Auth::user()->email }}</p>
            </div>
            <div>
                <p class="font-semibold">Verifikasi:</p>
                <p>
                    @if (Auth::user()->hasVerifiedEmail())
                        <span class="text-green-600 font-medium">✔ Terverifikasi</span>
                    @else
                        <span class="text-red-600 font-medium">❌ Belum</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Form ganti password -->
        <div class="border-t pt-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 17a1 1 0 001-1v-3a1 1 0 10-2 0v3a1 1 0 001 1zm0 5a1.5 1.5 0 001.5-1.5H10.5A1.5 1.5 0 0012 22z" />
                    <path fill-rule="evenodd" d="M18 8h-1V6a5 5 0 00-10 0v2H6a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2v-9a2 2 0 00-2-2zM9 6a3 3 0 116 0v2H9V6z" clip-rule="evenodd" />
                </svg>
                Ganti Password
            </h2>

            <form action="{{ route('updatePassword') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Password Lama -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-600 mb-1">Password Lama</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password"
                            class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 px-4 py-2 pr-10"
                            required>
                        <span onclick="togglePassword('current_password', this)"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Password Baru -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 px-4 py-2 pr-10"
                            required>
                        <span onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 px-4 py-2 pr-10"
                            required>
                        <span onclick="togglePassword('password_confirmation', this)"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-medium px-6 py-2 rounded-md transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script untuk toggle password --}}
<script>
    function togglePassword(inputId, el) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            el.classList.add('text-purple-600');
        } else {
            input.type = 'password';
            el.classList.remove('text-purple-600');
        }
    }
</script>
@endsection
