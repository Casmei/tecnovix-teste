<div class="flex justify-between">
    <x-back-button :route="route('books.list')"/>
</div>
<div class="flex flex-col lg:flex-row lg:space-x-6 space-y-6 lg:space-y-0">
    <div class="w-full lg:w-2/3 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex-grow motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="flex flex-col lg:flex-row">
            @if($book->image_path)
                <div class="flex-shrink-0">
                    <img src="{{ $book->image_path }}" alt="{{ $book->title }}" class="w-full object-cover rounded-lg shadow-md">
                </div>
            @else
                <div class="flex items-center justify-center w-full h-48 lg:w-92 bg-gray-300 rounded sm:w-96 dark:bg-gray-700">
                    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                    </svg>
                </div>
            @endif

            <div class="mt-4 lg:mt-0 lg:ml-6 flex-grow">
                <form action="{{route('books.update', ['book' => $book->id])}}" id="update-book" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PATCH')

                    <h1 class="text-4xl font-medium mb-4 text-white">{{$book->title}}</h1>

                    <label for="isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ISBN</label>
                    <div class="relative w-full mb-4">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z"/>
                            </svg>
                        </div>
                        <input type="text"  name="isbn" id="isbn" value="{{$book->isbn}}" readonly id="ispn" class="cursor-not-allowed text-gray-500 ps-10 p-2.5 mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600" placeholder="Search isbn number..." />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" value="{{ $book->title }}" id="title" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                            <input type="text" name="author" value="{{ $book->author->name }}" id="author" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">
                            @error('author')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">{{$book->description }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="year_of_publication" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year of publication</label>
                        <input type="number" name="year_of_publication" value="{{ $book->year_of_publication }}" id="year_of_publication" min="0" max="9999" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">
                        @error('year_of_publication')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="file-input" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                        <input type="file" accept=".png, .jpg, .jpeg" name="image_path" id="file-input" class="mt-1 block w-full text-sm focus:z-10 focus:border-blue-500disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400
                            file:bg-gray-50 file:border-0
                            file:me-4
                            file:py-[10px] file:px-4
                            dark:file:bg-gray-700 dark:file:text-neutral-400
                            bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white
                            ">
                        @error('image_path')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" id="submit-button" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow hover:bg-red-600 transition duration-150">Update book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
