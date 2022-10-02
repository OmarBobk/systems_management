<?php

namespace App\Http\Resources;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Bill;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contribution;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'category'          => (new CategoryResource($this->whenLoaded('category')))->attributes(['name', 'slug'])->data,
            'id'                => $this->id,
            'serial'            => (int) $this->serial,
            'name'              => __('products.'.str_replace(' ', '_', strtolower($this->name))),
            'description'       => $this->description,
            'code'              => $this->code,
            'amount'            => (int) $this->amount,
            'price'             => number_format($this->price / 1000, 3),
            'cost'              => number_format($this->cost / 1000, 3),
            'slug'              => $this->slug,
            'bill'              => Bill::findOrFail($this->bill_id)->only('id', 'serial'),
            'brand'             => Brand::findOrFail($this->brand_id)->only('id', 'name'),
//            'category'          => Category::findOrFail($this->category_id)->only('id', 'name'),
            'contribution'      => Contribution::with('contributor:name,id')->findOrFail($this->contribution_id)->only('id', 'amount', 'created_at', 'contributor'),
            'user'              => User::findOrFail($this->user_id)->only('id', 'name'),
        ];
    }
}
