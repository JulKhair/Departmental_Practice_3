@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            
<div class="flex items-center justify-between mb-6">

    <h1 class="text-2xl font-bold text-gray-800">
        Book Inventory
    </h1>

    <a href="{{ route('books.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white
              font-semibold px-5 py-2 rounded-lg
              transition duration-200">

        + Add New Book

    </a>

</div>


            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border-collapse border border-gray-300">

                <thead>
                    <tr class="bg-gray-100">

                        <th class="border border-gray-300 p-3 text-left">Title</th>
                        <th class="border border-gray-300 p-3 text-left">Author</th>
                        <th class="border border-gray-300 p-3 text-left">Category</th>
                        <th class="border border-gray-300 p-3 text-left">Price</th>
                        <th class="border border-gray-300 p-3 text-left">Availability</th>
                        <th class="border border-gray-300 p-3 text-left">Actions</th>

                    </tr>
                </thead>

                <tbody>
                    @forelse ($books as $book)

                        <tr>

                            <td class="border border-gray-300 p-3">
                                {{ $book->title }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                {{ $book->author }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                {{ $book->category }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                ₱{{ number_format($book->unit_price, 2) }}
                            </td>

                            <td class="border border-gray-300 p-3">
                                {{ $book->availability_status }}
                            </td>

                            <td class="border border-gray-300 p-3">

                                <a href="{{ route('books.show', $book->id) }}"
                                   class="text-blue-600 hover:underline">
                                    View
                                </a>
                                
                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this book?');"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="text-red-600 hover:underline ml-3">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">
                                No books found in the inventory.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection
