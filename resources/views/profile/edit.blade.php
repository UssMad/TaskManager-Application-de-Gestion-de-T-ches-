@extends('layouts.app')
@section('title', 'Profile — TaskFlow')
@section('content')

<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-on-surface font-semibold mb-1" style="font-size:32px;line-height:40px;letter-spacing:-0.02em;">Profile Settings</h1>
        <p class="text-on-surface-variant text-sm">Manage your account information and security preferences.</p>
    </div>

    {{-- Profile Information --}}
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.03)] overflow-hidden mb-5">
        <div class="px-8 py-5 border-b border-surface-variant bg-surface-bright flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-primary-container flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary" style="font-size:18px;font-variation-settings:'FILL' 1;">person</span>
            </div>
            <div>
                <h2 class="text-on-surface font-semibold" style="font-size:16px;">Profile Information</h2>
                <p class="text-on-surface-variant" style="font-size:12px;">Update your name and email address.</p>
            </div>
        </div>
        <div class="p-8">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Update Password --}}
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.03)] overflow-hidden mb-5">
        <div class="px-8 py-5 border-b border-surface-variant bg-surface-bright flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-surface-container-high flex items-center justify-center">
                <span class="material-symbols-outlined text-on-surface-variant" style="font-size:18px;">lock</span>
            </div>
            <div>
                <h2 class="text-on-surface font-semibold" style="font-size:16px;">Update Password</h2>
                <p class="text-on-surface-variant" style="font-size:12px;">Ensure your account uses a strong, unique password.</p>
            </div>
        </div>
        <div class="p-8">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Delete Account --}}
    <div class="bg-surface-container-lowest border border-error-container/60 rounded-xl shadow-[0_4px_12px_rgba(0,0,0,0.03)] overflow-hidden">
        <div class="px-8 py-5 border-b border-surface-variant bg-surface-bright flex items-center gap-3">
            <div class="w-9 h-9 rounded-lg bg-error-container flex items-center justify-center">
                <span class="material-symbols-outlined text-error" style="font-size:18px;">warning</span>
            </div>
            <div>
                <h2 class="text-on-surface font-semibold" style="font-size:16px;">Danger Zone</h2>
                <p class="text-on-surface-variant" style="font-size:12px;">Permanently delete your account and all data.</p>
            </div>
        </div>
        <div class="p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>

@endsection
