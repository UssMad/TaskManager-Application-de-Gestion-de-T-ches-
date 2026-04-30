@extends('layouts.guest')

@section('title', 'Sign In — iTask')

@section('content')
    <div class="mb-8 text-center">
        <h1 class="text-on-surface font-bold mb-2" style="font-size:24px; line-height:32px; letter-spacing:-0.015em;">Welcome back</h1>
        <p class="text-on-surface-variant" style="font-size:13px;">Please enter your details to sign in.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div class="flex flex-col gap-1.5">
            <label for="email" class="font-medium text-on-surface" style="font-size:12px; letter-spacing:0.02em;">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="name@company.com"
                   class="h-10 px-3 w-full bg-surface-container-lowest border border-outline-variant rounded-lg text-on-surface text-sm placeholder-outline focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('email') border-error @enderror">
            @error('email')
                <p class="text-error text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-1.5">
            <label for="password" class="font-medium text-on-surface" style="font-size:12px; letter-spacing:0.02em;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="••••••••"
                   class="h-10 px-3 w-full bg-surface-container-lowest border border-outline-variant rounded-lg text-on-surface text-sm placeholder-outline focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all @error('password') border-error @enderror">
            @error('password')
                <p class="text-error text-xs font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember / Forgot -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                       class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary bg-surface-container-lowest">
                <span class="text-on-surface-variant" style="font-size:13px;">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-primary hover:underline font-medium" style="font-size:12px; letter-spacing:0.02em;">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <button id="login-submit" type="submit"
                    class="w-full h-10 bg-primary text-on-primary text-sm font-medium rounded-lg shadow-[inset_0_1px_0_rgba(255,255,255,0.2)] hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center">
                Log In
            </button>
        </div>
    </form>

    <!-- Register link -->
    <div class="mt-8 text-center">
        <p class="text-on-surface-variant" style="font-size:13px;">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary hover:underline font-medium ml-1" style="font-size:12px;">Sign up</a>
        </p>
    </div>
@endsection
