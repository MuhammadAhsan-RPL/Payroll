<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl shadow-slate-200/50 border border-white/50 p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-black bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent tracking-tight">Payroll Management</h1>
                    <p class="mt-1 text-sm text-slate-500">Process salaries, allowances & deductions</p>
                </div>
                <div class="mt-3 sm:mt-0">
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-600/20">💰 Total Payroll: {{ $payrolls->count() }}</span>
                </div>
            </div>
        </div>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="mb-3 rounded-xl border-l-4 border-rose-500 bg-rose-50 p-4 shadow-sm">
                    <p class="text-sm text-rose-700 ml-5">{{ $error }}</p>
                </div>
            @endforeach
        @endif

        @if (session('message'))
            <div class="mb-4 animate-fadeIn rounded-xl border-l-4 border-emerald-500 bg-emerald-50 p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.48 4.79-1.72-1.72a.75.75 0 00-1.06 1.061l2.25 2.25a.75.75 0 001.137-.089l4-5.5z"/></svg>
                    <span class="text-sm font-medium text-emerald-800">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        <div class="mb-8 overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/50">
            <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-700">📊 Payroll Entry</h2>
            </div>
            <form wire:submit.prevent='store' class="p-6">
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Employee</label>
                        <select wire:model="employee_id" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                            <option value="">-- Select Employee --</option>
                            @foreach ($employees as $item)
                                <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Period</label>
                        <input type="date" wire:model='period' class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Allowance (+)</label>
                        <div class="relative"><span class="absolute left-3 top-2.5 text-slate-400">$</span><input type="number" wire:model='allowance' class="w-full rounded-xl border-slate-200 bg-slate-50/50 pl-7 pr-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20"></div>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Deduction (-)</label>
                        <div class="relative"><span class="absolute left-3 top-2.5 text-slate-400">$</span><input wire:model='deduction' type="number" placeholder="0" class="w-full rounded-xl border-slate-200 bg-slate-50/50 pl-7 pr-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20"></div>
                    </div>
                </div>
                <div class="mt-6">
                    @if ($editCheck == false)
                        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition-all hover:scale-[1.02]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Save Payroll
                        </button>
                    @endif
                </div>
            </form>
        </div>

        @if ($editCheck == true)
            <div class="mb-4 flex justify-end">
                <button wire:click='update({{ $idEdit }})' class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/25 transition-all hover:scale-[1.02]">Update Payroll</button>
            </div>
        @endif

        <div class="mb-4">
            <input type="text" class="w-full md:w-80 rounded-xl border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20" placeholder="🔍 Search payroll..." wire:model.live='keyword'>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Employee Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Period</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Salary</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Allowance</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Deduction</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Net Salary</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($payrolls as $item)
                            <tr class="group hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $loop->iteration}}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $item->employee->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $item->period }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-700">${{ number_format($item->employee->salary) }}</td>
                                <td class="px-6 py-4 text-sm text-emerald-600 font-medium">+${{ number_format($item->allowance) }}</td>
                                <td class="px-6 py-4 text-sm text-rose-600 font-medium">-${{ number_format($item->deduction) }}</td>
                                <td class="px-6 py-4 text-sm font-black text-indigo-700">${{ number_format($item->net_salary) }}</td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <button class="rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-600 hover:bg-rose-100" wire:click='destroy({{ $item->id}})'>Hapus</button>
                                    @if ($editCheck == false)
                                        <button wire:click='edit({{ $item->id}})' class="rounded-lg bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-600 hover:bg-sky-100">Edit</button>
                                    @endif
                                    @if ($editCheck == true)
                                        <button wire:click='clear()' class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">clear</button>
                                    @endif
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
    @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
</style>