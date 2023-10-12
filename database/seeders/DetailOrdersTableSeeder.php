<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\DetailOrder;
use Faker\Factory as Faker;

class DetailOrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        $productCount = Product::count();
        $orderCount = Order::count();

        // Generar detalles de órdenes ficticias
        for ($i = 0; $i < 25; $i++) {
            $detailOrder = new DetailOrder();
            $detailOrder->product_id = $faker->numberBetween(1, $productCount); // Asigna un producto aleatorio
            $detailOrder->order_id = $faker->numberBetween(1, $orderCount); // Asigna una orden aleatoria
            $detailOrder->quantity = $faker->numberBetween(1, 10); // Genera una cantidad aleatoria
            $detailOrder->save();
        }
    }
}
