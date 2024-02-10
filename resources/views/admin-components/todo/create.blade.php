
<div class="modal fade" id="todoCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{route('todos.store')}}" method="POST" id="todoForm">
        @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="createTodoTitle">{{__('Create Todo')}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="title">{{__('Todo Title')}}</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            <div class="form-group py-2">
                <label for="description">{{__('Todo Description')}}</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>