<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'admin','label' => 'Administrator'],
        ];

        foreach ($roles as $role){
            if(Role::where('name',$role['name'])->first() === null){
                $r = new Role($role);
                $r->save();
            }
        }

        Role::where('name','admin')->first()->permissions()->sync(Permission::all('id'));
    }
}
