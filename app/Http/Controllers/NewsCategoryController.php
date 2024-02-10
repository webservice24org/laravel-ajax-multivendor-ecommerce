<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $allCategories = NewsCategory::all();
        return view("pages.news.categories", compact("allCategories"));
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
                "category_name" => "required|min:3|unique:news_categories",
            ]);
            
            $userId = Auth::id();
            $category = NewsCategory::create([
                "user_id" => $userId,
                "category_name"=> $request->category_name,
                "category_desc"=> $request->category_desc
            ]);

            return response()->json(['status'=>'success','message'=> 'Category created successfully', 'category'=>$category],200);
            
        } catch (Exception $ex) {
            
            return response()->json(['status'=>'failed','message'=> $ex->getMessage()],200);
        }
        
    
    }

    /**
     * Display the specified resource.
     */
    public function show(NewsCategory $category)
    {
        if ($category) {
            return response()->json(['status'=> 'success', 'category'=>$category],200);
        }
        return response()->json(['status'=>'failed', 'message'=> 'No Catgory Found!'],200);
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
    public function update(Request $request, NewsCategory $category)
    {
        if($category){
            $category['category_name'] = $request->category_name;
            $category['category_desc'] = $request->category_desc;
            $category->save();
            return response()->json(['status'=>'success','message'=> 'Category Updated successfully', 'category'=>$category],200);
        }
        return response()->json(['status'=>'failed','message'=> 'Unable to Update Category'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsCategory $category)
    {
        if ($category) {
            $category->delete();
            return response()->json(['status'=> 'success','message'=> 'Category Deleted Successfully', 'category'=>$category],200);
        }
        return response()->json(['status'=> 'failed','message'=> 'Unable to Delete!'],200);
    }

    public function bulkCatDelete(Request $request) {
        if ($request->categoryIds) {
            $response = NewsCategory::whereIn('id', $request->categoryIds)->delete();

            if ($response) {
                return response()->json(['status' => 'success', 'message' => 'Category deleted successfully']);
            }
            return response()->json(['status' => 'failed', 'message' => 'Unable to delete Categories!']);
        }
        return response()->json(['status' => 'failed', 'message' => 'No Category found!']);
    }
}
