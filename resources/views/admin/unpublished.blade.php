<x-app-layout>
    <x-admin-sidebar>

        <h2 class="text-2xl font-black text-ink mb-6">Berita Diturunkan</h2>

 

        @forelse($articles as $article)
            <div class="glass-card rounded-2xl p-5 mb-4 hover:shadow-card-hover transition-all">
                <h3 class="text-lg font-bold text-ink mb-1">{{ $article->title }}</h3>
                <p class="text-ink-muted text-xs mb-2">
                    {{ $article->user->name ?? 'Unknown' }} • Diturunkan: {{ $article->updated_at->format('d M Y H:i') }}
                </p>
                <p class="text-ink-light text-sm line-clamp-2 mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}</p>
                <div class="flex flex-wrap gap-2">
                    <form action="{{ route('admin.republish', $article->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition-colors" onclick="return confirm('Publish ulang?')">Publish Ulang</button>
                    </form>
                    <a href="{{ route('admin.edit', $article->id) }}" class="bg-surface hover:bg-surface-2 text-ink px-3 py-1.5 rounded-xl text-xs font-bold transition-colors border border-border-light">Edit</a>
                    <form action="{{ route('admin.destroy', $article->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition-colors" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="glass-card rounded-2xl p-12 text-center">
                <p class="text-ink-muted">Tidak ada berita yang diturunkan.</p>
            </div>
        @endforelse

    </x-admin-sidebar>
</x-app-layout>
