<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\User;
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
            'first_name' => 'Test User',
            'last_name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $document_lists = [
            ['name' => 'copy_diploma', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_enrollment', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_gwa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_grades', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_graduation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_latin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_units', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_auth', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'cert_copy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'completion_grades', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'computerized_card', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'course_description', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'endorsement_letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'english_medium', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'honorable_dismissal', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'form137a_tor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'spes_certification', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'transcript_records', 'created_at' => now(), 'updated_at' => now()]
        ];

        Document::insert($document_lists);

        $purpose_lists = [
            ['name' => 'board exam', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'birth certificate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'employment abroad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'education assistance', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'evaluation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'local employment', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reference', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'spes application', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'visa application', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'further studies', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'transferee', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'inc', 'created_at' => now(), 'updated_at' => now()]
        ];

        Purpose::insert($purpose_lists);

        $programs = [
            ['name' => 'Bachelor of Science in Elementary Education', 'code' => 'BEED', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bachelor of Science in Secondary Education in English', 'code' => 'BSEDE', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bachelor of Science in Secondary Education in Filipino', 'code' => 'BSEDF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bachelor of Science in Secondary Education in Mathematics', 'code' => 'BSEDM', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bachelor of Science in Computer Science', 'created_at' => now(), 'code' => 'BSCS', 'updated_at' => now()],
            ['name' => 'Bachelor of Science in Information Technology', 'created_at' => now(), 'code' => 'BSIT', 'updated_at' => now()],
            ['name' => 'Bachelor of Science in Accountancy', 'created_at' => now(), 'code' => 'BSA', 'updated_at' => now()],
        ];

        Course::insert($programs);
    }
}
