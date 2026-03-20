<x-app-layout>
    <x-admin-sidebar>

        <h2 class="text-3xl font-black text-ink mb-2">Overview</h2>
        <p class="text-ink-muted mb-8">Ringkasan aktivitas dan performa MadingPost.</p>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 bg-surface-2 gap-6 mb-10">
            <!-- Total Articles -->
            <div class="glass-card p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5L18.5 7H20"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-ink-muted uppercase tracking-wider mb-1">Berita Tayang</h3>
                    <div class="text-3xl font-black text-ink">{{ number_format($stats['published_articles']) }}</div>
                </div>
            </div>

            <!-- Pending Articles -->
            <div class="glass-card p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-ink-muted uppercase tracking-wider mb-1">Menunggu Review</h3>
                    <div class="text-3xl font-black text-ink">{{ number_format($stats['pending_articles']) }}</div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="glass-card p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-ink-muted uppercase tracking-wider mb-1">Total Penulis</h3>
                    <div class="text-3xl font-black text-ink">{{ number_format($stats['total_users']) }}</div>
                </div>
            </div>

            <!-- Total Views -->
            <div class="glass-card p-6 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-ink-muted uppercase tracking-wider mb-1">Total Views</h3>
                    <div class="text-3xl font-black text-ink">{{ number_format($stats['total_views']) }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <!-- Recent Articles -->
            <div class="glass-card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-ink">Berita Terbaru</h3>
                    <a href="{{ route('admin.published') }}" class="text-sm font-bold text-accent-dark hover:underline">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @forelse($recentArticles as $article)
                        <div class="flex items-start gap-4 p-3 bg-surface rounded-xl border border-border-light hover:border-ink/20 transition-all">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0 border border-border-light">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-surface-2 flex items-center justify-center text-ink-muted flex-shrink-0 border border-border-light">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-ink text-sm truncate">
                                    <a href="{{ route('artikel.show', $article->id) }}" class="hover:underline">{{ $article->title }}</a>
                                </h4>
                                <div class="flex items-center gap-2 mt-1text-xs font-semibold text-ink-muted">
                                    <span>{{ $article->user->name }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-2 text-xs">
                                    @if($article->status === 'approved')
                                        <span class="bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-lg font-bold border border-emerald-200">Tayang</span>
                                    @elseif($article->status === 'pending')
                                        <span class="bg-amber-50 text-amber-600 px-2.5 py-1 rounded-lg font-bold border border-amber-200">Pending</span>
                                    @else
                                        <span class="bg-red-50 text-red-600 px-2.5 py-1 rounded-lg font-bold border border-red-200">Diturunkan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-sm text-ink-muted font-medium bg-surface rounded-xl border border-dashed border-border-light">
                            Belum ada berita.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Popular Articles -->
            <div class="glass-card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-black text-ink">Berita Terpopuler</h3>
                </div>
                <div class="space-y-4">
                    @forelse($popularArticles as $index => $article)
                        <div class="flex items-center gap-4 p-3 bg-surface rounded-xl border border-border-light hover:border-ink/20 transition-all">
                            <div class="w-8 flex-shrink-0 text-center font-black text-xl {{ $index < 3 ? 'text-accent-dark' : 'text-ink-muted' }}">
                                #{{ $index + 1 }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-ink text-sm truncate">
                                    <a href="{{ route('artikel.show', $article->id) }}" class="hover:underline">{{ $article->title }}</a>
                                </h4>
                                <div class="flex items-center gap-4 mt-1">
                                    <span class="flex items-center gap-1 text-xs font-semibold text-ink-muted" title="Views">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        {{ number_format($article->view_count) }}
                                    </span>
                                    <span class="flex items-center gap-1 text-xs font-semibold text-ink-muted" title="Likes">
                                        <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                        {{ number_format($article->likes_count) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-sm text-ink-muted font-medium bg-surface rounded-xl border border-dashed border-border-light">
                            Belum ada statistik populer.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </x-admin-sidebar>
</x-app-layout>
