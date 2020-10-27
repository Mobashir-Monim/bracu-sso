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
        $clients = new Laravel\Passport\ClientRepository;

        for ($i = 1; $i <= rand(10,30); $i++) {
            $client = $clients->create(
                null, "Resource Group $i", "http://127.0.0.1:800$i/callback",
                null, false, true, true
            );

            RG::create(['name' => "Resource Group $i", 'description' => Str::random(rand(30,255)), 'uuid' => $client->id]);
        }
    }
}
