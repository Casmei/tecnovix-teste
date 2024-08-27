<a href="{{ route('books.store') }}" class="block p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex-grow motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div class="flex flex-col lg:flex-row">
        @if($book->image_path)
            <div class="flex-shrink-0">
                <!-- Definindo tamanhos consistentes para as imagens -->
                <img src="{{ $book->image_path }}" alt="{{ $book->title }}" class="w-full h-48 lg:w-48 lg:h-60 object-cover rounded-lg shadow-md">
            </div>
        @endif

        <div class="mt-4 lg:mt-0 lg:ml-6 flex-grow">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $book->title }}
            </h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Author:</span> {{ $book->author }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Year of publication:</span> {{ $book->year_of_publication }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">ISBN:</span> {{ $book->isbn }}
            </p>
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-h-20 overflow-hidden">
                {{ Str::limit($book->description, 150, '...') }}
            </p>
        </div>
    </div>
</a>
