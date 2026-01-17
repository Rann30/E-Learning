<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\ViolationCard;
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

        // Teacher 2
        $teacher2 = User::firstOrCreate(
            ['email' => 'teacher2@test.com'],
            [
                'name' => 'Siti Nurhaliza',
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
                'class' => 'XII RPL 2',
                'status' => 'Belum Lulus',
                'points' => 0,
                'badges' => 2
            ]
        );

        // Student 2
        $user2 = User::firstOrCreate(
            ['email' => 'student@test.com'],
            [
                'name' => 'Andi Pratama',
                'password' => Hash::make('password'),
                'role' => 'student'
            ]
        );

        $student2 = Student::firstOrCreate(
            ['user_id' => $user2->id],
            [
                'nis' => '2024002',
                'class' => 'XII RPL 2',
                'status' => 'Belum Lulus',
                'points' => 5,
                'badges' => 1
            ]
        );

        // Student 3
        $user3 = User::firstOrCreate(
            ['email' => 'student3@test.com'],
            [
                'name' => 'Dewi Lestari',
                'password' => Hash::make('password'),
                'role' => 'student'
            ]
        );

        $student3 = Student::firstOrCreate(
            ['user_id' => $user3->id],
            [
                'nis' => '2024003',
                'class' => 'XII RPL 1',
                'status' => 'Belum Lulus',
                'points' => 3,
                'badges' => 0
            ]
        );

        // ============ VIOLATION CARDS ============

        ViolationCard::firstOrCreate(
            ['student_id' => $student1->id],
            [
                'card_number' => 'Ganjil 2526',
                'is_active' => true,
                'description' => 'Akses sas ganjil 2526 sudah aktif, kamu dapat melihat kartu ini'
            ]
        );

        ViolationCard::firstOrCreate(
            ['student_id' => $student2->id],
            [
                'card_number' => 'Ganjil 2527',
                'is_active' => true,
                'description' => 'Kartu pelanggaran aktif'
            ]
        );

        // ============ COURSES ============

        $course1 = Course::firstOrCreate(
            ['code' => 'RPL001'],
            [
                'name' => 'Pemrograman Web',
                'description' => 'Belajar membuat website dengan HTML, CSS, JavaScript, PHP dan Laravel',
                'teacher_id' => $teacher1->id
            ]
        );

        $course2 = Course::firstOrCreate(
            ['code' => 'RPL002'],
            [
                'name' => 'Basis Data',
                'description' => 'Mempelajari konsep database, SQL, dan MySQL',
                'teacher_id' => $teacher1->id
            ]
        );

        $course3 = Course::firstOrCreate(
            ['code' => 'RPL003'],
            [
                'name' => 'Pemrograman Mobile',
                'description' => 'Membuat aplikasi Android dengan Java dan Kotlin',
                'teacher_id' => $teacher2->id
            ]
        );

        $course4 = Course::firstOrCreate(
            ['code' => 'MTK001'],
            [
                'name' => 'Matematika',
                'description' => 'Matematika tingkat lanjut',
                'teacher_id' => $teacher2->id
            ]
        );

        // ============ ENROLLMENTS ============

        // Student 1 mengambil 3 kursus
        Enrollment::firstOrCreate(
            ['student_id' => $student1->id, 'course_id' => $course1->id],
            ['is_active' => true]
        );
        Enrollment::firstOrCreate(
            ['student_id' => $student1->id, 'course_id' => $course2->id],
            ['is_active' => true]
        );
        Enrollment::firstOrCreate(
            ['student_id' => $student1->id, 'course_id' => $course3->id],
            ['is_active' => true]
        );

        // Student 2 mengambil 2 kursus
        Enrollment::firstOrCreate(
            ['student_id' => $student2->id, 'course_id' => $course1->id],
            ['is_active' => true]
        );
        Enrollment::firstOrCreate(
            ['student_id' => $student2->id, 'course_id' => $course4->id],
            ['is_active' => true]
        );

        // ============ ANNOUNCEMENTS ============

        Announcement::firstOrCreate(
            ['title' => 'Selamat Datang di Semester Baru!'],
            [
                'content' => 'Selamat datang di semester baru tahun ajaran 2025/2026. Mari kita mulai dengan semangat baru!',
                'type' => 'info',
                'created_by' => $admin->id,
                'is_active' => true
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Pengumpulan Tugas Laravel'],
            [
                'content' => 'Harap segera kumpulkan tugas Laravel sebelum deadline. Tidak ada toleransi keterlambatan.',
                'type' => 'warning',
                'created_by' => $teacher1->id,
                'is_active' => true
            ]
        );

        Announcement::firstOrCreate(
            ['title' => 'Libur Nasional'],
            [
                'content' => 'Besok libur nasional, tidak ada kelas. Selamat beristirahat!',
                'type' => 'success',
                'created_by' => $admin->id,
                'is_active' => true
            ]
        );

        // ============ ASSIGNMENTS ============

        $assignment1 = Assignment::firstOrCreate(
            ['title' => 'Membuat Website E-Commerce'],
            [
                'course_id' => $course1->id,
                'description' => 'Buat website e-commerce sederhana dengan fitur CRUD produk, keranjang belanja, dan checkout.',
                'deadline' => Carbon::now()->addDays(7),
                'max_score' => 100
            ]
        );

        $assignment2 = Assignment::firstOrCreate(
            ['title' => 'Database Design E-Learning'],
            [
                'course_id' => $course2->id,
                'description' => 'Buat ERD dan implementasi database untuk sistem e-learning.',
                'deadline' => Carbon::now()->addDays(5),
                'max_score' => 100
            ]
        );

        $assignment3 = Assignment::firstOrCreate(
            ['title' => 'Aplikasi Todo List Android'],
            [
                'course_id' => $course3->id,
                'description' => 'Buat aplikasi todo list dengan fitur tambah, edit, hapus, dan simpan ke database.',
                'deadline' => Carbon::now()->addDays(10),
                'max_score' => 100
            ]
        );

        $assignment4 = Assignment::firstOrCreate(
            ['title' => 'Quiz Laravel Authentication'],
            [
                'course_id' => $course1->id,
                'description' => 'Implementasi sistem login dan register dengan Laravel Breeze atau custom.',
                'deadline' => Carbon::now()->addDays(3),
                'max_score' => 100
            ]
        );

        // ============ ASSIGNMENT SUBMISSIONS ============

        AssignmentSubmission::firstOrCreate(
            [
                'assignment_id' => $assignment1->id,
                'student_id' => $student1->id
            ],
            [
                'content' => 'Saya sudah menyelesaikan website e-commerce dengan fitur yang diminta.',
                'submitted_at' => Carbon::now()->subDays(2),
                'score' => 85,
                'feedback' => 'Bagus, namun perlu perbaikan di bagian UI/UX',
                'status' => 'graded'
            ]
        );

        AssignmentSubmission::firstOrCreate(
            [
                'assignment_id' => $assignment2->id,
                'student_id' => $student1->id
            ],
            [
                'content' => 'ERD sudah dibuat dengan normalisasi yang benar.',
                'submitted_at' => Carbon::now()->subDays(1),
                'score' => 90,
                'feedback' => 'Sangat baik! ERD sudah sesuai dengan kebutuhan.',
                'status' => 'graded'
            ]
        );

        AssignmentSubmission::firstOrCreate(
            [
                'assignment_id' => $assignment1->id,
                'student_id' => $student2->id
            ],
            [
                'content' => 'Website e-commerce sudah selesai.',
                'submitted_at' => Carbon::now()->subHours(5),
                'status' => 'pending'
            ]
        );

        // ============ SCHEDULES ============

        // Jadwal Senin
        Schedule::firstOrCreate(
            [
                'course_id' => $course1->id,
                'day' => 'Monday'
            ],
            [
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room' => 'Lab Komputer 1'
            ]
        );

        Schedule::firstOrCreate(
            [
                'course_id' => $course2->id,
                'day' => 'Monday'
            ],
            [
                'start_time' => '10:15',
                'end_time' => '12:00',
                'room' => 'Lab Komputer 2'
            ]
        );

        // Jadwal Selasa
        Schedule::firstOrCreate(
            [
                'course_id' => $course3->id,
                'day' => 'Tuesday'
            ],
            [
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room' => 'Lab Mobile'
            ]
        );

        // Jadwal Rabu
        Schedule::firstOrCreate(
            [
                'course_id' => $course1->id,
                'day' => 'Wednesday'
            ],
            [
                'start_time' => '13:00',
                'end_time' => '15:00',
                'room' => 'Lab Komputer 1'
            ]
        );

        // Jadwal Kamis
        Schedule::firstOrCreate(
            [
                'course_id' => $course2->id,
                'day' => 'Thursday'
            ],
            [
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room' => 'Lab Database'
            ]
        );

        Schedule::firstOrCreate(
            [
                'course_id' => $course4->id,
                'day' => 'Thursday'
            ],
            [
                'start_time' => '10:15',
                'end_time' => '12:00',
                'room' => 'Ruang 301'
            ]
        );

        // Jadwal Jumat
        Schedule::firstOrCreate(
            [
                'course_id' => $course3->id,
                'day' => 'Friday'
            ],
            [
                'start_time' => '08:00',
                'end_time' => '10:00',
                'room' => 'Lab Mobile'
            ]
        );

        // ============ ATTENDANCES ============

        // Kehadiran bulan ini untuk student 1
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $statuses = ['hadir', 'hadir', 'hadir', 'hadir', 'hadir', 'hadir', 'izin', 'hadir', 'sakit', 'hadir'];

        foreach ($statuses as $index => $status) {
            Attendance::firstOrCreate(
                [
                    'student_id' => $student1->id,
                    'course_id' => $course1->id,
                    'date' => Carbon::now()->subDays(20 - $index * 2)
                ],
                [
                    'status' => $status,
                    'note' => $status === 'izin' ? 'Ada keperluan keluarga' : ($status === 'sakit' ? 'Flu' : null)
                ]
            );
        }

        // Kehadiran untuk student 2
        for ($i = 0; $i < 8; $i++) {
            Attendance::firstOrCreate(
                [
                    'student_id' => $student2->id,
                    'course_id' => $course1->id,
                    'date' => Carbon::now()->subDays(20 - $i * 2)
                ],
                [
                    'status' => $i % 5 === 0 ? 'alpha' : 'hadir'
                ]
            );
        }

        $this->command->info('✅ Seeder berhasil dijalankan!');
        $this->command->info('');
        $this->command->info('📧 Login Credentials:');
        $this->command->info('Admin: admin@test.com / password');
        $this->command->info('Teacher 1: teacher@test.com / password');
        $this->command->info('Teacher 2: teacher2@test.com / password');
        $this->command->info('Student 1: zaffran@student.com / password');
        $this->command->info('Student 2: student@test.com / password');
        $this->command->info('Student 3: student3@test.com / password');
    }
}
