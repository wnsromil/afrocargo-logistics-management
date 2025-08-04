<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ParcelStatusUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (!Schema::hasColumn('parcel_status', 'class_name')) {
            DB::statement("ALTER TABLE parcel_status ADD COLUMN class_name VARCHAR(255) NULL");
        }

        $statusClasses = [
            '1' => 'new-badge-pending new-comman-css',
            '2' => 'new-badge-pickup new-comman-css',
            '3' => 'new-badge-picked-up new-comman-css',
            '4' => 'new-badge-arrived new-comman-css',
            '5' => 'new-badge-in-transit new-comman-css',
            '6' => 'new-badge-warehouse-load new-comman-css',
            '7' => 'new-badge-discharge new-comman-css',
            '8' => 'new-badge-arrived-final new-comman-css',
            '9' => 'new-badge-ready-pickup new-comman-css',
            '10' => 'new-badge-out-delivery new-comman-css',
            '11' => 'new-badge-delivered new-comman-css',
            '12' => 'new-badge-redelivery new-comman-css',
            '13' => 'new-badge-on-hold new-comman-css',
            '14' => 'new-badge-cancelled new-comman-css',
            '15' => 'new-badge-abandoned new-comman-css',
            '16' => 'new-badge-ready-transfer new-comman-css',
            '17' => 'new-badge-transfer-hub new-comman-css',
            '18' => 'new-badge-received new-comman-css',
            '19' => 'new-badge-hub-arrived new-comman-css',
            '20' => 'new-badge-loading new-comman-css',
            '21' => 'new-badge-self-pickup new-comman-css',
            '22' => 'new-badge-assign-driver new-comman-css',
            '23' => 'new-badge-reschedule new-comman-css',
            '24' => 'new-badge-hold new-comman-css',
            '25' => 'new-badge-gate-in new-comman-css',
            '26' => 'new-badge-in-custom-hold new-comman-css',
            '27' => 'new-badge-load-vessel new-comman-css',
            '28' => 'new-badge-departure new-comman-css',
            '29' => 'new-badge-arrived-vessel new-comman-css',
            '30' => 'new-badge-discharge-vessel new-comman-css',
            '32' => 'new-badge-pending new-comman-css',
            '33' => 'new-badge-hold-cleared new-comman-css',
            '34' => 'new-badge-pending new-comman-css',
            '35' => 'new-badge-arrived new-comman-css',
            '36' => 'new-badge-self-pickup new-comman-css',
            '37' => 'new-badge-gate-in new-comman-css',
            '38' => 'new-badge-assign-driver new-comman-css',
        ];

        foreach ($statusClasses as $id => $class) {
            DB::table('parcel_status')
                ->where('id', $id)
                ->update(['class_name' => $class]);
        }
    }
}
