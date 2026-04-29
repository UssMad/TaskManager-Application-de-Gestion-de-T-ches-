@extends('layouts.guest')

@section('title', 'Reset Password — TaskManager')

@section('content')
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Set new password</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Choose a strong password for your account</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition shadow-sm">
            @error('email')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">New Password</label>
            <input id="password" type="password" name="password" required
                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition shadow-sm"
                   placeholder="••••••••">
            @error('password')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition shadow-sm"
                   placeholder="••••••••">
            @error('password_confirmation')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-purple-600 hover:from-brand-700 hover:to-purple-700 text-white text-sm font-semibold shadow-lg shadow-brand-500/25 transition-all duration-200">
            Reset Password
        </button>
    </form>
@endsection
