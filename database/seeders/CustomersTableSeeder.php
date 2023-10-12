<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory as Faker;
class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        // Tipos de documentos disponibles
        $documentTypes = [
            'Tarjeta de identidad',
            'Cédula de ciudadanía',
            'Pasaporte',
            'Cédula de extranjería',
        ];

        // Generar clientes ficticios
        for ($i = 0; $i < 8; $i++) {
            $customer = new Customer();
            $customer->name = $faker->name; // Genera un nombre ficticio
            $customer->type_document = $documentTypes[rand(0, count($documentTypes) - 1)]; // Elige un tipo de documento aleatorio
            $customer->document = $faker->unique()->randomNumber(8); // Genera un número de documento aleatorio
            $customer->save();
        }
    }
}
