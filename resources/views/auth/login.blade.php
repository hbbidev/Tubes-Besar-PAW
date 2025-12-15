@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex justify-center mt-20 items-center h-[60vh]">
    <div class="glass-panel p-8 rounded-xl w-full max-w-md">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('logo2.png') }}" alt="Logo" class="relative w-32 mb-5 mx-auto transition object-cover">

            </a>
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Email</label>
                <input type="email" name="email" class="w-full bg-slate-50/5 border border-slate-600 rounded-xl p-2 text-white outline-violet-700" required>
            </div>
            <div>
                <label class="block text-sm mb-1">Password</label>
                <input type="password" name="password" class="w-full bg-slate-50/5 border border-slate-600 rounded-xl p-2 text-white outline-violet-700" required>
            </div>
            @if ($errors->any())
                <p class="text-red-500 text-sm">{{ $errors->first() }}</p>
            @endif
            <button type="submit" class="w-full bg-violet-700 hover:bg-violet-600 py-2 rounded font-bold rounded-xl">Login</button>
            <div class="text-center mt-6 pt-4 border-t border-slate-700">
                <p class="text-sm text-gray-400">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="inline-block mt-2 text-violet-700 hover:text-white font-bold hover:underline transition">
                    Daftar Sekarang
                </a>
            </div>
        </form>
    </div>
</div>
@endsection