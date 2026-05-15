<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Enterprise Login | HR Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                }
            }
        }
    </script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 font-sans">

    <div class="flex min-h-full flex-col justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-12 relative overflow-hidden">

        {{-- Animated Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 h-60 w-60 sm:h-80 sm:w-80 rounded-full bg-indigo-500/20 blur-3xl animate-float">
            </div>
            <div class="absolute -bottom-40 -left-40 h-72 w-72 sm:h-96 sm:w-96 rounded-full bg-purple-500/20 blur-3xl animate-float"
                style="animation-delay: -3s;"></div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-48 w-48 sm:h-64 sm:w-64 rounded-full bg-emerald-500/10 blur-3xl">
            </div>
        </div>

        {{-- Main Content --}}
        <div class="relative z-10 animate-fadeInUp w-full max-w-md mx-auto">

            {{-- Logo & Title --}}
            <div class="text-center">
                <div class="flex justify-center">
                    <div
                        class="h-14 w-14 sm:h-16 sm:w-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-2xl shadow-indigo-500/30 animate-float">
                        <svg class="h-7 w-7 sm:h-8 sm:w-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <h2 class="mt-6 sm:mt-8 text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Welcome back
                </h2>
                <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-slate-400">
                    Sign in to your enterprise dashboard
                </p>
            </div>

            {{-- Error Messages --}}
            @if ($errors->any())
            <div class="mt-6 space-y-2">
                @foreach ($errors->all() as $error)
                <div class="rounded-xl border-l-4 border-rose-500 bg-rose-500/10 backdrop-blur-sm p-3 sm:p-4 shadow-lg">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-rose-400 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-xs sm:text-sm text-rose-300">{{ $error }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- Notifikasi Error dari session (untuk login gagal) --}}
            @if (session('error'))
            <div
                class="mt-4 rounded-xl border-l-4 border-rose-500 bg-rose-500/10 backdrop-blur-sm p-3 sm:p-4 shadow-lg animate-fadeInUp">
                <div class="flex items-center gap-2 sm:gap-3">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-rose-400 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="text-xs sm:text-sm text-rose-300">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            {{-- Notifikasi Sukses (misal logout) --}}
            @if (session('success'))
            <div
                class="mt-4 rounded-xl border-l-4 border-emerald-500 bg-emerald-500/10 backdrop-blur-sm p-3 sm:p-4 shadow-lg animate-fadeInUp">
                <div class="flex items-center gap-2 sm:gap-3">
                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-emerald-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xs sm:text-sm text-emerald-300">{{ session('success') }}</span>
                </div>
            </div>
            @endif

            {{-- Success Message (misal logout) --}}
            @if (session('success'))
            <div class="mt-6">
                <div
                    class="rounded-xl border-l-4 border-emerald-500 bg-emerald-500/10 backdrop-blur-sm p-3 sm:p-4 shadow-lg">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-emerald-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs sm:text-sm text-emerald-300">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Login Form --}}
            <div class="mt-6 sm:mt-8">
                <div class="glass-card rounded-xl sm:rounded-2xl p-6 sm:p-8 shadow-2xl transition-all duration-300">
                    <form action="{{ route('action.login') }}" method="POST" class="space-y-5 sm:space-y-6">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-xs sm:text-sm font-semibold text-slate-300">Email
                                address</label>
                            <div class="mt-1 sm:mt-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-slate-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autocomplete="email"
                                        class="block w-full rounded-xl bg-white/5 border-0 px-9 sm:px-10 py-2.5 sm:py-3 text-sm sm:text-base text-white placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:bg-white/10 transition-all"
                                        placeholder="admin@company.com">
                                </div>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="block text-xs sm:text-sm font-semibold text-slate-300">Password</label>
                                <div class="text-xs sm:text-sm">
                                    <a href="#"
                                        class="font-medium text-indigo-400 hover:text-indigo-300 transition-colors duration-200">Forgot
                                        password?</a>
                                </div>
                            </div>
                            <div class="mt-1 sm:mt-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-slate-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input id="password" type="password" name="password" required
                                        autocomplete="current-password"
                                        class="block w-full rounded-xl bg-white/5 border-0 px-9 sm:px-10 py-2.5 sm:py-3 text-sm sm:text-base text-white placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500 focus:bg-white/10 transition-all"
                                        placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div>
                            <button type="submit"
                                class="group relative flex w-full justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 px-4 py-2.5 sm:py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition-all duration-300 hover:scale-[1.02] hover:shadow-indigo-500/40 focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                                <span
                                    class="absolute inset-y-0 left-0 flex items-center pl-3 transition-all duration-300 group-hover:translate-x-1">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-indigo-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                </span>
                                Sign in
                                <span
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 transition-all duration-300 group-hover:translate-x-1">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-indigo-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>

                    {{-- Divider --}}
                    <div class="relative my-6 sm:my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/10"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="bg-transparent px-2 text-slate-500">Secure enterprise access</span>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-4 sm:mt-6 text-center">
                    <div class="flex flex-wrap justify-center gap-2 sm:gap-4 text-[10px] sm:text-xs text-slate-500">
                        <span>🔒 SSL Encrypted</span>
                        <span>•</span>
                        <span>⭐ SOC 2 Compliant</span>
                        <span>•</span>
                        <span>🌍 24/7 Support</span>
                    </div>
                    <p class="mt-3 sm:mt-4 text-[10px] sm:text-xs text-slate-600">
                        &copy; {{ date('Y') }} Enterprise HR Portal. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input').forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.parentElement.classList.add('ring-2', 'ring-indigo-500/20');
        });
        input.addEventListener('blur', () => {
            input.parentElement.parentElement.classList.remove('ring-2', 'ring-indigo-500/20');
        });
    });
    </script>
</body>

</html>