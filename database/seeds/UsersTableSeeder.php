<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::where('email','guuslangelaar@gmail.com')->first() === null){
            $user = new User();
            $user->firstname = 'Guus';
            $user->lastname = 'Langelaar';
            $user->email = 'guuslangelaar@gmail.com';
            $user->password = bcrypt('test123');
            $user->save();
        }
    }
}
