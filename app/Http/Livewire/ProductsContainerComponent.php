<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsContainer;
use App\Models\ProductsDatabase;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsContainerComponent extends Component
{
    use WithPagination;

    // Edit & Create Product.
    public $name, $price, $cost, $serial, $category_id, $bill_id, $amount,
        $code, $contribution_id, $description, $brand_id, $edit_method_name,
        $is_view_product_details, $is_view_product_actions, $is_view_product_details_actions, $is_edit, $is_edit_details;

    // Just for Create New Product
    public $categories, $sellers, $contributions, $contributors, $bills,
        $contributor_id, $seller_id, $brands,
        $isCreateComponentOpen, $updateMode, $createMode;


    // these variables for details page
    public $details_brand, $details_bill;


    public $container_products;

    public $container;

    public $name_create, $code_create, $serial_create, $cost_create, $description_create,
        $price_create, $amount_create, $brand_id_create, $category_id_create;

    public $brands_create;
    public $categories_create;
    public $products_decoded;
    public $total_cost;

    public $products_container_counter, $products_container_total_amount;
    public $search = '';

    // Is products in the container has been
    // created and moved to the stock?
    public $is_products_created;

    // Edit Mode
    protected array $properties_rules = [
        'name_create'        => ['name_create.*' => 'required'],
        'code_create'        => ['code_create.*' => 'required'],
        'amount_create'      => ['amount_create.*' => 'required|integer|min:1'],
        'cost_create'        => ['cost_create.*' => 'required|integer|min:1'],
        'price_create'       => ['price_create.*' => 'required|integer'],
        'serial_create'      => ['serial_create.*' => 'required|integer'],
        'category_id_create' => ['category_id_create.*' => 'required|integer'],
        'brand_id_create'    => ['brand_id_create.*' => 'required|integer'],
        'description_create' => ['description_create.*' => 'required'],
    ];

    // Edit Mode
    protected array $properties_message = [
        'name_create' => ['name_create.*.required' => 'This Field is required!'],
        'code_create' => ['code_create.*.required' => 'This Field is required!'],
        'amount_create' => [
            'amount_create.*.required' => 'This Field is required!',
            'amount_create.*.min' => 'Amount Can not be Less then 1!',
            'amount_create.*.integer' => 'Amount Should be integer!',
        ],
        'cost_create' => [
            'cost_create.*.required' => 'This Field is required!',
            'cost_create.*.min' => 'Cost Can not be 0!',
            'cost_create.*.integer' => 'Cost Should be integer!',
        ],
        'price_create' => [
            'price_create.*.required' => 'This Field is required!',
            'price_create.*.integer' => 'Price Should be integer!',
        ],
        'serial_create' => [
            'serial_create.*.required' => 'This Field is required!',
            'serial_create.*.integer' => 'Serial Should be integer!',
        ],
        'category_id_create' => [
            'category_id_create.*.required' => 'This Field is required!',
            'category_id_create.*.integer' => 'Please Choose an other value.'
        ],
        'brand_id_create' => [
            'brand_id_create.*.required' => 'This Field is required!',
            'brand_id_create.*.integer' => 'Please Choose an other value.'
        ],
        'description_create' => ['description_create.*.required' => 'This Field is required!'],
    ];

    // Create Mode
    protected array $create_properties_rules = [
        'name_create' => 'required',
        'code_create' => 'required',
        'amount_create' => 'required|integer|min:1',
        'cost_create' => 'required|integer|min:1',
        'price_create' => 'required|integer',
        'serial_create' => 'required|integer',
        'category_id_create' => 'required|integer',
        'brand_id_create' => 'required|integer',
        'description_create' => 'required',
    ];

    // Create Mode
    protected array $create_properties_message = [
        'name_create.required'          => 'This Field is required!',
        'code_create.required'          => 'This Field is required!',
        'amount_create.required'        => 'This Field is required!',
        'amount_create.min'             => 'Amount Can not be Less then 1!',
        'amount_create.integer'         => 'Amount Should be integer!',
        'cost_create.required'          => 'This Field is required!',
        'cost_create.min'               => 'Cost Can not be 0!',
        'cost_create.integer'           => 'Cost Should be integer!',
        'price_create.required'         => 'This Field is required!',
        'price_create.integer'          => 'Price Should be integer!',
        'serial_create.required'        => 'This Field is required!',
        'serial_create.integer'         => 'Serial Should be integer!',
        'category_id_create.required'   => 'This Field is required!',
        'category_id_create.integer'    => 'Please Choose an other value.',
        'brand_id_create.required'      => 'This Field is required!',
        'brand_id_create.integer'       => 'Please Choose an other value.',
        'description_create.required'   => 'This Field is required!',
    ];

    public function mount(ProductsContainer $productsContainer)
    {
        $this->container = $productsContainer;
        $this->is_edit_product_name = [0 => false];
        $this->is_view_product_actions = [0 => false];
        $this->isCreateComponentOpen = false;
        $this->updateMode = false;
        $this->createMode = false;
        $this->is_products_created = $this->container->is_created;

        $this->is_edit = [
            'name' => [],
            'code' => [],
            'amount' => [],
            'cost' => [],
            'price' => [],
            'serial' => [],
        ];

        $this->is_edit_details = [
            'description' => [],
            'brand_id' => [],
            'bill_id' => [],
            'category_id' => [],
            'contribution_id' => [],
            'updated_at' => [],
        ];

    }

    public function render()
    {
        $this->brands_create = $this->container->bill->seller->brands;
        $this->categories_create = Category::all();
        $products = json_decode($this->container->container, true);
        $this->products_decoded = json_decode($this->container->container, true);
        $this->products_container_counter = count($products);
        $this->products_container_total_amount = 0;
        $this->total_cost = 0;

        $data = [];

        if (count($products) > 0) {
            foreach ($products as $product) {
                $this->products_container_total_amount += $product['amount'];
                $this->total_cost += $product['cost'] * $product['amount'];
                $data[] = (object)$product;
            }
        }

        if (!($this->search == '')) {
            $products = array_filter(
                array_map(
                    function ($x) {return str_contains($x['serial'], $this->search) ? $x : null; },
                    $products
                ),
                function ($x) {return $x;}
            );
        }

        $this->container_products = collect($data);

        return view('livewire.products-container.index-component', [
            'products' => $products,
        ])->layout('layouts.user');
    }

    public function create()
    {
        $this->resetCreateComponent();

    }

    public function store()
    {
        $data = json_decode($this->container->container, true);

        $this->validate([
            'name_create' => 'required',
            'code_create' => 'required',
            'amount_create' => 'required|integer|min:1',
            'cost_create' => 'required|integer|min:1',
            'serial_create' => ['required','integer',
//                'unique:products,serial',
//                function ($attribute, $value, $fail) use ($data) {
//                    foreach ($data as $product)
//                        if ($product['serial'] == $value)
//                            $fail('This Serial Has been already added to Container.');
//                },
                ],
            'category_id_create' => 'required|integer',
            'brand_id_create' => 'required|integer',
            'description_create' => 'required',
        ], [
            'name_create.required'          => 'This Field is required!',
            'code_create.required'          => 'This Field is required!',
            'amount_create.required'        => 'This Field is required!',
            'amount_create.min'             => 'Amount Can not be Less then 1!',
            'amount_create.integer'         => 'Amount Should be integer!',
            'cost_create.required'          => 'This Field is required!',
            'cost_create.min'               => 'Cost Can not be 0!',
            'cost_create.integer'           => 'Cost Should be integer!',
            'serial_create.required'        => 'This Field is required!',
            'serial_create.integer'         => 'Serial Should be integer!',
//            'serial_create.unique'          => 'This Serial has been used!',
            'category_id_create.required'   => 'This Field is required!',
            'category_id_create.integer'    => 'Please Choose an other value.',
            'brand_id_create.required'      => 'This Field is required!',
            'brand_id_create.integer'       => 'Please Choose an other value.',
            'description_create.required'   => 'This Field is required!',
        ]);

        $id = (!empty($data)) ? array_key_last($data) + 1 : Product::latest('id')->first()->id + 1;

        $data[$id] = [
            'id'                => $id,
            'name'              => $this->name_create,
            'description'       => $this->description_create,
            'code'              => $this->code_create,
            'amount'            => $this->amount_create,
            'cost'              => $this->cost_create,
            'price'             => (($this->cost_create * 80) / 100) + $this->cost_create,
            'serial'            => $this->serial_create,
            'category_id'       => $this->category_id_create,
            'brand_id'          => $this->brand_id_create,
            'user_id'           => Auth::user()->id,
            'slug'              => Str::slug($this->name_create),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        $flash_message = '';

        try {
            ProductsDatabase::whereSerial($this->serial_create)->firstOrFail();
            $flash_message = 'Product Created';

        } catch (ModelNotFoundException $e) {
            ProductsDatabase::create([
                'serial'        => $data[$id]['serial'],
                'name'          => $data[$id]['name'],
                'description'   => $data[$id]['description'],
                'code'          => $data[$id]['code'],
                'slug'          => $data[$id]['slug'],
                'image_url'     => asset('/public/assets/img/products/').$data[$id]['serial'].'jpg',
                'brand_id'      => $data[$id]['brand_id'],
                'category_id'   => $data[$id]['category_id'],
            ]);

            $flash_message = 'Product Created Successfuly in Product Databse & Container';
        }

        $this->container->update(['container' => json_encode($data)]);
        $this->products_container_total_amount += $this->amount_create;

        session()->flash('message', $flash_message);
        session()->flash('message', $flash_message);

        session()->flash('alert', 'success');

        $this->resetCreateComponent();

    }

    public function emptyCreateForm()
    {
        $this->resetCreateComponent();
    }

    public function resetCreateComponent()
    {
        $create_fields = [
            'name_create',
            'code_create',
            'serial_create',
            'cost_create',
            'description_create',
            'price_create',
            'amount_create',
            'brand_id_create',
            'category_id_create',
        ];

        $this->reset(...$create_fields);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }



    public function viewProductDetails($id)
    {
        if (isset($this->is_view_product_details)) {
            if (isset($this->is_view_product_details[$id])) {
                if ($this->is_view_product_details[$id]) {
                    $this->is_view_product_details = [$id => false];
                    $this->is_edit_details = array_map(fn() => [] , $this->is_edit_details);
                    $this->is_view_product_details = null;
                    $this->is_view_product_details_actions = null;
                    return;
                }
            }
        }

        $this->is_view_product_details = [$id => true];

        $this->details_brand = Brand::where('id', $this->container_products->where('id', $id)->first()['brand_id'])->first();


    }

    public function editNew($id, $propertyName)
    {

        $this->updateMode = true;
        $this->createMode = false;
        $product = $this->container_products->where('id', $id)->first();


        $this->is_edit = [
            'name' => [],
            'code' => [],
            'amount' => [],
            'cost' => [],
            'price' => [],
            'serial' => [],
        ];
        $this->{$propertyName}[$product['id']] = $product[$propertyName];
        $this->is_edit[$propertyName][$product['id']] = true;
        $this->is_view_product_actions = [];
        $this->is_view_product_actions[$product['id']] = true;
        $this->is_edit_details[$propertyName][$product['id']] = false;
        $this->is_view_product_details_actions[$product['id']] = false;
        $this->edit_method_name = $propertyName;
    }

    public function editDetails($id, $propertyName)
    {
        $this->updateMode = true;
        $this->createMode = false;
        $product = $this->container_products->where('id', $id)->first();


        $this->is_edit_details = [
            'description' => [],
            'brand_id' => [],
            'category_id' => [],
            'updated_at' => [],
        ];

        $this->{$propertyName}[$product['id']] = $product[$propertyName];
        $this->is_edit[$propertyName][$product['id']] = false;
        $this->is_edit_details[$propertyName][$product['id']] = true;
        $this->is_view_product_actions = [];
        $this->is_view_product_actions[$product['id']] = false;
        $this->is_view_product_details_actions = [];
        $this->is_view_product_details_actions[$product['id']] = true;
        $this->edit_method_name = $propertyName;
    }

    public function updateNew($id, $propertyName)
    {
        $data = $this->products_decoded;

        $rules   = [
            'name' => 'required',
            'code' => 'required',
            'amount' => 'required|integer|min:1',
            'cost' => 'required|integer|min:1',
            'price' => 'required|integer',
            'serial' => ['required','integer',
//                'unique:products,serial',
//                function ($attribute, $value, $fail) use ($data, $id) {
//                    foreach ($data as $product) {
//
//                        if ($product['id'] == $id) {
//                            continue;
//                        }
//
//                        if ($product['serial'] == $value    ) {
//                            $fail('This Serial Number is used.');
//                        }
//                    }
//                },
                ],
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'description' => 'required',
        ];

        $this->validate([
            $propertyName . ".$id" => $rules[$propertyName],
        ], [
            "name.$id.required"          => 'This Field is required!',
            "code.$id.required"          => 'This Field is required!',
            "amount.$id.required"        => 'This Field is required!',
            "amount.$id.min"             => 'Amount Can not be Less then 1!',
            "amount.$id.integer"         => 'Amount Should be integer!',
            "cost.$id.required"          => 'This Field is required!',
            "cost.$id.min"               => 'Cost Can not be 0!',
            "cost.$id.integer"           => 'Cost Should be integer!',
            "price.$id.required"          => 'This Field is required!',
            "price.$id.integer"           => 'Price Should be integer!',
            "serial.$id.required"        => 'This Field is required!',
            "serial.$id.integer"         => 'Serial Should be integer!',
            "serial.$id.unique"          => 'This Serial has been used!',
            "category_id.$id.required"   => 'This Field is required!',
            "category_id.$id.integer"    => 'Please Choose an other value.',
            "brand_id.$id.required"      => 'This Field is required!',
            "brand_id.$id.integer"       => 'Please Choose an other value.',
            "description.$id.required"   => 'This Field is required!',
        ]);

        $data[$id][$propertyName] = $this->{$propertyName}[$id];

        $this->container->update(['container' => json_encode($data)]);

        $this->updateMode = false;
        $this->createMode = true;
        $this->closeEdit($id, $propertyName);
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
        if ($propertyName == 'search') return;
        $name = explode('.', $propertyName)[0];
        $data = json_decode($this->container->container, true);
        $id   = ($this->updateMode) ? explode('.', $propertyName)[1] : 0;

        $check_serial = function ($attribute, $value, $fail) use ($data, $id) {
            foreach ($data as $product) {
                if ($product['id'] == $id) {
                    continue;
                }

                if ($product['serial'] == $value) {
                    $fail('This Serial Number is used.');
                }
            }
        };

        if ($this->updateMode) {
            // Update Mode

            $rules = [
                'name'          => 'required',
                'code'          => 'required',
                'amount'        => 'required|integer|min:1',
                'cost'          => 'required|integer|min:1',
                'price'         => 'required|integer',
                'serial'        => ['required','integer','unique:products,serial', $check_serial],
                'category_id'   => 'required|integer',
                'brand_id'      => 'required|integer',
                'description'   => 'required',
            ];

            $error_msg = [
                'name' => ["name.*.required"          => 'This Field is required!',],
                'code' => ["code.*.required"          => 'This Field is required!',],
                'amount' => [
                    "amount.*.required"        => 'This Field is required!',
                    "amount.*.min"             => 'Amount Can not be Less then 1!',
                    "amount.*.integer"         => 'Amount Should be integer!',
                    ],
                'cost'  => [
                    "cost.*.required"          => 'This Field is required!',
                    "cost.*.min"               => 'Cost Can not be 0!',
                    "cost.*.integer"           => 'Cost Should be integer!',
                    ],
                'price' => [
                    "price.*.required"          => 'This Field is required!',
                    "price.*.integer"           => 'Price Should be integer!',
                    ],
                'serial' => [
                    "serial.*.required"        => 'This Field is required!',
                    "serial.*.integer"         => 'Serial Should be integer!',
                    "serial.*.unique"          => 'This Serial has been used!',
                    ],
                'category_id' => [
                    "category_id.*.required"   => 'This Field is required!',
                    "category_id.*.integer"    => 'Please Choose an other value.',
                    ],
                'brand_id' => [
                    "brand_id.*.required"      => 'This Field is required!',
                    "brand_id.*.integer"       => 'Please Choose an other value.',],
                'description' => ["description.*.required"   => 'This Field is required!',],
            ];

            $name = explode('.', $propertyName)[0];
            $this->validateOnly(
                $propertyName,
                [$propertyName => $rules[$name]],
                $error_msg[$name]);

        } elseif($this->createMode) {
            // Create Mode

            $data = json_decode($this->container->container, true);

            $this->validateOnly($propertyName, [
                'name_create' => [
                    'name_create' => 'required',
                ],
                'code_create' => [
                    'code_create' => 'required',
                ],
                'amount_create' => [
                    'amount_create' => 'required|integer|min:1',
                ],
                'cost_create' => [
                    'cost_create' => 'required|integer|min:1',
                ],
                'price_create' => [
                    'price_create' => 'required|integer',
                ],
                'serial_create' => [
                    'serial_create' => ['required','integer',
//                        'unique:products,serial', $check_serial,
                    ],
                ],
                'category_id_create' => [
                    'category_id_create' => 'required|integer',
                ],
                'brand_id_create' => [
                    'brand_id_create' => 'required|integer',
                ],
                'description_create' => [
                    'description_create' => 'required',
                ],

            ][$propertyName], [
                'name_create' => [
                    'required'          => 'This Field is required!'
                ],
                'code_create' => [
                    'code_create.required'          => 'This Field is required!',
                ],
                'amount_create' => [
                    'amount_create.required'        => 'This Field is required!',
                    'amount_create.min'             => 'Amount Can not be Less then 1!',
                    'amount_create.integer'         => 'Amount Should be integer!',
                ],
                'cost_create' => [
                    'cost_create.required'          => 'This Field is required!',
                    'cost_create.min'               => 'Cost Can not be 0!',
                    'cost_create.integer'           => 'Cost Should be integer!',
                ],
                'price_create' => [
                    'price_create.required'         => 'This Field is required!',
                    'price_create.integer'          => 'Price Should be integer!',
                ],
                'serial_create' => [
                    'serial_create.required'        => 'This Field is required!',
                    'serial_create.integer'         => 'Serial Should be integer!',
//                    'serial_create.unique'          => 'This Serial has been used!',
                ],
                'category_id_create' => [
                    'category_id_create.required'   => 'This Field is required!',
                    'category_id_create.integer'    => 'Please Choose an other value.',
                ],
                'brand_id_create' => [
                    'brand_id_create.required'      => 'This Field is required!',
                    'brand_id_create.integer'       => 'Please Choose an other value.',
                ],
                'description_create' => [
                    'description_create.required'   => 'This Field is required!',
                ],
            ][$propertyName]);
        }


    }

    public function updating($propertyName)
    {


        $pattern = '/^[A-Za-z]*[_][A-Za-z]*(\w+)$/';
        $field = preg_match($pattern, $propertyName);
        if ($field == 0) {
            $this->updateMode = true;
            $this->createMode = false;
        } else {

            $this->createMode = true;
            $this->updateMode = false;
        }

    }

    public function emptyContainer()
    {
        $this->container->update(['container' => '{}']);
    }

    public function delete_product_from_container(int $id)
    {
        $data = json_decode($this->container->container, true);

        if ( array_key_exists($id, $data) ) {
            $this->products_container_total_amount -= $data[$id]['amount'];
            unset($data[$id]);
            $this->container->update(['container' => json_encode($data)]);

            session()->flash('message', 'Product deleted.');
            session()->flash('alert', 'success');
        }
    }

    public function createProductsFromContainer()
    {

        $products = [];
        $container = $this->container;

        if ($this->products_container_total_amount == $this->container->bill->quantity
            and
            $this->is_products_created != 1) {
            if ($this->total_cost == $this->container->bill->amount) {
                foreach ($this->products_decoded as $id => $product) {
                    if ($product['price'] <= $product['cost']) {
                        session()->flash('message', 'Put The Right Price For Product No: '.$id);
                        session()->flash('alert' , 'danger');
                        return;
                    }
                    $products[] = [
                        'id'              => $id,
                        'name'            => $product['name'],
                        'description'     => $product['description'],
                        'code'            => $product['code'],
                        'amount'          => $product['amount'],
                        'cost'            => $product['cost'],
                        'price'           => $product['price'],
                        'serial'          => $product['serial'],
                        'category_id'     => $product['category_id'],
                        'contribution_id' => $container->bill->contribution->id,
                        'brand_id'        => $product['brand_id'],
                        'bill_id'         => $container->bill_id,
                        'user_id'         => Auth::user()->id,
                        'slug'            => Str::slug($product['name']),
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now()
                    ];
                }

                $chunks = array_chunk($products, 50);

                foreach ($chunks as $chunk) {
                    Product::insert($chunk);
                }

                $container->update(['is_created' => 1]);
                $this->is_products_created = 1;

                session()->flash('message', 'Product Created');
                session()->flash('alert' , 'success');

            } else {
                session()->flash('message', 'The Total Cost of The products in the container does not Match The total cost in the bill');
                session()->flash('alert' , 'danger');
            }
        } else {
            session()->flash('message', 'The Quantity of The products in the container does not Match The Quantity in the bill');
            session()->flash('alert' , 'danger');
        }

    }

    public function updatedSerialCreate($value)
    {
        try {
            $product_databse = ProductsDatabase::where('serial', (int) $value)->firstOrFail();

            $this->name_create        = $product_databse->name;
            $this->code_create        = $product_databse->code;
            $this->description_create = $product_databse->description;
            $this->brand_id_create    = $product_databse->brand_id;
            $this->category_id_create = $product_databse->category_id;

        } catch (ModelNotFoundException $e) {
            $this->name_create        = 'Product Not Found In Database!';
            $this->code_create        = 'Product Not Found In Database!';
            $this->description_create = 'Product Not Found In Database!';
        }
    }

}
