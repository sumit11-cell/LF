<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'documents.*' => 'mimes:pdf,doc,docx,zip,jpeg,png,jpg|max:2048',
        ]);

        $student = new Student($request->all());

        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();  
            $request->profile_picture->move(public_path('images'), $imageName);
            $student->profile_picture = $imageName;
        }

        if ($request->hasFile('documents')) {
            $documentNames = [];
            foreach ($request->file('documents') as $document) {
                $documentName = time().'_'.$document->getClientOriginalName();
                $document->move(public_path('documents'), $documentName);
                $documentNames[] = $documentName;
            }
            $student->documents = json_encode($documentNames);
        }

        $student->save();

        return redirect()->route('students.index')->with('success','Student registered successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
        ]);

        $student->update($request->all());

        if ($request->hasFile('profile_picture')) {
            $imageName = time().'.'.$request->profile_picture->extension();  
            $request->profile_picture->move(public_path('images'), $imageName);
            $student->profile_picture = $imageName;
        }

        if ($request->hasFile('documents')) {
            $documentNames = [];
            foreach ($request->file('documents') as $document) {
                $documentName = time().'_'.$document->getClientOriginalName();
                $document->move(public_path('documents'), $documentName);
                $documentNames[] = $documentName;
            }
            $student->documents = json_encode($documentNames);
        }

        return redirect()->route('students.index')->with('success','Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully.');
    }
}

