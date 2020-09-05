<?php

use Illuminate\Database\Seeder;
use App\ResourceGroup as RG;

class ResourceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= rand(10,30); $i++) {
            RG::create(['name' => "Resource Group $i", 'description' => Str::random(rand(30,255))]);
        }
    }
}
