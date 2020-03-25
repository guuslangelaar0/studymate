<?php

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Module;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'firstname' => 'Rik',
                'lastname' => 'Meijer',
                'email' => 'r.meijer@avans.nl'
            ],
            [
                'firstname' => 'Guus',
                'lastname' => 'Langelaar',
                'email' => 'guus@avans.nl'
            ],
            [
                'firstname' => 'Roy',
                'lastname' => 'Berris',
                'email' => 'roy@avans.nl'
            ]
        ];

        foreach ($teachers as $givenTeacher) {
            if (Teacher::where('email', $givenTeacher['email'])->first() === null) {
                $teacher = new Teacher();
                $teacher->firstname = $givenTeacher['firstname'];
                $teacher->lastname = $givenTeacher['lastname'];
                $teacher->email = $givenTeacher['email'];
                $teacher->save();
            }
        }

        // $rikWhere = [
        //         [
        //             'short_name', '=', 'WEBPHP'
        //         ],
        //         [
        //             'block', '=', '7'
        //         ]
        //     ];

        // $rikModules = Module::where($rikWhere)->pluck('id')
        //     ->all();

        // Teacher::where('email', encrypt('r.meijer@avans.nl'))
        //     ->first()->modules()->sync($rikModules);
    }
}
