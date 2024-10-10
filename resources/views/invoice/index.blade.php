<!DOCTYPE html>
<html>

<head>
    <title>Invoice #{{ $data['order']->no_order }}</title>
    <style>
        /* Styling dasar untuk invoice */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            margin: 0;
        }

        .details,
        .products {
            width: 100%;
            margin-bottom: 20px;
        }

        .details th,
        .details td {
            text-align: left;
            padding: 5px;
        }

        .products table {
            width: 100%;
            border-collapse: collapse;
        }

        .products th,
        .products td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .products th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Invoice</h1>
        <p>No Order: {{ $data['order']->no_order }}</p>
        <p>Name Chasier: {{ $data['order']->name_cashier }}</p>
        <p>Date: {{ $data['order']->created_at->format('d M Y') }}</p>
    </div>

    <div class="details">
        <table>
            <tr>
                <th>Total</th>
                <td>:</td>
                <td>Rp {{ number_format($data['order']->grand_total, 2) }}</td>
            </tr>
            <tr>
                <th>Pay</th>
                <td>:</td>
                <td>Rp {{ number_format($data['order']->pay, 2) }}</td>
            </tr>
            <tr>
                <th>Change</th>
                <td>:</td>
                <td>Rp {{ number_format($data['order']->change, 2) }}</td>
            </tr>
        </table>
    </div>

    <div class="products">
        <h2>Daftar Produk</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['products'] as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>Rp {{ number_format($product->product->price, 2) }}</td>
                    <td>Rp {{ number_format($product->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <h3>Total Payment: Rp {{ number_format($data['order']->grand_total, 2) }}</h3>
    </div>
</body>

</html>