<x-app-layout>
    <x-admin-sidebar>
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-ink">Manajemen Kategori</h2>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-category')" class="brutal-btn px-5 py-2.5 rounded-xl text-sm">
                + Tambah Kategori
            </button>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-2 border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 font-bold flex justify-between items-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-2 border-b border-border-light text-ink">
                        <th class="p-4 font-black">ID</th>
                        <th class="p-4 font-black">Nama Kategori</th>
                        <th class="p-4 font-black">Slug</th>
                        <th class="p-4 font-black">Warna</th>
                        <th class="p-4 font-black text-center">Total Berita</th>
                        <th class="p-4 font-black text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($categories as $category)
                        <tr class="border-b border-border-light/50 hover:bg-surface-2/50 transition-colors">
                            <td class="p-4 font-bold text-ink-muted">#{{ $category->id }}</td>
                            <td class="p-4">
                                <form action="{{ route('admin.categories.update', $category) }}" method="POST" id="form-edit-{{ $category->id }}">
                                    @csrf
                                    @method('PUT')
                                </form>
                                <input type="text" form="form-edit-{{ $category->id }}" name="name" value="{{ $category->name }}" class="border-border-light rounded-lg text-sm px-3 py-1.5 w-full focus:border-ink focus:ring-ink/10 bg-white/50">
                            </td>
                            <td class="p-4 font-mono text-xs text-ink-muted">{{ $category->slug }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <input type="color" form="form-edit-{{ $category->id }}" name="color" value="{{ $category->color }}" class="w-8 h-8 rounded cursor-pointer border-0 p-0 bg-transparent">
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="bg-surface-2 text-ink font-bold px-3 py-1 rounded-full border border-border-light">{{ $category->articles_count }}</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <button form="form-edit-{{ $category->id }}" type="submit" class="bg-surface-2 text-ink hover:bg-white px-3 py-1.5 rounded-lg text-xs font-bold border border-border-light transition-colors">Simpan</button>
                                    
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Pastikan tidak ada berita di dalamnya.')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-bold border border-red-200 transition-colors">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-ink-muted font-medium">
                                Belum ada kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create Category Modal -->
        <x-modal name="create-category" :show="$errors->has('name') || $errors->has('color')" focusable>
            <form method="post" action="{{ route('admin.categories.store') }}" class="p-6 bg-surface rounded-2xl">
                @csrf

                <h2 class="text-xl font-black text-ink mb-6">
                    Tambah Kategori Baru
                </h2>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="name" value="Nama Kategori" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full input-light" placeholder="Misal: Politik" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="color" value="Warna Kategori (Pilih warna Badge)" />
                        <div class="flex items-center gap-3 mt-1">
                            <input type="color" id="color" name="color" value="#000000" class="w-12 h-12 rounded-lg cursor-pointer border-2 border-border-light p-1 bg-surface-2">
                        </div>
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')" class="bg-surface-2 hover:bg-border-light text-ink border border-border-light px-5 py-2.5 rounded-xl font-bold text-sm transition-colors">
                        Batal
                    </button>

                    <button type="submit" class="bg-ink hover:bg-ink/80 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-colors border-2 border-transparent">
                        Tambah Kategori
                    </button>
                </div>
            </form>
        </x-modal>

    </x-admin-sidebar>
</x-app-layout>
