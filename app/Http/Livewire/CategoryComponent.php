<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;

    public bool $isModalOpen = false;
    public bool $updateMode  = false;
    public $name, $category_id;

    public function render()
    {


        return view('livewire.category.index-component', [
            'categories' => Category::paginate(5),
        ])->layout('layouts.user');
    }

    public function edit(Category $category)
    {
        $this->category_id = $category->id;
        $this->name        = $category->name;
        $this->slug        = $category->slug;
        $this->updateMode  = true;

        $this->openModal();

    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Category::find($this->category_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('message' , 'Category Updated');
        session()->flash('alert' , 'success');
        $this->closeModal();
        $this->resetForm();

    }

    public function create()
    {
        $this->resetForm();
        $this->openModal();
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('message', 'Category Created Successfully');
        session()->flash('alert', 'success');

        $this->closeModal();
        $this->resetForm();

    }

    public function delete(int $id)
    {

        if($id == 1) {
            session()->flash('message', 'You Can\'t Delete This Category');
            session()->flash('alert', 'danger');
        } else {
            $category = Category::find($id);
            $products = $category->products;
            if ($products->count() > 0) {
                foreach ($products as $product) {
                    $product->update(['category_id' => 1]);
                }
            }

            $category->delete();
            session()->flash('message', 'Category Deleted Successfully');
            session()->flash('alert', 'success');
        }

    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetForm()
    {
        $this->reset('name', 'updateMode');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
