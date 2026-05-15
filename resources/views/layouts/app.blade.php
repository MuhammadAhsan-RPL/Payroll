<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Enterprise Portal</title>
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            from: { opacity: '0', transform: 'translateY(-10px)' },
                            to: { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .nav-link {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-50 via-white to-slate-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar Premium -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white transform -translate-x-full md:translate-x-0 transition-all duration-300 ease-out z-50 shadow-2xl">

            <div class="p-5 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div
                        class="h-9 w-9 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <span class="text-lg">🚀</span>
                    </div>
                    <div>
                        <h1
                            class="text-lg font-bold tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">
                            Admin Panel</h1>
                        <p class="text-[10px] font-semibold text-slate-400 tracking-wider">ENTERPRISE PORTAL</p>
                    </div>
                </div>
            </div>

            <!-- User Profile Card di Sidebar (Dynamic) -->
            <div class="mx-3 mt-4 p-3 rounded-xl bg-white/5 border border-white/10 backdrop-blur-sm">
                <div class="flex items-center gap-3">
                    <img src="{{ Auth::user()->profile_photo ? asset('storage/profile/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=E0E7FF' }}"
                        class="w-9 h-9 rounded-full ring-2 ring-indigo-500/40 object-cover">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold truncate text-white/90">{{ Auth::user()->name ?? 'Admin User' }}
                        </p>
                        <p class="text-[10px] text-slate-400 truncate">{{ auth()->user()->fresh()->email ??
                            'admin@enterprise.com' }}</p>
                    </div>
                </div>
            </div>

            <nav class="mt-5 space-y-1 px-3">
                <a href="/admin"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">🏠</span>
                    <span>Dashboard</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>
                <a href="/user"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">👤</span>
                    <span>Users</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>
                <a href="/position"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">📋</span>
                    <span>Position</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>
                <a href="/attendance-admin"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">📊</span>
                    <span>Attendance</span>
                </a>
                <a href="/employee"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">👨‍💼</span>
                    <span>Employee</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>
                <a href="/payroll"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">💰</span>
                    <span>Payroll</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>


                <!-- MENU MY PROFILE -->
                <a href="/profile"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-all duration-200 group">
                    <span class="text-lg">⚙️</span>
                    <span>My Profile</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>

                <div class="pt-4 mt-2 border-t border-white/10"></div>
                <a href="/logout"
                    class="nav-link flex items-center gap-3 py-2.5 px-3 rounded-xl text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-200 group">
                    <span class="text-lg">🚪</span>
                    <span>Logout</span>
                    <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-xs">→</span>
                </a>
            </nav>

            <div class="absolute bottom-5 left-0 right-0 text-center">
                <p class="text-[9px] text-slate-500 tracking-wider">v2.0.0 — SOC 2 Compliant</p>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-72 overflow-hidden">

            <!-- Navbar Premium -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/60 shadow-sm sticky top-0 z-30">
                <div class="px-4 sm:px-6 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleSidebar()"
                            class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <div class="hidden sm:flex items-center gap-2 text-sm">
                            <span class="text-slate-400">/</span>
                            <span class="text-slate-600 font-medium">{{ Request::path() }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-medium text-slate-500">Welcome back,</p>
                            <p class="text-sm font-semibold text-slate-700">{{ Auth::user()->name ?? Auth::user()->email
                                }}</p>
                        </div>
                        <div class="relative">
                            <img src="{{ asset('storage/profile/' . Auth::user()->profile_photo) ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=E0E7FF' }}"
                                class="w-10 h-10 rounded-full ring-2 ring-indigo-500/30 shadow-sm object-cover">
                            <div
                                class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full ring-2 ring-white">
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="animate-fade-in">

                    <!-- Notifikasi Sukses -->
                    @if (session('message'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                        x-transition:enter="transform ease-out duration-300 transition"
                        x-transition:enter-start="translate-x-full opacity-0"
                        x-transition:enter-end="translate-x-0 opacity-100"
                        x-transition:leave="transform ease-in duration-200 transition"
                        x-transition:leave-start="translate-x-0 opacity-100"
                        x-transition:leave-end="translate-x-full opacity-0"
                        class="fixed top-5 right-5 z-50 w-full max-w-sm">
                        <div class="rounded-xl shadow-2xl bg-emerald-50 border-l-4 border-emerald-500 p-4">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm font-medium text-emerald-800">{{ session('message') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Notifikasi Error -->
                    @if ($errors->any())
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        x-transition:enter="transform ease-out duration-300 transition"
                        x-transition:enter-start="translate-x-full opacity-0"
                        x-transition:enter-end="translate-x-0 opacity-100"
                        x-transition:leave="transform ease-in duration-200 transition"
                        x-transition:leave-start="translate-x-0 opacity-100"
                        x-transition:leave-end="translate-x-full opacity-0"
                        class="fixed top-5 right-5 z-50 w-full max-w-sm">
                        <div class="rounded-xl shadow-2xl bg-rose-50 border-l-4 border-rose-500 p-4">
                            <div class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-rose-800">Validasi Gagal!</p>
                                    <p class="text-xs text-rose-700 mt-1">{{ $errors->first() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (isset($slot))
                    {{ $slot }}
                    @else
                    @yield('content')
                    @endif
                </div>
            </main>

            <footer class="border-t border-slate-200/60 bg-white/40 backdrop-blur-sm px-6 py-3 text-center">
                <p class="text-xs text-slate-400">
                    &copy; {{ date('Y') }} Enterprise HR Portal. All rights reserved.
                    <span class="hidden sm:inline">— Secure enterprise-grade platform</span>
                </p>
            </footer>
        </div>
    </div>

    <script>
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                document.getElementById('sidebar').classList.remove('-translate-x-full');
            }
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                if (!sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    </script>
    @livewireScripts
</body>

</html>