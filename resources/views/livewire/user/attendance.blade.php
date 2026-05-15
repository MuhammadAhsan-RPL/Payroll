<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @livewireStyles()
    @livewireScripts()
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Header dengan Profile Dropdown --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                Attendance Management
            </h1>
            <p class="text-sm text-slate-500 mt-1">Track employee attendance, sick leave, and permits</p>
        </div>
        
        <div class="flex items-center gap-3">
            {{-- Profile Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-medium text-slate-500">Welcome back,</p>
                        <p class="text-sm font-semibold text-slate-700">{{ Auth::user()->name ?? Auth::user()->email }}</p>
                    </div>
                    <div class="relative">
                        <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=E0E7FF' }}" 
                            class="w-10 h-10 rounded-full ring-2 ring-indigo-500/30 shadow-sm cursor-pointer object-cover">
                        <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 rounded-full ring-2 ring-white"></div>
                    </div>
                </button>

                {{-- Dropdown Menu --}}
                <div x-show="open" @click.away="open = false" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl border border-slate-100 z-50 overflow-hidden"
                    style="display: none;">
                    <div class="py-2">
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="/logout" class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="mb-8 overflow-hidden rounded-2xl bg-white shadow-md border border-slate-100">
        <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
            <h2 class="text-lg font-semibold text-slate-700">📋 Mark Attendance</h2>
            <p class="text-xs text-slate-400">Record today's attendance status</p>
        </div>
        
        <div class="p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1 w-full sm:w-auto">
                    <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Status
                    </label>
                    <select wire:model="status" 
                        class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-700 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20 transition">
                        <option value="">-- Select status --</option>
                        <option value="present">✅ Present</option>
                        <option value="absent">❌ Absent</option>
                        <option value="sick">🤒 Sick</option>
                        <option value="permit">📝 Permission</option>
                    </select>
                </div>
                
                <div>
                    <button type="button" wire:click="save()" 
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-indigo-500/25 transition hover:scale-[1.02]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Attendance
                    </button>
                </div>
            </div>

            {{-- Success Message --}}
            @if (session('message'))
                <div class="mt-4 rounded-xl bg-emerald-50 border-l-4 border-emerald-500 p-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-emerald-800">{{ session('message') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl bg-white shadow-md border border-slate-100">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-slate-50 to-white border-b border-slate-100">
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($attendances as $attendance)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-800 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($attendance->user->name, 0, 1) }}
                                    </div>
                                    {{ $attendance->user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                @php
                                    $statusConfig = [
                                        'present' => ['bg-emerald-100', 'text-emerald-700', '✅ Hadir'],
                                        'absent' => ['bg-rose-100', 'text-rose-700', '❌ Tidak Hadir'],
                                        'sick' => ['bg-amber-100', 'text-amber-700', '🤒 Sakit'],
                                        'permit' => ['bg-sky-100', 'text-sky-700', '📝 Izin'],
                                    ];
                                    $config = $statusConfig[$attendance->status] ?? ['bg-gray-100', 'text-gray-700', $attendance->status];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full {{ $config[0] }} px-3 py-1 text-xs font-semibold {{ $config[1] }}">
                                    {{ $config[2] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="text-sm text-slate-500 font-medium">Belum ada data attendance</span>
                                    <span class="text-xs text-slate-400">Mulai catat kehadiran karyawan</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>