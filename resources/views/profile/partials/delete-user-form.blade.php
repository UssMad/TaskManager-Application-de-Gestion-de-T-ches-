<section x-data="{ confirmDelete: false }">
    <p class="text-on-surface-variant text-sm leading-relaxed mb-5">
        Once your account is deleted, all of your data will be permanently removed. This action cannot be undone.
    </p>

    <button x-on:click="confirmDelete = true"
            class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-error border border-error-container rounded-lg hover:bg-error-container transition-colors">
        <span class="material-symbols-outlined" style="font-size:16px;">delete_forever</span>
        Delete Account
    </button>

    {{-- Confirmation Modal --}}
    <div x-show="confirmDelete" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
        <div x-on:click.outside="confirmDelete = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-md bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-[0_12px_24px_rgba(0,0,0,0.08)]">

            <h3 class="text-on-surface font-semibold mb-2" style="font-size:18px;line-height:28px;letter-spacing:-0.01em;">Delete your account?</h3>
            <p class="text-on-surface-variant text-sm mb-5">Enter your password to permanently delete your account. All your tasks and data will be removed.</p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div class="flex flex-col gap-1.5">
                    <label for="delete_password" class="sr-only">Password</label>
                    <input id="delete_password" name="password" type="password" required
                           placeholder="Your current password"
                           class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-error focus:ring-2 focus:ring-error/10 transition-all">
                    @error('password', 'userDeletion')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" x-on:click="confirmDelete = false"
                            class="px-4 py-2 text-sm font-medium text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-5 py-2 text-sm font-semibold text-on-primary bg-error rounded-lg hover:bg-error/90 shadow-sm transition-colors">
                        Delete Permanently
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
