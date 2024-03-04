<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                        <h3>Teacher List</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="addNewTeacher" class="btn btn-primary">Add New Teacher</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="teacherTable">
                        <thead>
                            <tr>
                                <th>{{__("ID")}}</th>
                                <th>{{__("name")}}</th>
                                <th>{{__("email")}}</th>
                                <th>{{__("phone")}}</th>
                                <th>{{__("photo")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                            <tr id="{{'teacher_'.$teacher->id}}">
                                <td>{{$teacher->id}}</td>
                                <td>{{$teacher->name}}</td>
                                <td>{{$teacher->email}}</td>
                                <td>{{$teacher->phone}}</td>
                                <td>
                                    <img src="{{$teacher->photo}}" alt="{{$teacher->name}}" style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-success editStudent" data-id="{{$teacher->id}}">Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger deleteStudent" data-id="{{$teacher->id}}">Delete</a>
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