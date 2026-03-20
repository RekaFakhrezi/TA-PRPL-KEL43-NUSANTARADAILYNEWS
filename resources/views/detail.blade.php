<x-app-layout>

    <!-- Hero Section with Image -->
    @if($article->image)
        <div class="relative w-full h-[450px] overflow-hidden">
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            <div class="hero-overlay absolute inset-0"></div>
        </div>
    @else
        <div class="h-32 bg-gradient-to-r from-surface-2 to-surface"></div>
    @endif

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Back Button -->
        <a href="{{ route('home') }}" class="inline-flex items-center text-ink-light hover:text-ink font-semibold mb-8 transition-colors duration-200 group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <!-- Category Badge -->
        @if($article->category)
            <span class="inline-block mb-4 px-3 py-1.5 rounded-xl text-xs font-bold border-2" style="background: {{ $article->category->color }}15; color: {{ $article->category->color }}; border-color: {{ $article->category->color }}40">
                {{ $article->category->name }}
            </span>
        @endif

        <!-- Article Title -->
        <h1 class="text-3xl md:text-5xl font-black text-ink mb-6 leading-tight">{{ $article->title }}</h1>

        <!-- Article Meta -->
        <div class="flex flex-wrap items-center gap-4 text-ink-light mb-8 pb-8 border-b border-border-light">
            @if($article->user)
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-ink flex items-center justify-center text-surface font-bold text-sm">
                        {{ strtoupper(substr($article->user->name, 0, 1)) }}
                    </div>
                    <p class="font-semibold text-ink text-sm">{{ $article->user->name }}</p>
                </div>
            @endif
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-ink-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="text-sm">{{ $article->created_at->format('d M Y') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-ink-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm">~{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} menit baca</span>
            </div>
        </div>

        <!-- Article Content -->
        <article class="mb-12">
            <div class="text-ink-light leading-relaxed text-lg prose prose-invert prose-lg max-w-none">
                {!! $article->content !!}
            </div>
        </article>

        <!-- Like Button -->
        <div class="flex items-center gap-4 mb-8 pb-8 border-b border-border-light">
            @auth
                <button id="likeBtn" onclick="toggleLike({{ $article->id }})" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border-2 {{ $article->isLikedBy(auth()->user()) ? 'bg-red-500 text-white border-red-500' : 'bg-card border-border-light text-ink-light hover:text-red-500 hover:border-red-300' }}">
                    <svg id="likeIcon" class="w-5 h-5" fill="{{ $article->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span id="likeText">{{ $article->isLikedBy(auth()->user()) ? 'Liked' : 'Like' }}</span>
                </button>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm bg-white/60 border-2 border-border-light text-ink-light hover:text-red-500 hover:border-red-300 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Like
                </a>
            @endauth
            <span id="likeCount" class="text-ink-light text-sm">
                <span class="text-red-500 font-bold">{{ $article->likes_count }}</span> orang menyukai artikel ini
            </span>
        </div>

        <!-- Share Section -->
        <div class="mb-8 pb-8 border-b border-border-light">
            <p class="text-ink font-bold mb-4">Bagikan artikel ini</p>
            <div class="flex gap-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-100 transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0C4.477 0 0 4.484 0 10.017c0 4.905 3.692 8.997 8.716 9.529v-6.992h-2.736V12.47h2.736V9.717c0-2.706 1.612-4.204 4.064-4.204 1.176 0 2.388.223 2.388.223v2.624h-1.346c-1.326 0-1.738.823-1.738 1.669v2.008h2.958l-.472 2.997h-2.486v6.992C16.308 19.014 20 15.013 20 10.017 20 4.484 15.523 0 10 0z"></path></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($article->title) }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-sky-50 text-sky-600 hover:bg-sky-100 border border-sky-100 transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M19 4.74a7.981 7.981 0 01-2.357.646 4.11 4.11 0 001.804-2.27 8.049 8.049 0 01-2.606.996 4.022 4.022 0 00-7.34 2.748c0 .316.036.623.106.917A11.414 11.414 0 012.557 2.61a4.02 4.02 0 001.245 5.369A3.976 3.976 0 012 7.73v.052a4.019 4.019 0 003.22 3.938 4.008 4.008 0 01-1.815.069 4.03 4.03 0 003.756 2.791A8.073 8.073 0 010 8.557a11.372 11.372 0 006.167 1.81c7.4 0 11.435-6.145 11.435-11.465 0-.175-.004-.348-.013-.52a8.151 8.151 0 002.007-2.084z"></path></svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); this.querySelector('span').textContent = 'Disalin!'; setTimeout(() => this.querySelector('span').textContent = 'Salin', 2000)" class="inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-card border border-border-light text-ink-light hover:bg-ink hover:text-surface transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    <span class="text-xs font-bold">Salin</span>
                </button>
            </div>
        </div>

        <!-- Author Card -->
        @if($article->user)
            <div class="glass-card-strong rounded-2xl p-6 mb-12">
                <h3 class="text-lg font-black text-ink mb-3">Tentang Penulis</h3>
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-xl bg-ink flex items-center justify-center text-surface text-2xl font-bold flex-shrink-0">
                        {{ strtoupper(substr($article->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-ink">{{ $article->user->name }}</h4>
                        <p class="text-ink-light text-sm mt-1">Kontributor di Nusantara Post</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Comments Section -->
        <div class="mb-16" id="comments">
            <h3 class="text-2xl font-black text-ink mb-8 flex items-center gap-3">
                Komentar 
                <span class="bg-surface-2 text-ink-muted text-sm px-3 py-1 rounded-full border border-border-light">{{ $article->comments()->count() }}</span>
            </h3>

            @auth
                <!-- Comment Form -->
                <div class="mb-10 flex gap-4">
                    <div class="flex-shrink-0 hidden sm:block">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-10 h-10 rounded-full object-cover border border-border-light">
                        @else
                            <div class="w-10 h-10 rounded-full bg-surface-2 flex items-center justify-center text-ink-muted font-bold text-sm border border-border-light">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <form action="{{ route('comments.store', $article->id) }}" method="POST">
                            @csrf
                            <textarea name="content" rows="3" class="input-light w-full p-4 text-sm resize-none mb-3" placeholder="Tulis komentar Anda..." required></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="brutal-btn px-6 py-2.5 text-sm">Beri Komentar</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="mb-10 p-6 bg-surface-2 rounded-2xl border border-border-light text-center">
                    <p class="text-ink-muted mb-4 font-semibold">Silakan masuk ke akun Anda untuk ikut berdiskusi.</p>
                    <a href="{{ route('login') }}" class="inline-block bg-ink text-surface px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-ink-light transition-colors">Masuk</a>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-6">
                @foreach($article->comments()->whereNull('parent_id')->latest()->get() as $comment)
                    <div class="flex gap-4" id="comment-{{ $comment->id }}">
                        <div class="flex-shrink-0">
                            @if($comment->user->avatar)
                                <img src="{{ asset('storage/' . $comment->user->avatar) }}" class="w-10 h-10 rounded-full object-cover border border-border-light">
                            @else
                                <div class="w-10 h-10 rounded-full bg-surface-2 flex items-center justify-center text-ink-muted font-bold text-sm border border-border-light">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="glass-card p-4 rounded-tl-none relative group transition-colors hover:border-border">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-ink text-sm">{{ $comment->user->name }}</h4>
                                        @if($comment->user_id === $article->user_id)
                                            <span class="bg-accent-light/30 text-accent-dark text-[10px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">Penulis</span>
                                        @endif
                                        <span class="text-xs text-ink-muted font-medium">&bull; {{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    @auth
                                        @if(auth()->id() === $comment->user_id || auth()->user()->is_admin)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-bold transition-colors">Hapus</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                                <div class="text-ink text-sm leading-relaxed prose-sm">
                                    {!! nl2br(e($comment->content)) !!}
                                </div>
                                
                                @auth
                                    <div class="mt-3">
                                        <button onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')" class="text-xs font-bold text-ink-muted hover:text-ink transition-colors flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                            Balas
                                        </button>
                                    </div>
                                    <!-- Reply Form -->
                                    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store', $article->id) }}" method="POST" class="hidden mt-3">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <div class="flex gap-2">
                                            <input type="text" name="content" class="input-light w-full px-3 py-2 text-sm" placeholder="Balas komentar {{ $comment->user->name }}..." required>
                                            <button type="submit" class="bg-ink text-surface px-4 py-2 rounded-xl font-bold text-sm hover:bg-ink-light transition-colors">Kirim</button>
                                        </div>
                                    </form>
                                @endauth
                            </div>

                            <!-- Replies -->
                            @if($comment->replies->count() > 0)
                                <div class="mt-4 space-y-4">
                                    @foreach($comment->replies as $reply)
                                        <div class="flex gap-3" id="comment-{{ $reply->id }}">
                                            <div class="flex-shrink-0">
                                                @if($reply->user->avatar)
                                                    <img src="{{ asset('storage/' . $reply->user->avatar) }}" class="w-8 h-8 rounded-full object-cover border border-border-light">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-surface-2 flex items-center justify-center text-ink-muted font-bold text-xs border border-border-light">
                                                        {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="glass-card p-3.5 rounded-tl-none relative group bg-surface/50 border-border-light shadow-sm transition-colors hover:border-border">
                                                    <div class="flex items-center justify-between mb-1.5">
                                                        <div class="flex items-center gap-2">
                                                            <h4 class="font-bold text-ink text-sm">{{ $reply->user->name }}</h4>
                                                            @if($reply->user_id === $article->user_id)
                                                                <span class="bg-accent-light/30 text-accent-dark text-[10px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">Penulis</span>
                                                            @endif
                                                            <span class="text-xs text-ink-muted font-medium">&bull; {{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        
                                                        @auth
                                                            @if(auth()->id() === $reply->user_id || auth()->user()->is_admin)
                                                                <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus balasan ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-bold transition-colors">Hapus</button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                    <div class="text-ink text-sm leading-relaxed prose-sm">
                                                        {!! nl2br(e($reply->content)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                
                @if($article->comments()->whereNull('parent_id')->count() === 0)
                    <div class="text-center py-10 bg-surface-2 rounded-2xl border border-dashed border-border-light text-ink-muted">
                        <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <p class="font-medium text-sm">Belum ada komentar. Jadilah yang pertama!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Articles -->
        @php
            $relatedQuery = \App\Models\Article::where('id', '!=', $article->id)->where('status', 'approved');
            if ($article->category_id) {
                $relatedQuery->where('category_id', $article->category_id);
            }
            $relatedArticles = $relatedQuery->latest()->limit(3)->get();
            if ($relatedArticles->count() < 3 && $article->category_id) {
                $moreIds = $relatedArticles->pluck('id')->push($article->id)->toArray();
                $more = \App\Models\Article::whereNotIn('id', $moreIds)->where('status', 'approved')->latest()->limit(3 - $relatedArticles->count())->get();
                $relatedArticles = $relatedArticles->merge($more);
            }
        @endphp

        @if($relatedArticles->count() > 0)
            <div>
                <h3 class="text-2xl font-black text-ink mb-6">Artikel Terkait</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('artikel.show', $related->id) }}" class="card-hover glass-card rounded-2xl overflow-hidden group">
                            @if($related->image)
                                <div class="overflow-hidden h-48">
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-surface-2 to-white"></div>
                            @endif
                            <div class="p-4">
                                <h4 class="font-bold text-ink group-hover:text-accent-dark transition-colors line-clamp-2">{{ $related->title }}</h4>
                                <p class="text-xs text-ink-muted mt-2">{{ $related->created_at->format('d M Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    <!-- Like Toggle JS -->
    <script>
        function toggleLike(articleId) {
            fetch(`/artikel/${articleId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(r => r.json())
            .then(data => {
                const btn = document.getElementById('likeBtn');
                const icon = document.getElementById('likeIcon');
                const text = document.getElementById('likeText');
                const count = document.getElementById('likeCount');
                
                if (data.liked) {
                    btn.className = 'inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border-2 bg-red-500 text-white border-red-500';
                    icon.setAttribute('fill', 'currentColor');
                    text.textContent = 'Liked';
                } else {
                    btn.className = 'inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-bold text-sm transition-all border-2 bg-white/60 border-border-light text-ink-light hover:text-red-500 hover:border-red-300';
                    icon.setAttribute('fill', 'none');
                    text.textContent = 'Like';
                }
                count.innerHTML = `<span class="text-red-500 font-bold">${data.count}</span> orang menyukai artikel ini`;
            });
        }
    </script>

</x-app-layout>