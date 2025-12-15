<!-- Chosen Palette: Cyberpunk Gaming (Slate-900 Background, Blue-500 & Purple-500 Accents) -->

<!-- Application Structure Plan: 1. Hero Section: Captures the essence of the project with a high-impact intro, mimicking the "Modern Landing Page" feature of the project itself. 2. Feature Explorer (Interactive Tabs): Splits the complex feature list into "User Experience" and "Admin Capabilities" for easier digestion. Users can toggle between views. 3. Tech Stack Grid: Visualizes the technologies used (Laravel, MySQL, etc.) as cards. 4. Admin Dashboard Simulation (Chart.js): Visualizes the "Dashboard Statistik" feature mentioned in the report using a dynamic chart to show dummy income/transaction data. 5. Interactive Installation Wizard: Transforms the linear installation instructions into a step-by-step wizard to reduce cognitive load. Users focus on one command at a time. 6. Demo Access Hub: A dedicated section for copying demo credentials easily. This structure is chosen to turn a static technical document into an engaging product tour. -->

<!-- Visualization & Content Choices: * Admin Stats (Report: 'Dashboard Statistik'): Goal: Visualize admin capabilities. Method: Chart.js Line Chart. Interaction: Hover to see data points. Justification: Shows what the admin dashboard actually looks/feels like. * Installation Guide (Report: 'Panduan Instalasi'): Goal: Instruction. Method: Step-by-Step Wizard (JS-controlled visibility). Interaction: Next/Previous buttons, Copy Code buttons. Justification: Prevents wall-of-text fatigue. * Feature List (Report: 'Fitur Utama'): Goal: Inform. Method: Interactive Tabs. Interaction: Click to switch content. Justification: Organizes distinct user roles (Public vs Admin) cleanly. * Icons: FontAwesome (via CDN) to represent features visually without SVGs. -->

<!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

<!DOCTYPE html>

