<div>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Product Tables</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <button type="button" wire:click='resetFormCreate' class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Create
                </button>
                <input type="text" wire:model.live="search" placeholder="Search product..."
                    class="form-control w-50 ml-3">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $index => $data)
                            <tr>
                                <td>{{ $product->firstItem() + $index }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->category->name }}</td>
                                <td>{{ $data->stock }}</td>
                                <td>{{ number_format($data->price) }}</td>
                                <td>
                                    <button type="button" wire:click='editProduct({{ $data->id }})' class="btn btn-warning btn-sm"
                                        data-toggle="modal" data-target="#editModal">
                                        Edit
                                    </button>
                                    <button wire:click="deleteProduct({{ $data->id }})" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$product->links('vendor.livewire.bootstrap')}}
                </div>
            </div>
            @include('livewire.product.create')
            @include('livewire.product.edit')
            @include('livewire.product.scripts')
        </div>
    </div>
</div>
