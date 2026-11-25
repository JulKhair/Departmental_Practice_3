@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <h1 class="text-2xl font-bold mb-6">
                Book Details
            </h1>

            <div class="space-y-4">

                <div>
                    <h2 class="font-semibold text-gray-600">Title</h2>
                    <p>{{ $book->title }}</p>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-600">Author</h2>
                    <p>{{ $book->author }}</p>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-600">Category</h2>
                    <p>{{ $book->category }}</p>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-600">Unit Price</h2>
                    <p>₱{{ number_format($book->unit_price, 2) }}</p>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-600">Description</h2>
                    <p>{{ $book->description }}</p>
                </div>

                <div>
                    <h2 class="font-semibold text-gray-600">Availability Status</h2>
                    <p>{{ $book->availability_status }}</p>
                </div>

            </div>

            <div class="mt-8">
                <a href="{{ route('books.index') }}"
                   class="bg-gray-600 text-white px-5 py-2 rounded-md hover:bg-gray-700">
                    Back to Inventory
                </a>
            </div>

        </div>

    </div>
</div>

@endsection
