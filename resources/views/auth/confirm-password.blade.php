@extends('layouts.guest')

@section('title', 'Confirm Password — TaskManager')

@section('content')
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Confirm password</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">This is a secure area. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 text-slate-800 dark:text-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition shadow-sm"
                   placeholder="••••••••">
            @error('password')
                <p class="mt-1.5 text-xs text-red-500 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-purple-600 hover:from-brand-700 hover:to-purple-700 text-white text-sm font-semibold shadow-lg shadow-brand-500/25 transition-all duration-200">
            Confirm
        </button>
    </form>
@endsection
