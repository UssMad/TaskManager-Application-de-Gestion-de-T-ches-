<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="TaskFlow — Minimalist task management for productive teams.">

    <title>@yield('title', 'TaskFlow')</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#dad7ff",
                        "on-secondary": "#ffffff",
                        "primary-fixed": "#e2dfff",
                        "outline-variant": "#c7c4d8",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed": "#ffdbcc",
                        "surface-bright": "#fcf8ff",
                        "surface-tint": "#4d44e3",
                        "inverse-surface": "#302f39",
                        "error": "#ba1a1a",
                        "on-primary-fixed": "#0f0069",
                        "error-container": "#ffdad6",
                        "surface-dim": "#dcd8e5",
                        "secondary-fixed-dim": "#4edea3",
                        "on-primary": "#ffffff",
                        "on-tertiary-container": "#ffd2be",
                        "surface-container-low": "#f5f2ff",
                        "surface-container": "#f0ecf9",
                        "surface-container-high": "#eae6f4",
                        "on-error-container": "#93000a",
                        "on-error": "#ffffff",
                        "primary-fixed-dim": "#c3c0ff",
                        "on-surface-variant": "#464555",
                        "secondary": "#006c49",
                        "primary-container": "#4f46e5",
                        "on-secondary-fixed": "#002113",
                        "on-secondary-fixed-variant": "#005236",
                        "on-surface": "#1b1b24",
                        "on-primary-fixed-variant": "#3323cc",
                        "background": "#fcf8ff",
                        "outline": "#777587",
                        "inverse-on-surface": "#f3effc",
                        "surface-container-highest": "#e4e1ee",
                        "on-background": "#1b1b24",
                        "surface": "#fcf8ff",
                        "tertiary": "#7e3000",
                        "on-tertiary-fixed": "#351000",
                        "primary": "#3525cd",
                        "tertiary-container": "#a44100",
                        "on-secondary-container": "#00714d",
                        "secondary-container": "#6cf8bb",
                        "surface-variant": "#e4e1ee",
                        "tertiary-fixed-dim": "#ffb695",
                        "on-tertiary-fixed-variant": "#7b2f00",
                        "inverse-primary": "#c3c0ff",
                        "secondary-fixed": "#6ffbbe"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "sm": "8px", "xl": "40px", "xs": "4px",
                        "md": "16px", "gutter": "20px", "lg": "24px",
                        "base": "4px", "container-margin": "32px"
                    },
                    fontFamily: {
                        "h1": ["Inter"], "body-sm": ["Inter"], "h3": ["Inter"],
                        "h2": ["Inter"], "button": ["Inter"], "label-md": ["Inter"],
                        "body-base": ["Inter"], "sans": ["Inter"]
                    },
                    fontSize: {
                        "h1": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "600" }],
                        "body-sm": ["13px", { lineHeight: "20px", letterSpacing: "0", fontWeight: "400" }],
                        "h3": ["18px", { lineHeight: "28px", letterSpacing: "-0.01em", fontWeight: "600" }],
                        "h2": ["24px", { lineHeight: "32px", letterSpacing: "-0.015em", fontWeight: "600" }],
                        "button": ["14px", { lineHeight: "20px", letterSpacing: "0", fontWeight: "500" }],
                        "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "500" }],
                        "body-base": ["14px", { lineHeight: "24px", letterSpacing: "0", fontWeight: "400" }]
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #c7c4d8; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #777587; }
    </style>
</head>
<body class="bg-background text-on-background font-sans text-body-base antialiased min-h-screen flex" style="font-family: 'Inter', sans-serif;">

<!-- ── Side Navigation ─────────────────────────────────────── -->
<nav class="w-[240px] h-screen border-r border-outline-variant bg-gray-50 flex flex-col fixed left-0 top-0 py-6 px-4 z-50">

    <!-- Logo / Brand -->
    <div class="flex items-center gap-3 px-2 mb-8">
        <div class="w-8 h-8 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1; font-size:18px;">task_alt</span>
        </div>
        <div>
            <h2 class="text-[15px] font-bold text-gray-900 leading-tight">TaskFlow</h2>
            <p class="text-gray-500 text-xs">{{ Auth::user()->name }}</p>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex flex-col gap-1 flex-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm transition-colors duration-200 ease-in-out
                  {{ request()->routeIs('dashboard') ? 'text-primary font-semibold bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]" style="{{ request()->routeIs('dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
            Dashboard
        </a>

        <a href="{{ route('tasks.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm transition-colors duration-200 ease-in-out
                  {{ request()->routeIs('tasks.*') ? 'text-primary font-semibold bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]" style="{{ request()->routeIs('tasks.*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">checklist</span>
            My Tasks
        </a>

        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-md text-sm transition-colors duration-200 ease-in-out
                  {{ request()->routeIs('profile.*') ? 'text-primary font-semibold bg-indigo-50' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
            <span class="material-symbols-outlined text-[20px]" style="{{ request()->routeIs('profile.*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">person</span>
            Profile
        </a>
    </div>

    <!-- Logout Footer -->
    <div class="mt-auto border-t border-gray-200 pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-md text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200 text-left">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Logout
            </button>
        </form>
    </div>
</nav>

<!-- ── Main Content Wrapper ───────────────────────────────── -->
<div class="flex-1 flex flex-col ml-[240px]">

    <!-- ── Top Navigation Bar ─────────────────────────────── -->
    <header class="h-16 w-full border-b border-gray-200 flex items-center justify-between px-8 sticky top-0 z-40 bg-white/80 backdrop-blur-md shadow-sm">
        <!-- Search -->
        <div class="relative w-64 group">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px] group-focus-within:text-primary transition-colors">search</span>
            <input type="text"
                   placeholder="Search tasks..."
                   class="w-full pl-9 pr-4 py-1.5 bg-gray-100/50 border border-transparent rounded-md focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all text-sm text-gray-900 outline-none">
        </div>

        <!-- Right: actions + user -->
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.create') }}"
               class="bg-primary text-on-primary text-sm font-medium px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors shadow-[inset_0_1px_0_rgba(255,255,255,0.2)]">
                <span class="material-symbols-outlined text-[16px]">add</span>
                New Task
            </a>
            <div class="h-6 w-px bg-gray-200"></div>
            <div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-sm font-bold text-primary border border-outline-variant">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </header>

    <!-- ── Toast Notifications ────────────────────────────── -->
    @if(session('success') || session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-[80px] right-6 z-[100] w-[360px]">
            <div class="bg-surface-container-lowest border border-outline-variant rounded-lg shadow-[0_12px_24px_rgba(0,0,0,0.08)] p-4 flex items-start gap-3">
                @if(session('success'))
                    <span class="material-symbols-outlined text-secondary mt-0.5 shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                @else
                    <span class="material-symbols-outlined text-error mt-0.5 shrink-0" style="font-variation-settings: 'FILL' 1;">error</span>
                @endif
                <div class="flex-1">
                    <p class="text-sm font-medium text-on-surface">{{ session('success') ?? session('error') }}</p>
                </div>
                <button x-on:click="show = false" class="text-outline hover:text-on-surface shrink-0">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </div>
    @endif

    <!-- ── Page Canvas ────────────────────────────────────── -->
    <main class="flex-1 p-8 max-w-[1440px] w-full mx-auto">
        @yield('content')
    </main>

</div>

</body>
</html>
