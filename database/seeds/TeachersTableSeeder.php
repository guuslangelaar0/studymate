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
                'email' => 'r.meijer@avans.nl',
                'modules' => [
                    1,
                    2 => ['coordinator' => 1],
                ]
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
        $all = Teacher::all()->pluck('email')->toArray(); //decrypted by the model, but cant search for it.

        foreach ($teachers as $givenTeacher) {
            if (!in_array($givenTeacher['email'], $all)) {
                $teacher = new Teacher();
                $teacher->firstname = $givenTeacher['firstname'];
                $teacher->lastname = $givenTeacher['lastname'];
                $teacher->email = $givenTeacher['email'];
                $teacher->save();

                $teacher->modules()->sync($givenTeacher['modules'] ?? []);
            }
        }
    }
}
