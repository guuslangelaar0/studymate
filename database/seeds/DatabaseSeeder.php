<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RoleTableSeeder::class,
            UsersTableSeeder::class,
            ModulesTableSeeder::class,
            TeachersTableSeeder::class
        ]);
    }
}
