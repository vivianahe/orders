<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Order;
use Faker\Factory as Faker;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        $customerCount = Customer::count();

        // Estado de las órdenes disponibles
        $states = [
            'En Proceso',
            'Listo para Envío',
            'En Tránsito',
            'Entregado',
            'Cancelado',
            'Rechazado',
            'Devuelto',
            'En Espera de Stock',
            'En Revisión',
        ];

        // Generar datos ficticios de órdenes
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->code = 'ORDER' . $faker->unique()->numberBetween(1000, 9999);
            $order->delivery_address = $faker->address;
            $order->state = $states[rand(0, count($states) - 1)];
            $order->delivery_date = $faker->dateTimeBetween('-30 days', '+30 days');
            $order->customer_id = $faker->numberBetween(1, $customerCount);
            $order->save();
        }
    }
}
