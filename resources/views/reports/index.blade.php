@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            {{-- Page Heading --}}
            <div class="flex justify-between items-center mb-8">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Book Reports
                    </h1>

                    <p class="text-gray-500 mt-1">
                        View inventory summaries and generate bookstore reports.
                    </p>
                </div>

                <a href="{{ route('books.index') }}"
                   class="text-blue-600 hover:underline">
                    Back to Inventory
                </a>

            </div>

            {{-- Inventory Summary --}}
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Inventory Summary
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

                {{-- Total Books --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
                    <p class="text-sm text-blue-700 font-medium">
                        Total Books
                    </p>

                    <h3 class="text-3xl font-bold text-blue-900 mt-2">
                        {{ $books->count() }}
                    </h3>
                </div>

                {{-- Available Books --}}
                <div class="bg-green-50 border border-green-200 rounded-lg p-5">
                    <p class="text-sm text-green-700 font-medium">
                        Available Books
                    </p>

                    <h3 class="text-3xl font-bold text-green-900 mt-2">
                        {{ $availableBooks }}
                    </h3>
                </div>

                {{-- Unavailable Books --}}
                <div class="bg-red-50 border border-red-200 rounded-lg p-5">
                    <p class="text-sm text-red-700 font-medium">
                        Unavailable Books
                    </p>

                    <h3 class="text-3xl font-bold text-red-900 mt-2">
                        {{ $unavailableBooks }}
                    </h3>
                </div>

                {{-- Total Categories --}}
                <div class="bg-purple-50 border border-purple-200 rounded-lg p-5">
                    <p class="text-sm text-purple-700 font-medium">
                        Total Categories
                    </p>

                    <h3 class="text-3xl font-bold text-purple-900 mt-2">
                        {{ $booksByCategory->count() }}
                    </h3>
                </div>

            </div>

            {{-- Books by Category --}}
            <div class="border border-gray-200 rounded-lg p-5 mb-8">

                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Books by Category
                </h2>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-3">Category</th>
                                <th class="px-4 py-3">Total Books</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($booksByCategory as $category)

                                <tr class="border-b">

                                    <td class="px-4 py-3">
                                        {{ $category->category }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $category->total }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="2"
                                        class="px-4 py-4 text-center text-gray-500">
                                        No category records found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


{{-- Book Price List --}}
<div class="border border-gray-200 rounded-lg p-5 mb-8">

    <h2 class="text-lg font-semibold text-gray-800 mb-4">
        Book Price List
    </h2>

    <div class="overflow-x-auto">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Author</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Unit Price</th>
                    <th class="px-4 py-3">Availability</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($books as $book)

                    <tr class="border-b">

                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $book->title }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $book->author }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $book->category }}
                        </td>

                        <td class="px-4 py-3">
                            ₱{{ number_format($book->unit_price, 2) }}
                        </td>

                        <td class="px-4 py-3">

                            @if ($book->availability_status === 'Available')
                                <span class="text-green-700 font-semibold">
                                    Available
                                </span>
                            @else
                                <span class="text-red-700 font-semibold">
                                    Unavailable
                                </span>
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5"
                            class="px-4 py-4 text-center text-gray-500">
                            No books found in the inventory.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

            
{{-- Inventory Filters --}}
<div class="border-t border-gray-200 pt-6">

    <h2 class="text-lg font-semibold text-gray-800 mb-4">
        Inventory Filters
    </h2>

    <form action="{{ route('reports.index') }}" method="GET">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            {{-- Category Filter --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Category
                </label>

                <select name="category"
                        class="w-full border-gray-300 rounded-md shadow-sm">

                    <option value="">All Categories</option>

                    <option value="Fiction"
                        {{ request('category') == 'Fiction' ? 'selected' : '' }}>
                        Fiction
                    </option>

                    <option value="Nonfiction"
                        {{ request('category') == 'Nonfiction' ? 'selected' : '' }}>
                        Nonfiction
                    </option>

                    <option value="Academic"
                        {{ request('category') == 'Academic' ? 'selected' : '' }}>
                        Academic
                    </option>

                    <option value="Children’s Books"
                        {{ request('category') == 'Children’s Books' ? 'selected' : '' }}>
                        Children’s Books
                    </option>

                </select>

            </div>

            {{-- Availability Filter --}}
            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Availability
                </label>

                <select name="availability_status"
                        class="w-full border-gray-300 rounded-md shadow-sm">

                    <option value="">All Statuses</option>

                    <option value="Available"
                        {{ request('availability_status') == 'Available' ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="Unavailable"
                        {{ request('availability_status') == 'Unavailable' ? 'selected' : '' }}>
                        Unavailable
                    </option>

                </select>

            </div>

            {{-- Filter Buttons --}}
            <div class="flex items-end gap-2">

                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-5 py-2 rounded-md shadow hover:bg-blue-700">
                    Apply Filters
                </button>

                <a href="{{ route('reports.index') }}"
                   class="bg-gray-300 text-gray-900 font-semibold px-5 py-2 rounded-md shadow hover:bg-gray-400">
                    Reset
                </a>

            </div>

        </div>

    </form>

</div>


            {{-- Export Options --}}
            <div class="border-t border-gray-200 mt-8 pt-6">

                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Export Reports
                </h2>

                <div class="flex flex-wrap gap-3">

    <a href="{{ route('reports.pdf', request()->query()) }}"
   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
    Export PDF
</a>

<a href="{{ route('reports.csv', request()->query()) }}"
   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
    Export CSV
</a>

</div>

            </div>

        </div>

    </div>
</div>

@endsection
