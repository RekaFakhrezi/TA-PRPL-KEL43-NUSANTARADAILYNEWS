<x-app-layout>

    <div class="py-12 max-w-3xl mx-auto">

        <h2 class="text-2xl font-bold mb-6">
            Submit Berita
        </h2>

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <h1 class="text-red-600 text-xl">TES UPLOAD</h1>
                <label class="block font-semibold mb-2">Judul</label>
                <input type="text" name="title"
                       class="w-full border rounded p-2"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Isi Berita</label>
                <textarea name="content"
                          rows="6"
                          class="w-full border rounded p-2"
                          required></textarea>
                          
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-2">Upload Gambar</label>
                <input type="file" name="image" class="w-full border rounded p-2">
            </div>

            <button class="bg-blue-500 text-white px-6 py-2 rounded">
                Kirim Berita
            </button>

        </form>

    </div>

</x-app-layout>