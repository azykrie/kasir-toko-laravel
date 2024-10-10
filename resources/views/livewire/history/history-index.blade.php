<div>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Order History Tables</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <input type="text" wire:model.live="search" placeholder="Search order.." class="form-control w-50 ml-3">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Cashier Name</th>
                                <th>Grand Total</th>
                                <th>Change</th>
                                <th>Pay</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $index => $data)
                            <tr>
                                <td>{{ $data->no_order}}</td>
                                <td>{{ $data->name_cashier}}</td>
                                <td>{{ number_format($data->grand_total)}}</td>
                                <td>{{ number_format($data->change)}}</td>
                                <td>{{ number_format($data->pay)}}</td>
                                <td><button wire:click='detailOrder({{ $data->id }})' data-toggle="modal"
                                        data-target="#showDetail" class="btn btn-warning btn-sm">Detail</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('livewire.history.history-order')
                </div>
            </div>
        </div>
    </div>
</div>