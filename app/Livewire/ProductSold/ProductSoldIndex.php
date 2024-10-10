<?php

namespace App\Livewire\ProductSold;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderProduct;
use Livewire\Attributes\Title;
use Livewire\WithoutUrlPagination;

#[Title('Product-sold')]
class ProductSoldIndex extends Component
{
    use WithoutUrlPagination;

    public function render()
    {
        $orderProduct = OrderProduct::latest()->paginate(10);
        return view('livewire.product-sold.product-sold-index',[
            'orderProduct' => $orderProduct
        ])->layout('components.layouts.main');
    }
}
