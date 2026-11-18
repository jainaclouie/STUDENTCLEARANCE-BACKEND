<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'name' => 'Shan Degolacion',
                'address' => 'Davao City, Davao del Sur',
                'email' => 'shan.degolacion@example.com',
                'age' => 21,
                'birthday' => '2003-05-14',
                'clearance_status' => 'pending',
            ],
            [
                'name' => 'Juan Dela Cruz',
                'address' => 'Digos City, Davao del Sur',
                'email' => 'juan.delacruz@example.com',
                'age' => 22,
                'birthday' => '2002-11-02',
                'clearance_status' => 'cleared',
            ],
            [
                'name' => 'Maria Santos',
                'address' => 'Mati City, Davao Oriental',
                'email' => 'maria.santos@example.com',
                'age' => 20,
                'birthday' => '2004-03-27',
                'clearance_status' => 'pending',
            ],
            [
                'name' => 'Mark Villanueva',
                'address' => 'Tagum City, Davao del Norte',
                'email' => 'mark.villanueva@example.com',
                'age' => 23,
                'birthday' => '2001-08-19',
                'clearance_status' => 'rejected',
            ],
            [
                'name' => 'Angel Reyes',
                'address' => 'Panabo City, Davao del Norte',
                'email' => 'angel.reyes@example.com',
                'age' => 21,
                'birthday' => '2003-01-09',
                'clearance_status' => 'cleared',
            ],
        ];

        foreach ($students as $student) {
            Student::updateOrCreate(
                ['email' => $student['email']], // avoid duplicates if you re-run this
                $student
            );
        }
    }
}
