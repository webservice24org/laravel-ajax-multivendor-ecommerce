
<div class="modal fade" id="createpCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST" id="pCategoryForm">
        @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="pCatTitle">{{__('Create Product Category')}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="product_category_name">{{__('Category Name')}}</label>
              <input type="text" id="product_category_name" name="product_category_name" class="form-control">
          </div>
          <div class="form-group py-2">
              <label for="category_image">{{__('Category Image')}} <small class="text-danger">(Optional)</small></label>
              <input type="file" class="form-control" name="category_image" id="category_image">   

          </div>
          <div class="form-group py-2">
             <div id="category_image_preview"></div>
          </div>
          <div class="form-group">
              <label for="category_desc">{{__('Category Desc')}} <small class="text-danger">(Optional)</small></label>
              <textarea name="category_desc" id="category_desc" class="form-control" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group">
              <label for="product_category_slug">{{__('Category Slug')}}<small class="text-danger">(Optional)</small></label>
              <input type="text" id="product_category_slug" name="product_category_slug" class="form-control">
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
