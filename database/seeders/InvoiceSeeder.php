<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        Invoice::insert([
            [
                'parcel_id' => 1,
                'user_id' => 1,
                'total_amount' => rand(100, 1000),
                'is_paid' => rand(1, 2),
                'invoice_no' => 'INV-001',
                'issue_date' => '2025-10-09',
            ],
            [
                'parcel_id' => 2,
                'user_id' => 1,
                'total_amount' => rand(100, 1000),
                'is_paid' => rand(1, 2),
                'invoice_no' => 'INV-002',
                'issue_date' => '2025-04-19',
            ],
            [
                'parcel_id' => 3,
                'user_id' => 1,
                'total_amount' => rand(100, 1000),
                'is_paid' => rand(1, 2),
                'invoice_no' => 'INV-003',
                'issue_date' => '2025-03-26',
            ],
        ]);
    }
}
