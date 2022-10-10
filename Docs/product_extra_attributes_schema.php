<?php

return [
    // discount
    'discount' => [
        ['name' => 'The Summer Discount', 'value' => 20, 'is_active' => 1,],
        ['name' => 'The Winter Discount', 'value' => 40, 'is_active' => 0,],
    ],

    'size' => [
        ['name' => 'Small', 'value' => 'S', 'order' => 0,],
        ['name' => 'Medium', 'value' => 'M', 'order' => 1,],
        ['name' => 'Large', 'value' => 'L', 'order' => 2,],
    ],

    'color' => [
        ['name' => 'Red', 'value' => 'red', 'order' => 0, 'image' => 'path/productSerialRed.jpg'],
        ['name' => 'Blue', 'value' => 'blue', 'order' => 1, 'image' => 'path/productSerialBlue.jpg'],
        ['name' => 'Black', 'value' => 'black', 'order' => 2, 'image' => 'path/productSerialBlack.jpg'],
    ],
];
