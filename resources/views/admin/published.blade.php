<x-app-layout>
    <x-admin-sidebar>

        <h2 class="text-2xl font-black text-ink mb-6">Berita Tayang</h2>

        <form action="{{ route('admin.bulkTrash') }}" method="POST" id="bulkTrashForm">
            @csrf
        </form>

        <div class="mb-6 flex items-center justify-between bg-surface-2 p-3 rounded-xl border border-border-light">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="checkbox" id="selectAll" class="w-5 h-5 rounded border-border-light text-ink focus:ring-ink transition-all">
                <span class="text-sm font-black text-ink">Pilih Semua</span>
            </label>
            <button type="submit" form="bulkTrashForm" id="bulkActionBtn" class="hidden items-center gap-2 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-4 py-2 rounded-xl text-xs uppercase tracking-wider font-black transition-colors border border-red-200 hover:border-red-500" onclick="return confirm('Pindahkan berita yang dipilih ke Trash?')">
                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Trash <span id="selectedCount">0</span>
            </button>
        </div>

        @forelse($articles as $categoryName => $categoryArticles)
            <div class="mb-12 last:mb-0">
                <div class="flex items-center gap-3 mb-6">
                    <h3 class="text-xl font-black text-ink">{{ $categoryName }}</h3>
                    <span class="bg-surface-2 text-ink-muted text-xs font-bold px-2.5 py-1 rounded-lg border border-border-light">{{ count($categoryArticles) }} Berita</span>
                    <div class="flex-1 h-px bg-border-light/50"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($categoryArticles as $article)
                        <div class="glass-card rounded-3xl overflow-hidden hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300 flex flex-col border border-white/40">
                            <!-- Image Section -->
                            <div class="relative h-48 w-full bg-surface-2">
                                <div class="absolute top-3 right-3 z-30">
                                    <input type="checkbox" name="ids[]" value="{{ $article->id }}" form="bulkTrashForm" class="article-checkbox w-6 h-6 rounded-md border-2 border-white text-ink focus:ring-ink transition-all shadow-md bg-white">
                                </div>
                                @if($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-ink-muted/50">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif

                                <!-- Tags Overlaid -->
                                <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                                    @if($article->category)
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-black shadow-sm border border-white/20 backdrop-blur-md" style="background: {{ $article->category->color }}dd; color: #fff;">{{ $article->category->name }}</span>
                                    @endif
                                </div>
                                
                                <div class="absolute top-3 right-3 flex flex-col gap-2 items-end">
                                    @if($article->featured)
                                        <span class="bg-emerald-500/90 backdrop-blur-md text-white px-2.5 py-1 rounded-lg text-[10px] uppercase tracking-wider font-black shadow-sm border border-emerald-400/50">★ Featured</span>
                                    @endif
                                    @if($article->spotlight)
                                        <span class="bg-purple-500/90 backdrop-blur-md text-white px-2.5 py-1 rounded-lg text-[10px] uppercase tracking-wider font-black shadow-sm border border-purple-400/50">✦ Spotlight</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-5 flex-1 flex flex-col">
                                <h4 class="text-lg font-black text-ink leading-tight mb-3 line-clamp-2" title="{{ $article->title }}">{{ $article->title }}</h4>
                                
                                <div class="flex items-center gap-3 mb-4 text-xs font-bold text-ink-muted">
                                    <div class="flex items-center gap-1.5 min-w-0">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        <span class="truncate">{{ $article->user->name ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 flex-shrink-0">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ $article->created_at->format('d M y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1 flex-shrink-0 text-red-500 ml-auto">
                                        <svg class="w-4 h-4 fill-current flex-shrink-0" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                        <span>{{ $article->likes_count ?? $article->likes()->count() }}</span>
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 flex flex-col gap-2 border-t border-border-light border-dashed">
                                    <!-- Action Buttons -->
                                    <div class="flex gap-2">
                                        <a href="{{ route('artikel.show', $article->id) }}" class="flex-1 text-center bg-ink hover:bg-ink-dark text-surface px-3 py-2 rounded-xl text-xs font-black transition-colors" title="Lihat">Lihat</a>
                                        <a href="{{ route('admin.edit', $article->id) }}" class="flex-1 text-center bg-surface hover:bg-surface-2 text-ink border border-border-light px-3 py-2 rounded-xl text-xs font-black transition-colors" title="Edit">Edit</a>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        @if(! $article->featured)
                                        <form action="{{ route('admin.setFeatured', $article->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button class="w-full bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white px-2 py-2 rounded-xl text-[10px] uppercase tracking-wider font-black transition-colors border border-emerald-200 hover:border-emerald-500" onclick="return confirm('Set sebagai featured?')">Featured</button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.toggleSpotlight', $article->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button class="w-full bg-purple-50 hover:bg-purple-500 text-purple-600 hover:text-white px-2 py-2 rounded-xl text-[10px] uppercase tracking-wider font-black transition-colors border border-purple-200 hover:border-purple-500">{{ $article->spotlight ? 'Unspot' : 'Spotlight' }}</button>
                                        </form>
                                        <form action="{{ route('admin.unpublish', $article->id) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button class="w-full bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white px-2 py-2 rounded-xl text-[10px] uppercase tracking-wider font-black transition-colors border border-amber-200 hover:border-amber-500" onclick="return confirm('Turunkan?')">Turunkan</button>
                                        </form>
                                        <form action="{{ route('admin.destroy', $article->id) }}" method="POST" class="flex-none">
                                            @csrf
                                            @method('DELETE')
                                            <button class="flex items-center justify-center w-full h-full bg-red-50 hover:bg-red-500 text-red-500 hover:text-white px-3 py-2 rounded-xl text-xs font-black transition-colors border border-red-200 hover:border-red-500" onclick="return confirm('Hapus article ini?')" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="glass-card rounded-3xl p-16 text-center border border-white/40 flex flex-col items-center justify-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-surface-2 border border-border-light mb-5 shadow-sm">
                    <svg class="w-10 h-10 text-ink-muted/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 4v6h6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14h6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 10h6"></path></svg>
                </div>
                <h3 class="text-xl font-black text-ink mb-2">Belum Ada Berita</h3>
                <p class="text-ink-muted max-w-sm mx-auto">Tidak ada satupun berita yang tayang saat ini. Berita yang sudah tayang akan muncul di sini.</p>
            </div>
        @endforelse

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('.article-checkbox');
                const bulkActionBtn = document.getElementById('bulkActionBtn');
                const selectedCount = document.getElementById('selectedCount');

                function updateBulkButton() {
                    const checkedList = document.querySelectorAll('.article-checkbox:checked');
                    if (checkedList.length > 0) {
                        bulkActionBtn.classList.remove('hidden');
                        bulkActionBtn.classList.add('flex');
                        selectedCount.textContent = checkedList.length;
                    } else {
                        bulkActionBtn.classList.add('hidden');
                        bulkActionBtn.classList.remove('flex');
                    }
                }

                if(selectAll) {
                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(cb => cb.checked = this.checked);
                        updateBulkButton();
                    });
                }

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        if (!this.checked) selectAll.checked = false;
                        if (document.querySelectorAll('.article-checkbox:checked').length === checkboxes.length) selectAll.checked = true;
                        updateBulkButton();
                    });
                });
            });
        </script>

    </x-admin-sidebar>
</x-app-layout>
