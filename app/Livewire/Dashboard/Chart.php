<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Dashboard")]
class Chart extends Component
{
    public function render()
    {
        $totalUser = User::count();
        $earning = OrderProduct::sum('total');
        $totalOrder = Order::count();
        $totalProductSold = OrderProduct::count();
        
        return view('livewire.dashboard.chart',[
        'totalUser' => $totalUser,
        'earning' => $earning,
        'totalOrder' => $totalOrder,
        'totalProductSold' => $totalProductSold,
        ])->layout('components.layouts.main'); 
    }
}
