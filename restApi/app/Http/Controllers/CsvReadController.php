<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CsvReadController extends Controller
{
    public function index()
    {
        // Define the CSV file path
        $filePath = storage_path('app/employees.csv');

        // Check if the file exists
        if (!file_exists($filePath) || !is_readable($filePath)) {
            return response()->json(['message' => 'No data found'], 404);
        }

        // Initialize an array to hold CSV data
        $data = [];

        // Open the file and read it
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Get the headers
            $headers = fgetcsv($handle);
            // Read each row and map it to the headers
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = array_combine($headers, $row);
            }
            fclose($handle);
        }

        // Return the data as JSON
        return response()->json($data);
    }
}
