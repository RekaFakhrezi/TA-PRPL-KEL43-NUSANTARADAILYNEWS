<x-app-layout>

    <div class="py-12 max-w-4xl mx-auto">

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}"
                class="w-full mb-6 rounded">
        @endif

        <h1 class="text-3xl font-bold mb-4">
            {{ $article->title }}
        </h1>

        <p class="text-gray-500 mb-6">
            {{ $article->created_at->format('d M Y') }}
        </p>

        <div class="leading-relaxed">
            {{ $article->content }}
        </div>

        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">
                ← Kembali
            </a>
        </div>

    </div>

</x-app-layout>