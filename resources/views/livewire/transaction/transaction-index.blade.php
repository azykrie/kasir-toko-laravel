<div>
    <section class="content">
        <div class="container-fluid py-3">
            <div class="row">
                <!-- Order Product Section -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Product</h3>
                        </div>

                        <div class="card-body">
                            <form wire:submit='addTransaction'>
                                <div class="row">
                                    <!-- Product Selection -->
                                    <div class="col-8">
                                        <div class="form-group">
                                            <span>Product Name</span>
                                            <select wire:model='product_id' class="form-control" required>
                                                <option value="">Select Product</option>
                                                @foreach ($products as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Quantity Input -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <span>Quantity</span>
                                            <input wire:model='quantity' type="number" min="1" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Add Product Button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-3">
                                            Add Product
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Success Message -->
                            @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- General Error Message -->
                            @if (session('error'))
                            <div class="alert alert-danger mt-3">
                                {{session('error')}}
                            </div>
                            @endif
                        </div>

                        <!-- Products Table -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="25%">Product Name</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%">Price</th>
                                        <th width="20%">Total</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                @foreach ($transactions as $index => $item)
                                <tbody>
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($item->quantity > 1)
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="decrement({{ $item->id }})">-</button>
                                                @endif
                                                <input type="text" class="form-control qty"
                                                    value="{{ $item->quantity }}" readonly>
                                                <button type="button" class="btn btn-success btn-sm"
                                                    wire:click="increment({{ $item->id }})">+</button>
                                            </div>
                                        </td>
                                        <td>{{number_format($item->product->price)}}</td>
                                        <td>{{number_format($item->total)}}</td>
                                        <td><button type="button" wire:click='deleteProduct({{$item->id}})' class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="card-body">
                                                <label>Total Transaction</label>
                                                <input value="Rp. {{number_format($transactions->sum('total'))}}" type="text" class="form-control" disabled>
                                                <label>Pay</label>
                                                <input wire:model.live='pay' type="number" class="form-control">
                                                <label>Change</label>
                                                <input value="Rp. {{ number_format($pay - $transactions->sum('total')) }}" type="text" class="form-control" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-end">
                                                <button wire:click='saveTransaction' type="button" class="btn btn-info">
                                                    Pay
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Styles -->
        <style>
            .qty {
                width: 40px;
                text-align: center;
            }
        </style>
    </section>
    @include('livewire.transaction.scripts')
</div>