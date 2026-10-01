<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolSetting;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // 2. Data Subjects (Mata Pelajaran)
        $subjects = [
            ['subject_code' => 'MTK-01', 'subject_name' => 'Mathematics', 'credits' => 4],
            ['subject_code' => 'BIN-01', 'subject_name' => 'Bahasa Indonesia', 'credits' => 3],
            ['subject_code' => 'BIG-01', 'subject_name' => 'English Language', 'credits' => 3],
            ['subject_code' => 'FIS-01', 'subject_name' => 'Physics', 'credits' => 4],
            ['subject_code' => 'KIM-01', 'subject_name' => 'Chemistry', 'credits' => 3],
            ['subject_code' => 'BIO-01', 'subject_name' => 'Biology', 'credits' => 3],
            ['subject_code' => 'HIS-01', 'subject_name' => 'World History', 'credits' => 2],
        ];

        foreach ($subjects as $sub) {
            Subject::updateOrCreate(['subject_code' => $sub['subject_code']], $sub);
        }

        // 3. Data Teachers + Dibuatkan Akun User (Role: teacher)
        $teachersData = [
            ['nip' => 'TCH-101', 'full_name' => 'Dra. Endang Sri', 'subject_id' => 1, 'username' => 'guru_endang', 'email' => 'endang@school.com'],
            ['nip' => 'TCH-102', 'full_name' => 'Bambang Pamungkas, M.Pd', 'subject_id' => 2, 'username' => 'guru_bambang', 'email' => 'bambang@school.com'],
            ['nip' => 'TCH-103', 'full_name' => 'Sarah Johnson, S.Pd', 'subject_id' => 3, 'username' => 'guru_sarah', 'email' => 'sarah@school.com'],
            ['nip' => 'TCH-104', 'full_name' => 'Dr. Hendra Wijaya', 'subject_id' => 4, 'username' => 'guru_hendra', 'email' => 'hendra@school.com'],
            ['nip' => 'TCH-105', 'full_name' => 'Dewi Lestari, S.Si', 'subject_id' => 5, 'username' => 'guru_dewi', 'email' => 'dewi@school.com'],
        ];

        foreach ($teachersData as $t) {
            $user = User::firstOrCreate(
                ['email' => $t['email']],
                [
                    'username' => $t['username'],
                    'password' => Hash::make('password123'),
                    'role'     => 'teacher',
                ]
            );

            Teacher::updateOrCreate(
                ['nip' => $t['nip']],
                [
                    'nip'        => $t['nip'],
                    'full_name'  => $t['full_name'],
                    'subject_id' => $t['subject_id'],
                    'user_id'    => $user->user_id ?? $user->id,
                ]
            );
        }

        // 4. Data Classes (Kelas)
        $classes = [
            ['class_name' => '10 IPA 1', 'homeroom_teacher_id' => 1, 'academic_year' => '2025/2026'],
            ['class_name' => '10 IPA 2', 'homeroom_teacher_id' => 2, 'academic_year' => '2025/2026'],
            ['class_name' => '11 IPS 1', 'homeroom_teacher_id' => 3, 'academic_year' => '2025/2026'],
            ['class_name' => '11 IPS 2', 'homeroom_teacher_id' => 4, 'academic_year' => '2025/2026'],
            ['class_name' => '12 IPA 3', 'homeroom_teacher_id' => 5, 'academic_year' => '2025/2026'],
        ];

        foreach ($classes as $cls) {
            SchoolClass::updateOrCreate(['class_name' => $cls['class_name']], $cls);
        }

        // 5. Data Students + Dibuatkan Akun User (Role: student)
        $studentsData = [
            ['nis' => 'STD-001', 'full_name' => 'Budi Santoso', 'class_id' => 1, 'date_of_birth' => '2008-05-12', 'username' => 'siswa_budi', 'email' => 'budi@student.com'],
            ['nis' => 'STD-002', 'full_name' => 'Siti Aminah', 'class_id' => 4, 'date_of_birth' => '2007-08-20', 'username' => 'siswa_siti', 'email' => 'siti@student.com'],
            ['nis' => 'STD-003', 'full_name' => 'Andi Saputra', 'class_id' => 5, 'date_of_birth' => '2006-11-03', 'username' => 'siswa_andi', 'email' => 'andi@student.com'],
            ['nis' => 'STD-004', 'full_name' => 'Rizky Pratama', 'class_id' => 1, 'date_of_birth' => '2008-01-15', 'username' => 'siswa_rizky', 'email' => 'rizky@student.com'],
            ['nis' => 'STD-005', 'full_name' => 'Nabila Putri', 'class_id' => 2, 'date_of_birth' => '2008-03-22', 'username' => 'siswa_nabila', 'email' => 'nabila@student.com'],
            ['nis' => 'STD-006', 'full_name' => 'Dwi Cahyono', 'class_id' => 3, 'date_of_birth' => '2007-09-10', 'username' => 'siswa_dwi', 'email' => 'dwi@student.com'],
            ['nis' => 'STD-007', 'full_name' => 'Eka Rahmawati', 'class_id' => 2, 'date_of_birth' => '2008-07-04', 'username' => 'siswa_eka', 'email' => 'eka@student.com'],
            ['nis' => 'STD-008', 'full_name' => 'Fajar Nugraha', 'class_id' => 3, 'date_of_birth' => '2007-12-18', 'username' => 'siswa_fajar', 'email' => 'fajar@student.com'],
            ['nis' => 'STD-009', 'full_name' => 'Gita Gutawa', 'class_id' => 4, 'date_of_birth' => '2007-04-30', 'username' => 'siswa_gita', 'email' => 'gita@student.com'],
            ['nis' => 'STD-010', 'full_name' => 'Hadi Sucipto', 'class_id' => 5, 'date_of_birth' => '2006-06-25', 'username' => 'siswa_hadi', 'email' => 'hadi@student.com'],
        ];

        foreach ($studentsData as $s) {
            $user = User::firstOrCreate(
                ['email' => $s['email']],
                [
                    'username' => $s['username'],
                    'password' => Hash::make('password123'),
                    'role'     => 'student',
                ]
            );

            Student::updateOrCreate(
                ['nis' => $s['nis']],
                [
                    'nis'           => $s['nis'],
                    'full_name'     => $s['full_name'],
                    'class_id'      => $s['class_id'],
                    'date_of_birth' => $s['date_of_birth'],
                    'user_id'       => $user->user_id ?? $user->id,
                ]
            );
        }

        // 6. Data Sekolah / School Settings
        SchoolSetting::updateOrCreate(
            ['school_id' => 1],
            [
                'school_name'   => 'EDUDASH High School',
                'npsn'          => '10293847',
                'address'       => 'Jl. Pendidikan No. 123, Jakarta',
                'phone'         => '021-5551234',
                'email'         => 'info@edudash.sch.id',
                'academic_year' => '2025/2026',
                'semester'      => 'Odd',
            ]
        );
    }
}
