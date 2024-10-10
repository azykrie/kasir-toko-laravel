<div>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Users Tables</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <button type="button" wire:click='resetFormCreate' class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Create
                </button>
                <input type="text" wire:model.live="search" placeholder="Search users..." class="form-control w-50 ml-3">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        @foreach ($users as $index => $data)
                        <tbody>
                            <tr>
                                <td>{{$users->firstItem() + $index}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->role}}</td>
                                <td>
                                    <button type="button" wire:click='editUser({{$data->id}})' class="btn btn-warning btn-sm"
                                        data-toggle="modal" data-target="#editModal">
                                        Edit
                                    </button>
                                    <button wire:click="deleteUser({{ $data->id }})"
                                        class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    {{$users->links('vendor.livewire.bootstrap')}}
                </div>
            </div>
        </div>
        @include('livewire.users.edit')
        @include('livewire.users.create')
        @include('livewire.users.scripts')
    </div>
</div>