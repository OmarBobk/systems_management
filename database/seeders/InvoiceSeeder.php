<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Invoicecustomer;
use App\Models\Invoicerecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer_1 = Invoicecustomer::create([
            'name' => "Mazen",
            "phone" => 5353402539,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $customer_2 = Invoicecustomer::create([
            'name' => "Ahmad",
            "phone" => 5353402539,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // Create Invoices
        $customer_1_invoices = Invoice::create([
            'serial' => 1001,
            'cost' => 500,
            'price' => 506,
            'profit' => 6,
            'amount' => 2,
            'invoicecustomer_id' => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $customer_2_invoices = Invoice::create([
            'serial' => 1002,
            'cost' => 250,
            'price' => 253,
            'profit' => 3,
            'amount' => 1,
            'invoicecustomer_id' => 2,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        // Invoice Records
        $customer_1_invoices_records_1 = Invoicerecord::create([
            'name'   => 'Electric',
            'cost'   => 250,
            'serial'   => 250,
            'price'  => 253,
            'profit' => 3,
            'invoice_id' => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        $customer_1_invoices_records_2 = Invoicerecord::create([
            'name'   => 'Water',
            'cost'   => 250,
            'serial'   => 250,
            'price'  => 253,
            'profit' => 3,
            'invoice_id' => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

        $customer_2_invoices_records = Invoicerecord::create([
            'name'   => 'Electric',
            'cost'   => 250,
            'serial'   => 250,
            'price'  => 253,
            'profit' => 3,
            'invoice_id' => 2,
            "created_at" => now(),
            "updated_at" => now(),
        ]);

    }
}
