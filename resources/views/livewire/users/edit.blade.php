<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div aria-hidden="true">&times;</div>
                </button>
            </div>
            <form wire:submit.prevent='updateUser'>
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input wire:model='email' type="email" class="@error('email') is-invalid @enderror form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('email')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input wire:model='password' type="password"
                            class="@error('password') is-invalid @enderror form-control" id="exampleInputPassword1">
                        @error('password')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <label for="role">Roles</label>
                    <select wire:model.defer='role' class="@error('role') is-invalid @enderror custom-select">
                        <option value="" selected>Open this select menu</option>
                        <option value="admin">admin</option>
                        <option value="staff">staff</option>
                        <option value="cashier">cashier</option>
                    </select>
                    @error('role')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>