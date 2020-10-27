<?php

use Illuminate\Database\Seeder;
use App\Scope;

class ScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default = [
            'openid' => '',
            'email' => 'Read your email address',
            'name' => 'Read your name',
            'user' => 'Read your email address and name',
        ];

        foreach ($default as $key => $value) {
            Scope::create(['name' => $key, 'description' => $value]);
        }
    }
}
