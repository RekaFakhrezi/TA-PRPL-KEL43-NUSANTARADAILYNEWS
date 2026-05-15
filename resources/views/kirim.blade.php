<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <div class="max-w-2xl mx-auto px-4 py-12">

        <h2 class="text-3xl font-black text-ink mb-2">Kirim Berita Warga</h2>
        <p class="text-ink-light mb-8">Bagikan berita dari lingkungan Anda untuk dibaca oleh seluruh nusantara.</p>

        @if ($errors->any())
            <div class="bg-red-50 border-2 border-red-200 text-red-700 p-4 rounded-xl mb-6">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" id="submitForm" 
              class="glass-card-strong rounded-2xl p-8 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-ink mb-2">Judul Berita</label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       class="input-light" placeholder="Tulis judul berita yang menarik...">
            </div>

            <div>
                <label class="block text-sm font-bold text-ink mb-2">Kategori</label>
                <select name="category_id" class="input-light">
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-ink mb-2">Isi Berita</label>
                <textarea name="content" id="contentEditor" rows="12" 
                          class="input-light resize-none" 
                          placeholder="Tulis isi berita secara lengkap dan detail...">{{ old('content') }}</textarea>
            </div>

            <div class="bg-surface/60 rounded-xl p-5 border border-border-light">
                <label class="block text-sm font-bold text-ink mb-1">Gambar Berita (Opsional)</label>
                <p class="text-xs text-ink-muted mb-3">Format: JPG, JPEG, PNG | Maks: 2MB | Optimal: 800x400px</p>
                <input type="file" id="imageInput" accept="image/jpeg,image/png,image/jpg" 
                       class="text-sm text-ink-light file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-2 file:border-ink file:text-sm file:font-bold file:bg-ink file:text-surface hover:file:bg-ink/80 file:cursor-pointer file:transition-all">
                <input type="hidden" name="cropped_image" id="croppedImage">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full brutal-btn justify-center py-3.5 text-base rounded-xl">
                    Kirim Berita
                </button>
            </div>
        </form>

    </div>

    <!-- Image Cropper Modal -->
    <div id="cropperModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 p-4 flex items-center justify-center">
        <div class="glass-card-strong max-w-3xl w-full rounded-2xl p-6">
            <h3 class="text-xl font-black text-ink mb-1">Potong & Atur Gambar</h3>
            <p class="text-sm text-ink-light mb-4">Ukuran optimal: <strong class="text-ink">800x400px</strong> (Rasio 2:1)</p>
            <div class="w-full h-[50vh] bg-surface rounded-xl overflow-hidden border border-border-light flex items-center justify-center">
                <img id="cropImage" class="block max-w-full max-h-full">
            </div>
            <div class="mt-5 flex justify-end gap-3">
                <button type="button" id="cancelCropBtn" class="brutal-btn-outline px-5 py-2.5 rounded-xl text-sm">Batal</button>
                <button type="button" id="cropBtn" class="brutal-btn px-5 py-2.5 rounded-xl text-sm">Crop Gambar</button>
            </div>
        </div>
    </div>

    <script>
        // Editor configurations removed        // Image Cropper
        let cropper = null;
        const imageInput = document.getElementById('imageInput');
        const cropImage = document.getElementById('cropImage');
        const cropperModal = document.getElementById('cropperModal');
        const croppedImageInput = document.getElementById('croppedImage');
        const cropBtn = document.getElementById('cropBtn');
        const cancelCropBtn = document.getElementById('cancelCropBtn');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    cropImage.src = event.target.result;
                    // Ensure image takes full width inside container for cropper
                    cropImage.style.display = 'block';
                    cropImage.style.maxWidth = '100%';
                    
                    cropperModal.classList.remove('hidden');
                    if (cropper) cropper.destroy();
                    cropper = new Cropper(cropImage, { 
                        aspectRatio: 2/1, 
                        autoCropArea: 0.9, 
                        viewMode: 1,
                        background: false,
                        zoomable: true,
                        scalable: false,
                        responsive: true 
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        cropBtn.addEventListener('click', function() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({ maxWidth: 800, maxHeight: 400 });
                canvas.toBlob(function(blob) {
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        croppedImageInput.value = reader.result;
                        cropperModal.classList.add('hidden');
                        alert('Gambar berhasil di-crop. Klik "Kirim Berita" untuk melanjutkan.');
                    };
                    reader.readAsDataURL(blob);
                });
            }
        });

        cancelCropBtn.addEventListener('click', function() {
            cropperModal.classList.add('hidden');
            imageInput.value = '';
            croppedImageInput.value = '';
            if (cropper) { cropper.destroy(); cropper = null; }
        });



</x-app-layout>
