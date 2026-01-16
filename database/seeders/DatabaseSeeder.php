<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\ViolationCard;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user student
        $user = User::create([
            'name' => 'Muhammad Zaffran Az-zahran',
            'email' => 'zaffran@student.com',
            'password' => Hash::make('password'),
            'role' => 'student'
        ]);

        // Buat data student
        $student = Student::create([
            'user_id' => $user->id,
            'nis' => '2024001',
            'class' => 'XII RPL 2',
            'status' => 'Belum Lulus',
            'points' => 0,
            'badges' => 2
        ]);

        // Buat violation card
        ViolationCard::create([
            'student_id' => $student->id,
            'card_number' => 'Ganjil 2526',
            'is_active' => true,
            'description' => 'Akses sas ganjil 2526 sudah aktif, kamu dapat melihat kartu ini'
        ]);
    }
}
