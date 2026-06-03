<?php

namespace App\Http\Controllers;

use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = StudentModel::latest()->get();

        return view('student_info', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        StudentModel::create($validated);

        return redirect()->route('student.info')->with('success', 'Student created successfully');
    }

    public function edit(string $id)
    {
        $student = StudentModel::findOrFail($id);

        return view('student_edit', compact('student'));
    }

    public function update(Request $request, string $id)
    {
        $student = StudentModel::findOrFail($id);

        $validated = $request->validate($this->rules($student->id));

        if ($request->hasFile('profile_image')) {
            if ($student->profile_image) {
                Storage::disk('public')->delete($student->profile_image);
            }

            $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        $student->update($validated);

        return redirect()->route('student.info')->with('success', 'Student updated successfully');
    }

    public function destroy(string $id)
    {
        $student = StudentModel::findOrFail($id);

        if ($student->profile_image) {
            Storage::disk('public')->delete($student->profile_image);
        }

        $student->delete();

        return redirect()->route('student.info')->with('success', 'Student deleted successfully');
    }

    private function rules(?int $ignoreId = null): array
    {
        $emailRule = 'required|email|max:255|unique:student,email';

        if ($ignoreId) {
            $emailRule .= ',' . $ignoreId;
        }

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => $emailRule,
            'gender' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'year' => 'required|string|max:50',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
