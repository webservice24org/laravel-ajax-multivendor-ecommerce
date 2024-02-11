<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" id="bulkBrandDelete" class="btn btn-danger d-none">Bulk Delete!</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3>Product Brands</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="brandCreate" class="btn btn-primary">Create Brand</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="brandTable">
                        <thead>
                            <tr>
                                <th data-orderable="false" class="no-sort">
                                    <input type="checkbox" name="selectAllBrands" id="selectAllBrands" class="form-check-input brand-checkbox">
                                </th>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Brand Title")}}</th>
                                <th>{{__("Brand Image")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($allBrands as $brand)
                            <tr id="{{'brand'.$brand->id}}">
                                <td>
                                    <input type="checkbox" name="checkAllBrands" id="checkAllBrands" class="form-check-input brand-checkbox" value="{{$brand->id}}">
                                </td>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->brand_name}}</td>
                                <td>
                                    <img src="{{$brand->brand_image}}" alt="Brand Image" style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btnBrandView" data-id="{{$brand->id}}">View</a>
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm btnBrandEdit" data-id="{{$brand->id}}">Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btnBrandDelete" data-id="{{$brand->id}}">Delete</a>
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

