<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'iTask')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#e2dfff",
                        "outline-variant": "#c7c4d8",
                        "surface-bright": "#fcf8ff",
                        "surface-tint": "#4d44e3",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f5f2ff",
                        "surface-container": "#f0ecf9",
                        "surface-container-high": "#eae6f4",
                        "on-surface-variant": "#464555",
                        "primary-container": "#4f46e5",
                        "on-surface": "#1b1b24",
                        "on-primary-fixed-variant": "#3323cc",
                        "background": "#fcf8ff",
                        "outline": "#777587",
                        "surface-container-highest": "#e4e1ee",
                        "on-background": "#1b1b24",
                        "primary": "#3525cd",
                        "error": "#ba1a1a",
                        "surface-dim": "#dcd8e5",
                        "secondary": "#006c49",
                    },
                    fontFamily: { "sans": ["Inter"] },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                    spacing: { "sm": "8px", "xl": "40px", "xs": "4px", "md": "16px", "lg": "24px", "base": "4px", "container-margin": "32px" },
                    fontSize: {
                        "h2": ["24px", { lineHeight: "32px", letterSpacing: "-0.015em", fontWeight: "600" }],
                        "body-sm": ["13px", { lineHeight: "20px", letterSpacing: "0", fontWeight: "400" }],
                        "button": ["14px", { lineHeight: "20px", letterSpacing: "0", fontWeight: "500" }],
                        "label-md": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "500" }],
                        "body-base": ["14px", { lineHeight: "24px", letterSpacing: "0", fontWeight: "400" }],
                        "h3": ["18px", { lineHeight: "28px", letterSpacing: "-0.01em", fontWeight: "600" }],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="min-h-screen bg-background flex flex-col justify-center items-center p-md sm:p-lg antialiased" style="font-family: 'Inter', sans-serif;">

    <!-- Logo -->
    <div class="flex justify-center mb-8">
        <div class="flex items-center gap-2 text-on-surface">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 28px; color: #3525cd;">check_circle</span>
            <span class="text-h3 font-h3 tracking-tight font-bold" style="font-size:20px; font-weight:700;">iTask</span>
        </div>
    </div>

    <!-- Card -->
    <main class="w-full max-w-[420px] bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0px_4px_12px_rgba(0,0,0,0.03)] p-8 overflow-hidden">
        @yield('content')
    </main>

    <p class="mt-8 text-xs text-outline">&copy; {{ date('Y') }} iTask &mdash; Built for velocity.</p>

</body>
</html>
