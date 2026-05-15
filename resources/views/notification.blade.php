<div x-data="{ show: @entangle('show'), message: @entangle('message'), type: @entangle('type'), title: @entangle('title') }"
     x-init="
        $watch('show', value => {
            if (value) {
                setTimeout(() => { show = false }, 4000);
            }
        });
        Livewire.on('hide-notification', () => {
            setTimeout(() => { show = false }, 4000);
        });
     "
     x-show="show"
     x-transition:enter="transform ease-out duration-300 transition"
     x-transition:enter-start="translate-x-full opacity-0"
     x-transition:enter-end="translate-x-0 opacity-100"
     x-transition:leave="transform ease-in duration-200 transition"
     x-transition:leave-start="translate-x-0 opacity-100"
     x-transition:leave-end="translate-x-full opacity-0"
     class="fixed top-5 right-5 z-[100] w-full max-w-sm">
    
    <div class="rounded-xl shadow-2xl overflow-hidden border backdrop-blur-md"
         :class="{
             'bg-emerald-50 border-emerald-200': type === 'success',
             'bg-rose-50 border-rose-200': type === 'error',
             'bg-amber-50 border-amber-200': type === 'warning',
             'bg-sky-50 border-sky-200': type === 'info'
         }">
        
        <div class="p-4">
            <div class="flex items-start gap-3">
                <!-- Icon berdasarkan type -->
                <div class="flex-shrink-0">
                    <template x-if="type === 'success'">
                        <div class="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="type === 'error'">
                        <div class="h-8 w-8 rounded-full bg-rose-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="type === 'warning'">
                        <div class="h-8 w-8 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="type === 'info'">
                        <div class="h-8 w-8 rounded-full bg-sky-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </template>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" 
                       :class="{
                           'text-emerald-800': type === 'success',
                           'text-rose-800': type === 'error',
                           'text-amber-800': type === 'warning',
                           'text-sky-800': type === 'info'
                       }"
                       x-text="title"></p>
                    <p class="text-xs mt-0.5" 
                       :class="{
                           'text-emerald-700': type === 'success',
                           'text-rose-700': type === 'error',
                           'text-amber-700': type === 'warning',
                           'text-sky-700': type === 'info'
                       }"
                       x-text="message"></p>
                </div>

                <!-- Close button -->
                <button @click="show = false" class="flex-shrink-0">
                    <svg class="h-4 w-4 text-slate-400 hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Progress bar -->
        <div class="h-1 w-full bg-white/50">
            <div class="h-full transition-all duration-[4000ms] linear"
                 :class="{
                     'bg-emerald-500': type === 'success',
                     'bg-rose-500': type === 'error',
                     'bg-amber-500': type === 'warning',
                     'bg-sky-500': type === 'info'
                 }"
                 x-init="$el.style.width = '100%'"
                 x-effect="setTimeout(() => $el.style.width = '0%', 50)"></div>
        </div>
    </div>
</div>

<!-- Alpine JS (required untuk animasi) -->
<script src="//unpkg.com/alpinejs" defer></script>

<style>
    /* Smooth progress bar animation */
    [x-cloak] { display: none !important; }
</style>
