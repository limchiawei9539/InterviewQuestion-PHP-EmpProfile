<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CsvController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed',
            'phone' => 'required|regex:/^(\+?\d{1,3})?[-.\s]?(\d{10})$/',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
            'dob' => 'required|date|before:today',
            'nationality' => 'required|string|max:100',
            'hire_date' => 'required|date|after_or_equal:dob',
            'department' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $data = $validator->validated();

        $filePath = storage_path('app/employees.csv');

        $file = fopen($filePath, 'a');

        if (filesize($filePath) == 0) {
            fputcsv($file, array_keys($data));
        }

        fputcsv($file, $data);

        fclose($file);

        return response()->json(['message' => 'Data saved successfully'], 200);
    }
}
