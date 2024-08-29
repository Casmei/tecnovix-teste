<div class="flex justify-between">
    <x-back-button :route="route('books.list')"/>

    <div class="flex sm:space-x-4 space-x-2">
        <a href="{{route('books.edit', ['book' => $book->id])}}">
            <button type="button" class="text-white mb-4 flex items-center px-4 py-2 bg-blue-500 border border-blue-600 dark:bg-blue-700 dark:border-blue-800 font-semibold text-xs uppercase tracking-widest motion-safe:hover:scale-[1.01] focus:outline-none disabled:opacity-25 ease-in-out duration-150 via-transparent dark:ring-1 dark:ring-inset dark:ring-blue-500 rounded-lg shadow-2xl shadow-blue-500/20 dark:shadow-none flex-grow transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                Edit
            </button>
        </a>


        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                @csrf
                @method('DELETE')
            <button type="submit" class="text-white mb-4 flex items-center px-4 py-2 bg-red-500 border border-red-600 dark:bg-red-700 dark:border-red-800 font-semibold text-xs uppercase tracking-widest motion-safe:hover:scale-[1.01] focus:outline-none disabled:opacity-25 ease-in-out duration-150 via-transparent dark:ring-1 dark:ring-inset dark:ring-red-500 rounded-lg shadow-2xl shadow-red-500/20 dark:shadow-none flex-grow transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                Delete
            </button>
        </form>


    </div>
</div>
<div class="flex flex-col lg:flex-row lg:space-x-6 space-y-6 lg:space-y-0">
    <div class="w-full lg:w-2/3 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex-grow motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="flex flex-col lg:flex-row">
            @if($book->image_path)
                <div class="flex-shrink-0">
                    <img src="{{ $book->image_path }}" alt="{{ $book->title }}" class="w-full object-cover rounded-lg shadow-md">
                </div>
            @else
                <div class="flex items-center justify-center w-full h-48 lg:w-full bg-gray-300 rounded sm:w- dark:bg-gray-700">
                    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
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
                <p class="text-sm mt-2 text-gray-500 dark:text-gray-400">
                    <span class="font-medium">Added at:</span> {{ $book->created_at }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    <span class="font-medium">Updated at:</span> {{ $book->updated_at }}
                </p>
                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    {{$book->description}}
                </p>
            </div>
        </div>
    </div>

    @if (isset($book->author->address->zip_code))
        <div class="w-full lg:w-1/3 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex-grow motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="mt-4 lg:mt-0 lg:ml-6 flex-grow">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Author Address
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Zip code:</span> {{ $book->author->address->zip_code }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Street:</span> {{ $book->author->address->street }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Complement:</span> {{ $book->author->address->complement }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Unit:</span> {{ $book->author->address->unit }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">Neighborhood:</span> {{ $book->author->address->neighborhood }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">City:</span> {{ $book->author->address->city }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-medium">State:</span> {{ $book->author->address->state }}
                    </p>
                </div>
            </div>
        </div>
    @endif

</div>
