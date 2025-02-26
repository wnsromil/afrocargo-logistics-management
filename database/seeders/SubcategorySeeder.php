<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    public function run()
    {
        $categories = DB::table('categories')->get();

        $subcategories = [
            'box' => ['Small Box', 'Medium Box', 'Large Box', 'Custom Box'],
            'bag' => ['Hand Bag', 'Travel Bag', 'School Bag', 'Shopping Bag'],
            'barrel' => ['Small Barrel', 'Medium Barrel', 'Large Barrel', 'Special Barrel'],
            'test box' => ['Test Sample A', 'Test Sample B', 'Test Sample C', 'Other Test Box'],
            'bottel' => ['Glass Bottle', 'Plastic Bottle', 'Metal Bottle', 'Recycled Bottle']
        ];

        foreach ($categories as $category) {
            $categoryName = strtolower($category->name);

            if (isset($subcategories[$categoryName])) {
                foreach ($subcategories[$categoryName] as $sub) {
                    DB::table('subcategories')->insert([
                        'name' => $sub,
                        'category_id' => $category->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    echo "✅ Inserted: " . $sub . " under category: " . $category->name . "\n";
                }
            } else {
                echo "⚠ No subcategories found for category: " . $category->name . "\n";
            }
        }

        echo "✅ Seeder Run Successfully!";
    }
}
