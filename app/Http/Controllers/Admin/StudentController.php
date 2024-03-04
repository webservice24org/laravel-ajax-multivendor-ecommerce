<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('pages.students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|unique:students,email',
                'phone' => 'required|min:11|unique:students,phone'
            ], [
                'name.required' => 'The name field is required.',
                'name.min' => 'The name must be at least :min characters.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'The email has already been taken.',
                'phone.required' => 'The phone field is required.',
                'phone.min' => 'The phone must be at least :min characters.',
                'phone.unique' => 'The phone has already been taken.'
            ]);
            
    
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return response()->json(['status'=>'success', 'message'=>'Student Added Successfully!', 'student'=>$student],200);
        } catch (Exception $ex) {
            return response()->json(['status'=>'failed', 'message'=>$ex->getMessage()],400);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


  /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $student = Student::findOrFail($id);
            return response()->json(['status' => 'success', 'student' => $student], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:3',
                'email' => 'required|unique:students,email,' . $id,
                'phone' => 'required|min:11|unique:students,phone,' . $id
            ], [
                'name.required' => 'The name field is required.',
                'name.min' => 'The name must be at least :min characters.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'The email has already been taken.',
                'phone.required' => 'The phone field is required.',
                'phone.min' => 'The phone must be at least :min characters.',
                'phone.unique' => 'The phone has already been taken.'
            ]);

            $student = Student::findOrFail($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->save();

            return response()->json(['status' => 'success', 'message' => 'Student updated successfully.', 'student' => $student], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json(['status' => 'success', 'message' => 'Student deleted successfully.', 'student'=>$student]);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to delete student.'], 500);
        }
    }

}
