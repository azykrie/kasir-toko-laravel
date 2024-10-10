<div>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Product Sold</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 10%;">No</th>
                                <th style="width: 50%;">Name</th>
                                <th style="width: 20%;">Quantity</th>
                                <th style="width: 20%;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderProduct as $index => $data)
                            <tr>
                                <td>{{ $orderProduct->firstItem() + $index }}</td>
                                <td>@if ($data->product)
                                    {{ $data->product->name }}
                                    @else
                                    <em>Product not found</em>
                                    @endif
                                </td>
                                <td>{{number_format($data->quantity)}}</td>
                                <td>{{number_format($data->total)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$orderProduct->links('vendor.livewire.bootstrap')}}
                </div>
            </div>
        </div>
    </div>
</div>