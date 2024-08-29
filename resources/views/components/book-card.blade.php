<a href="{{ route('books.show', ['book' => $book->id]) }}" class="block p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex-grow motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
    <div class="flex flex-col lg:flex-row">
        @if($book->image_path)
            <div class="flex-shrink-0">
                <img src="{{ $book->image_path }}" alt="{{ $book->title }}" class="w-full h-48 lg:w-48 lg:h-60 object-cover rounded-lg shadow-md">
            </div>

        @else
        <div class="flex items-center justify-center w-full h-48 lg:w-full   lg:h-60 bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
            <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
            </svg>
        </div>
        @endif

        <div class="mt-4 lg:mt-0 lg:ml-6 flex-grow">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $book->title }}
            </h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Author:</span> {{ $book->author->name }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">Year of publication:</span> {{ $book->year_of_publication }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                <span class="font-medium">ISBN:</span> {{ $book->isbn }}
            </p>
            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed max-h-20 overflow-hidden">
                {{ $limitDescription ? Str::limit($book->description, 150, '...') : $book->description}}
            </p>
        </div>
    </div>
</a>
