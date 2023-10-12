<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        // Generar productos ficticios
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->name = $faker->sentence(3); // Genera un nombre ficticio
            $product->ref = 'REF' . $faker->unique()->numberBetween(1000, 9999); // Genera una referencia única
            $product->quantity = $faker->numberBetween(1, 100); // Genera una cantidad aleatoria
            $product->save();
        }
    }
}
