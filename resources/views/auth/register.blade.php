@extends('layouts.guest')

@section('title', 'Create Account — TaskFlow')

@section('content')
    <div class="flex flex-col items-center mb-8">
        <div class="w-12 h-12 bg-primary-container rounded-lg flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-on-primary font-bold text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
        <h1 class="text-on-background font-bold text-center mb-1" style="font-size:24px; line-height:32px; letter-spacing:-0.015em;">Create an account</h1>
        <p class="text-on-surface-variant text-center" style="font-size:14px;">Join TaskFlow to manage your tasks.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
        @csrf

        <!-- Name -->
        <div class="flex flex-col gap-1.5">
            <label for="name" class="font-medium text-on-surface" style="font-size:12px; letter-spacing:0.02em;">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   placeholder="Jane Doe"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded text-on-background px-3 py-2 text-sm transition-all duration-200 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 placeholder:text-outline @error('name') border-error @enderror">
            @error('name')
                <p class="text-error text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="flex flex-col gap-1.5">
            <label for="email" class="font-medium text-on-surface" style="font-size:12px; letter-spacing:0.02em;">Work Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   placeholder="jane@company.com"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded text-on-background px-3 py-2 text-sm transition-all duration-200 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 placeholder:text-outline @error('email') border-error @enderror">
            @error('email')
                <p class="text-error text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-1.5">
            <label for="password" class="font-medium text-on-surface" style="font-size:12px; letter-spacing:0.02em;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded text-on-background px-3 py-2 text-sm transition-all duration-200 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 placeholder:text-outline @error('password') border-error @enderror">
            @error('password')
                <p class="text-error text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="flex flex-col gap-1.5">
            <label for="password_confirmation" class="font-medium text-on-surface" style="font-size:12px; letter-spacing:0.02em;">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full bg-surface-container-lowest border border-outline-variant rounded text-on-background px-3 py-2 text-sm transition-all duration-200 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 placeholder:text-outline @error('password_confirmation') border-error @enderror">
            @error('password_confirmation')
                <p class="text-error text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <button id="register-submit" type="submit"
                    class="w-full flex justify-center items-center py-[10px] px-4 bg-primary hover:bg-surface-tint text-on-primary text-sm font-medium rounded-lg transition-colors duration-200 shadow-sm border-t border-white/20">
                Register
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-on-surface-variant" style="font-size:13px;">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary hover:text-surface-tint font-medium hover:underline transition-colors ml-1" style="font-size:13px;">Log in</a>
        </p>
    </div>
@endsection
