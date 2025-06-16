<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('currencies')->insert([
            ['country' => 'United States', 'currency_name' => 'US Dollar', 'currency_code' => 'USD', 'exchange_rate' => 1.0000],
            ['country' => 'European Union', 'currency_name' => 'Euro', 'currency_code' => 'EUR', 'exchange_rate' => 0.9100],
            ['country' => 'India', 'currency_name' => 'Indian Rupee', 'currency_code' => 'INR', 'exchange_rate' => 83.1000],
            ['country' => 'Sri Lanka', 'currency_name' => 'Sri Lankan Rupee', 'currency_code' => 'LKR', 'exchange_rate' => 305.0000],
            ['country' => 'Greenland', 'currency_name' => 'Danish Krone', 'currency_code' => 'DKK', 'exchange_rate' => 6.8200],
            ['country' => 'United Kingdom', 'currency_name' => 'British Pound', 'currency_code' => 'GBP', 'exchange_rate' => 0.7800],
            ['country' => 'Nigeria', 'currency_name' => 'Nigerian Naira', 'currency_code' => 'NGN', 'exchange_rate' => 1480.00],
            ['country' => 'Kenya', 'currency_name' => 'Kenyan Shilling', 'currency_code' => 'KES', 'exchange_rate' => 131.00],
            ['country' => 'South Africa', 'currency_name' => 'South African Rand', 'currency_code' => 'ZAR', 'exchange_rate' => 18.40],
            ['country' => 'Ghana', 'currency_name' => 'Ghanaian Cedi', 'currency_code' => 'GHS', 'exchange_rate' => 15.00],
            ['country' => 'Uganda', 'currency_name' => 'Ugandan Shilling', 'currency_code' => 'UGX', 'exchange_rate' => 3750.00],
            ['country' => 'Tanzania', 'currency_name' => 'Tanzanian Shilling', 'currency_code' => 'TZS', 'exchange_rate' => 2550.00],
            ['country' => 'Ethiopia', 'currency_name' => 'Ethiopian Birr', 'currency_code' => 'ETB', 'exchange_rate' => 57.00],
            ['country' => 'Egypt', 'currency_name' => 'Egyptian Pound', 'currency_code' => 'EGP', 'exchange_rate' => 47.00],
            ['country' => 'Zambia', 'currency_name' => 'Zambian Kwacha', 'currency_code' => 'ZMW', 'exchange_rate' => 26.00],
            ['country' => 'Morocco', 'currency_name' => 'Moroccan Dirham', 'currency_code' => 'MAD', 'exchange_rate' => 10.00],
            ['country' => 'Rwanda', 'currency_name' => 'Rwandan Franc', 'currency_code' => 'RWF', 'exchange_rate' => 1300.00],
            ['country' => 'Botswana', 'currency_name' => 'Botswana Pula', 'currency_code' => 'BWP', 'exchange_rate' => 13.70],
            ['country' => 'Cameroon', 'currency_name' => 'Central African CFA Franc', 'currency_code' => 'XAF', 'exchange_rate' => 610.00],
            ['country' => 'Senegal', 'currency_name' => 'West African CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => 'Zimbabwe', 'currency_name' => 'Zimbabwean Dollar', 'currency_code' => 'ZWL', 'exchange_rate' => 1000.00],
            ['country' => 'Namibia', 'currency_name' => 'Namibian Dollar', 'currency_code' => 'NAD', 'exchange_rate' => 18.40],
            ['country' => 'Malawi', 'currency_name' => 'Malawian Kwacha', 'currency_code' => 'MWK', 'exchange_rate' => 1000.00],
            ['country' => 'Mozambique', 'currency_name' => 'Mozambican Metical', 'currency_code' => 'MZN', 'exchange_rate' => 65.00],
            ['country' => 'Angola', 'currency_name' => 'Angolan Kwanza', 'currency_code' => 'AOA', 'exchange_rate' => 800.00],
            ['country' => 'Congo', 'currency_name' => 'Congolese Franc', 'currency_code' => 'CDF', 'exchange_rate' => 2000.00],
            ['country' => 'Burundi', 'currency_name' => 'Burundian Franc', 'currency_code' => 'BIF', 'exchange_rate' => 2000.00],
            ['country' => 'Sierra Leone', 'currency_name' => 'Sierra Leonean Leone', 'currency_code' => 'SLL', 'exchange_rate' => 15000.00],
            ['country' => 'Liberia', 'currency_name' => 'Liberian Dollar', 'currency_code' => 'LRD', 'exchange_rate' => 150.00],
            ['country' => 'Mauritius', 'currency_name' => 'Mauritian Rupee', 'currency_code' => 'MUR', 'exchange_rate' => 45.00],
            ['country' => 'Madagascar', 'currency_name' => 'Malagasy Ariary', 'currency_code' => 'MGA', 'exchange_rate' => 4000.00],
            ['country' => 'Cape Verde', 'currency_name' => 'Cape Verdean Escudo', 'currency_code' => 'CVE', 'exchange_rate' => 100.00],
            ['country' => 'Comoros', 'currency_name' => 'Comorian Franc', 'currency_code' => 'KMF', 'exchange_rate' => 450.00],
            ['country' => 'Djibouti', 'currency_name' => 'Djiboutian Franc', 'currency_code' => 'DJF', 'exchange_rate' => 177.72],
            ['country' => 'Eswatini', 'currency_name' => 'Swazi Lilangeni', 'currency_code' => 'SZL', 'exchange_rate' => 18.40],
            ['country' => 'Lesotho', 'currency_name' => 'Lesotho Loti', 'currency_code' => 'LSL', 'exchange_rate' => 18.40],
            ['country' => 'Seychelles', 'currency_name' => 'Seychellois Rupee', 'currency_code' => 'SCR', 'exchange_rate' => 13.00],
            ['country' => 'Mauritania', 'currency_name' => 'Mauritanian Ouguiya', 'currency_code' => 'MRU', 'exchange_rate' => 36.00],
            ['country' => 'Togo', 'currency_name' => 'Togolese CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => 'Benin', 'currency_name' => 'West African CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => 'Burkina Faso', 'currency_name' => 'West African CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => 'Chad', 'currency_name' => 'Central African CFA Franc', 'currency_code' => 'XAF', 'exchange_rate' => 610.00],
            ['country' => 'Central African Republic', 'currency_name' => 'Central African CFA Franc', 'currency_code' => 'XAF', 'exchange_rate' => 610.00],
            ['country' => 'Gabon', 'currency_name' => 'Central African CFA Franc', 'currency_code' => 'XAF', 'exchange_rate' => 610.00],
            ['country' => 'Guinea-Bissau', 'currency_name' => 'West African CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => 'Mali', 'currency_name' => 'West African CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => "Côte d'Ivoire", "currency_name" => "West African CFA Franc", "currency_code" => "XOF", "exchange_rate" => 610.00],
            ['country' => 'Niger', 'currency_name' => 'West African CFA Franc', 'currency_code' => 'XOF', 'exchange_rate' => 610.00],
            ['country' => 'Sao Tome and Principe', 'currency_name' => 'Dobra', 'currency_code' => 'STN', 'exchange_rate' => 22.00],
            ['country' => 'South Sudan', 'currency_name' => 'South Sudanese Pound', 'currency_code' => 'SSP', 'exchange_rate' => 130.00],
            ['country' => 'Sudan', 'currency_name' => 'Sudanese Pound', 'currency_code' => 'SDG', 'exchange_rate' => 1500.00],
            ['country' => 'Tajikistan', 'currency_name' => 'Tajikistani Somoni', 'currency_code' => 'TJS', 'exchange_rate' => 11.00],
            ['country' => 'Uzbekistan', 'currency_name' => 'Uzbekistani Som', 'currency_code' => 'UZS', 'exchange_rate' => 11000.00],
            ['country' => 'Kazakhstan', 'currency_name' => 'Kazakhstani Tenge', 'currency_code' => 'KZT', 'exchange_rate' => 450.00],
            ['country' => "Kyrgyzstan", "currency_name" => "Kyrgyzstani Som", "currency_code" => "KGS", "exchange_rate" => 90.00],
            ['country' => "Turkmenistan", "currency_name" => "Turkmenistani Manat", "currency_code" => "TMT", "exchange_rate" => 3.50],
            ['country' => 'Armenia', 'currency_name' => 'Armenian Dram', 'currency_code' => 'AMD', 'exchange_rate' => 400.00],
            ['country' => 'Azerbaijan', 'currency_name' => 'Azerbaijani Manat', 'currency_code' => 'AZN', 'exchange_rate' => 1.70],
            ['country' => 'Georgia', 'currency_name' => 'Georgian Lari', 'currency_code' => 'GEL', 'exchange_rate' => 2.60],
            ['country' => 'Mongolia', 'currency_name' => 'Mongolian Tögrög', 'currency_code' => 'MNT', 'exchange_rate' => 3500.00],
            ['country' => 'Vietnam', 'currency_name' => 'Vietnamese Dong', 'currency_code' => 'VND', 'exchange_rate' => 23000.00],
            ['country' => 'Thailand', 'currency_name' => 'Thai Baht', 'currency_code' => 'THB', 'exchange_rate' => 35.00],
            ['country' => 'Indonesia', 'currency_name' => 'Indonesian Rupiah', 'currency_code' => 'IDR', 'exchange_rate' => 15000.00],
            ['country' => 'Philippines', 'currency_name' => 'Philippine Peso', 'currency_code' => 'PHP', 'exchange_rate' => 55.00],
            ['country' => "Malaysia", "currency_name" => "Malaysian Ringgit", "currency_code" => "MYR", "exchange_rate" => 4.50],
            ['country' => "Singapore", "currency_name" => "Singapore Dollar", "currency_code" => "SGD", "exchange_rate" => 1.35],
            ['country' => "South Korea", "currency_name" => "South Korean Won", "currency_code" => "KRW", "exchange_rate" => 1300.00],
            ['country' => "Japan", "currency_name" => "Japanese Yen", "currency_code" => "JPY", "exchange_rate" => 110.00],
            ['country' => "China", "currency_name" => "Chinese Yuan Renminbi", "currency_code" => "CNY", "exchange_rate" => 6.50],
        ]);
    }
}
