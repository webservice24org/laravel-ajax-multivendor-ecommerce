
<div class="modal fade" id="CreateNewsCats" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST" id="categoryForm">
        @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="CatTitle">{{__('Create News Category')}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="title">{{__('Category Name')}}</label>
                <input type="text" id="category_name" name="category_name" class="form-control">
            </div>
            <div class="form-group py-2">
                <label for="category_desc">{{__('Category Description')}}</label>
                <textarea class="form-control" name="category_desc" id="category_desc" rows="3"></textarea>
                    
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