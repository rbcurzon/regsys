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
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@example.com',
            'isAdmin' => true,
        ]);

        $document_lists = [
            ['document_name' => 'copy_diploma', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_enrollment', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_gwa', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_grades', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_graduation', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_latin', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_units', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_auth', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'cert_copy', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'completion_grades', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'computerized_card', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'course_description', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'endorsement_letter', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'english_medium', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'honorable_dismissal', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'form137a_tor', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'spes_certification', 'created_at' => now(), 'updated_at' => now()],
            ['document_name' => 'transcript_records', 'created_at' => now(), 'updated_at' => now()]
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
    }
}
