<x-app-layout>

    <!-- Hero Section: Featured Article -->
    @if(!empty($featured))
        <section class="relative w-full h-[500px] overflow-hidden group">
            @if($featured->image)
                <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            @else
                <div class="w-full h-full bg-gradient-to-br from-surface-2 to-surface"></div>
            @endif
            <div class="hero-overlay absolute inset-0"></div>
            <div class="absolute inset-0 flex items-end">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 w-full">
                    <span class="badge-dark inline-block mb-4">LIPUTAN KHUSUS</span>
                    <h1 class="text-3xl md:text-5xl font-black text-ink mb-4 leading-tight max-w-2xl">{{ $featured->title }}</h1>
                    <p class="text-ink-light text-base md:text-lg mb-6 max-w-xl line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($featured->content), 200) }}</p>
                    <a href="{{ route('artikel.show', $featured->id) }}" class="brutal-btn-accent inline-flex items-center gap-2 px-6 py-3 rounded-xl font-bold border-2 border-ink transition-all hover:translate-x-[-2px] hover:translate-y-[-2px] hover:shadow-brutal">
                        Baca Laporan Lengkap
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Search, Sort, Category Toolbar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form method="GET" action="{{ route('home') }}" id="filterForm">
            <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center justify-between mb-6">
                <!-- Search -->
                <div class="relative w-full lg:w-96">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-ink-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full bg-card backdrop-blur-sm border-2 border-border-light rounded-xl pl-12 pr-4 py-3 text-sm text-ink placeholder-ink-muted focus:outline-none focus:border-ink focus:ring-0 transition-all">
                </div>

                <!-- Sort Buttons -->
                <div class="flex gap-2 flex-wrap">
                    @php $currentSort = request('sort', 'terbaru'); @endphp
                    @foreach(['terbaru' => 'Terbaru', 'terlama' => 'Terlama', 'terpopuler' => 'Terpopuler'] as $key => $label)
                        <button type="submit" name="sort" value="{{ $key }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all border-2 {{ $currentSort === $key ? 'bg-ink text-surface border-ink' : 'bg-card border-border-light text-ink-light hover:text-ink hover:border-ink' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Category Tabs -->
            <div class="flex gap-2 overflow-x-auto pb-2 mb-2">
                <a href="{{ route('home', array_merge(request()->except('category', 'page'))) }}" class="px-4 py-2 rounded-xl text-sm font-bold whitespace-nowrap transition-all border-2 {{ !request('category') ? 'bg-ink text-surface border-ink' : 'bg-card border-border-light text-ink-light hover:text-ink hover:border-ink' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('home', array_merge(request()->except('page'), ['category' => $cat->id])) }}" class="px-4 py-2 rounded-xl text-sm font-bold whitespace-nowrap transition-all border-2 {{ request('category') == $cat->id ? 'text-surface border-ink' : 'bg-card border-border-light text-ink-light hover:text-ink hover:border-ink' }}" style="{{ request('category') == $cat->id ? 'background:' . $cat->color . '; border-color:' . $cat->color : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </form>
    </div>

    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-10 gap-8">

            <!-- Left: Article Grid (7 cols) -->
            <div class="lg:col-span-7">
                <h2 class="text-2xl font-black text-ink mb-6">
                    @if(request('search'))
                        Hasil pencarian "{{ request('search') }}"
                    @elseif(request('category'))
                        {{ $categories->find(request('category'))->name ?? 'Artikel' }}
                    @else
                        Artikel Pilihan
                    @endif
                </h2>

                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($articles as $article)
                            <a href="{{ route('artikel.show', $article->id) }}" class="card-hover glass-card rounded-2xl overflow-hidden group">
                                @if($article->image)
                                    <div class="overflow-hidden h-48">
                                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    </div>
                                @else
                                    <div class="h-48 bg-gradient-to-br from-surface-2 to-surface flex items-center justify-center">
                                        <svg class="w-12 h-12 text-ink-muted/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif
                                <div class="p-5">
                                    @if($article->category)
                                        <span class="inline-block mb-3 px-2.5 py-1 rounded-lg text-xs font-bold border" style="background: {{ $article->category->color }}15; color: {{ $article->category->color }}; border-color: {{ $article->category->color }}30">
                                            {{ $article->category->name }}
                                        </span>
                                    @endif
                                    <h3 class="text-lg font-bold text-ink mb-2 line-clamp-2 group-hover:text-accent-dark transition-colors">{{ $article->title }}</h3>
                                    <p class="text-ink-light text-sm line-clamp-2 mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}</p>
                                    <div class="flex items-center justify-between text-xs text-ink-muted">
                                        <div class="flex items-center gap-3">
                                            <span>{{ $article->created_at->format('d M Y') }}</span>
                                            <span>•</span>
                                            <span>~{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} mnt</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-red-400">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                            <span>{{ $article->likes_count ?? $article->likes()->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $articles->links() }}
                    </div>
                @else
                    <div class="glass-card rounded-2xl p-12 text-center">
                        <svg class="w-16 h-16 text-ink-muted/30 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <p class="text-ink-muted text-lg">Tidak ada artikel ditemukan.</p>
                    </div>
                @endif
            </div>

            <!-- Right: Sidebar (3 cols) -->
            <aside class="lg:col-span-3 space-y-6">

                <!-- Artikel Terpopuler -->
                <div class="glass-card-strong rounded-2xl p-6">
                    <div class="flex items-center gap-2 mb-5">
                        <span class="text-xl">🔥</span>
                        <h4 class="text-lg font-black text-ink">Terpopuler Minggu Ini</h4>
                    </div>
                    @forelse($popularArticles as $index => $pop)
                        <a href="{{ route('artikel.show', $pop->id) }}" class="flex gap-3 py-3 group {{ !$loop->last ? 'border-b border-border-light' : '' }}">
                            <span class="trending-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="flex-1 min-w-0">
                                <h5 class="text-sm font-semibold text-ink group-hover:text-accent-dark transition-colors line-clamp-2">{{ $pop->title }}</h5>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-red-400 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                        {{ $pop->likes_count }}
                                    </span>
                                    <span class="text-xs text-ink-muted">{{ $pop->created_at->format('d M') }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-ink-muted text-sm">Belum ada data.</p>
                    @endforelse
                </div>

            </aside>
        </div>

        <!-- Category Sections -->
        @if(!request('search') && !request('category') && !request('sort'))
            @foreach($categoryArticles as $catData)
                <div class="mt-12">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1.5 h-8 rounded-full" style="background: {{ $catData['category']->color }}"></div>
                        <h2 class="text-2xl font-black text-ink">{{ $catData['category']->name }}</h2>
                        <a href="{{ route('home', ['category' => $catData['category']->id]) }}" class="ml-auto text-sm font-bold text-ink-light hover:text-ink transition-colors">Lihat Semua →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($catData['articles'] as $catArticle)
                            <a href="{{ route('artikel.show', $catArticle->id) }}" class="card-hover glass-card rounded-2xl overflow-hidden group">
                                @if($catArticle->image)
                                    <div class="overflow-hidden h-36">
                                        <img src="{{ $catArticle->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-sm font-bold text-ink line-clamp-2 group-hover:text-accent-dark transition-colors">{{ $catArticle->title }}</h3>
                                    <p class="text-xs text-ink-muted mt-2">{{ $catArticle->created_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</x-app-layout>
