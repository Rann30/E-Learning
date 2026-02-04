<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Announcement;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============ USERS ============

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin System',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // Teacher 1
        $teacher1 = User::firstOrCreate(   // ✅ BENAR
            ['email' => 'teacher@test.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'teacher'
            ]
        );



        // Student 1
        $user1 = User::firstOrCreate(
            ['email' => 'zaffran@student.com'],
            [
                'name' => 'Muhammad Zaffran Az-zahran',
                'password' => Hash::make('password'),
                'role' => 'student'
            ]
        );

        $student1 = Student::firstOrCreate(
            ['user_id' => $user1->id],
            [
                'nis' => '2024001',
                'class' => 'VI A',
                'status' => 'Belum Lulus',

            ]
        );








        // ============ COURSES ============


        $this->command->info('✅ Seeder berhasil dijalankan!');
        $this->command->info('');
        $this->command->info('📧 Login Credentials:');
        $this->command->info('Admin: admin@test.com / password');
        $this->command->info('Teacher 1: teacher@test.com / password');
        $this->command->info('Student 1: zaffran@student.com / password');
    }
}
