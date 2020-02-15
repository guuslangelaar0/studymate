<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'admin.overview','label' => 'Admin overview page'],

            ['name' => 'user.overview','label' => 'User overview page'],
            ['name' => 'user.create','label' => 'User create page'],
            ['name' => 'user.update','label' => 'User update page'],
            ['name' => 'user.delete','label' => 'User delete page'],

            ['name' => 'teacher.overview','label' => 'Teacher overview page'],
            ['name' => 'teacher.create','label' => 'Teacher create page'],
            ['name' => 'teacher.update','label' => 'Teacher update page'],
            ['name' => 'teacher.delete','label' => 'Teacher delete page'],

            ['name' => 'module.overview','label' => 'Module overview page'],
            ['name' => 'module.create','label' => 'Module create page'],
            ['name' => 'module.update','label' => 'Module update page'],
            ['name' => 'module.delete','label' => 'Module delete page'],

            ['name' => 'role.overview','label' => 'Role overview page'],
            ['name' => 'role.create','label' => 'Role create page'],
            ['name' => 'role.update','label' => 'Role update page'],
            ['name' => 'role.delete','label' => 'Role delete page'],

            ['name' => 'permission.overview','label' => 'Permission overview page'],
            ['name' => 'permission.create','label' => 'Permission create page'],
            ['name' => 'permission.update','label' => 'Permission update page'],
            ['name' => 'permission.delete','label' => 'Permission delete page'],
        ];

        foreach ($permissions as $permission){
            if(Permission::where('name',$permission['name'])->first() === null){
                $p = new Permission($permission);
                $p->save();
            }
        }
    }
}
