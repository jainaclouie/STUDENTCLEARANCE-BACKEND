<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
   public function stats(): JsonResponse
{
    return response()->json([
        'total' => Student::count(),
        'pending' => Student::where('clearance_status', 'pending')->count(),
        'cleared' => Student::where('clearance_status', 'cleared')->count(),
        'rejected' => Student::where('clearance_status', 'rejected')->count(),
    ]);
}

    public function index(): JsonResponse
    {
        return response()->json(Student::orderBy('created_at', 'desc')->get());
    }

    public function show(Student $student): JsonResponse
    {
        return response()->json($student);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:0|max:150',
            'birthday' => 'required|date',
            'clearance_status' => 'in:pending,cleared,rejected',
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }

    public function update(Request $request, Student $student): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'age' => 'required|integer|min:0|max:150',
            'birthday' => 'required|date',
            'clearance_status' => 'in:pending,cleared,rejected',
        ]);

        $student->update($validated);

        return response()->json($student);
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json(['message' => 'Student deleted']);
    }
}