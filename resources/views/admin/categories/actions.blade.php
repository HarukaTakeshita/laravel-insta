<div class="modal fade" id="delete-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="h5"><i class="fa-regular fa-trash-can"></i> Delete Category</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
                <br>
                <p>This action will affect all the posts under this category. Posts without a category will fall under Uncategorized</p>
            </div>
            <div class="modal-footer border-secondary-50">
                <form action="{{ route('admin.categories.destroy', $category->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <form action="{{ route('admin.categories.update', $category->id)}}" method="post">
                @csrf 
                @method('PATCH')
                <div class="modal-header border-warning">
                    <h4 class="h5"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="categ_name" id="category" class="form-control" placeholder="{{ old('name', $category->name) }}">
                    {{-- don't use name="category" because it's already used add category --}}
                    @error('categ_name')
                        <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                @error('category')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
                <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
