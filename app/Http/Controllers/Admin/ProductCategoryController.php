<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCats = ProductCategory::all();
        return view("pages.product-categories", compact("allCats"));
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
                "product_category_name" => "required|min:3|unique:product_categories",
                //"category_image" => "image|mimes:jpeg,png,jpg,gif|max:2048"
            ]);
        
            // Handle file upload
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/admin/img/categories'), $imageName);
                $imagePath = 'assets/admin/img/categories/' . $imageName;
            } else {
                $imagePath = 'assets/admin/img/categories/default.jpg'; 
            }
        
            $userId = Auth::id();
            $productCategory = ProductCategory::create([
                "user_id" => $userId,
                "product_category_name" => $request->product_category_name,
                "product_category_slug" => Str::slug($request->product_category_name, '-'),
                "category_image" => $imagePath,
                "category_desc" => $request->category_desc
            ]);
        
            return response()->json(['status' => 'success', 'message' => 'Category created successfully', 'productCategory' => $productCategory], 200);
        } catch (Exception $ex) {
            return response()->json(['status' => 'failed', 'message' => $ex->getMessage()], 200);
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        if ($productCategory) {
            return response()->json(['status'=> 'success','productCategory'=> $productCategory], 200);
        }
        else{
            return response()->json(['status'=> 'failed', 'message'=>'No Category found!'],200);
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
    public function update(Request $request, ProductCategory $productCategory)
{
    try {
        $this->validate($request, [
            "product_category_name" => "required|min:3|unique:product_categories,product_category_name," . $productCategory->id,
            //"category_image" => "image|mimes:jpeg,png,jpg,gif|max:2048"
        ]);
    
        // Handle file upload
        if ($request->hasFile('category_image')) {
            // Delete previous image if exists
            if ($productCategory->category_image && file_exists(public_path($productCategory->category_image))) {
                unlink(public_path($productCategory->category_image));
            }
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/admin/img/categories'), $imageName);
            $imagePath = 'assets/admin/img/categories/' . $imageName;
        } else {
            $imagePath = $productCategory->category_image; // Keep existing image path
        }
    
        $data = [
            "product_category_name" => $request->product_category_name,
            "category_image" => $imagePath,
            "category_desc" => $request->category_desc
        ];

        // Check if new slug is provided
        if ($request->filled('product_category_slug')) {
            $data["product_category_slug"] = Str::slug($request->product_category_slug, '-');
        }
    
        $productCategory->update($data);
    
        return response()->json(['status' => 'success', 'message' => 'Category updated successfully', 'productCategory' => $productCategory], 200);
    } catch (Exception $ex) {
        return response()->json(['status' => 'failed', 'message' => $ex->getMessage()], 200);
    }
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $ProductCategory)
    {
        if ($ProductCategory) {
            if ($ProductCategory->category_image !== 'assets/admin/img/categories/default.png') {
                if (file_exists(public_path($ProductCategory->category_image))) {
                    unlink(public_path($ProductCategory->category_image));
                }
            }
            $ProductCategory->delete();
            return response()->json(['status' => 'success', 'message' => 'Category Deleted Successfully', 'productCategory' => $ProductCategory], 200);
        }
        
        return response()->json(['status' => 'failed', 'message' => 'Unable to Delete!'], 200);
        
    }

    public function bulkpCatDelete(Request $request) {
        if ($request->pcatIds) {
            $categories = ProductCategory::whereIn('id', $request->pcatIds)->get();
    
            foreach ($categories as $category) {
                if ($category->category_image !== 'assets/admin/img/categories/default.png') {
                    if (file_exists(public_path($category->category_image))) {
                        unlink(public_path($category->category_image));
                    }
                }
            }
            $response = ProductCategory::whereIn('id', $request->pcatIds)->delete();
    
            if ($response) {
                return response()->json(['status' => 'success', 'message' => 'Categories deleted successfully']);
            }
            return response()->json(['status' => 'failed', 'message' => 'Unable to delete Categories!']);
        }
        return response()->json(['status' => 'failed', 'message' => 'No Category found!']);
    }
    
}
