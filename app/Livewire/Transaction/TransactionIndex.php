<?php

namespace App\Livewire\Transaction;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaction;
use App\Models\OrderProduct;

class TransactionIndex extends Component
{
    public $product_id, $quantity = 1, $total, $pay, $grand_total, $change;

    public function rules()
    {
        return [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ];
    }
    public function addTransaction()
    {
        $this->validate();

        $product = Product::find($this->product_id);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        if ($product->stock < $this->quantity) {
            session()->flash('error', 'Not enough product in stock.');
            return;
        }

        $existingTransaction = Transaction::where('product_id', $this->product_id)->first();

        if ($existingTransaction) {
            session()->flash('error', 'Product already in the table.');
            return;
        }

        $total = $this->quantity * $product->price;

        Transaction::create([
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'total' => $total,
        ]);

        $product->stock -= $this->quantity;
        $product->save();

        session()->flash('success', 'Transaction added successfully.');

        $this->reset(['product_id', 'quantity']);
    }


    public function increment($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $product = $transaction->product;

            if ($product->stock > 0) {
                $transaction->quantity++;
                $transaction->total = $transaction->quantity * $product->price;
                $transaction->save();

                $product->stock--;
                $product->save();
            } else {
                session()->flash('error', 'Not enough product in stock.');
            }
        }
    }

    public function decrement($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            if ($transaction->quantity > 1) {
                $transaction->quantity--;
                $transaction->total = $transaction->quantity * $transaction->product->price;
                $transaction->save();

                $transaction->product->stock++;
                $transaction->product->save();
            } else {
                session()->flash('error', 'Quantity cannot be less than 1');
            }
        }
    }


    public function deleteProduct($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $product = $transaction->product;
            $product->stock += $transaction->quantity;
            $product->save();

            $transaction->delete();
            session()->flash('success', 'Product deleted successfully.');
        }
    }

    public function saveTransaction()
    {
        $transaction = Transaction::all();
        $grand_total = $transaction->sum('total');
        $order = Order::create([
            'no_order' => date('Ymd') . rand(1111, 9999),
            'name_cashier' => auth()->user()->name,
            'grand_total' => $grand_total,
            'pay' => $this->pay,
            'change' => $this->pay - $grand_total
        ]);

        $transaction = Transaction::get();
        $orderProduct = [];

        foreach ($transaction as $index => $item) {
            $product = [
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'total' => $item->total,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            OrderProduct::insert($product);
        }

        Transaction::truncate();

        $this->reset(['pay']);

        $this->dispatch('success', ['message' => 'Transaction saved successfully']);

        $orderWithProducts = Order::with('orderProducts.product')->find($order->id);

        $invoiceData = [
            'order' => $orderWithProducts,
            'products' => $orderWithProducts->orderProducts,
        ];

        $pdf = PDF::loadView('invoice.index', ['data' => $invoiceData])->setPaper('A4');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');

    }

    public function render()
    {
        $pay = floatval($this->pay);
        return view('livewire.transaction.transaction-index', [
            'products' => Product::all(),
            'transactions' => Transaction::all(),
        ])->layout('components.layouts.main');
    }
}