<html lang="en" class="scroll-smooth"> <head> <meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>GamerTopup - Project Documentation Explorer</title> <script src="https://cdn.tailwindcss.com"></script> <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <style> /* Custom Scrollbar */ ::-webkit-scrollbar { width: 8px; } ::-webkit-scrollbar-track { background: #0f172a; } ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 4px; } ::-webkit-scrollbar-thumb:hover { background: #60a5fa; }

    .glass-panel {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .code-block {
        font-family: 'Courier New', Courier, monospace;
    }

    .step-active {
        border-color: #3b82f6;
        color: #3b82f6;
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head> <body class="bg-slate-950 text-slate-200 font-sans antialiased selection:bg-purple-500 selection:text-white">

<!-- Navigation -->
<nav class="fixed w-full z-50 glass-panel border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-gamepad text-blue-500 text-2xl"></i>
                <span class="font-bold text-xl tracking-tight text-white">Gamer<span class="text-blue-500">Topup</span> Docs</span>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="#overview" class="hover:bg-slate-800 px-3 py-2 rounded-md text-sm font-medium transition-colors">Overview</a>
                    <a href="#features" class="hover:bg-slate-800 px-3 py-2 rounded-md text-sm font-medium transition-colors">Features</a>
                    <a href="#tech-stack" class="hover:bg-slate-800 px-3 py-2 rounded-md text-sm font-medium transition-colors">Tech Stack</a>
                    <a href="#installation" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">Install Now</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="overview" class="pt-32 pb-20 px-4 relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 opacity-20 pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-purple-600 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-20 right-20 w-72 h-72 bg-blue-600 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
    </div>

    <div class="max-w-7xl mx-auto text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-blue-400 text-xs font-semibold mb-6">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            Open Source Laravel Project
        </div>
        <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6">
            Automated Game <br />
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">Topup Platform</span>
        </h1>
        <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400">
            A robust Laravel web application featuring automated transactions via Midtrans, a dynamic admin panel, and a modern responsive interface.
        </p>
        
        <div class="mt-10 flex justify-center gap-4">
            <a href="#demo" class="px-8 py-3 rounded-lg bg-white text-slate-900 font-bold hover:bg-slate-200 transition-all flex items-center gap-2">
                <i class="fa-solid fa-user-secret"></i> Get Demo Accounts
            </a>
            <a href="#features" class="px-8 py-3 rounded-lg glass-panel hover:bg-slate-800 transition-all flex items-center gap-2">
                Explore Features <i class="fa-solid fa-arrow-down"></i>
            </a>
        </div>
    </div>
</section>

<!-- Features Section (Interactive Tabs) -->
<section id="features" class="py-20 bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-4">Core Capabilities</h2>
            <p class="text-slate-400">Discover what GamerTopup offers for both users and administrators.</p>
        </div>

        <!-- Tab Controls -->
        <div class="flex justify-center mb-8">
            <div class="bg-slate-800 p-1 rounded-lg inline-flex">
                <button onclick="switchTab('user')" id="btn-user" class="px-6 py-2 rounded-md text-sm font-medium transition-all bg-blue-600 text-white shadow-lg">
                    <i class="fa-solid fa-users mr-2"></i> Public & Member
                </button>
                <button onclick="switchTab('admin')" id="btn-admin" class="px-6 py-2 rounded-md text-sm font-medium transition-all text-slate-400 hover:text-white">
                    <i class="fa-solid fa-shield-halved mr-2"></i> Admin Panel
                </button>
            </div>
        </div>

        <!-- User Content -->
        <div id="content-user" class="grid grid-cols-1 md:grid-cols-2 gap-8 fade-in">
            <div class="glass-panel p-8 rounded-2xl border-l-4 border-blue-500">
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center mb-6">
                    <i class="fa-solid fa-rocket text-blue-400 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Modern User Experience</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <div>
                            <strong class="text-slate-200">Landing Page Modern:</strong>
                            <p class="text-sm text-slate-400">Responsive design with Tailwind CSS, hero sliders, and smooth animations.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <div>
                            <strong class="text-slate-200">Real-time Search:</strong>
                            <p class="text-sm text-slate-400">Instantly find games from the catalog.</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="glass-panel p-8 rounded-2xl border-l-4 border-purple-500">
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-6">
                    <i class="fa-solid fa-credit-card text-purple-400 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-4">Seamless Transactions</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <div>
                            <strong class="text-slate-200">Midtrans Integration:</strong>
                            <p class="text-sm text-slate-400">Support for QRIS, E-Wallet, and Virtual Accounts via Midtrans Snap popup.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <div>
                            <strong class="text-slate-200">Member Dashboard:</strong>
                            <p class="text-sm text-slate-400">Track purchase history and real-time payment status (Pending, Success, Failed).</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Admin Content (Hidden by default) -->
        <div id="content-admin" class="hidden grid grid-cols-1 lg:grid-cols-3 gap-8 fade-in">
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-panel p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-white mb-4"><i class="fa-solid fa-gamepad text-blue-500 mr-2"></i> Game Management</h3>
                    <p class="text-sm text-slate-400 mb-4">Full CRUD capabilities for the game catalog.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="bg-slate-800 px-2 py-1 rounded text-xs">Add Games</span>
                        <span class="bg-slate-800 px-2 py-1 rounded text-xs">Edit Prices</span>
                        <span class="bg-slate-800 px-2 py-1 rounded text-xs">Manage Items</span>
                    </div>
                </div>
                <div class="glass-panel p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-white mb-4"><i class="fa-solid fa-money-bill-transfer text-green-500 mr-2"></i> Transactions</h3>
                    <p class="text-sm text-slate-400">Monitor incoming payments and manually update status if needed.</p>
                </div>
            </div>

            <!-- Visualization of "Dashboard Statistik" feature -->
            <div class="lg:col-span-2 glass-panel p-6 rounded-2xl flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-white">Admin Dashboard Preview</h3>
                    <span class="text-xs bg-blue-900 text-blue-200 px-2 py-1 rounded">Live Viz</span>
                </div>
                <p class="text-sm text-slate-400 mb-4">Visualize revenue streams and transaction volume directly from the admin panel.</p>
                
                <!-- Chart Container -->
                <div class="chart-container relative flex-grow w-full h-64">
                    <canvas id="adminChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tech Stack Grid -->
<section id="tech-stack" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-4">Built With</h2>
            <div class="h-1 w-20 bg-blue-500 mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            <!-- Tech Items -->
            <div class="glass-panel p-6 rounded-xl text-center hover:bg-slate-800 transition group">
                <i class="fa-brands fa-laravel text-4xl text-red-500 mb-3 group-hover:scale-110 transition"></i>
                <h4 class="font-bold text-white">Laravel</h4>
                <span class="text-xs text-slate-500">v10 / 11</span>
            </div>
            <div class="glass-panel p-6 rounded-xl text-center hover:bg-slate-800 transition group">
                <i class="fa-brands fa-php text-4xl text-indigo-400 mb-3 group-hover:scale-110 transition"></i>
                <h4 class="font-bold text-white">PHP</h4>
                <span class="text-xs text-slate-500">v8.1+</span>
            </div>
            <div class="glass-panel p-6 rounded-xl text-center hover:bg-slate-800 transition group">
                <i class="fa-solid fa-database text-4xl text-orange-400 mb-3 group-hover:scale-110 transition"></i>
                <h4 class="font-bold text-white">MySQL</h4>
                <span class="text-xs text-slate-500">Database</span>
            </div>
            <div class="glass-panel p-6 rounded-xl text-center hover:bg-slate-800 transition group">
                <i class="fa-brands fa-css3-alt text-4xl text-cyan-400 mb-3 group-hover:scale-110 transition"></i>
                <h4 class="font-bold text-white">Tailwind</h4>
                <span class="text-xs text-slate-500">Styling</span>
            </div>
            <div class="glass-panel p-6 rounded-xl text-center hover:bg-slate-800 transition group">
                <i class="fa-solid fa-credit-card text-4xl text-blue-400 mb-3 group-hover:scale-110 transition"></i>
                <h4 class="font-bold text-white">Midtrans</h4>
                <span class="text-xs text-slate-500">Payment</span>
            </div>
            <div class="glass-panel p-6 rounded-xl text-center hover:bg-slate-800 transition group">
                <i class="fa-brands fa-git-alt text-4xl text-orange-600 mb-3 group-hover:scale-110 transition"></i>
                <h4 class="font-bold text-white">Git</h4>
                <span class="text-xs text-slate-500">Version Control</span>
            </div>
        </div>
    </div>
</section>

<!-- Installation Wizard -->
<section id="installation" class="py-20 bg-slate-900/50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-4">Installation Wizard</h2>
            <p class="text-slate-400">Follow these steps to deploy GamerTopup on your local machine.</p>
        </div>

        <!-- Wizard Progress -->
        <div class="flex justify-between items-center mb-10 relative">
            <div class="absolute top-1/2 left-0 w-full h-1 bg-slate-800 -z-10"></div>
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-white step-dot" data-step="1">1</div>
            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center font-bold text-slate-400 step-dot" data-step="2">2</div>
            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center font-bold text-slate-400 step-dot" data-step="3">3</div>
            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center font-bold text-slate-400 step-dot" data-step="4">4</div>
            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center font-bold text-slate-400 step-dot" data-step="5">5</div>
        </div>

        <!-- Steps Content -->
        <div class="glass-panel p-8 rounded-2xl min-h-[300px] relative">
            
            <!-- Step 1: Prereqs -->
            <div class="wizard-step" id="step-1">
                <h3 class="text-xl font-bold text-white mb-4">1. Prerequisites</h3>
                <p class="text-slate-300 mb-4">Before starting, ensure you have the following installed:</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-slate-800 p-4 rounded-lg flex items-center gap-3">
                        <i class="fa-solid fa-server text-green-400"></i> XAMPP
                    </div>
                    <div class="bg-slate-800 p-4 rounded-lg flex items-center gap-3">
                        <i class="fa-solid fa-box text-yellow-400"></i> Composer
                    </div>
                    <div class="bg-slate-800 p-4 rounded-lg flex items-center gap-3">
                        <i class="fa-brands fa-git text-orange-400"></i> Git
                    </div>
                </div>
            </div>

            <!-- Step 2: Clone & Install -->
            <div class="wizard-step hidden" id="step-2">
                <h3 class="text-xl font-bold text-white mb-4">2. Clone & Install Dependencies</h3>
                <p class="text-slate-300 mb-4">Clone the repository and install required PHP libraries.</p>
                
                <div class="space-y-4">
                    <div class="bg-slate-950 p-4 rounded-lg relative group">
                        <p class="text-xs text-slate-500 mb-1">Terminal</p>
                        <code class="text-green-400 code-block text-sm">git clone [https://github.com/USERNAME_GITHUB_ANDA/gamertopup.git](https://github.com/USERNAME_GITHUB_ANDA/gamertopup.git)</code>
                        <button onclick="copyToClipboard('git clone [https://github.com/USERNAME_GITHUB_ANDA/gamertopup.git](https://github.com/USERNAME_GITHUB_ANDA/gamertopup.git)')" class="absolute top-4 right-4 text-slate-500 hover:text-white"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <div class="bg-slate-950 p-4 rounded-lg relative group">
                        <p class="text-xs text-slate-500 mb-1">Terminal</p>
                        <code class="text-green-400 code-block text-sm">cd gamertopup && composer install</code>
                        <button onclick="copyToClipboard('cd gamertopup && composer install')" class="absolute top-4 right-4 text-slate-500 hover:text-white"><i class="fa-regular fa-copy"></i></button>
                    </div>
                </div>
            </div>

            <!-- Step 3: Env Config -->
            <div class="wizard-step hidden" id="step-3">
                <h3 class="text-xl font-bold text-white mb-4">3. Environment Configuration</h3>
                <p class="text-slate-300 mb-4">Copy the environment file and configure your database & Midtrans keys.</p>
                
                <div class="bg-slate-950 p-4 rounded-lg relative mb-4">
                    <code class="text-green-400 code-block text-sm">cp .env.example .env</code>
                </div>

                <div class="bg-slate-800 p-4 rounded-lg border-l-4 border-yellow-500 text-sm">
                    <p class="text-white mb-2 font-bold">Edit your .env file:</p>
                    <pre class="text-slate-300 overflow-x-auto">
DB_DATABASE=db_gamertopup MIDTRANS_SERVER_KEY=SB-Mid-server-xxxx MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxx MIDTRANS_IS_PRODUCTION=false</pre> </div> </div>

            <!-- Step 4: Key & Migrate -->
            <div class="wizard-step hidden" id="step-4">
                <h3 class="text-xl font-bold text-white mb-4">4. Key Generation & Migration</h3>
                <p class="text-slate-300 mb-4">Generate the app key and setup the database tables with dummy data.</p>
                
                <div class="space-y-4">
                    <div class="bg-slate-950 p-4 rounded-lg relative">
                        <code class="text-green-400 code-block text-sm">php artisan key:generate</code>
                    </div>
                    <div class="bg-slate-950 p-4 rounded-lg relative">
                        <code class="text-green-400 code-block text-sm">php artisan migrate:fresh --seed</code>
                        <button onclick="copyToClipboard('php artisan migrate:fresh --seed')" class="absolute top-4 right-4 text-slate-500 hover:text-white"><i class="fa-regular fa-copy"></i></button>
                    </div>
                </div>
            </div>

            <!-- Step 5: Serve -->
            <div class="wizard-step hidden" id="step-5">
                <h3 class="text-xl font-bold text-white mb-4">5. Launch Application</h3>
                <div class="text-center py-8">
                    <div class="w-20 h-20 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                        <i class="fa-solid fa-play text-green-500 text-3xl"></i>
                    </div>
                    <div class="bg-slate-950 p-4 rounded-lg inline-block mb-4">
                        <code class="text-green-400 code-block text-sm">php artisan serve</code>
                    </div>
                    <p class="text-slate-300">Access your app at <a href="[http://127.0.0.1:8000](http://127.0.0.1:8000)" class="text-blue-400 hover:underline">[http://127.0.0.1:8000](http://127.0.0.1:8000)</a></p>
                </div>
            </div>

            <!-- Controls -->
            <div class="flex justify-between mt-8 pt-6 border-t border-slate-700">
                <button id="prevBtn" onclick="changeStep(-1)" class="px-4 py-2 rounded-lg text-slate-400 hover:text-white disabled:opacity-50" disabled>Previous</button>
                <button id="nextBtn" onclick="changeStep(1)" class="px-6 py-2 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-500">Next Step</button>
            </div>
        </div>
    </div>
</section>

<!-- Demo Accounts -->
<section id="demo" class="py-20">
    <div class="max-w-4xl mx-auto px-4">
        <div class="glass-panel p-8 rounded-2xl border border-slate-700 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">Demo Access</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700">
                    <div class="inline-block px-3 py-1 rounded-full bg-red-500/20 text-red-400 text-xs font-bold mb-4">ADMIN ROLE</div>
                    <p class="text-slate-400 text-sm mb-1">Email</p>
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <code class="text-white font-bold">admin@toko.com</code>
                        <button onclick="copyToClipboard('admin@toko.com')" class="text-slate-500 hover:text-blue-400"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <p class="text-slate-400 text-sm mb-1">Password</p>
                    <code class="text-white font-bold">password123</code>
                </div>

                <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700">
                    <div class="inline-block px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold mb-4">MEMBER ROLE</div>
                    <p class="text-slate-400 text-sm mb-1">Email</p>
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <code class="text-white font-bold">member@gmail.com</code>
                        <button onclick="copyToClipboard('member@gmail.com')" class="text-slate-500 hover:text-blue-400"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <p class="text-slate-400 text-sm mb-1">Password</p>
                    <code class="text-white font-bold">password123</code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Webhook Info -->
<section class="py-10 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-slate-900 border border-slate-800 p-6 rounded-xl">
            <h3 class="text-white font-bold mb-2"><i class="fa-solid fa-satellite-dish text-blue-500 mr-2"></i> Localhost Webhook Setup</h3>
            <p class="text-slate-400 text-sm mb-4">To receive Midtrans payment callbacks on localhost:</p>
            <code class="bg-black px-3 py-2 rounded text-green-400 text-sm block mb-2">ngrok http 8000</code>
            <p class="text-xs text-slate-500">Set Notification URL in Midtrans Dashboard to: <span class="text-slate-300">[https://your-ngrok-url.app/midtrans/callback](https://your-ngrok-url.app/midtrans/callback)</span></p>
        </div>
    </div>
</section>

<footer class="bg-slate-950 py-8 border-t border-slate-800 mt-10">
    <div class="text-center text-slate-500 text-sm">
        <p>&copy; 2025 GamerTopup Project.</p>
        <p class="mt-2">Licensed under <a href="#" class="text-blue-500 hover:underline">MIT License</a>.</p>
    </div>
</footer>

<script>
    // --- 1. Tab Switching Logic ---
    function switchTab(tab) {
        const userContent = document.getElementById('content-user');
        const adminContent = document.getElementById('content-admin');
        const btnUser = document.getElementById('btn-user');
        const btnAdmin = document.getElementById('btn-admin');

        if (tab === 'user') {
            userContent.classList.remove('hidden');
            adminContent.classList.add('hidden');
            
            btnUser.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
            btnUser.classList.remove('text-slate-400');
            
            btnAdmin.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
            btnAdmin.classList.add('text-slate-400');
        } else {
            userContent.classList.add('hidden');
            adminContent.classList.remove('hidden');
            
            btnAdmin.classList.add('bg-blue-600', 'text-white', 'shadow-lg');
            btnAdmin.classList.remove('text-slate-400');
            
            btnUser.classList.remove('bg-blue-600', 'text-white', 'shadow-lg');
            btnUser.classList.add('text-slate-400');
        }
    }

    // --- 2. Installation Wizard Logic ---
    let currentStep = 1;
    const totalSteps = 5;

    function changeStep(direction) {
        // Hide current step
        document.getElementById(`step-${currentStep}`).classList.add('hidden');
        
        // Update step number
        currentStep += direction;
        
        // Boundary checks
        if (currentStep < 1) currentStep = 1;
        if (currentStep > totalSteps) currentStep = totalSteps;
        
        // Show new step
        const newStepEl = document.getElementById(`step-${currentStep}`);
        newStepEl.classList.remove('hidden');
        newStepEl.classList.add('fade-in');

        // Update Progress Dots
        document.querySelectorAll('.step-dot').forEach((dot, index) => {
            if (index + 1 === currentStep) {
                dot.classList.add('bg-blue-600', 'text-white');
                dot.classList.remove('bg-slate-800', 'text-slate-400');
            } else if (index + 1 < currentStep) {
                dot.classList.add('bg-blue-900', 'text-blue-300'); // Completed steps
                dot.classList.remove('bg-blue-600', 'text-white', 'bg-slate-800', 'text-slate-400');
            } else {
                dot.classList.remove('bg-blue-600', 'text-white', 'bg-blue-900', 'text-blue-300');
                dot.classList.add('bg-slate-800', 'text-slate-400');
            }
        });

        // Button State
        document.getElementById('prevBtn').disabled = currentStep === 1;
        document.getElementById('nextBtn').innerText = currentStep === totalSteps ? "Finish" : "Next Step";
        if(currentStep === totalSteps) {
             document.getElementById('nextBtn').classList.replace('bg-blue-600', 'bg-green-600');
             document.getElementById('nextBtn').classList.replace('hover:bg-blue-500', 'hover:bg-green-500');
        } else {
             document.getElementById('nextBtn').classList.replace('bg-green-600', 'bg-blue-600');
             document.getElementById('nextBtn').classList.replace('hover:bg-green-500', 'hover:bg-blue-500');
        }
    }

    // --- 3. Clipboard Copy Logic ---
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }

    // --- 4. Chart.js Initialization (Admin Stats) ---
    // Ensuring chart container strictly follows styling rules
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('adminChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Total Revenue (Dummy)',
                    data: [1200000, 1900000, 3000000, 5000000, 2000000, 3000000],
                    borderColor: '#8b5cf6', // Purple-500
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Transactions',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#3b82f6', // Blue-500
                    borderWidth: 2,
                    tension: 0.4,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Critical for Tailwind container control
                plugins: {
                    legend: { labels: { color: '#94a3b8' } }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#1e293b' },
                        ticks: { color: '#94a3b8' }
                    },
                    y1: {
                        type: 'linear',
                        display: false,
                        position: 'right',
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });
    });
</script>
</body> </html>
