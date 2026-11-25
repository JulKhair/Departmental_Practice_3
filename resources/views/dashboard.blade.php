@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-sm sm:rounded-lg p-8 text-center">

            <h1 class="text-3xl font-bold text-gray-800 mb-3">
                Welcome to the Bookstore Inventory System,
                {{ Auth::user()->name }}!
            </h1>

            <p class="text-gray-600 mb-6">
                Manage your bookstore inventory, keep track of
                book availability, and generate organized reports
                all in one place.
            </p>

            <a href="{{ route('books.index') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700
                      text-white font-semibold px-6 py-3
                      rounded-lg transition duration-200">
                Get Started
            </a>

        </div>

    </div>
</div>

@endsection
