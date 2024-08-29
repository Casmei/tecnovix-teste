<form action="{{route('books.store')}}" id="create-book" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none">
    @csrf
    <h1 class="text-4xl font-medium mb-4 text-white">Book detail</h1>

    <label for="isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ISBN</label>
    <div class="flex">
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z"/>
                </svg>
            </div>
            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" id="ispn" class="ps-10 p-2.5 mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white" placeholder="Search isbn number..." />
        </div>
        <button type="button" onclick="searchISBN()" class="px-6 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </div>
    @error('isbn')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" id="title" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
            <input type="text" name="author" value="{{ old('author') }}" id="author" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">
            @error('author')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
        <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">{{ old('description') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:mb-6 mb-4">
        <div>
            <label for="year_of_publication" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year of publication</label>
            <input type="number" name="year_of_publication" value="{{ old('year_of_publication') }}" id="year_of_publication" min="0" max="9999" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white">
            @error('year_of_publication')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
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
    </div>

    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

    <h1 class="text-4xl font-medium mb-4 text-white">Author address detail</h1>

    <label for="zip_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Zip code</label>

    <div class="flex">
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                </svg>
            </div>

            <input type="text" id="zip_code" name="zip_code" value="{{old('zip_code')}}" class="ps-10 p-2.5 mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-white" placeholder="Search zip code number..." />
        </div>
        <button onclick="searchZipCode()" class="px-6 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </div>
    @error('zip_code')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="street" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street</label>
            <input type="text" name="street" value="{{ old('street') }}" id="street" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-gray-100">
            @error('street')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="complement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Complement</label>
            <input type="text" name="complement" value="{{ old('complement') }}" id="complement" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-gray-100">
            @error('complement')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="neighborhood" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Neighborhood</label>
            <input type="text" name="neighborhood" value="{{ old('neighborhood') }}" id="neighborhood" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-gray-100">
            @error('neighborhood')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
                <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unit</label>
                <input type="text" name="unit" value="{{ old('unit') }}" id="unit" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-gray-100">
                @error('unit')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                <input type="text" name="city" value="{{ old('city') }}" id="city" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-gray-100">
                @error('city')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
        </div>

        <div class="mb-4">
                <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                <input type="text" name="state" value="{{ old('state') }}" id="state" class="mt-1 block w-full px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-gray-100">
                @error('state')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
        </div>
    </div>

    <div class="text-right">
        <button type="submit" id="submit-button" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow hover:bg-red-600 transition duration-150">Save book</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $('#isbn').inputmask('**********');
        $('#zip_code').inputmask('99999-999');
    });

    function showToast(message, type = 'error') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 p-4 rounded-md text-white ${type === 'error' ? 'bg-red-500' : 'bg-green-500'} shadow-lg transition-opacity duration-500`;
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 500);
        }, 5000);
    }

    function searchISBN() {
        event.preventDefault();

        const isbn = document.getElementById('isbn').value;

        if (isbn) {
            fetch(`/api/books/auto-complete?isbn=${isbn}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    showToast(data.message);
                } else {
                    document.getElementById('title').value = data.volumeInfo.title || '';
                    document.getElementById('author').value = data.volumeInfo.authors ? data.volumeInfo.authors[0] : '';
                    document.getElementById('description').value = data.volumeInfo.description || '';
                    document.getElementById('year_of_publication').value = data.volumeInfo.publishedDate ? data.volumeInfo.publishedDate.substring(0, 4) : '';

                    showToast('Book information loaded successfully!', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while fetching book information.');
            });
        }
    };

    function searchZipCode() {
        event.preventDefault();

        const zip_code = $('#zip_code').inputmask('unmaskedvalue');

        if (zip_code) {
            fetch(`/api/addresses?zip_code=${zip_code}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    showToast(data.message);
                } else {
                    document.getElementById('street').value = data.street || '';
                    document.getElementById('complement').value = data.complement || '';
                    document.getElementById('unit').value = data.unit || '';
                    document.getElementById('city').value = data.city || '';
                    document.getElementById('state').value = data.state || '';
                    document.getElementById('neighborhood').value = data.neighborhood || '';

                    showToast('Zip code information loaded successfully!', 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred while fetching zip code information.');
            });
        }
    }

    document.getElementById('ispn').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            searchISBN();
        }
    });

    document.getElementById('zip_code').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            searchZipCode();
        }
    });
</script>
