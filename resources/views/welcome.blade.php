@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Seção de cabeçalho com campo de busca e botão de novo livro -->
        <div class="fixed top-0 left-0 w-full bg-white dark:bg-gray-900 shadow-md z-10 p-6">
            <div class="flex items-center justify-between">
                <!-- Campo de Busca -->
                <form action="{{ route('books.list') }}" method="GET" class="flex items-center">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search books..." class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 text-gray-900 dark:text-white">
                    <button type="submit" class="ml-2 px-4 py-2 bg-red-500 text-white font-semibold rounded-md shadow hover:bg-red-600 transition duration-150">Search</button>
                </form>

                <!-- Botão de Novo Livro -->
                <a href="{{ route('books.create') }}" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow hover:bg-green-600 transition duration-150">New Book</a>
            </div>
        </div>

        <!-- Adicionando um espaçamento para evitar sobreposição -->
        <div class="pt-20">
            <!-- Listagem de Livros -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($books as $book)
                    <x-book-card :book="$book"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
