<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" id="bulkCatDelete" class="btn btn-danger d-none">Bulk Delete!</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3>News categories</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="categoryCreate" class="btn btn-primary">Create Category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="categoryTable">
                        <thead>
                            <tr>
                                <th data-orderable="false" class="no-sort">
                                    <input type="checkbox" name="selectAllCats" id="selectAllCats" class="form-check-input category-checkbox">
                                </th>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Title")}}</th>
                                <th>{{__("Description")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allCategories as $category)
                            <tr id="{{'category_'.$category->id}}">
                                <td>
                                    <input type="checkbox" name="checkAllCats" id="checkAllCats" class="form-check-input category-checkbox" value="{{$category->id}}">
                                </td>
                                <td>{{$category->id}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->category_desc}}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btnCatView" data-id="{{$category->id}}">View</a>
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm btnCatEdit" data-id="{{$category->id}}">Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btnCatDelete" data-id="{{$category->id}}">Delete</a>
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