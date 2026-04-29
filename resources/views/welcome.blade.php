<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Minimalist Task Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    "surface-container-lowest":"#ffffff","primary-fixed":"#e2dfff","outline-variant":"#c7c4d8",
                    "surface-bright":"#fcf8ff","surface-tint":"#4d44e3","on-primary":"#ffffff",
                    "surface-container-low":"#f5f2ff","surface-container":"#f0ecf9",
                    "surface-container-high":"#eae6f4","on-surface-variant":"#464555",
                    "primary-container":"#4f46e5","on-surface":"#1b1b24","on-primary-fixed-variant":"#3323cc",
                    "background":"#fcf8ff","outline":"#777587","surface-container-highest":"#e4e1ee",
                    "on-background":"#1b1b24","primary":"#3525cd","error":"#ba1a1a",
                    "secondary":"#006c49","secondary-container":"#6cf8bb","on-secondary-container":"#00714d",
                    "on-primary-container":"#dad7ff",
                },
                fontFamily: { sans: ["Inter"] },
                borderRadius: { "DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px" },
                spacing: { "sm":"8px","xl":"40px","xs":"4px","md":"16px","lg":"24px","base":"4px","container-margin":"32px" },
            }}
        }
    </script>
    <style>.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}</style>
</head>
<body class="bg-surface-container-lowest text-on-background min-h-screen flex flex-col antialiased" style="font-family:'Inter',sans-serif;">

{{-- Top Nav --}}
<nav class="fixed top-0 w-full z-50 border-b border-gray-200 shadow-[0_1px_2px_rgba(0,0,0,0.05)] bg-white/80 backdrop-blur-md">
    <div class="flex justify-between items-center h-14 px-6 max-w-[1440px] mx-auto w-full">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1;font-size:22px;">check_circle</span>
            <span class="text-lg font-bold tracking-tight text-gray-900">TaskFlow</span>
        </div>
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-on-surface-variant hover:text-on-surface transition-colors">Dashboard</a>
                <a href="{{ route('tasks.index') }}" class="text-sm font-medium bg-primary text-on-primary px-4 py-2 rounded-lg hover:opacity-90 transition-all shadow-[0_4px_12px_rgba(0,0,0,0.03)] border-t border-white/20">My Tasks</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-on-surface-variant hover:text-on-surface transition-colors">Log In</a>
                <a href="{{ route('register') }}" class="text-sm font-medium bg-primary text-on-primary px-4 py-2 rounded-lg hover:opacity-90 transition-all shadow-[0_4px_12px_rgba(0,0,0,0.03)] border-t border-white/20">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Hero --}}
