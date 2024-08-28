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
            <div class="mb-5 p-4 text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300" role="alert">
                <div class="flex items-center mb-3">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <h2 class="text-lg font-bold">Olá, Entrevistador(a)!</h2>
                </div>
                <div>
                    <span class="font-medium">Nota sobre os Livros: <strong>Imagens Ausentes</strong></span><br>
                    Neste momento, os livros não têm imagens associadas.
                    Isso é intencional, pois você pode usar suas credenciais do AWS S3 para adicionar imagens.<br>
                    Aproveite a oportunidade para editar ou adicionar as imagens que desejar. 😁
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($books as $book)
                    <x-book-card :book="$book"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
