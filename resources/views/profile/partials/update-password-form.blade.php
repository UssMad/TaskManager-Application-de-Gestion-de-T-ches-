<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div class="flex flex-col gap-1.5">
            <label for="update_password_current_password" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('current_password', 'updatePassword') border-error @enderror">
            @error('current_password', 'updatePassword')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="update_password_password" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">New Password</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('password', 'updatePassword') border-error @enderror">
            @error('password', 'updatePassword')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="update_password_password_confirmation" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Confirm New Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('password_confirmation', 'updatePassword') border-error @enderror">
            @error('password_confirmation', 'updatePassword')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="bg-primary text-on-primary text-sm font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
                Update Password
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-medium text-secondary">✓ Updated</p>
            @endif
        </div>
    </form>
</section>
