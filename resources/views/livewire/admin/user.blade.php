<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl shadow-slate-200/50 border border-white/50 p-6">
            <h1 class="text-3xl font-black bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent tracking-tight">User Management</h1>
            <p class="mt-1 text-sm text-slate-500">Manage system users and roles</p>
        </div>

        @foreach ($errors->all() as $error)
            <div class="mb-3 rounded-xl border-l-4 border-rose-500 bg-rose-50 p-4 text-sm text-rose-700">
                {{ $errors->any() }}
            </div>
        @endforeach

        @if (session('message'))
            <div class="mb-4 animate-fadeIn rounded-xl bg-emerald-50 p-4 text-sm font-medium text-emerald-800">
                {{ session('message') }}
            </div>
        @endif

        <div class="mb-8 overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/50">
            <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-6 py-4">
                <h2 class="text-lg font-semibold text-slate-700">👤 Create New User</h2>
            </div>
            <form wire:submit.prevent='store' class="p-6">
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Full Name</label>
                        <input type="text" wire:model='name' class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Email</label>
                        <input type="text" wire:model='email' class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Password</label>
                        <input wire:model='password' type="password" placeholder="••••••" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wider text-slate-500">Role</label>
                        <select wire:model="role" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm focus:border-indigo-400 focus:bg-white">
                            <option value="">-- Select Role --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    @if ($editCheck == false)
                        <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/25 transition hover:scale-[1.02]">Create User</button>
                    @endif
                </div>
            </form>
        </div>

        @if ($editCheck == true)
            <div class="mb-4 flex justify-end">
                <button wire:click='update({{ $idEdit }})' class="rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-amber-500/25 transition hover:scale-[1.02]">Update User</button>
            </div>
        @endif

        <div class="mb-4">
            <input type="text" class="w-full md:w-80 rounded-xl border-slate-200 bg-white px-4 py-2.5 text-sm shadow-sm focus:border-indigo-400 focus:ring-2 focus:ring-indigo-400/20" placeholder="🔍 Search users..." wire:model.live='keyword'>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-xl shadow-slate-200/60 ring-1 ring-slate-200/50">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($users as $item)
                            <tr class="group hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $loop->iteration}}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $item->name }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $item->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex rounded-full {{ $item->role == 'admin' ? 'bg-purple-50 text-purple-700' : 'bg-slate-100 text-slate-600' }} px-2.5 py-0.5 text-xs font-medium">
                                        {{ ucfirst($item->role) }}
                                    </span>
                                </td>
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
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .animate-fadeIn { animation: fadeIn 0.2s ease-out; }
</style>