<nav x-data="{ open: false }" class="glass-nav sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-9 h-9 bg-ink rounded-xl flex items-center justify-center group-hover:shadow-brutal-sm transition-all duration-200">
                            <svg class="w-5 h-5 text-surface" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold text-ink tracking-tight">Nusantara Post</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex items-center">
                    <a href="{{ route('home') }}" class="nav-link-hover text-sm font-semibold text-ink-light hover:text-ink transition-colors {{ request()->routeIs('home') ? 'text-ink' : '' }}">
                        Home
                    </a>
                    @auth
                        <a href="{{ route('artikel.create') }}" class="nav-link-hover text-sm font-semibold text-ink-light hover:text-ink transition-colors {{ request()->routeIs('artikel.create') ? 'text-ink' : '' }}">
                            Submit Berita
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ url('/admin') }}" class="nav-link-hover text-sm font-semibold text-ink-light hover:text-ink transition-colors {{ request()->is('admin*') ? 'text-ink' : '' }}">
                                Admin
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right Side: Auth & Theme -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Theme Toggle -->
                <button id="themeToggle" class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl text-ink-light hover:text-ink hover:bg-white border border-transparent hover:border-border-light focus:outline-none transition-all dark:hover:bg-ink dark:text-ink-muted dark:hover:text-white dark:hover:border-white/10" aria-label="Toggle Dark Mode">
                    <!-- Sun Icon (shows in dark mode) -->
                    <svg id="themeToggleLightIcon" class="hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <!-- Moon Icon (shows in light mode) -->
                    <svg id="themeToggleDarkIcon" class="w-5 h-5 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                @guest
                    <a href="{{ route('login') }}" class="brutal-btn text-sm">
                        Masuk
                    </a>
                @else
                    <!-- Notification Bell -->
                    <a href="{{ route('notifications.index') }}" class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl text-ink-light hover:text-ink hover:bg-white border border-transparent hover:border-border-light focus:outline-none transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @php $unreadCount = Auth::user()->unreadNotificationsCount(); @endphp
                        @if($unreadCount > 0)
                            <span class="absolute top-1.5 right-1.5 flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border border-white"></span>
                            </span>
                        @endif
                    </a>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 text-sm font-semibold rounded-xl text-ink bg-card hover:bg-card-solid border border-border-light hover:border-ink/20 focus:outline-none transition-all backdrop-blur-sm">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-7 h-7 rounded-lg object-cover border border-border-light">
                                @else
                                    <div class="w-7 h-7 rounded-lg bg-ink flex items-center justify-center text-surface text-xs font-bold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4 text-ink-muted" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('artikel.my-articles')">
                                {{ __('Berita Saya') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-ink-light hover:text-ink hover:bg-white/50 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden glass-card-strong border-t border-border-light">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('home') }}" class="block py-2.5 text-sm font-semibold text-ink-light hover:text-ink transition-colors">
                Home
            </a>
            @auth
                <a href="{{ route('artikel.create') }}" class="block py-2.5 text-sm font-semibold text-ink-light hover:text-ink transition-colors">
                    Submit Berita
                </a>
                @if(auth()->user()->is_admin)
                    <a href="{{ url('/admin') }}" class="block py-2.5 text-sm font-semibold text-ink-light hover:text-ink transition-colors">
                        Admin
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="block py-2.5 text-sm font-bold text-ink transition-colors">
                    Masuk
                </a>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-3 border-t border-border-light px-4">
            <div class="flex items-center gap-3 mb-3">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-10 h-10 rounded-xl object-cover border border-border-light">
                @else
                    <div class="w-10 h-10 rounded-xl bg-ink flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-semibold text-sm text-ink">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-ink-muted">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('artikel.my-articles') }}" class="block py-2 text-sm text-ink-light hover:text-ink transition-colors flex items-center justify-between">
                <span>Berita Saya</span>
            </a>
            <a href="{{ route('notifications.index') }}" class="block py-2 text-sm text-ink-light hover:text-ink transition-colors flex items-center justify-between">
                <span>Notifikasi</span>
                @php $unreadCount = Auth::user()->unreadNotificationsCount(); @endphp
                @if($unreadCount > 0)
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }} Baru</span>
                @endif
            </a>
            <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-ink-light hover:text-ink transition-colors">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left py-2 text-sm text-ink-light hover:text-ink transition-colors">
                    Log Out
                </button>
            </form>
        </div>
        @endauth
    </div>
</nav>
