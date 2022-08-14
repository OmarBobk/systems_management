<?php

namespace Database\Seeders;

use App\Models\ProductsContainer;
use Illuminate\Database\Seeder;

class ProductsContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $containers = [];

        // Default.Owner
        $containers[] = [
            'container'  => '{"1":{"id":1,"name":"Product 1","description":"a","code":"pro-1","amount":"10000","cost":"0","price":1.8,"serial":"8581001","category_id":"1","brand_id":"1","user_id":1,"slug":"product-1","created_at":"2022-08-14T20:31:45.173410Z","updated_at":"2022-08-14T20:31:45.173410Z"}}',
            'bill_id'    => 1,
            'is_created' => 1,
        ];

        // Stocktaking.Owner
        $containers[] = [
            'container'  => '{"2":{"id":2,"name":"Product 2","description":"a","code":"pro-2","amount":"1000","cost":"100000","price":150000,"serial":"8581002","category_id":"1","brand_id":"1","user_id":1,"slug":"product-2","created_at":"2022-08-14T20:31:45.173410Z","updated_at":"2022-08-14T20:31:45.173410Z"}}',
            'bill_id'    => 2,
            'is_created' => 1,
        ];

        // Goods.Owner
        $containers[] = [
            'container'  => '{"3":{"id":3,"name":"Product 3","description":"a","code":"pro-3","amount":"1000","cost":"50000","price":100000,"serial":"8581003","category_id":"1","brand_id":"8","user_id":1,"slug":"product-3","created_at":"2022-08-14T20:31:45.173410Z","updated_at":"2022-08-14T20:31:45.173410Z"}}',
            'bill_id'    => 3,
            'is_created' => 1,
        ];

        // Goods.ConX
        $containers[] = [
            'container'  => '{"4":{"id":4,"name":"Product 4","description":"a","code":"pro-4","amount":"1000","cost":"20000","price":50000,"serial":"8581004","category_id":"1","brand_id":"14","user_id":1,"slug":"product-4","created_at":"2022-08-14T20:31:45.173410Z","updated_at":"2022-08-14T20:31:45.173410Z"}}',
            'bill_id'    => 4,
            'is_created' => 1,
        ];

        // Goods.ConX
        $containers[] = [
            'container'  => '{"5":{"id":5,"name":"Product 5","description":"a","code":"pro-5","amount":"1000","cost":"50000","price":100000,"serial":"8581005","category_id":"1","brand_id":"4","user_id":1,"slug":"product-5","created_at":"2022-08-14T20:31:45.173410Z","updated_at":"2022-08-14T20:31:45.173410Z"}}',
            'bill_id'    => 5,
            'is_created' => 1,
        ];


        ProductsContainer::insert($containers);
    }
}
