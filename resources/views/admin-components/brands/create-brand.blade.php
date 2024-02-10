
<div class="modal fade" id="createBrands" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="POST" id="brandForm">
        @csrf
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="brandTitle">{{__('Create Brand')}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="title">{{__('Brand Title')}}</label>
                <input type="text" id="brand_name" name="brand_name" class="form-control">
            </div>
            <div class="form-group py-2">
                <label for="brand_image">{{__('Brand Image')}}</label>
                <textarea class="form-control" name="brand_image" id="brand_image" rows="3"></textarea>
                    
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