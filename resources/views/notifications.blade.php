<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                <h2 class="text-3xl font-black text-ink">Notifikasi</h2>
                
                @if($notifications->count() > 0 && $notifications->where('is_read', false)->count() > 0)
                    <form action="{{ route('notifications.markAllRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-accent-dark hover:text-ink transition-colors">
                            Tandai semua sudah dibaca
                        </button>
                    </form>
                @endif
            </div>

            <div class="glass-card shadow-glass border-none sm:rounded-2xl overflow-hidden">
                <div class="divide-y divide-border-light">
                    @forelse($notifications as $notification)
                        <div class="p-6 transition-colors hover:bg-surface-2/50 {{ $notification->is_read ? 'opacity-70' : 'bg-surface-2' }}">
                            <div class="flex items-start gap-4">
                                <!-- Icon based on type -->
                                <div class="flex-shrink-0 mt-1">
                                    @if($notification->type === 'article_approved')
                                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    @elseif($notification->type === 'article_rejected' || $notification->type === 'article_unpublished')
                                        <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </div>
                                    @elseif($notification->type === 'new_like')
                                        <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-surface text-ink flex items-center justify-center border border-border-light">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-ink {{ !$notification->is_read ? 'font-bold' : '' }}">
                                        {{ $notification->message }}
                                    </p>
                                    <p class="text-xs text-ink-muted mt-1 font-semibold">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                    
                                    @if($notification->link)
                                        <div class="mt-3 flex gap-3 items-center">
                                            @if(!$notification->is_read)
                                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs font-bold text-white bg-ink hover:bg-ink-light px-3 py-1.5 rounded-lg transition-colors">
                                                        Buka & Tandai Dibaca
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ $notification->link }}" class="text-xs font-bold text-ink hover:text-accent-dark bg-surface px-3 py-1.5 rounded-lg border border-border-light transition-colors">
                                                    Lihat
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                
                                @if(!$notification->is_read && !$notification->link)
                                    <div class="flex-shrink-0">
                                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-xs font-bold text-ink-muted hover:text-ink transition-colors">
                                                Tandai Dibaca
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="w-16 h-16 rounded-full bg-surface-2 flex items-center justify-center mx-auto mb-4 border border-border-light text-ink-muted">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            </div>
                            <h3 class="text-lg font-bold text-ink mb-1">Belum ada notifikasi</h3>
                            <p class="text-sm text-ink-muted">Notifikasi terbaru akan muncul di sini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
