@extends('layouts.guest')

@section('title', 'Verify Email — TaskManager')

@section('content')
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-sky-100 dark:bg-sky-950/50 mb-4">
            <svg class="w-7 h-7 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 dark:text-slate-100">Check your email</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 leading-relaxed">We've sent a verification link to your email address. Please click it to verify your account.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 text-sm font-medium">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-brand-600 to-purple-600 hover:from-brand-700 hover:to-purple-700 text-white text-sm font-semibold shadow-lg shadow-brand-500/25 transition-all duration-200">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-6 py-3 rounded-xl text-sm font-medium text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition text-center">
                Log Out
            </button>
        </form>
    </div>
@endsection
