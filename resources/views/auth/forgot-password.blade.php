@extends('layouts.guest')

@section('title', 'Forgot Password — TaskManager')

@section('content')
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-950/50 mb-4">
            <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Reset your password</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Enter your email and we'll send you a reset link</p>
    </div>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 text-sm font-medium">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition shadow-sm placeholder-slate-400"
                   placeholder="you@example.com">
            @error('email')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-purple-600 hover:from-brand-700 hover:to-purple-700 text-white text-sm font-semibold shadow-lg shadow-brand-500/25 transition-all duration-200">
            Send Reset Link
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition">← Back to Sign In</a>
    </div>
@endsection
