<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Nusantara Post — Portal berita warga terpercaya. Baca berita terkini, opini, budaya, dan laporan mendalam.">

        <title>{{ config('app.name', 'Nusantara Post') }}</title>

        <!-- Google Fonts: Inter -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
            } else {
            document.documentElement.classList.remove('dark')
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-surface text-ink min-h-screen flex flex-col">

        @include('layouts.navigation')

        <main class="flex-1">
            {{ $slot }}

            @if(session('success') || session('login_success'))
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-init="setTimeout(() => show = false, 3000)"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="translate-y-12 opacity-0"
                     x-transition:enter-end="translate-y-0 opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed bottom-6 right-6 z-[100] bg-surface border border-border-light shadow-brutal rounded-2xl p-4 flex items-center gap-4 max-w-sm">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-black text-ink mb-0.5">{{ session('login_success') ? 'Login Berhasil!' : 'Sukses!' }}</h4>
                        <p class="text-xs text-ink-muted">{{ session('success') ?? session('login_success') }}</p>
                    </div>
                    <button @click="show = false" class="text-ink-muted hover:text-ink transition-colors flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif
        </main>

        <!-- Footer -->
        <footer class="glass-card-strong border-t border-border-light mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-ink rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-surface" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-lg font-extrabold text-ink tracking-tight">Nusantara Post</span>
                    </div>
                    <p class="text-ink-muted text-sm">
                        &copy; {{ date('Y') }} Nusantara Post. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const themeToggleBtn = document.getElementById('themeToggle');
                const darkIcon = document.getElementById('themeToggleDarkIcon');
                const lightIcon = document.getElementById('themeToggleLightIcon');

                // Function to update icon based on current theme
                const updateIcon = () => {
                    if (document.documentElement.classList.contains('dark')) {
                        darkIcon.classList.add('hidden');
                        lightIcon.classList.remove('hidden');
                    } else {
                        lightIcon.classList.add('hidden');
                        darkIcon.classList.remove('hidden');
                    }
                };

                // Initialize icon
                if (themeToggleBtn) {
                    updateIcon();

                    themeToggleBtn.addEventListener('click', () => {
                        // Toggle dark class
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                            localStorage.theme = 'light';
                        } else {
                            document.documentElement.classList.add('dark');
                            localStorage.theme = 'dark';
                        }
                        updateIcon();
                    });
                }
            });
        </script>
    </body>
</html>