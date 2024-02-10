<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="javascript:void(0)" id="markCompleted" class="btn btn-success d-none">Mark Completed</a>
                        <a href="javascript:void(0)" id="bulkDelete" class="btn btn-danger d-none">Bulk Delete!</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3>To do List</h3>
                    </div>
                    <div class="col-sm-4 text-end">
                        <a href="javascript:void(0)" id="createTodo" class="btn btn-primary">create todo</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="todoTable">
                        <thead>
                            <tr>
                                <th data-orderable="false" class="no-sort">
                                    <input type="checkbox" name="selectAll" id="selectAll" class="form-check-input">
                                </th>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Title")}}</th>
                                <th>{{__("Description")}}</th>
                                <th>{{__("Status")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo)
                                <tr id="{{'todo_'.$todo->id}}">
                                    <td>
                                        <input type="checkbox" name="checkAll" id="chaeckAll" class="form-check-input todo-checkbox" value="{{$todo->id}}">
                                    </td>
                                    <td>{{$todo->id}}</td>
                                    <td>{{$todo->title}}</td>
                                    <td>{{$todo->description}}</td>
                                    <td>{{$todo->is_completed ? 'yes' : 'no'}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-view" data-id="{{$todo->id}}">View</a>
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm btn-edit" data-id="{{$todo->id}}">Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete" data-id="{{$todo->id}}">Delete</a>
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