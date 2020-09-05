<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Mobashir Monim';
        $user->email = 'mobashirmonim@gmail.com';
        $user->password = bcrypt('bangladesh');
        $user->save();

        for ($i = 1; $i <= rand(10,30); $i++) {
            $user = new User;
            $user->name = "Name $i";
            $user->email = "email$i@gmail.com";
            $user->password = bcrypt('bangladesh');
            $user->save();
        }
    }
}
