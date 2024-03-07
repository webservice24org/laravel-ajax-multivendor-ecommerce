<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('pages.teachers', compact('teachers'));
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
            $teacher = new Teacher();

            // Store the image
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/admin/img/teacher/'), $imageName);
                $teacher->photo = $imageName;
            } else {
                $teacher->photo = 'default.png';
            }
            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            $teacher->save();

            return response()->json(['status' => 'success', 'message' => 'Teacher added successfully.', 'teacher' => $teacher], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
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
    public function edit($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            return response()->json(['status' => 'success', 'teacher' => $teacher], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
<<<<<<< HEAD
    /**
 * Update the specified resource in storage.
 */
// public function update(Request $request, $id)
// {
//     try {
//         // Validate input data
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|max:255',
//             'phone' => 'required|string|max:20',
//             'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $teacher = Teacher::findOrFail($id);
//         if ($request->hasFile('photo')) {
//             $image = $request->file('photo');
//             $imageName = time() . '.' . $image->getClientOriginalExtension();
//             $image->move(public_path('assets/admin/img/teacher'), $imageName);
//             $teacher->photo = $imageName;
//         }
//         $teacher->update([
//             'name' => $request->name,
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'photo' => $imageName ?? null, 
//         ]);

//         return response()->json(['status' => 'success', 'message' => 'Teacher updated successfully.', 'teacher' => $teacher], 200);
//     } catch (Exception $e) {
//         return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
//     }
// }

public function update(Request $request, $id)
{
    try {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust maximum file size as needed
        ]);

        $teacher = Teacher::findOrFail($id);
        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/admin/img/teacher'), $imageName);
            $teacher->photo = $imageName;
        } elseif ($request->has('current_photo')) {
            // If no new photo is selected, but a current photo is provided, keep the current photo
            $teacher->photo = basename($request->input('current_photo'));
        }
        // Update teacher's information
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json(['status' => 'success', 'message' => 'Teacher updated successfully.', 'teacher' => $teacher], 200);
    } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
=======
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $teacher = Teacher::findOrFail($id);
            if ($request->hasFile('photo')) {
                if ($teacher->photo && $teacher->photo != 'default.png') {
                    $photoPath = public_path('assets/admin/img/teacher/' . $teacher->photo);
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/admin/img/teacher'), $imageName);
                $teacher->photo = $imageName;
            } elseif ($request->has('current_photo')) {

                $teacher->photo = basename($request->input('current_photo'));
            }
            $teacher->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Teacher updated successfully.', 'teacher' => $teacher], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
>>>>>>> 2cece7ed2a806f1a5dab2b16d36b2d4bcd74c46d
    }
}







    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            if ($teacher->photo && $teacher->photo != 'default.png') {
                $photoPath = public_path('assets/admin/img/teacher/' . $teacher->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            $teacher->delete();

            return response()->json(['status' => 'success', 'message' => 'Teacher deleted successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

}
