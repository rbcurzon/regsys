<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\Transaction;
use App\Models\User;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'student_id' => '2022-10304',
            'first_name' => 'John',
            'last_name' => 'Xoe',
            'email' => 'jx@example.com',
        ]);

        User::factory()->create([
            'student_id' => '2022-10302',
            'email' => 'jv@example.com',
        ]);

        User::factory()->create([
            'student_id' => '2022-10303',
            'email' => 'jc@example.com',
        ]);

        $document_lists = [
            ['document_name' => 'copy of diploma', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'enrollment certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'gwa certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'grades certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'graduation certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'latin certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'units certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'auth certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'copy certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'completion of grades', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'computerized card', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'course description', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'endorsement letter', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'english medium', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'honorable dismissal', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'form137', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'spes certification', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'transcript records', 'cost' => rand(50, 100), 'created_at' => now(), 'updated_at' => now()]
        ];

        Document::insert($document_lists);

        $purpose_lists = [
            ['purpose_name' => 'board exam', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'birth certificate', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'employment abroad', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'education assistance', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'evaluation', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'local employment', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'reference', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'spes application', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'visa application', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'further studies', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'transferee', 'created_at' => now(), 'updated_at' => now()],
            ['purpose_name' => 'inc', 'created_at' => now(), 'updated_at' => now()]
        ];

        Purpose::insert($purpose_lists);

        $programs = [
            ['course_name' => 'Bachelor of Science in Elementary Education', 'code' => 'BEED', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Bachelor of Science in Secondary Education in English', 'code' => 'BSEDE', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Bachelor of Science in Secondary Education in Filipino', 'code' => 'BSEDF', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Bachelor of Science in Secondary Education in Mathematics', 'code' => 'BSEDM', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Bachelor of Science in Computer Science', 'created_at' => now(), 'code' => 'BSCS', 'updated_at' => now()],
            ['course_name' => 'Bachelor of Science in Information Technology', 'created_at' => now(), 'code' => 'BSIT', 'updated_at' => now()],
            ['course_name' => 'Bachelor of Science in Accountancy', 'created_at' => now(), 'code' => 'BSA', 'updated_at' => now()],
        ];

        Course::insert($programs);

        Transaction::factory(10)->create();

        User::factory()->create([
            'student_id' => '2022-30305',
            'first_name' => 'John',
            'last_name' => 'Zoe',
            'email' => 'jz@example.com',
            'role' => 'treasurer'
        ]);

        User::factory()->create([
            'student_id' => '2022-20301',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'jd@example.com',
            'role' => 'admin'
        ]);
    }
}

