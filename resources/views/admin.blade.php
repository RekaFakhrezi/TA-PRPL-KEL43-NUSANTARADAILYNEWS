<x-app-layout>
    <x-admin-sidebar>

        <h2 class="text-2xl font-black text-ink mb-6">Verifikasi Berita</h2>

 

        @forelse($articles as $article)
            <div class="glass-card rounded-2xl p-5 mb-4 hover:shadow-card-hover transition-all">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-ink mb-1">{{ $article->title }}</h3>
                        <p class="text-ink-muted text-xs mb-2">
                            Oleh: {{ $article->user->name ?? 'Unknown' }} • {{ $article->created_at->format('d M Y H:i') }}
                            @if($article->category)
                                <span class="ml-2 px-2 py-0.5 rounded-lg text-xs font-bold border" style="background: {{ $article->category->color }}15; color: {{ $article->category->color }}; border-color: {{ $article->category->color }}30">
                                    {{ $article->category->name }}
                                </span>
                            @endif
                        </p>
                        <p class="text-ink-light text-sm line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}</p>
                    </div>
                    @if($article->image)
                        <img src="{{ $article->image_url }}" class="w-20 h-20 object-cover rounded-xl flex-shrink-0 border border-border-light">
                    @endif
                </div>
                <div class="flex flex-wrap gap-2 mt-4">
                    <a href="{{ route('artikel.show', $article->id) }}" class="text-ink-light hover:text-ink text-sm font-bold transition-colors">
                        Baca →
                    </a>
                    <a href="{{ route('admin.edit', $article->id) }}" class="bg-surface hover:bg-surface-2 text-ink px-3 py-1.5 rounded-xl text-xs font-bold transition-colors border border-border-light">Edit</a>
                    <form action="{{ route('admin.approve', $article->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition-colors">Approve</button>
                    </form>
                    <form action="{{ route('admin.reject', $article->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition-colors">Reject</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="glass-card rounded-2xl p-12 text-center">
                <svg class="w-12 h-12 text-ink-muted/30 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-ink-muted">Tidak ada berita pending.</p>
            </div>
        @endforelse

    </x-admin-sidebar>
</x-app-layout>
