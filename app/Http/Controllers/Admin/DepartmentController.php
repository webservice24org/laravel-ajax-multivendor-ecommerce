<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deps = Department::all();
        return view("pages.departments", compact("deps"));
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
                "department_name"=> "required|min:3|unique:departments,department_name"
            ]);
            $dep = Department::create([
                "department_name"=> $request->department_name
            ]);
            if ($dep) {
                return response()->json(['status'=>'success','message'=> 'Department Added Successfully', 'dep'=>$dep],200);
            } 
        } catch (Exception $ex) {
            
            return response()->json(['status'=>'failed','message'=> $ex->getMessage()],200);
        }
        
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $dep)
    {
        if ($dep) {
            return response()->json(['status'=> 'success','dep'=> $dep], 200);
        }
        else{
            return response()->json(['status'=> 'failed', 'message'=>'No dep found!'],200);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $dep)
    {

        if($dep){
            $dep['department_name'] = $request->department_name;
            $dep->save();
            return response()->json(['status'=>'success','message'=> 'department Updated success', 'dep'=>$dep],200);
        }
        return response()->json(['status'=>'failed','message'=> 'Unable to Update department'],200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $dep)
    {
        try {
            if ($dep) {
                $dep->delete();
                return response()->json(['status' => 'success', 'message' => 'Department Deleted Successfully'], 200);
            } else {
                return response()->json(['status' => 'failed', 'message' => 'Failed to Delete Department'], 400);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
        }
    }

    public function bulkDepDelete(Request $request) {
        if ($request->depIds) {
            $response = Department::whereIn('id', $request->depIds)->delete();

            if ($response) {
                return response()->json(['status' => 'success', 'message' => 'Departments deleted successfully']);
            }
            return response()->json(['status' => 'failed', 'message' => 'Unable to delete Departments!']);
        }
        return response()->json(['status' => 'failed', 'message' => 'No Departments found!']);
    }

}
