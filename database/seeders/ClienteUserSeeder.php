<?php

namespace Database\Seeders;

use App\Models\ClienteUser; //Se debe incluir el modelo a usar
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Se pobla mediante el modelo y su factory
        ClienteUser::factory()->count(10)->create();
    }
}
