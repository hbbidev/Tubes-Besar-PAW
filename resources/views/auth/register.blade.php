@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="flex justify-center items-center py-10">
    <div class="glass-panel p-8 rounded-xl w-full max-w-md shadow-2xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Buat Akun Baru</h2>
            <p class="text-gray-400 text-sm mt-2">Gabung sekarang untuk topup lebih mudah</p>
        </div>
        
        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf
            
            <!-- Nama Lengkap -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fas fa-user"></i></span>
                    <input type="text" name="name" class="w-full bg-gray-800/10 border border-slate-400 rounded-lg py-3 pl-10 pr-4 text-white focus:border-purple-500 focus:outline-none transition" placeholder="John Doe" required>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="w-full bg-gray-800/10 border border-slate-400 rounded-lg py-3 pl-10 pr-4 text-white focus:border-purple-500 focus:outline-none transition" placeholder="nama@email.com" required>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="w-full bg-gray-800/10 border border-slate-400 rounded-lg py-3 pl-10 pr-4 text-white focus:border-purple-500 focus:outline-none transition" placeholder="Minimal 8 karakter" required>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400"><i class="fas fa-check-circle"></i></span>
                    <input type="password" name="password_confirmation" class="w-full bg-gray-800/10 border border-slate-400 rounded-lg py-3 pl-10 pr-4 text-white focus:border-purple-500 focus:outline-none transition" placeholder="Ulangi password" required>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 text-sm p-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="w-full bg-violet-600 hover:bg-violet-500 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:scale-[1.02]">
                Daftar Sekarang
            </button>
            
            <p class="text-center text-sm text-gray-500 mt-4">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-violet-400 hover:text-violet-300 font-bold">Login disini</a>
            </p>
        </form>
    </div>
</div>
@endsection