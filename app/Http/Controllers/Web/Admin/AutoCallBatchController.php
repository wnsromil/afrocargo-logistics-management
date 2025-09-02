<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoCallBatchController extends Controller
{



    function insertStatesAndCities()
    {
        // 1. States ka data
        $statesData = [
            ['name' => 'Abidjan',             'country_id' => 251, 'country_code' => 'CI', 'type' => 'Autonomous District', 'level' => 1, 'latitude' => 5.4091179,  'longitude' => -4.0422099,  'flag' => 1],
            ['name' => 'Bas-Sassandra',       'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 5.3523063,  'longitude' => -6.6766897,  'flag' => 1],
            ['name' => 'Comoé',               'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 6.0762474,  'longitude' => -3.3082115,  'flag' => 1],
            ['name' => 'Denguélé',            'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 9.6380415,  'longitude' => -7.3900097,  'flag' => 1],
            ['name' => 'Gôh-Djiboua',         'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 5.9536464,  'longitude' => -5.6069906,  'flag' => 1],
            ['name' => 'Lacs',                'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 7.0523847,  'longitude' => -4.4419131,  'flag' => 1],
            ['name' => 'Lagunes',             'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 5.8451583,  'longitude' => -4.2931136,  'flag' => 1],
            ['name' => 'Montagnes',           'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 6.9418251,  'longitude' => -7.6541621,  'flag' => 1],
            ['name' => 'Sassandra-Marahoué',  'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 7.0551607,  'longitude' => -6.3368560,  'flag' => 1],
            ['name' => 'Savanes',             'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 9.5652587,  'longitude' => -5.5594265,  'flag' => 1],
            ['name' => 'Vallée du Bandama',   'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 8.2702860,  'longitude' => -4.9452089,  'flag' => 1],
            ['name' => 'Woroba',              'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 8.3713178,  'longitude' => -6.7463262,  'flag' => 1],
            ['name' => 'Yamoussoukro',        'country_id' => 251, 'country_code' => 'CI', 'type' => 'Autonomous District', 'level' => 1, 'latitude' => 6.8691450,  'longitude' => -5.2823277,  'flag' => 1],
            ['name' => 'Zanzan',              'country_id' => 251, 'country_code' => 'CI', 'type' => 'District',            'level' => 1, 'latitude' => 8.6702847,  'longitude' => -3.3447445,  'flag' => 1],
        ];

        // Insert states and get their IDs
        $stateIdMap = [];
        foreach ($statesData as $state) {
            $id = DB::table('states')->insertGetId($state);
            $stateIdMap[$state['name']] = $id;
        }

        // 2. Cities ka data (state_id ko hum state name se map karenge)
        $citiesData = [
            ['name' => 'Abidjan',            'state_name' => 'Abidjan', 'state_code' => 'AB', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.35861,   'longitude' => -4.01389,   'flag' => 1],
            ['name' => 'Yopougon',           'state_name' => 'Abidjan', 'state_code' => 'YO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.38333,   'longitude' => -4.03333,   'flag' => 1],
            ['name' => 'Koumassi',           'state_name' => 'Abidjan', 'state_code' => 'KO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.32361,   'longitude' => -4.00028,   'flag' => 1],
            ['name' => 'Bouaké',             'state_name' => 'Zanzan', 'state_code' => 'BK', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 7.68300,   'longitude' => -5.01700,   'flag' => 1],
            ['name' => 'Daloa',              'state_name' => 'Montagnes', 'state_code' => 'DL', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.88300,   'longitude' => -6.45000,   'flag' => 1],
            ['name' => 'Yamoussoukro',       'state_name' => 'Yamoussoukro', 'state_code' => 'YM', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.81700,   'longitude' => -5.28300,   'flag' => 1],
            ['name' => 'San-Pédro',          'state_name' => 'Bas-Sassandra', 'state_code' => 'SP', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 4.75200,   'longitude' => -6.64100,   'flag' => 1],
            ['name' => 'Korhogo',            'state_name' => 'Savanes', 'state_code' => 'KH', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.46125,   'longitude' => -5.63873,   'flag' => 1],
            ['name' => 'Anyama',             'state_name' => 'Lagunes', 'state_code' => 'AY', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.41700,   'longitude' => -4.02700,   'flag' => 1],
            ['name' => 'Divo',               'state_name' => 'Gôh-Djiboua', 'state_code' => 'DV', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.83500,   'longitude' => -5.36000,   'flag' => 1],
            ['name' => 'Gagnoa',             'state_name' => 'Gôh-Djiboua', 'state_code' => 'GN', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.13300,   'longitude' => -5.95000,   'flag' => 1],
            ['name' => 'Man',                'state_name' => 'Montagnes', 'state_code' => 'MA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 7.41200,   'longitude' => -7.55300,   'flag' => 1],
            ['name' => 'Soubré',             'state_name' => 'Bas-Sassandra', 'state_code' => 'SO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.83300,   'longitude' => -6.73300,   'flag' => 1],
            ['name' => 'Abengourou',         'state_name' => 'Comoé', 'state_code' => 'AB', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.73300,   'longitude' => -3.50000,   'flag' => 1],
            ['name' => 'Aboisso',            'state_name' => 'Comoé', 'state_code' => 'AB', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.46400,   'longitude' => -3.21000,   'flag' => 1],
            ['name' => 'Bingerville',        'state_name' => 'Lagunes', 'state_code' => 'BI', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.37500,   'longitude' => -3.87500,   'flag' => 1],
            ['name' => 'Grand-Bassam',       'state_name' => 'Lagunes', 'state_code' => 'GR', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.25000,   'longitude' => -3.75000,   'flag' => 1],
            ['name' => 'Odienné',            'state_name' => 'Denguélé', 'state_code' => 'OD', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.50000,   'longitude' => -7.55000,   'flag' => 1],
            ['name' => 'Sassandra',          'state_name' => 'Sassandra-Marahoué', 'state_code' => 'SA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.94400,   'longitude' => -6.54100,   'flag' => 1],
            ['name' => 'Toulepleu',          'state_name' => 'Montagnes', 'state_code' => 'TO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.90000,   'longitude' => -7.23300,   'flag' => 1],
            ['name' => 'Tiebissou',          'state_name' => 'Lacs', 'state_code' => 'TI', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.88300,   'longitude' => -4.45000,   'flag' => 1],
            ['name' => 'Vavoua',             'state_name' => 'Gôh-Djiboua', 'state_code' => 'VA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.58300,   'longitude' => -6.48300,   'flag' => 1],
            ['name' => 'Zoukougbeu',         'state_name' => 'Gôh-Djiboua', 'state_code' => 'ZO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.23300,   'longitude' => -6.65000,   'flag' => 1],
            ['name' => 'Séguéla',            'state_name' => 'Denguélé', 'state_code' => 'SE', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 8.16600,   'longitude' => -6.40000,   'flag' => 1],
            ['name' => 'Tanda',              'state_name' => 'Comoé', 'state_code' => 'TA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 7.26600,   'longitude' => -3.36600,   'flag' => 1],
            ['name' => 'Bondoukou',          'state_name' => 'Zanzan', 'state_code' => 'BO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 8.03300,   'longitude' => -2.81600,   'flag' => 1],
            ['name' => 'Bouna',              'state_name' => 'Zanzan', 'state_code' => 'BN', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.26600,   'longitude' => -2.58300,   'flag' => 1],
            ['name' => 'Ferkessédougou',     'state_name' => 'Savanes', 'state_code' => 'FE', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.60000,   'longitude' => -5.16000,   'flag' => 1],
            ['name' => 'Tengrela',           'state_name' => 'Savanes', 'state_code' => 'TE', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 10.08300,  'longitude' => -6.90000,   'flag' => 1],
            ['name' => 'Séguélon',           'state_name' => 'Denguélé',           'state_code' => 'SG', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.25000,   'longitude' => -7.00000,   'flag' => 1],
            ['name' => 'Danané',             'state_name' => 'Montagnes',          'state_code' => 'DA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.91600,   'longitude' => -7.35000,   'flag' => 1],
            ['name' => 'Issia',              'state_name' => 'Gôh-Djiboua',         'state_code' => 'IS', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.16600,   'longitude' => -6.46600,   'flag' => 1],
            ['name' => 'Bangolo',            'state_name' => 'Montagnes',          'state_code' => 'BA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.75000,   'longitude' => -7.13300,   'flag' => 1],
            ['name' => 'Guiglo',             'state_name' => 'Montagnes',          'state_code' => 'GU', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.56600,   'longitude' => -7.35000,   'flag' => 1],
            ['name' => 'Katiola',            'state_name' => 'Vallée du Bandama',  'state_code' => 'KA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 8.11600,   'longitude' => -5.06600,   'flag' => 1],
            ['name' => 'Mankono',            'state_name' => 'Denguélé',           'state_code' => 'MN', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 8.08300,   'longitude' => -6.10000,   'flag' => 1],
            ['name' => 'Sinfra',             'state_name' => 'Lacs',               'state_code' => 'SI', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 7.33300,   'longitude' => -5.08300,   'flag' => 1],
            ['name' => 'Tiebissou',          'state_name' => 'Lacs',               'state_code' => 'TI', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.88300,   'longitude' => -4.45000,   'flag' => 1],
            ['name' => 'Toumodi',            'state_name' => 'Lacs',               'state_code' => 'TO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.78300,   'longitude' => -5.05000,   'flag' => 1],
            ['name' => 'Vavoua',             'state_name' => 'Gôh-Djiboua',         'state_code' => 'VA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.58300,   'longitude' => -6.48300,   'flag' => 1],
            ['name' => 'Yamoussoukro',       'state_name' => 'Yamoussoukro',       'state_code' => 'YA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.81700,   'longitude' => -5.28300,   'flag' => 1],
            ['name' => 'Zuenoula',           'state_name' => 'Lacs',               'state_code' => 'ZU', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 7.01700,   'longitude' => -5.28300,   'flag' => 1],
            ['name' => 'Bondoukou',          'state_name' => 'Zanzan',             'state_code' => 'BO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 8.03300,   'longitude' => -2.81600,   'flag' => 1],
            ['name' => 'Bouna',              'state_name' => 'Zanzan',             'state_code' => 'BN', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.26600,   'longitude' => -2.58300,   'flag' => 1],
            ['name' => 'Nassian',            'state_name' => 'Zanzan',             'state_code' => 'NA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.66600,   'longitude' => -2.51600,   'flag' => 1],
            ['name' => 'Tanda',              'state_name' => 'Comoé',              'state_code' => 'TA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 7.26600,   'longitude' => -3.36600,   'flag' => 1],
            ['name' => 'Agnibilékrou',       'state_name' => 'Comoé',              'state_code' => 'AG', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.78300,   'longitude' => -3.68300,   'flag' => 1],
            ['name' => 'Dabou',              'state_name' => 'Lagunes',            'state_code' => 'DA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.28300,   'longitude' => -4.35000,   'flag' => 1],
            ['name' => 'Tiassalé',           'state_name' => 'Lagunes',            'state_code' => 'TI', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.90000,   'longitude' => -4.65000,   'flag' => 1],
            ['name' => 'Grand-Lahou',        'state_name' => 'Bas-Sassandra',      'state_code' => 'GL', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 5.25000,   'longitude' => -5.00000,   'flag' => 1],
            ['name' => 'Tabou',              'state_name' => 'Bas-Sassandra',      'state_code' => 'TA', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 4.43300,   'longitude' => -7.36600,   'flag' => 1],
            ['name' => 'Dimbokro',           'state_name' => 'Lacs',               'state_code' => 'DI', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 6.66600,   'longitude' => -5.10000,   'flag' => 1],
            ['name' => 'Koun-Fao',           'state_name' => 'Zanzan',             'state_code' => 'KO', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 8.58300,   'longitude' => -3.16600,   'flag' => 1],
            ['name' => 'Ferkessédougou',     'state_name' => 'Savanes',            'state_code' => 'FE', 'country_id' => 251, 'country_code' => 'CI', 'latitude' => 9.60000,   'longitude' => -5.16000,   'flag' => 1],

        ];

        // Insert cities dynamically with correct state_id
        foreach ($citiesData as $city) {
            if (isset($stateIdMap[$city['state_name']])) {
                DB::table('cities')->insert([
                    'name' => $city['name'],
                    'state_id' => $stateIdMap[$city['state_name']],
                    'state_code' => $city['state_code'],
                    'country_id' => $city['country_id'],
                    'country_code' => $city['country_code'],
                    'latitude' => $city['latitude'],
                    'longitude' => $city['longitude'],
                    'flag' => $city['flag'],
                ]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.templates.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
