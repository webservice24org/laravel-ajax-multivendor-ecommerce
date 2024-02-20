<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" id="bulkPCatDelete" class="btn btn-danger d-none">Bulk Delete!</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3>Product Categories</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="pCategoryCreate" class="btn btn-primary">Create Product Category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="pCategoryTable">
                        <thead>
                            <tr>
                                <th data-orderable="false" class="no-sort">
                                    <input type="checkbox" name="selectAllpcategory" id="selectAllpcategory" class="form-check-input pcategory-checkbox">
                                </th>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Category Name")}}</th>
                                <th>{{__("Category Image")}}</th>
                                <th>{{__("Description")}}</th>
                                <th>{{__("Slug")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allCats as $cat)
                                <tr id="{{'pcat_'.$cat->id}}">
                                    <td>
                                        <input type="checkbox" name="selectAllpcategory" id="selectAllpcategory" class="form-check-input pcategory-checkbox" value="{{$cat->id}}">
                                    </td>
                                    <td>{{$cat->id}}</td>
                                    <td>{{$cat->product_category_name}}</td>
                                    <td>
                                        <img src="{{$cat->category_image}}" alt="{{$cat->product_category_name}}" style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td>{{$cat->category_desc}}</td>
                                    <td>{{$cat->product_category_slug}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm btnPCatView" data-id="{{$cat->id}}">View</a>
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm btnPCatEdit" data-id="{{$cat->id}}">Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm btnPCatDelete" data-id="{{$cat->id}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

