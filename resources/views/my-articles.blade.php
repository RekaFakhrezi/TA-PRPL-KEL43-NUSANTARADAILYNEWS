<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-black text-ink">Berita Saya</h2>
                <a href="{{ route('artikel.create') }}" class="brutal-btn px-5 py-2.5 rounded-xl text-sm">
                    + Tulis Berita
                </a>
            </div>

            <div class="bg-surface border-2 border-border-light rounded-2xl overflow-hidden shadow-brutal-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-2 border-b-2 border-border-light text-ink">
                                <th class="p-4 font-black">Judul Berita</th>
                                <th class="p-4 font-black">Kategori</th>
                                <th class="p-4 font-black">Status</th>
                                <th class="p-4 font-black">Statistik</th>
                                <th class="p-4 font-black text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                                <tr class="border-b border-border-light/50 hover:bg-surface-2/50 transition-colors">
                                    <td class="p-4">
                                        <div class="flex items-center gap-4">
                                            @if($article->image)
                                                <img src="{{ asset('storage/' . $article->image) }}" class="w-16 h-12 object-cover rounded-xl border border-border-light hidden sm:block">
                                            @endif
                                            <div>
                                                <h3 class="font-bold text-ink hover:text-accent-dark transition-colors">
                                                    @if($article->status === 'approved')
                                                        <a href="{{ route('artikel.show', $article->id) }}">{{ $article->title }}</a>
                                                    @else
                                                        {{ $article->title }}
                                                    @endif
                                                </h3>
                                                <p class="text-xs text-ink-muted mt-1">{{ $article->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        @if($article->category)
                                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold border" style="background: {{ $article->category->color }}15; color: {{ $article->category->color }}; border-color: {{ $article->category->color }}30">
                                                {{ $article->category->name }}
                                            </span>
                                        @else
                                            <span class="text-ink-muted text-sm">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if($article->status === 'approved')
                                            <span class="bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-lg text-xs font-bold border border-emerald-200">Tayang</span>
                                        @elseif($article->status === 'pending')
                                            <span class="bg-amber-50 text-amber-600 px-2.5 py-1 rounded-lg text-xs font-bold border border-amber-200">Menunggu</span>
                                        @elseif($article->status === 'unpublished')
                                            <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg text-xs font-bold border border-gray-300">Diturunkan</span>
                                        @elseif($article->status === 'trashed')
                                            <span class="bg-red-50 text-red-600 px-2.5 py-1 rounded-lg text-xs font-bold border border-red-200">{{ $article->trashed_reason === 'rejected' ? 'Ditolak' : 'Dihapus' }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-3 text-sm font-semibold text-ink-light">
                                            <span class="flex items-center gap-1" title="Views">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                {{ $article->view_count }}
                                            </span>
                                            <span class="flex items-center gap-1" title="Likes">
                                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                                {{ $article->likes_count }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            @if($article->status === 'pending' || $article->status === 'trashed' || $article->status === 'unpublished')
                                                <!-- To do: edit functionality for user can be added later, for now we let them delete -->
                                                <form action="{{ route('admin.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-bold border border-red-200 transition-colors">Hapus</button>
                                                </form>
                                            @elseif($article->status === 'approved')
                                                <a href="{{ route('artikel.show', $article->id) }}" class="bg-surface-2 text-ink hover:text-accent-dark px-3 py-1.5 rounded-lg text-xs font-bold border border-border-light transition-colors">Lihat</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-ink-muted">
                                        Kamu belum menulis berita apapun. <br>
                                        <a href="{{ route('artikel.create') }}" class="text-accent-dark font-bold hover:underline mt-2 inline-block">Mulai Menulis →</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-6">
                {{ $articles->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
