<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductsDatabase;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsDatabaseComponent extends Component
{
    use WithPagination;

    // Edit & Create Product.
    public $name, $price, $cost, $serial, $category_id, $bill_id, $amount,
        $code, $contribution_id, $description, $brand_id, $edit_method_name,
        $is_view_product_details, $is_view_product_actions, $is_view_product_details_actions, $is_edit, $is_edit_details;

    // Just for Create New Product
    public $categories, $sellers, $contributions, $contributors, $bills,
        $contributor_id, $seller_id, $brands,
        $isCreateComponentOpen, $updateMode;

    // Statiscis
    public $products_amount, $products_type_amount, $products_cost, $per_page;

    // Edit Mode
    protected array $properties_rules = [
        'name' => ['name.*' => 'required'],
        'code' => ['code.*' => 'required'],
        'amount' => ['amount.*' => 'required|integer|min:1'],
        'cost' => ['cost.*' => 'required|integer|min:1'],
        'price' => ['price.*' => 'required|integer'],
        'serial' => ['serial.*' => 'required|integer|unique:products,serial'],
        'category_id' => ['category_id.*' => 'required|integer'],
        'contribution_id' => ['contribution_id.*' => 'required|integer'],
        'contributor_id' => ['contributor_id.*' => 'required|integer'],
        'bill_id' => ['bill_id.*' => 'required|integer'],
        'brand_id' => ['brand_id.*' => 'required|integer'],
        'seller_id' => ['seller_id.*' => 'required|integer'],
        'description' => ['description.*' => 'required'],
    ];

    // Edit Mode
    protected array $properties_message = [
        'name' => ['name.*.required' => 'This Field is required!'],
        'code' => ['code.*.required' => 'This Field is required!'],
        'amount' => [
            'amount.*.required' => 'This Field is required!',
            'amount.*.min' => 'Amount Can not be Less then 1!',
            'amount.*.integer' => 'Amount Should be integer!',
        ],
        'cost' => [
            'cost.*.required' => 'This Field is required!',
            'cost.*.min' => 'Cost Can not be 0!',
            'cost.*.integer' => 'Cost Should be integer!',
        ],
        'price' => [
            'price.*.required' => 'This Field is required!',
            'price.*.integer' => 'Price Should be integer!',
        ],
        'serial' => [
            'serial.*.required' => 'This Field is required!',
            'serial.*.integer' => 'Serial Should be integer!',
            'serial.*.unique' => 'This Serial has been used!',
        ],
        'category_id' => [
            'category_id.*.required' => 'This Field is required!',
            'category_id.*.integer' => 'Please Choose an other value.'
        ],
        'contribution_id' => [
            'contribution_id.*.required' => 'This Field is required!',
            'contribution_id.*.integer' => 'Please Choose an other value.'
        ],
        'contributor_id' => [
            'contributor_id.*.required' => 'This Field is required!',
            'contributor_id.*.integer' => 'Please Choose an other value.'
        ],
        'bill_id' => [
            'bill_id.*.required' => 'This Field is required!',
            'bill_id.*.integer' => 'Please Choose an other value.'
        ],
        'brand_id' => [
            'brand_id.*.required' => 'This Field is required!',
            'brand_id.*.integer' => 'Please Choose an other value.'
        ],
        'seller_id' => [
            'seller_id.*.required' => 'This Field is required!',
            'seller_id.*.integer' => 'Please Choose an other value.'
        ],
        'description' => ['description.*.required' => 'This Field is required!'],
    ];

    // Create Mode
    protected array $create_properties_rules = [
        'name' => 'required',
        'code' => 'required',
        'amount' => 'required|integer|min:1',
        'cost' => 'required|integer|min:1',
        'price' => 'required|integer',
        'serial' => 'required|integer|unique:products,serial',
        'category_id' => 'required|integer',
        'contribution_id' => 'required|integer',
        'contributor_id' => 'required|integer',
        'bill_id' => 'required|integer',
        'brand_id' => 'required|integer',
        'seller_id' => 'required|integer',
        'description' => 'required',
    ];

    // Create Mode
    protected array $create_properties_message = [
        'name.required' => 'This Field is required!',
        'code.required' => 'This Field is required!',
        'amount.required' => 'This Field is required!',
        'amount.min' => 'Amount Can not be Less then 1!',
        'amount.integer' => 'Amount Should be integer!',
        'cost.required' => 'This Field is required!',
        'cost.min' => 'Cost Can not be 0!',
        'cost.integer' => 'Cost Should be integer!',
        'price.required' => 'This Field is required!',
        'price.integer' => 'Price Should be integer!',
        'serial.required' => 'This Field is required!',
        'serial.integer' => 'This Field Should be integer!!',
        'serial.unique' => 'This Serial is in used!',
        'category_id.required' => 'This Field is required!',
        'category_id.integer' => 'Please Choose an other value.',
        'contribution_id.required' => 'This Field is required!',
        'contribution_id.integer' => 'Please Choose an other value.',
        'contributor_id.required' => 'This Field is required!',
        'contributor_id.integer' => 'Please Choose an other value.',
        'bill_id.required' => 'This Field is required!',
        'bill_id.integer' => 'Please Choose an other value.',
        'brand_id.required' => 'This Field is required!',
        'brand_id.integer' => 'Please Choose an other value.',
        'seller_id.required' => 'This Field is required!',
        'seller_id.integer' => 'Please Choose an other value.',
        'description.required' => 'This Field is required!',
    ];

    // Search
    public $search_field = 'code';
    public $searchKeyword = '';

    protected $queryString = [
        'searchKeyword' => ['except' => ''],
    ];

    // Breadcrumbs
    public $breadcrumbs;

    public function mount()
    {
        $this->brands = Brand::all();
        $this->is_edit_product_name = [0 => false];
        $this->is_view_product_actions = [0 => false];
        $this->isCreateComponentOpen = false;
        $this->updateMode = false;
        $this->is_edit = [
            'name' => [],
            'code' => [],
            'serial' => [],
        ];
        $this->is_edit_details = [
            'description' => [],
            'brand_id' => [],
            'category_id' => [],
            'updated_at' => [],
        ];

        $this->reset('searchKeyword', 'search_field', 'page');
    }

    public function render()
    {
        $this->breadcrumbs = [
            [
                'route' => 'productsdatabase',
                'index' => 'Products Database'
            ],
        ];
        $this->products_amount = 0;
        $products = ProductsDatabase::where($this->search_field, "like", "%$this->searchKeyword%")
            ->orderBy('id');

        $this->products_type_amount = $products->count();

        foreach ($products->get() as $product) {
            if ($product->id != 1) {
                $this->products_amount += $product->amount;
            }
        }
        return view('livewire.productsdatabase.index-component', [
            'products' => $products->paginate(5)
        ])
            ->layout('layouts.user', ['breadcrumbs' => $this->breadcrumbs]);
    }

    public function create()
    {
        $this->resetCreateComponent();
        $this->openCreateComponent();

    }

    public function store()
    {

        $this->validate($this->create_properties_rules, $this->create_properties_message);


        ProductsDatabase::create([
            'name' => $this->name,
            'description' => $this->description,
            'code' => $this->code,
            'serial' => $this->serial,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('message', 'Product Created');
        session()->flash('alert', 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();

    }


    public function openCreateComponent()
    {
        $this->isCreateComponentOpen = true;
        $this->updateMode = true;
        $this->categories = Category::all();
    }

    public function closeCreateComponent()
    {
        $this->isCreateComponentOpen = false;
        $this->updateMode = false;
    }

    public function resetCreateComponent()
    {
        $this->reset('name', 'serial', 'updateMode', 'description',
            'category_id', 'code', 'brand_id');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function viewProductDetails($id)
    {
        $this->is_view_product_details = (isset($this->is_view_product_details))
            ? (isset($this->is_view_product_details[$id])
                ? (($this->is_view_product_details[$id])
                    ? [$id => false]
                    : [$id => true])
                : [$id => true])
            : [$id => true];


    }

    public function editNew(ProductsDatabase $product, $propertyName)
    {
        $this->closeCreateComponent();
        $this->is_edit = [
            'name' => [],
            'code' => [],
            'serial' => [],
        ];
        $this->{$propertyName}[$product->id] = $product->{$propertyName};
        $this->is_edit[$propertyName][$product->id] = true;
        $this->is_view_product_actions = [];
        $this->is_view_product_actions[$product->id] = true;
        $this->is_edit_details[$propertyName][$product->id] = false;
        $this->is_view_product_details_actions[$product->id] = false;
        $this->edit_method_name = $propertyName;
    }

    public function editDetails(ProductsDatabase $product, $propertyName)
    {
        $this->closeCreateComponent();
        $this->is_edit_details = [
            'description' => [],
            'brand_id' => [],
            'category_id' => [],
            'updated_at' => [],
        ];
        $this->{$propertyName}[$product->id] = $product->{$propertyName};
        $this->is_edit[$propertyName][$product->id] = false;
        $this->is_edit_details[$propertyName][$product->id] = true;
        $this->is_view_product_actions = [];
        $this->is_view_product_actions[$product->id] = false;
        $this->is_view_product_details_actions = [];
        $this->is_view_product_details_actions[$product->id] = true;
        $this->edit_method_name = $propertyName;
    }

    public function updateNew(ProductsDatabase $product, $propertyName)
    {

        $this->validate(
            [$propertyName . '.' . $product->id => $this->properties_rules[$propertyName][$propertyName . '.*']],
            $this->properties_message[$propertyName]
        );
        $product->update([$propertyName => $this->{$propertyName}[$product->id]]);
        $this->closeEdit($product->id, $propertyName);
    }

    public function closeEdit($id, $propertyName)
    {
        $this->is_edit[$propertyName][$id] = false;
        $this->is_edit_details[$propertyName][$id] = false;
        $this->is_view_product_actions[$id] = false;
        $this->is_view_product_details_actions[$id] = false;
    }

    public function updated($propertyName)
    {
        if ($propertyName != 'searchKeyword' and $propertyName != 'search_field') {
            if ($this->updateMode) {
                $this->validateOnly($propertyName, $this->create_properties_rules, $this->create_properties_message);
            } else {
                $name = explode('.', $propertyName)[0];

                $this->validateOnly($propertyName, $this->properties_rules[$name], $this->properties_message[$name]);
            }
        } else {
            $this->reset('page');
        }

    }

    public function delete(int $id)
    {
        ProductsDatabase::find($id)->delete();
        session()->flash('message', 'Product deleted.');
        session()->flash('alert', 'success');
    }


}

