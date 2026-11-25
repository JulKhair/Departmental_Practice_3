<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Book Inventory Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        .report-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #e5e7eb;
        }

        .available {
            color: green;
            font-weight: bold;
        }

        .unavailable {
            color: red;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

    <h1>Bookstore Inventory Report</h1>

    <p class="subtitle">
        Book Price List
    </p>

    {{-- Report Information --}}
    <div class="report-info">

        <p>
            <strong>Generated:</strong>
            {{ now()->format('F d, Y h:i A') }}
        </p>

        <p>
            <strong>Category:</strong>
            {{ $category ?: 'All Categories' }}
        </p>

        <p>
            <strong>Availability:</strong>
            {{ $availability ?: 'All Statuses' }}
        </p>

        <p>
            <strong>Total Books:</strong>
            {{ $books->count() }}
        </p>

    </div>

    {{-- Book Price List --}}
    <table>

        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Availability</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($books as $book)

                <tr>
                    <td>{{ $book->title }}</td>

                    <td>{{ $book->author }}</td>

                    <td>{{ $book->category }}</td>

                    <td>
                        ₱{{ number_format($book->unit_price, 2) }}
                    </td>

                    <td class="{{ $book->availability_status === 'Available' ? 'available' : 'unavailable' }}">
                        {{ $book->availability_status }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="5" class="empty">
                        No books found in the inventory.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>
