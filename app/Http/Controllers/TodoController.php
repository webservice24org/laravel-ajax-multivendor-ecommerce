<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $todos = Todo::all();
        return view("pages.todolist", compact("todos"));
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
        $this->validate($request, [
            "title"=> "required|min:3",
            "description" => "required|min:5"
        ]);
        $todo = Todo::create([
            "title"=> $request->title,
            "description"=> $request->description
        ]);
        if ($todo) {
            return response()->json(['status'=>'success','message'=> 'To do created success', 'todo'=>$todo],200);
        }
        return response()->json(['status'=>'failed','message'=> 'Unable to create to do'],200);
    
    }

    /** 
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        if ($todo) {
            return response()->json(['status'=> 'success','todo'=> $todo], 200);
        }
        else{
            return response()->json(['status'=> 'failed', 'message'=>'No todo found!'],200);
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
    public function update(Request $request, Todo $todo)
    {
        if($todo){
            $todo['title'] = $request->title;
            $todo['description'] = $request->description;
            $todo->save();
            return response()->json(['status'=>'success','message'=> 'Todo Updated success', 'todo'=>$todo],200);
        }
        return response()->json(['status'=>'failed','message'=> 'Unable to Update todo'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        if ($todo) {
            $todo->delete();
            return response()->json(['status'=> 'success','message'=> 'Todo Deleted Successfully', 'todo'=>$todo],200);
        }
        return response()->json(['status'=> 'failed','message'=> 'Unable to Delete!'],200);
    }
    /**
     * mark completed
     */
    public function markCompleted(Request $request) {
        if ($request->todoIds) {
            $todos = [];

            foreach ($request->todoIds as $todoId) {
                $todo = Todo::find($todoId);
                if ($todo) {
                    unset($todo->title);
                    unset($todo->description);
                    unset($todo->created_at);
                    $todos[] = $todo;

                    $todo['is_completed'] = true;
                    $todo->save();
                }
            }

            // Todo::whereIn('id', $request->todoIds)->update(['is_completed' => true]);
            return response()->json(['status' => 'success', 'message' => 'Todos updated', 'todos' => $todos]);

        }
        return response()->json(['status' => 'failed', 'message' => 'No Todos found!']);
    }
    public function bulkDelete(Request $request) {
        if ($request->todoIds) {
            $response = Todo::whereIn('id', $request->todoIds)->delete();

            if ($response) {
                return response()->json(['status' => 'success', 'message' => 'Todos deleted successfully']);
            }
            return response()->json(['status' => 'failed', 'message' => 'Unable to delete Todos!']);
        }
        return response()->json(['status' => 'failed', 'message' => 'No Todos found!']);
    }
}
