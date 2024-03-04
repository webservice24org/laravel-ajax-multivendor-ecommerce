<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" id="deleteStudents" class="btn btn-danger d-none">Bulk Delete!</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3>Student List</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="addNewStudent" class="btn btn-primary">Add New Student</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="studentTable">
                        <thead>
                            <tr>
                                <th>{{__("ID")}}</th>
                                <th>{{__("name")}}</th>
                                <th>{{__("email")}}</th>
                                <th>{{__("phone")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr id="{{'student_'.$student->id}}">
                                <td>{{$student->id}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->email}}</td>
                                <td>{{$student->phone}}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-success editStudent" data-id="{{$student->id}}">Edit</a>
                                    <a href="javascript:void(0)" class="btn btn-danger deleteStudent" data-id="{{$student->id}}">Delete</a>
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