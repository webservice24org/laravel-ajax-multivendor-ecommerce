<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" id="bulkDelete" class="btn btn-danger d-none">Bulk Delete!</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3>Department List</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="createDep" class="btn btn-primary">create Department</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="depTable">
                        <thead>
                            <tr>
                                <th data-orderable="false" class="no-sort">
                                    <input type="checkbox" name="selectDeps" id="selectDeps" class="form-check-input">
                                </th>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Department Name")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deps as $dep)
                                <tr id="{{'dep_'.$dep->id}}">
                                    <td>
                                        <input type="checkbox" name="checkAll" id="chaeckAllDep" class="form-check-input dep-checkbox" value="{{$dep->id}}">
                                    </td>
                                    <td>{{$dep->id}}</td>
                                    <td>{{$dep->department_name}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm btnDepview" data-id="{{$dep->id}}">View</a>
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm btnDepedit" data-id="{{$dep->id}}">Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm btnDepdelete" data-id="{{$dep->id}}">Delete</a>
                                    </td>
                                </tr>
                            
                            @endforeach
                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>