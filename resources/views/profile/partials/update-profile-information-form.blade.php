<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div class="flex flex-col gap-1.5">
            <label for="name" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Full Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('name') border-error @enderror">
            @error('name')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex flex-col gap-1.5">
            <label for="email" class="font-medium text-on-surface" style="font-size:12px;letter-spacing:0.02em;">Email Address</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded-lg px-3 py-2.5 text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('email') border-error @enderror">
            @error('email')<p class="text-error text-xs font-medium mt-1">{{ $message }}</p>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-1">
                    <p class="text-on-surface-variant text-xs">
                        Your email is unverified.
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-primary hover:underline font-medium">Resend verification</button>
                        </form>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-xs text-secondary font-medium mt-1">✓ A new link has been sent.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="bg-primary text-on-primary text-sm font-medium px-5 py-2.5 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
                Save Changes
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-medium text-secondary">✓ Saved</p>
            @endif
        </div>
    </form>
</section>
