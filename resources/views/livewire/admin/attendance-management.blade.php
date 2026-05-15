<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1
                class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                📋 Attendance Management
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage employee attendance records
            </p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 px-4 py-3 shadow-sm">
            <p class="text-xs text-slate-400">Today</p>
            <p class="font-bold text-slate-700">{{ now()->format('d F Y') }}</p>
        </div>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if (session('message'))
    <div class="rounded-xl bg-emerald-50 border-l-4 border-emerald-500 p-4">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium text-emerald-800">{{ session('message') }}</span>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="rounded-xl bg-rose-50 border-l-4 border-rose-500 p-4">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium text-rose-800">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- STATISTICS CARDS --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-100 p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-emerald-600">{{ $stats['present'] }}</div>
            <div class="text-sm font-medium text-emerald-700">✅ Hadir</div>
            <div class="text-xs text-slate-400 mt-1">{{ $totalEmployees > 0 ? round(($stats['present'] /
                $totalEmployees) * 100) : 0 }}%</div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-rose-600">{{ $stats['absent'] }}</div>
            <div class="text-sm font-medium text-rose-700">❌ Tidak Hadir</div>
            <div class="text-xs text-slate-400 mt-1">{{ $totalEmployees > 0 ? round(($stats['absent'] / $totalEmployees)
                * 100) : 0 }}%</div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-amber-600">{{ $stats['sick'] }}</div>
            <div class="text-sm font-medium text-amber-700">🤒 Sakit</div>
            <div class="text-xs text-slate-400 mt-1">{{ $totalEmployees > 0 ? round(($stats['sick'] / $totalEmployees) *
                100) : 0 }}%</div>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-4 text-center shadow-sm">
            <div class="text-2xl font-black text-sky-600">{{ $stats['permit'] }}</div>
            <div class="text-sm font-medium text-sky-700">📝 Izin</div>
            <div class="text-xs text-slate-400 mt-1">{{ $totalEmployees > 0 ? round(($stats['permit'] / $totalEmployees)
                * 100) : 0 }}%</div>
        </div>
    </div>

    {{-- FILTERS --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">📅 Date</label>
                <input type="date" wire:model.live="selectedDate"
                    class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">🏷️ Status</label>
                <select wire:model.live="selectedStatus"
                    class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20">
                    <option value="">All Status</option>
                    <option value="present">✅ Hadir</option>
                    <option value="absent">❌ Tidak Hadir</option>
                    <option value="sick">🤒 Sakit</option>
                    <option value="permit">📝 Izin</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">🔍 Search Employee</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name..."
                        class="w-full pl-9 pr-4 py-2 rounded-xl border-slate-200 bg-slate-50 text-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20">
                </div>
            </div>
            <div class="flex items-end">
                <button wire:click="resetFilters"
                    class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-medium transition">
                    Reset Filters
                </button>
            </div>
        </div>
    </div>

    {{-- QUICK ADD ATTENDANCE --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
            <h2 class="font-semibold text-slate-800">➕ Quick Add Attendance</h2>
            <p class="text-xs text-slate-400">Add attendance for employee who doesn't have record on selected date</p>
        </div>
        <div class="overflow-x-auto p-4">
            <div class="flex flex-wrap gap-2">
                @foreach($allEmployees as $employee)
                @php
                $hasAttendance = \App\Models\Attendance::where('user_id', $employee->user_id)
                ->whereDate('date', $selectedDate)
                ->exists();
                @endphp
                @if(!$hasAttendance)
                <button wire:click="createAttendance({{ $employee->user_id }})"
                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-600 text-xs font-medium hover:bg-indigo-100 transition">
                    + {{ $employee->user->name }}
                </button>
                @endif
                @endforeach
                @if($allEmployees->every(fn($e) => \App\Models\Attendance::where('user_id',
                $e->user_id)->whereDate('date', $selectedDate)->exists()))
                <p class="text-sm text-slate-400">All employees already have attendance for this date</p>
                @endif
            </div>
        </div>
    </div>

    {{-- ATTENDANCE TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500">#</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500">Employee</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500">Date</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500">Status</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($attendances as $index => $attendance)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 text-slate-500">{{ $attendances->firstItem() + $index }}</td>
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $attendance->user->name }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ \Carbon\Carbon::parse($attendance->date)->format('d M
                            Y') }}</td>
                        <td class="px-5 py-3">
                            @if($editId == $attendance->id)
                            <select wire:model="editStatus"
                                class="rounded-xl border-slate-200 bg-slate-50 px-3 py-1 text-sm">
                                <option value="present">✅ Hadir</option>
                                <option value="absent">❌ Tidak Hadir</option>
                                <option value="sick">🤒 Sakit</option>
                                <option value="permit">📝 Izin</option>
                            </select>
                            @else
                            @php
                            $badges = [
                            'present' => 'bg-emerald-100 text-emerald-700 ✅ Hadir',
                            'absent' => 'bg-rose-100 text-rose-700 ❌ Tidak Hadir',
                            'sick' => 'bg-amber-100 text-amber-700 🤒 Sakit',
                            'permit' => 'bg-sky-100 text-sky-700 📝 Izin',
                            ];
                            $badge = $badges[$attendance->status] ?? 'bg-gray-100 text-gray-700 ❓ Unknown';
                            @endphp
                            <span
                                class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ explode(' ', $badge)[0] }} {{ explode(' ', $badge)[1] }}">
                                {{ implode(' ', array_slice(explode(' ', $badge), 2)) }}
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-3 space-x-2">
                            @if($editId == $attendance->id)
                            {{-- TOMBOL SAVE & CANCEL saat edit mode --}}
                            <button wire:click="update"
                                class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1 rounded-lg text-xs">
                                💾 Save
                            </button>
                            <button wire:click="cancel"
                                class="bg-slate-400 hover:bg-slate-500 text-white px-3 py-1 rounded-lg text-xs">
                                ❌ Cancel
                            </button>
                            @else
                            {{-- TOMBOL EDIT & DELETE saat normal mode --}}
                            <button wire:click="edit({{ $attendance->id }})"
                                class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded-lg text-xs">
                                ✏️ Edit
                            </button>
                            <button wire:click="delete({{ $attendance->id }})"
                                wire:confirm="Yakin ingin menghapus data ini?"
                                class="bg-rose-500 hover:bg-rose-600 text-white px-3 py-1 rounded-lg text-xs">
                                🗑️ Delete
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-slate-400">No attendance records found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $attendances->links() }}
        </div>
    </div>

</div>