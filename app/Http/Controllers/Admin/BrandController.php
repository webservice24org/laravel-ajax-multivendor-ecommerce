<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBrands = Brand::all();
        return view("pages.brands", compact("allBrands"));
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
            "brand_name"=> "required|min:2"
        ]);
        
        // Handle image upload
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            
            $imageName = time().'.'.$image->getClientOriginalExtension();

            $image->move(public_path('assets/admin/img/brands'), $imageName);
            
            $imagePath = 'assets/admin/img/brands/'.$imageName;
        } else {
            $imagePath = 'assets/admin/img/brands/default.png'; 
        }
        
        $brand = Brand::create([
            "brand_name"=> $request->brand_name,
            "brand_image" => $imagePath
        ]);
        
        if ($brand) {
            return response()->json(['status'=>'success','message'=> 'Brand created successfully', 'brand'=>$brand],200);
        }
        return response()->json(['status'=>'failed','message'=> 'Unable to create Brand'],200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        if ($brand) {
            return response()->json(['status'=> 'success','brand'=> $brand], 200);
        }
        else{
            return response()->json(['status'=> 'failed', 'message'=>'No brand found!'],200);
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
    public function update(Request $request, Brand $brand)
    {
        if($brand){
            $brand['brand_name'] = $request->brand_name;
            $brand['brand_image'] = $request->brand_image;
            $brand->save();
            return response()->json(['status'=>'success','message'=> 'Brand Updated success', 'brand'=>$brand],200);
        }
        return response()->json(['status'=>'failed','message'=> 'Unable to Update brand'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand) {
            $brand->delete();
            return response()->json(['status'=> 'success','message'=> 'brand Deleted Successfully', 'brand'=>$brand],200);
        }
        return response()->json(['status'=> 'failed','message'=> 'Unable to Delete!'],200);
    }

    public function bulkBrandDelete(Request $request) {
        if ($request->brandIds) {
            $response = Brand::whereIn('id', $request->brandIds)->delete();

            if ($response) {
                return response()->json(['status' => 'success', 'message' => 'Brands deleted successfully']);
            }
            return response()->json(['status' => 'failed', 'message' => 'Unable to delete Brands!']);
        }
        return response()->json(['status' => 'failed', 'message' => 'No Brands found!']);
    }
}