<main class="flex-grow pt-24 pb-20">
    <section class="px-8 max-w-[1440px] mx-auto flex flex-col items-center text-center gap-6 mt-10 mb-24">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-surface-container border border-outline-variant text-on-surface-variant text-xs font-medium mb-2">
            <span class="material-symbols-outlined" style="font-size:14px;font-variation-settings:'FILL' 1;">bolt</span>
            Built for velocity &amp; clarity
        </div>
        <h1 class="text-on-background max-w-3xl" style="font-size:48px;font-weight:700;line-height:1.15;letter-spacing:-0.03em;">
            Master your workflow<br>with effortless precision.
        </h1>
        <p class="text-on-surface-variant max-w-xl" style="font-size:18px;line-height:28px;font-weight:400;">
            The minimalist task manager designed for speed, clarity, and uncompromising focus.
        </p>
        <div class="flex gap-4 mt-2">
            <a href="{{ route('register') }}" class="flex items-center gap-2 text-sm font-medium bg-primary text-on-primary px-6 py-3 rounded-lg hover:opacity-90 transition-all shadow-[0_12px_24px_rgba(0,0,0,0.08)] border-t border-white/20">
                Get Started
                <span class="material-symbols-outlined" style="font-size:18px;">arrow_forward</span>
            </a>
            <a href="{{ route('login') }}" class="flex items-center gap-2 text-sm font-medium bg-surface-container-lowest text-on-background border border-outline-variant px-6 py-3 rounded-lg hover:bg-surface-container-low transition-colors">
                Sign In
            </a>
        </div>

        {{-- Hero bento --}}
        <div class="mt-12 w-full max-w-4xl grid grid-cols-1 md:grid-cols-3 gap-5 text-left">
            <div class="md:col-span-2 bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_12px_24px_rgba(0,0,0,0.06)] overflow-hidden">
                <div class="border-b border-outline-variant p-3 flex items-center gap-2 bg-surface-container-low/50">
                    <div class="flex gap-1.5">
                        <div class="w-2.5 h-2.5 rounded-full bg-outline-variant"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-outline-variant"></div>
                        <div class="w-2.5 h-2.5 rounded-full bg-outline-variant"></div>
                    </div>
                    <div class="h-3 w-40 bg-surface-variant rounded mx-auto"></div>
                </div>
                <div class="p-5 space-y-3">
                    @foreach(['Prepare Q3 marketing report','Update product roadmap','Review design system tokens','Client onboarding call'] as $i => $t)
                        <div class="flex items-center gap-3 p-3 rounded-lg {{ $i === 0 ? 'bg-surface-container border border-outline-variant' : '' }} hover:bg-surface-container transition-colors">
                            <div class="w-4 h-4 rounded border-2 {{ $i < 2 ? 'border-secondary bg-secondary flex items-center justify-center' : 'border-outline-variant' }} shrink-0">
                                @if($i < 2)<span class="material-symbols-outlined text-on-secondary" style="font-size:10px;font-variation-settings:'FILL' 1;">check</span>@endif
                            </div>
                            <span class="text-sm {{ $i < 2 ? 'line-through text-on-surface-variant' : 'text-on-surface font-medium' }}">{{ $t }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-5">
                <div class="bg-surface-container-low rounded-xl border border-outline-variant p-5 flex-1">
                    <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-on-primary" style="font-size:18px;font-variation-settings:'FILL' 1;">bolt</span>
                    </div>
                    <h3 class="text-on-background font-semibold mb-1" style="font-size:15px;">Built for Velocity</h3>
                    <p class="text-on-surface-variant" style="font-size:13px;">Keyboard shortcuts for every action. Move at the speed of thought.</p>
                </div>
                <div class="bg-surface-container rounded-xl border border-outline-variant p-5 flex-1">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center mb-3">
                        <span class="material-symbols-outlined text-on-secondary-container" style="font-size:18px;font-variation-settings:'FILL' 1;">security</span>
                    </div>
                    <h3 class="text-on-background font-semibold mb-1" style="font-size:15px;">Private &amp; Secure</h3>
                    <p class="text-on-surface-variant" style="font-size:13px;">Each user's tasks are fully isolated. Only you can see your work.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="px-8 max-w-[1440px] mx-auto py-16 border-t border-outline-variant/30">
        <div class="mb-10 max-w-xl">
            <span class="text-primary font-medium uppercase tracking-wider mb-2 block" style="font-size:12px;">Core Philosophy</span>
            <h2 class="text-on-background font-semibold" style="font-size:24px;line-height:32px;letter-spacing:-0.015em;">Engineered for a clear mind.</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach([
                ['check_box_outline_blank','Radical Simplicity','No complexity. Just your tasks, clearly organized.'],
                ['account_tree','Fluid Organization','Filter by status or category. Find anything instantly.'],
                ['center_focus_strong','Deep Work Focus','Single-task views and minimal cues keep you in flow.'],
            ] as [$icon,$title,$desc])
            <div class="group bg-surface-container-lowest rounded-xl p-6 border border-outline-variant shadow-[0_4px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_24px_rgba(0,0,0,0.08)] transition-shadow duration-300 flex flex-col">
                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-4 group-hover:bg-primary/10 transition-colors">
                    <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors" style="font-size:22px;">{{ $icon }}</span>
                </div>
                <h3 class="text-on-background font-semibold mb-2" style="font-size:16px;">{{ $title }}</h3>
                <p class="text-on-surface-variant flex-grow" style="font-size:14px;line-height:24px;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </section>
</main>

{{-- Footer --}}
<footer class="w-full border-t border-gray-100 bg-white">
    <div class="flex flex-col md:flex-row justify-between items-center py-6 px-8 max-w-7xl mx-auto gap-4">
        <p class="text-xs text-gray-400">&copy; {{ date('Y') }} TaskFlow &mdash; Built for velocity.</p>
        <div class="flex gap-6">
            <a href="{{ route('login') }}" class="text-xs text-gray-400 hover:text-gray-700 transition-colors">Sign In</a>
            <a href="{{ route('register') }}" class="text-xs text-gray-400 hover:text-gray-700 transition-colors">Sign Up</a>
        </div>
    </div>
</footer>

</body>
</html>
