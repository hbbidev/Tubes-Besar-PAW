<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KidPedia - @yield('title', 'Solusi Topup Tercepat')</title>
    <link rel="icon" href="{{ asset('logo2.png') }}" type="image/png">
    <!-- CDN Tailwind & FontAwesome (Link Bersih) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&display=swap');
        body { font-family: "Poppins", sans-serif; }
        .glass-panel {
            background: rgba(61, 61, 61, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.34);
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-black-800 border-b border-slate-700 backdrop-blur-2xl sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <!-- <div class="container mx-auto px-4 py-3 flex justify-between items-center"> -->
            <!-- LOGO WEBSITE -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('logo2.png') }}" alt="Logo" class="relative w-14 transition object-cover">
                    <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-wider leading-none ">KID<span class="text-violet-400">Pedia</span></span>
                    <span class="text-[10px] text-white tracking-widest uppercase">Game Store</span>
                </div>

            </a>
            
            <!-- Menu Login / User -->
            @auth
                <!-- Jika Sudah Login -->
                <div class="relative group">
                    <button class="flex items-center space-x-2 bg-slate-500/10 hover:bg-slate-500/20 border border-gray-700 px-4 py-2 rounded-lg transition">
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <!-- Dropdown Menu -->
                     <div class="absolute right-0 top-full pt-0 w-48 hidden group-hover:block z-50">
                    <div class="absolute right-0 mt-0 w-48 bg-slate-500/10 rounded-lg shadow-xl border border-slate-700 hidden group-hover:block z-50">
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-slate-500/30 backdrop-blur-2xl">Dashboard Admin</a>
                        @else
                            <a href="{{ route('member.dashboard') }}" class="block px-4 py-2 hover:bg-slate-500/30 backdrop-blur-2xl">Dashboard Saya</a>
                        @endif
                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-600 rounded-b-lg text-red-600 hover:text-white backdrop-blur-2xl">Logout</button>
                        </form>
                    </div>
    </div>

                </div>
            @else
                <!-- Jika Belum Login -->
                <a href="{{ route('login') }}" class="bg-violet-700 hover:bg-violet-600 px-4 py-2 rounded-lg text-sm font-semibold transition">
                    Masuk / Daftar
                </a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 relative">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black-100 border-t border-slate-800 mt-12 py-2">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Kelompok 5 All rights reserved.</p>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>