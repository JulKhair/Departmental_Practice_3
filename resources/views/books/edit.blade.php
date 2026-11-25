@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <h1 class="text-2xl font-bold mb-6">
                Edit Book
            </h1>

            @if ($errors->any())
             <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">

            <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
                 </ul>

               </div>
           @endif
            <form action="{{ route('books.update', $book->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium mb-2">Title</label>
                    <input type="text" name="title"
                        value="{{ old('title', $book->title) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Author</label>
                    <input type="text" name="author"
                        value="{{ old('author', $book->author) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Category</label>

                    <select name="category" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Fiction" {{ old('category', $book->category) == 'Fiction' ? 'selected' : '' }}>Fiction</option>
                        <option value="Nonfiction" {{ old('category', $book->category) == 'Nonfiction' ? 'selected' : '' }}>Nonfiction</option>
                        <option value="Academic" {{ old('category', $book->category) == 'Academic' ? 'selected' : '' }}>Academic</option>
                        <option value="Children’s Books" {{ old('category', $book->category) == 'Children’s Books' ? 'selected' : '' }}>Children’s Books</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Unit Price (₱)</label>
                    <input type="number" name="unit_price"
                        value="{{ old('unit_price', $book->unit_price) }}"
                        step="0.01" min="0"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-2">Availability Status</label>

                    <select name="availability_status" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Available" {{ old('availability_status', $book->availability_status) == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Unavailable" {{ old('availability_status', $book->availability_status) == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700">
                    Update Book
                </button>

            </form>

        </div>

    </div>
</div>

@endsection
