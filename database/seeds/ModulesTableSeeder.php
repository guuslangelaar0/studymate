<?php

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'Web JavaScript',
                'short_name' => 'WEBJS',
                'block' => 7
            ],
            [
                'name' => 'Web PHP',
                'short_name' => 'WEBPHP',
                'block' => 7
            ],
            [
                'name' => 'Web Python',
                'short_name' => 'WEBPYTH',
                'block' => 7
            ]
        ];

        foreach ($modules as $givenModule) {
            if (Module::where('short_name', $givenModule['short_name'])->first() === null) {
                $module = new Module();
                $module->name = $givenModule['name'];
                $module->short_name = $givenModule['short_name'];
                $module->block = $givenModule['block'];
                $module->save();
            }
        }
    }
}
