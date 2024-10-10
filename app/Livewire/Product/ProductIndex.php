<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
#[Title("Product")]
class ProductIndex extends Component
{
    public $name, $category_id, $price, $stock, $product_id;
    public $search = '';
    public $isEditMode = false;
    use WithPagination;

    public function rules()
    {
        return
            [
                'name' => 'required',
                'category_id' => 'required',
                'stock' => 'required',
                'price' => 'required'
            ];
    }

    public function resetInput()
    {
        $this->reset('name', 'category_id', 'stock', 'price');
    }

    public function createProduct()
    {
        $this->validate();
        Product::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'stock' => $this->stock,
            'price' => $this->price
        ]);

        $this->resetInput();
        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'Product created successfully']);
    }

    public function resetFormCreate()
    {
        $this->resetInput();
        $this->isEditMode = false;
    }

    public function editProduct($product_id)
    {
        $product = Product::findOrFail($product_id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->isEditMode = true;

    }

    public function updateProduct()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);

        $product->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock
        ]);

        $this->resetInput();
        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'Product updated successfully']);
    }

    public function deleteProduct($product_id)
    {
        Product::destroy($product_id);
        $this->dispatch('success', ['message' => 'Product deleted successfully']);
    }
    public function render()
    {
        $categories = Category::all();
        $product = Product::where('name', 'like', '%' . $this->search . '%')
            ->latest()->paginate(10);


        return view('livewire.product.product-index', [
            'product' => $product,
            'categories' => $categories
        ])->layout('components.layouts.main');
    }
}
