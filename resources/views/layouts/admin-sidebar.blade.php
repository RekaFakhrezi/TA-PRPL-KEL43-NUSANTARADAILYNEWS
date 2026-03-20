<!-- Admin Sidebar Component -->
@php
    $currentRoute = request()->route()->getName() ?? '';
@endphp

<div class="flex min-h-[calc(100vh-4rem)]">
    <!-- Sidebar -->
    <aside class="w-64 bg-dark-card border-r border-dark-border flex-shrink-0 hidden lg:block">
        <div class="sticky top-16 p-6 space-y-2">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Panel Admin</h3>

            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ $currentRoute === 'admin.dashboard' ? 'bg-gold/10 text-gold border border-gold/20' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Verifikasi Berita
                @php $pendingCount = \App\Models\Article::where('status', 'pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-gold text-dark-bg text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.published') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ $currentRoute === 'admin.published' ? 'bg-gold/10 text-gold border border-gold/20' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                Berita Tayang
            </a>

            <a href="{{ route('admin.unpublished') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ $currentRoute === 'admin.unpublished' ? 'bg-gold/10 text-gold border border-gold/20' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
                Diturunkan
            </a>

            <a href="{{ route('admin.trash') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all {{ $currentRoute === 'admin.trash' ? 'bg-gold/10 text-gold border border-gold/20' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Trash
            </a>

            <div class="border-t border-dark-border pt-4 mt-4">
                <a href="{{ route('home') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-gold hover:bg-dark-bg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </aside>

    <!-- Mobile sidebar toggle -->
    <div class="lg:hidden fixed bottom-4 right-4 z-40" x-data="{ sidebarOpen: false }">
        <button @click="sidebarOpen = !sidebarOpen" class="bg-gold text-dark-bg p-3 rounded-full shadow-lg hover:bg-gold-light transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" x-transition class="fixed inset-0 bg-black/60 z-40" @click="sidebarOpen = false"></div>
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" class="fixed top-0 left-0 h-full w-64 bg-dark-card border-r border-dark-border z-50 p-6 space-y-2">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Panel Admin</h3>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ $currentRoute === 'admin.dashboard' ? 'text-gold bg-gold/10' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">Verifikasi</a>
            <a href="{{ route('admin.published') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ $currentRoute === 'admin.published' ? 'text-gold bg-gold/10' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">Berita Tayang</a>
            <a href="{{ route('admin.unpublished') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ $currentRoute === 'admin.unpublished' ? 'text-gold bg-gold/10' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">Diturunkan</a>
            <a href="{{ route('admin.trash') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium {{ $currentRoute === 'admin.trash' ? 'text-gold bg-gold/10' : 'text-gray-400 hover:text-white hover:bg-dark-bg' }}">Trash</a>
            <div class="border-t border-dark-border pt-4 mt-4">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gold text-sm">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 lg:p-8">
        {{ $slot }}
    </div>
</div>
