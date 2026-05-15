<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        {{-- Header dengan efek glass --}}
        <div class="mb-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl shadow-slate-200/50 border border-white/50 p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-black bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent tracking-tight">Employee Directory</h1>
                    <p class="mt-1 text-sm text-slate-500">Manage employee records, assignments & compensation</p>
                </div>
                <div class="mt-3 sm:mt-0">
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-600/20">✨ Total: {{ $employees->count() }} employees</span>
                </div>
            </div>
        </div>

        {{-- Error Messages --}}
        @foreach ($errors->all() as $error)
            <div class="mb-3 animate-shake rounded-xl border-l-4 border-rose-500 bg-rose-50 p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                    <span class="text-sm text-rose-700">{{ $error }}</span>
                </div>
            </div>
        @endforeach

        {{-- Success Message --}}
        @if (session('message'))
            <div class="mb-4 animate-fadeIn rounded-xl border-l-4 border-emerald-500 bg-emerald-50 p-4 shadow-sm" role="alert">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.48 4.79-1.72-1.72a.75.75 0 00-1.06 1.061l2.25 2.25a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                    <span class="text-sm font-medium text-emerald-800">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        {{-- Form Card Premium --}}
        <div class="mb-8 overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/50">
            <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-700">📋 Employee Registration</h2>
                <p class="text-xs text-slate-400">Fill in the details below</p>
            </div>
            <form wire:submit.prevent='store' class="p-6">
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="group">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">User</label>
                        <select wire:model="user_id" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm font-medium text-slate-700 transition-all focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="group">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Position</label>
                        <select wire:model='position_id' class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm font-medium text-slate-700 transition-all focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                            <option value="">-- Select Position --</option>
                            @foreach ($positions as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="group">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Salary (USD)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2.5 text-slate-400">$</span>
                            <input wire:model='salary' type="number" placeholder="0.00" class="w-full rounded-xl border-slate-200 bg-slate-50/50 pl-7 pr-4 py-2.5 text-sm font-medium text-slate-700 transition-all focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex gap-3">
                    @if ($editCheck == false)
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition-all hover:scale-[1.02] hover:from-indigo-700 hover:to-indigo-800 active:scale-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Employee
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- Update Button --}}
        @if ($editCheck == true)
            <div class="mb-4 flex justify-end">
                <button wire:click='update({{ $idEdit }})' class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/25 transition-all hover:scale-[1.02]">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Update Employee
                </button>
            </div>
        @endif

        {{-- Table Premium --}}
        <div class="overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Position</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Salary</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($employees as $item)
                            <tr class="group transition-all hover:bg-slate-50/80">
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-500">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-800">{{ $item->user->name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                    <span class="inline-flex rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700">{{ $item->position->name }}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-bold text-emerald-700">${{ number_format((float)$item->salary) }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <button wire:click='destroy({{ $item->id }})' class="inline-flex items-center gap-1 rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-600 transition-all hover:bg-rose-100 hover:shadow-md">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                        @if ($editCheck == false)
                                            <button wire:click='edit({{ $item->id }})' class="inline-flex items-center gap-1 rounded-lg bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-600 transition-all hover:bg-sky-100 hover:shadow-md">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </button>
                                        @endif
                                        @if ($editCheck == true)
                                            <button wire:click='clear()' class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 transition-all hover:bg-slate-200">Clear</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
    .animate-shake { animation: shake 0.2s ease-in-out 0s 2; }
</style>