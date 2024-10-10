<div wire:ignore.self class="modal fade" id="showDetail" tabindex="-1" aria-labelledby="showDetailLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDetailLabel">Detail Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div aria-hidden="true">&times;</div>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetails as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ number_format($item->product->price) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{number_format($item->total)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click='resetShow' class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
