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
        $users = [
            [
                'username' => 'guuslangelaar',
                'email' => 'guuslangelaar@gmail.com',
                'firstname' => 'Guus',
                'lastname' => 'Langelaar',
                'password' => 'test123',
                'roles' => [1]
            ],
            [
                'username' => 'royberris',
                'email' => 'roy@berris.nl',
                'firstname' => 'Roy',
                'lastname' => 'Berris',
                'password' => 'test123',
                'roles' => [1]
            ],
        ];

        foreach ($users as $givenUser) {
            if(User::where('email',$givenUser['email'])->first() === null){
                $user = new User();
                $user->username = $givenUser['username'];
                $user->firstname = encrypt($givenUser['firstname']);
                $user->lastname = encrypt($givenUser['lastname']);
                $user->email = encrypt($givenUser['email']);
                $user->password = bcrypt($givenUser['password']);
                $user->save();

                $user->roles()->sync($givenUser['roles']);
            }
        }

    }
}
