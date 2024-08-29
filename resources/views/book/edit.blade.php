@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="container mx-auto p-6">
            <x-book-edit :book="$book"/>
        </div>
    </div>
@endsection
