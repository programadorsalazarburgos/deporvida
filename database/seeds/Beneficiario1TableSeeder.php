<?php

use Illuminate\Database\Seeder;
use App\Beneficiario;

class Beneficiario1TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Beneficiario::class,100)->create();
    }
}
