<section class="space-y-6">
    <header>
        <h2 class="text-xl font-black text-red-600">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-ink-muted">
            Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen. Pastikan Anda telah mengunduh data apa pun sebelum melanjutkan tindakan ini.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-5 py-2.5 rounded-xl font-bold text-sm transition-colors"
    >Hapus Akun Permanen</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-surface rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-ink">
                Apakah Anda benar-benar yakin ingin menghapus akun?
            </h2>

            <p class="mt-2 text-sm text-ink-muted">
                Tindakan ini tidak bisa dibatalkan. Masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun ini secara permanen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full input-light"
                    placeholder="Masukkan password Anda..."
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-surface-2 hover:bg-border-light text-ink border border-border-light px-5 py-2.5 rounded-xl font-bold text-sm transition-colors">
                    Batal
                </button>

                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition-colors">
                    Hapus Akun Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>
