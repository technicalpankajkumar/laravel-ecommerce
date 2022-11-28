<?php

namespace Database\Seeders;

use App\Models\Brands;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\Config;

class AddProducts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=faker::create();
        foreach(range(1,100)as $value)
        {
          Products::create([
            'name'=>$faker->randomElement(Brands::pluck('name'))."Phone".$faker->numberBetween($min=1, $max=18),
            'brand_id'=>$faker->randomElement(Brands::pluck('id')),
            'price'=>$faker->numberBetween($min=15000,$max=25000),
            'sale_price'=>$faker->numberBetween($min=9000,$max=14999),
            'color'=>$faker->randomElement(['Aqua','Gold','White','Black','WhiteGreen']),
            'product_code'=>$faker->numerify('Lv-#####'),
            'gender'=>$faker->randomElement(['Male','Female','Children','All']),
            'function'=>$faker->randomElement(Config::get('add_function_admin')),
            'stock'=>$faker->randomDigit(),
            'description'=>$faker->text($maxNbChars=500),
            'image'=>$faker->imageUrl($width=300,$height=500),
            'action'=>$faker->randomElement(['1','0'])
          ]);
        }
    }
}
