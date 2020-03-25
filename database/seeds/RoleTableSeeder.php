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
            ['name' => 'deadline', 'label' => 'Deadline Manager']
        ];

        foreach ($roles as $role){
            if(Role::where('name',$role['name'])->first() === null){
                $r = new Role($role);
                $r->save();
            }
        }

        $adminPermissions = Permission::all('id');
        Role::where('name','admin')->first()
            ->permissions()
            ->sync($adminPermissions);

        $deadlinePermissions = Permission::where('name', 'like', 'dm.%')
            ->pluck('id')
            ->all();
        Role::where('name', 'deadline')->first()
            ->permissions()
            ->sync($deadlinePermissions);
    }
}
