<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Start with all inventory records
        $query = Book::query();

        // Filter books by category, if selected
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter books by availability, if selected
        if ($request->filled('availability_status')) {
            $query->where(
                'availability_status',
                $request->availability_status
            );
        }

        // Retrieve the filtered books
        $books = $query->get();

        // Count available and unavailable books
        $availableBooks = $books->where(
            'availability_status',
            'Available'
        )->count();

        $unavailableBooks = $books->where(
            'availability_status',
            'Unavailable'
        )->count();

        // Group filtered books by category
        $booksByCategory = (clone $query)
           ->select('category')
           ->selectRaw('COUNT(*) as total')
           ->groupBy('category')
           ->get();

        return view('reports.index', compact(
            'books',
            'availableBooks',
            'unavailableBooks',
            'booksByCategory'
        ));
    }

    public function exportPdf(Request $request)
    {
        // Start with all inventory records
        $query = Book::query();

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply availability filter
        if ($request->filled('availability_status')) {
            $query->where(
                'availability_status',
                $request->availability_status
            );
        }

        // Retrieve matching books
        $books = $query->get();

        // Generate PDF using the PDF Blade view
        $pdf = Pdf::loadView('reports.pdf', [
            'books' => $books,
            'category' => $request->category,
            'availability' => $request->availability_status,
        ]);

        // Download the generated PDF
        return $pdf->download('book-inventory-report.pdf');
    }

    public function exportCsv(Request $request)
    {
        // Start with all inventory records
        $query = Book::query();

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply availability filter
        if ($request->filled('availability_status')) {
            $query->where(
                'availability_status',
                $request->availability_status
            );
        }

        // Retrieve matching books
        $books = $query->get();

        // Generate downloadable CSV file
        return response()->streamDownload(function () use ($books) {

            $handle = fopen('php://output', 'w');

            // Add UTF-8 BOM for spreadsheet compatibility
            fwrite($handle, "\xEF\xBB\xBF");

            // Add CSV column headings
            fputcsv($handle, [
                'Title',
                'Author',
                'Category',
                'Unit Price',
                'Availability'
            ]);

            // Add book records
            foreach ($books as $book) {
                fputcsv($handle, [
                    $book->title,
                    $book->author,
                    $book->category,
                    $book->unit_price,
                    $book->availability_status
                ]);
            }

            fclose($handle);

        }, 'book-inventory-report.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8'
        ]);
    }
}
