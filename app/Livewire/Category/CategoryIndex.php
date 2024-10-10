<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
#[Title('Category')]
class CategoryIndex extends Component
{
    use WithPagination;
    public $name, $category_id;
    public $isEditMode = false;
    public $search = '';

    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:categories,name,' . $this->category_id,
        ];
    }

    public function resetInput()
    {
        $this->reset(['name']);
    }

    public function createCategory()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
        ]);

        $this->resetInput();

        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'Category created successfully']);
    }
    public function resetFormCreate()
    {
        $this->resetInput();
        $this->isEditMode = false;
    }

    public function editCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->isEditMode = true;
    }

    public function updateCategory()
    {
        $this->Validate();

        $category = Category::findOrFail($this->category_id);
        $category->update([
            'name' => $this->name,
        ]);

        $this->resetInput();

        $this->dispatch('close-modal');
        $this->dispatch('success', ['message' => 'Category updated successfully']);

    }

    public function deleteCategory($id)
    {
        Category::destroy($id);
        $this->dispatch('success', ['message' => 'Category deleted successfully']);
    }
    public function render()
    {
        $category = Category::where('name', 'like', '%' . $this->search . '%')
            ->latest()->paginate(10);

        return view('livewire.category.category-index', [
            'category' => $category
        ])->layout('components.layouts.main');
    }
}
