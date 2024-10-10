<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div aria-hidden="true">&times;</div>
                </button>
            </div>
            <form wire:submit.prevent='createCategory'>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input wire:model.defer='name' type="text"
                            class="@error('name') is-invalid @enderror form-control" id="exampleInputName1">
                        @error('name')
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