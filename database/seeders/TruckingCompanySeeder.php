<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TruckingCompany;

class TruckingCompanySeeder extends Seeder
{
    public function run()
    {
        $companies = [
            ['name' => 'American President Lines', 'code' => 'APL'],
            ['name' => 'Atlantic Container Line', 'code' => 'ACL'],
            ['name' => 'Australia National Line', 'code' => 'ANL'],
            ['name' => 'CMA CGM', 'code' => 'CMA CGM'],
            ['name' => 'COSCO', 'code' => 'COSCO'],
            ['name' => 'China United Line', 'code' => 'CUL'],
            ['name' => 'Crowley', 'code' => 'CROWLY'],
            ['name' => 'Evergreen', 'code' => 'EVERGREEN'],
            ['name' => 'Gold Star Line', 'code' => 'GSL'],
            ['name' => 'Hamburg Süd', 'code' => 'HSD'],
            ['name' => 'Hapag-Lloyd', 'code' => 'HPL'],
            ['name' => 'Hyundai Merchant Marine', 'code' => 'HMM'],
            ['name' => 'Independent Container Line', 'code' => 'ICL'],
            ['name' => 'Maersk', 'code' => 'MAERSK'],
            ['name' => 'Maston Navigation Company', 'code' => 'MASTON'],
            ['name' => 'Mediterranean Shipping Company', 'code' => 'MSC'],
            ['name' => 'Ocean Network Express', 'code' => 'ONE'],
            ['name' => 'Orient Overseas Container Line', 'code' => 'OOCL'],
            ['name' => 'Pacific International Line', 'code' => 'PIL'],
            ['name' => 'SM Line', 'code' => 'SM'],
            ['name' => 'Safmarine Container Line', 'code' => 'SAF'],
            ['name' => 'Sealand Europe', 'code' => 'SEALAND EUROPE'],
            ['name' => 'Sealand', 'code' => 'SEALAND'],
            ['name' => 'Sealand Americas', 'code' => 'SEALAND AMERICAS'],
            ['name' => 'Seth Shipping', 'code' => 'SETH'],
            ['name' => 'Swire Shipping', 'code' => 'SWIRE'],
            ['name' => 'T.S. Line', 'code' => 'TSL'],
            ['name' => 'Transfer', 'code' => 'TRANSFER'],
            ['name' => 'Turku Line', 'code' => 'TURKU'],
            ['name' => 'Wan Hai Line', 'code' => 'WAN HAI'],
            ['name' => 'Westwood Shipping Lines', 'code' => 'WESTWOOD'],
            ['name' => 'Yang Ming Marine Transport', 'code' => 'YML'],
            ['name' => 'Zim American Integrated Shipping Services', 'code' => 'ZIM'],
        ];

        foreach ($companies as $company) {
            TruckingCompany::create($company);
        }
    }
}
