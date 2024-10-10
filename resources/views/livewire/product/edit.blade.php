<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div aria-hidden="true">&times;</div>
                </button>
            </div>
            <form wire:submit.prevent='updateProduct'>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input wire:model='name' type="text" class="@error('name') is-invalid @enderror form-control"
                            id="exampleInputName1">
                        @error('name')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <label>Category</label>
                    <select wire:model='category_id' class="@error('category_id') is-invalid @enderror custom-select">
                        <option selected>Open this select menu</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group mt-2">
                        <label for="exampleInputName1">Stock</label>
                        <input wire:model='stock' type="number"
                            class="@error('stock') is-invalid @enderror form-control" id="exampleInputName1">
                        @error('stock')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputName1">Price</label>
                        <input wire:model='price' type="number"
                            class="@error('price') is-invalid @enderror form-control" id="exampleInputName1">
                        @error('price')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>