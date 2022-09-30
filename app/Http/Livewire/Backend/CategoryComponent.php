<?php

namespace App\Http\Livewire\Backend;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use function session;
use function view;

class CategoryComponent extends Component
{
    use WithPagination;

    public bool $isModalOpen = false;
    public bool $updateMode  = false;
    public $name, $category_id, $breadcrumbs, $parent_category;
    public $selected_parent_category = [];
    public $listStyle = '';

    public function render()
    {
        $this->breadcrumbs = [
            [
                'route' => 'backend.categories',
                'index' => 'Categories'
            ],
        ];

//        $categories = query();
        $cats= Category::all()->whereNull('category_id');
        $all = Category::orderBy('category_id')->paginate(10);

        return view('livewire.backend.category.index-component', [
            'parent_categories'     => $cats,
            'all_categories'        => $all,
        ])->layout('layouts.user', ['breadcrumbs' => $this->breadcrumbs]);
    }

    public function updatingSelectedParentCategory()
    {
        $this->reset('selected_parent_category');
    }

    public function edit(Category $category)
    {
        $this->category_id = $category->id;
        $this->name        = $category->name;
        $this->slug        = $category->slug;
        $this->selected_parent_category = [$category->category_id => 'on'];
        $this->updateMode  = true;

        $this->openModal();

    }

    public function updateRec()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Category::find($this->category_id)->update([
            'name' => $this->name,
            'category_id' => (array_key_first($this->selected_parent_category) == 'null') ? null : array_key_first($this->selected_parent_category),
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('message' , 'Category Updated');
        session()->flash('alert' , 'success');
        $this->closeModal();
        $this->resetForm();

    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $now = Carbon::now();

        $this->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $this->name,
            'category_id' => (array_key_first($this->selected_parent_category) == 'null') ? null : array_key_first($this->selected_parent_category),
            'slug' => Str::slug($this->name),
            'created_at'=> $now,
            'updated_at'=> $now,
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
        $this->resetForm();

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetForm()
    {
        $this->reset('name', 'updateMode', 'selected_parent_category');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

}
