<?php

namespace App\Livewire\History;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('History-order')]
class HistoryIndex extends Component
{
    public $product_id, $quanitity, $total;
    public $orderDetails = [];
    public $search = '';

    public function detailOrder($id)
    {
        $this->orderDetails = OrderProduct::where('order_id', $id)->get();
    }

    public function resetShow()
    {
        $this->reset(['product_id', 'quanitity', 'total', 'orderDetails']);
    }

    public function render()
    {
        $order = Order::where('no_order', 'like', '%' . $this->search . '%')
        ->orWhere('name_cashier', 'like', '%' . $this->search .'%')
        ->latest()->paginate(10);
        return view('livewire.history.history-index', [
            'order' => $order
        ])->layout('components.layouts.main');
    }
}
