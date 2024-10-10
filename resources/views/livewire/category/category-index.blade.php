<div>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Category Tables</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <button type="button" wire:click='resetFormCreate' class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Create
                </button>
                <input type="text" wire:model.live="search" placeholder="Search category..."
                    class="form-control w-50 ml-3">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 75%;">Name</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $index => $data)
                            <tr>
                                <td>{{ $category->firstItem() + $index }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <button type="button" wire:click='editCategory({{ $data->id }})' class="btn btn-warning btn-sm"
                                        data-toggle="modal" data-target="#editModal">
                                        Edit
                                    </button>
                                    <button wire:click="deleteCategory({{ $data->id }})" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$category->links('vendor.livewire.bootstrap')}}
                </div>
            </div>
            @include('livewire.category.create')
            @include('livewire.category.edit')
            @include('livewire.category.scripts')
        </div>
    </div>
</div>
