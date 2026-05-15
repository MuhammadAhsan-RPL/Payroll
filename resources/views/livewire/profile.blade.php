<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
            My Profile
        </h1>
        <p class="text-sm text-slate-500 mt-1">Manage your personal information</p>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="mb-4 rounded-xl bg-emerald-50 border-l-4 border-emerald-500 p-4">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-medium text-emerald-800">{{ session('message') }}</span>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Foto Profile -->
        <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
            <div class="text-center">
                <!-- Foto Profile -->
                <div class="relative inline-block">
                    <img src="{{ $existing_photo }}" 
                         class="w-32 h-32 rounded-full object-cover ring-4 ring-indigo-500/20 shadow-lg mx-auto">
                    
                    @if (Auth::user()->profile_photo)
                    <button wire:click="deletePhoto" 
                            wire:confirm="Yakin ingin menghapus foto profile?"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition shadow-md"
                            title="Hapus foto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    @endif
                </div>
                
                <h3 class="mt-4 text-lg font-semibold text-slate-800">{{ Auth::user()->name }}</h3>
                <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                <p class="text-xs text-slate-400 mt-1">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Upload New Photo</label>
                    <input type="file" wire:model="profile_photo" 
                           class="w-full text-sm text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                    <div wire:loading wire:target="profile_photo" class="text-xs text-indigo-500 mt-1">
                        Uploading...
                    </div>
                    @error('profile_photo') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Profile -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Form Info Profile -->
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                <h2 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Personal Information
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                        <input type="text" wire:model="name" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                        @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                        <input type="email" wire:model="email" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                        @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Phone Number</label>
                        <input type="tel" wire:model="phone" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20"
                               placeholder="+62 xxx xxx xxx">
                        @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Address</label>
                        <textarea wire:model="address" rows="3" 
                                  class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20"
                                  placeholder="Your address..."></textarea>
                        @error('address') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="pt-2">
                        <button wire:click="updateProfile" wire:loading.attr="disabled"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-indigo-500/25 transition hover:scale-[1.02] disabled:opacity-50">
                            <span wire:loading.remove>Save Changes</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Ganti Password -->
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                <button type="button" @click="$wire.showPasswordForm = !$wire.showPasswordForm" 
                        class="flex items-center justify-between w-full text-left">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <h2 class="text-lg font-semibold text-slate-800">Change Password</h2>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 transition-transform" :class="{'rotate-180': $wire.showPasswordForm}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <div x-show="$wire.showPasswordForm" x-collapse class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Current Password</label>
                        <input type="password" wire:model="current_password" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                        @error('current_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">New Password</label>
                        <input type="password" wire:model="new_password" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                        @error('new_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Confirm New Password</label>
                        <input type="password" wire:model="new_password_confirmation" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 focus:border-indigo-400 focus:bg-white focus:ring-2 focus:ring-indigo-400/20">
                    </div>
                    
                    <div class="pt-2">
                        <button wire:click="updatePassword" wire:loading.attr="disabled"
                                class="bg-slate-600 hover:bg-slate-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition">
                            <span wire:loading.remove>Update Password</span>
                            <span wire:loading>Updating...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function() {
        // Auto refresh profile photo after upload
        Livewire.on('profile-updated', () => {
            location.reload();
        });
    });
</script>