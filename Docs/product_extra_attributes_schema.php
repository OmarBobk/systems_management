<?php

// Products Will be recevied from /api/v1/products

// On sale Logo
// indirimli old_price and new_price
// product name
// product image order 0
// hizli teslimat

$x = '{
    "color": [
        {
            "name": "Red",
            "image": "http://karman.store/assets/images/products/km-258/km-258_0.jpg",
            "order": 0,
            "value": "red",
            "is_active": 1
        },
        {
            "name": "Blue",
            "image": "http://karman.store/assets/images/products/km-258/km-258_1.jpg",
            "order": 1,
            "value": "blue",
            "is_active": 1
        }
    ]
}';


$products = [
    [],
    [],

    'category' => [
        'name' => 'Tablet',
        'slug' => '',
        'parent' => 'Computer & Tablet',
        'grandparent' => 'Electronic',
    ],
];

$attributes = [

    'discount' => [
        [
            'name' => '20%', 'value' => '20', 'type' => 'discount', 'order' => 0,
            'additional' => [],
        ],
        [
            'name' => '10%', 'value' => '10', 'type' => 'discount', 'order' => 0,
            'additional' => [],
        ],
    ],

    'size' => [
        ['name' => 'Small', 'value' => 'S', 'type' => 'size', 'order' => 0],
        ['name' => 'Large', 'value' => 'L', 'type' => 'size', 'order' => 1],
    ],
    'color' => [
        [
            'name' => 'Red', 'value' => '#050', 'type' => 'color', 'order' => 0,
            'additional' => [
                'image' => ['id' => 324, 'path' => 'path/image.jpg'],
            ],
        ],
        [
            'name' => 'blue', 'value' => '#550', 'type' => 'color', 'order' => 1,
            'additional' => [
                'image' => ['id' => 324, 'path' => 'path/image.jpg'],
            ],
        ],
    ],

    'price' => [
        [
            'name' => 'Price', 'value' => '200', 'type' => 'price', 'order' => 0,
            'additional' => [
                "currency" => 'usd',
            ],
        ],
    ],
];

// HomeProducts Section
$products = [
    'title' => 'On Sale',
    'product_count' => 5,
    'order' => 0,
    'products' => [
        ['name' => 'Product Name',
            'price' => 104,
            'is_freeshipping' => false,
            'image' => 'path/image.jpg',],
        ['name' => 'Product Name',
            'price' => 104,
            'is_freeshipping' => false,
            'image' => 'path/image.jpg',],
        ['name' => 'Product Name',
            'price' => 104,
            'is_freeshipping' => false,
            'image' => 'path/image.jpg',],
    ],
    'category' => 98
];

return [[
    // Extra Attributes
    'discount' => [
        // Only the active discount will be applied.
        ['name' => 'The Summer Discount', 'value' => 20, 'is_active' => 1,],
        ['name' => 'The Winter Discount', 'value' => 40, 'is_active' => 0,],
    ],

    'size' => [
        // if is not active then we don't have this size in the stock
        ['name' => 'Small', 'value' => 'S', 'order' => 0, 'is_active' => 1,],
        ['name' => 'Medium', 'value' => 'M', 'order' => 1, 'is_active' => 1,],
        ['name' => 'Large', 'value' => 'L', 'order' => 2, 'is_active' => 1,],
    ],

    'color' => [
        // if is not active then we don't have this color in the stock
        ['name' => 'Red', 'value' => 'red', 'order' => 0, 'image' => 'path/product-code_order.jpg', 'is_active' => 1,],
        ['name' => 'Blue', 'value' => 'blue', 'order' => 1, 'image' => 'path/product-code_order.jpg', 'is_active' => 1,],
        ['name' => 'Black', 'value' => 'black', 'order' => 2, 'image' => 'path/product-code_order.jpg', 'is_active' => 1,],
    ],
], [
    // Description
    // 'Line Number' => 'Description',
]];
