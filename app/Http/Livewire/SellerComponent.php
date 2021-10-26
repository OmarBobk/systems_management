<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SellerComponent extends Component
{

    public $searchKeyword, $results;
    public $sellers, $editName, $editPhone, $editAddress;
    public $name, $phone, $address;
    public $newSellerName, $newSellerPhone, $newSellerAddress;

    public $brand_name, $brand_description;
    public $new_brand_name, $new_brand_description;

    public $is_brand_name, $is_brand_description, $is_view_brands;
    public $is_show_brands_from_search, $is_create_new_seller, $is_create_new_brand;
    public $is_view_brands_from_search_form;

    protected array $rules = [
        'newSellerName'    => 'required',
        'newSellerPhone'   => 'required',
        'newSellerAddress' => 'required',
    ];

    public function render()
    {

        $this->sellers = Seller::all();

        return view('livewire.sellers.seller-component')->layout('layouts.user');
    }

    /**
     * Search For a Seller
     */
    public function updatedSearchKeyword()
    {
        $this->results = Seller::where("name", "like", "%$this->searchKeyword%")->orderBy('id')->get();
    }

    /**
     * Toggle view Brands table.
     *
     * @param $id
     */
    public function viewBrands($id)
    {
        $this->is_view_brands = (isset($this->is_view_brands))
            ? (isset($this->is_view_brands[$id])
                ? (($this->is_view_brands[$id])
                    ? [$id => false]
                    : [$id => true])
                : [$id => true])
            : [$id => false];

    }

    /**
     * Toggle view Brands table from search form.
     *
     * @param $id
     */
    public function viewBrandFromSearchForm($id)
    {
        $this->is_view_brands_from_search_form = (isset($this->is_view_brands_from_search_form))
            ? (isset($this->is_view_brands_from_search_form[$id])
                ? (($this->is_view_brands_from_search_form[$id])
                    ? [$id => false]
                    : [$id => true])
                : [$id => true])
            : [$id => false];

    }

    /**
     * view Seller and his brands table next user
     * find him by searching and clicking on seller name.
     *
     * @param Seller $seller
     */
    public function showBrandsFromSearch(Seller $seller)
    {
        $this->is_show_brands_from_search = [];
        $this->is_show_brands_from_search[$seller->id] = true;
    }

    /**
     * Edit Seller Name
     *
     * @param Seller $seller
     */
    public function editName(Seller $seller)
    {
        $this->editName    = [$seller->id => true];
        $this->editPhone   = [$seller->id => false];
        $this->editAddress = [$seller->id => false];
        $this->name[$seller->id] = $seller->name;
    }

    /**
     * Update Seller Name
     *
     * @param Seller $seller
     */
    public function updateNameEnter(Seller $seller)
    {
        $seller->update(['name' => $this->name[$seller->id]]);
        $this->editName = [$seller->id => false];
    }

    /**
     * Close The Edit Seller Name
     *
     * @param $id
     */
    public function closeUpdateNameEnter($id)
    {
        $this->editName = [$id => false];
    }



    /**
     * Edit Seller Phone Number
     * @param Seller $seller
     */
    public function editPhone(Seller $seller)
    {
        $this->editName    = [$seller->id => false];
        $this->editPhone   = [$seller->id => true];
        $this->editAddress = [$seller->id => false];
        $this->phone[$seller->id] = $seller->phone;
    }

    /**
     * Update Seller Phone Number
     *
     * @param Seller $seller
     */
    public function updatePhoneEnter(Seller $seller)
    {
        $seller->update(['phone' => $this->phone[$seller->id]]);
        $this->editPhone = [$seller->id => false];
    }

    /**
     * Close The Edit Seller Phone Number
     *
     * @param $id
     */
    public function closeUpdatePhoneEnter($id)
    {
        $this->editPhone = [$id => false];
    }



    /**
     * Edit Seller Address Number
     * @param Seller $seller
     */
    public function editAddress(Seller $seller)
    {
        $this->editName    = [$seller->id => false];
        $this->editPhone   = [$seller->id => false];
        $this->editAddress = [$seller->id => true];
        $this->address[$seller->id] = $seller->address;
    }

    /**
     * Update Seller Address Number
     *
     * @param Seller $seller
     */
    public function updateAddressEnter(Seller $seller)
    {
        $seller->update(['address' => $this->address[$seller->id]]);
        $this->editAddress = [$seller->id => false];
    }

    /**
     * Close The Edit Seller Address Number
     *
     * @param $id
     */
    public function closeUpdateAddressEnter($id)
    {
        $this->editAddress = [$id => false];
    }


    /**
     * Edit Brand Name
     *
     * @param $id
     * @param Brand $brand
     */
    public function editBrandName($id, Brand $brand)
    {
        $this->determineWhatToEdit($id, $brand->id, 'name');
        $this->brand_name[$id][$brand->id]    = $brand->name;
    }

    public function updateBrandName($id, Brand $brand)
    {
        $brand->update(['name' => $this->brand_name[$id][$brand->id]]);
        $this->is_brand_name = [$id => [$brand->id => false]];
    }

    public function closeBrandName($seller_id, $brand_id)
    {
        $this->is_brand_name = [$seller_id => [$brand_id => false]];
    }


    /**
     * Edit Brand Description.
     *
     * @param $id
     * @param Brand $brand
     */
    public function editBrandDescription($id, Brand $brand)
    {
        $this->determineWhatToEdit($id, $brand->id, 'description');
        $this->brand_description[$id][$brand->id]    = $brand->description;
    }

    public function updateBrandDescription($id, Brand $brand)
    {
        $brand->update(['description' => $this->brand_description[$id][$brand->id]]);
        $this->is_brand_description = [$id => [$brand->id => false]];
    }

    public function closeBrandDescription($seller_id, $brand_id)
    {
        $this->is_brand_description = [$seller_id => [$brand_id => false]];
    }



    public function addNewSeller()
    {
        $this->resetCreateNewSellerForm();
        $this->is_create_new_seller = true;
    }

    public function storeSeller()
    {

        $this->validate();

        Seller::create([
            'name'          => $this->newSellerName,
            'phone'         => $this->newSellerPhone,
            'address'       => $this->newSellerAddress,
        ]);

        session()->flash('message', 'Seller Created');
        session()->flash('alert' , 'success');

        $this->closeCreateSellerComponent();
        $this->resetCreateNewSellerForm();

    }

    public function closeCreateSellerComponent()
    {
        $this->is_create_new_seller = false;
    }

    public function resetCreateNewSellerForm()
    {
        $this->reset('newSellerName', 'newSellerPhone', 'newSellerAddress');
    }



    public function createNewBrand($id)
    {
        $this->resetCreateNewBrandForm();
        $this->is_create_new_brand = [$id => true];
    }

    public function storeBrand($seller_id)
    {
        $this->validate([
            'new_brand_name'          => 'required',
        ]);

        Brand::create([
            'name'          => $this->new_brand_name,
            'description'   => $this->new_brand_description,
            'seller_id'     => $seller_id,
        ]);

        session()->flash('message', 'Brand Created');
        session()->flash('alert' , 'success');

        $this->closeCreateBrandComponent();
        $this->resetCreateNewBrandForm();

    }

    public function closeCreateBrandComponent()
    {
        $this->is_create_new_brand = false;
    }

    public function resetCreateNewBrandForm()
    {
        $this->reset('new_brand_name', 'new_brand_description');
    }



    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    /**
     * Helper function
     * @param $seller_id
     * @param Brand $brand
     */
    public function determineWhatToUpdate($seller_id, Brand $brand)
    {
        $available_methods = [
            $this->is_brand_name        [$seller_id][$brand->id] => 'updateBrandName',
            $this->is_brand_description [$seller_id][$brand->id] => 'updateBrandDescription',
        ];

        // calling the method
        $this->{$available_methods[1]}($seller_id, $brand);

    }

    /**
     * Helper function
     * @param $seller_id
     * @param $brand_id
     */
    public function determineWhatToClose($seller_id, $brand_id)
    {
        $available_methods = [
            $this->is_brand_name        [$seller_id][$brand_id] => 'closeBrandName',
            $this->is_brand_description [$seller_id][$brand_id] => 'closeBrandDescription',
        ];

        // calling the method
        $this->{$available_methods[1]}($seller_id, $brand_id);

    }

    public function determineWhatToEdit($seller_id, $brand_id, $field)
    {
        $name           = [$seller_id => [$brand_id => false]];
        $description    = [$seller_id => [$brand_id => false]];

        $$field         = [$seller_id => [$brand_id => true]];

        $this->is_brand_name                 = $name;
        $this->is_brand_description          = $description;

    }

    public function test()
    {
        $x = [
            2 => 3,

        ];
    }

}
