@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="fixed top-0 left-0 w-full bg-white dark:bg-gray-900 shadow-md z-10 p-6">
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0">
                <form action="{{ route('books.list') }}" method="GET" class="flex items-center w-full sm:w-auto">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search books..." class="px-3 py-2 w-full sm:w-auto bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-white">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 text-white font-semibold shadow transition duration-150">Search</button>
                </form>

                <a href="{{ route('books.create') }}" class="w-full sm:w-auto px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow hover:bg-green-600 transition duration-150">New Book</a>
            </div>
        </div>

        <div class="sm:pt-20 pt-32">
            @if ($books->isEmpty())
                <div class="text-center py-4">
                    @if (request('query'))
                        <p class="text-gray-700 dark:text-gray-200">No books found for "{{ request('query') }}". Please try another search.</p>
                    @else
                        <p class="text-gray-700 dark:text-gray-200">No books available at the moment.</p>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($books as $book)
                        <x-book-card :book="$book"/>
                    @endforeach
                </div>

                <div class="mt-4 pagination">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
