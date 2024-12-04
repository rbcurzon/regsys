<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Document;
use App\Models\Purpose;
use App\Models\Transaction;
use App\Models\TransactionDocument;
use App\Models\User;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('accounts')->insert([
            ['name' => 'Cash'],
            ['name' => 'Services Revenues']
        ]);

        User::factory(5)->create();

        $document_lists = [
            ['document_name' => 'Copy of Grades', 'cost' => 30],
            ['document_name' => 'Transcript of Records', 'cost' => 50],
            ['document_name' => 'Certificates of Enrollment', 'cost' => 50],
            ['document_name' => 'Certificates of GWA', 'cost' => 50],
            ['document_name' => 'Certificates of Medium of Certification', 'cost' => 50],
            ['document_name' => 'Certificates of Graduation', 'cost' => 50],
            ['document_name' => 'Dropping of Subjects', 'cost' => 25],
            ['document_name' => 'Filling of Student Leave of Absence (LOA)', 'cost' => 25],
            ['document_name' => 'Exit Clearance or Returning Clearance', 'cost' => 0],
            ['document_name' => 'Petition of Opening of Subject', 'cost' => 0],
            ['document_name' => 'Authentication of Documents', 'cost' => 30],
            ['document_name' => 'Request for Second Copy of Registration Form', 'cost' => 100],
            ['document_name' => 'Request for Second Copy of Comp Card', 'cost' => 50],
            ['document_name' => 'Request for Second Copy of Diploma', 'cost' => 300],
            ['document_name' => 'Request for Completion Form', 'cost' => 50],
            ['document_name' => 'Application for Late Enrollment', 'cost' => 50],
            ['document_name' => 'Application for Re-admission', 'cost' => 50],
            ['document_name' => 'Application for Shifting', 'cost' => 50],
            ['document_name' => 'Application for Clearance for Graduating Students', 'cost' => 0],
        ];

        Document::insert($document_lists);

        $purpose_lists = [
            ['purpose_name' => 'Board Exam'],
            ['purpose_name' => 'Birth Certificate'],
            ['purpose_name' => 'Employment Abroad'],
            ['purpose_name' => 'Education Assistance'],
            ['purpose_name' => 'Evaluation'],
            ['purpose_name' => 'Local Employment'],
            ['purpose_name' => 'Reference'],
            ['purpose_name' => 'Spes Application'],
            ['purpose_name' => 'Visa Application'],
            ['purpose_name' => 'Further Studies'],
            ['purpose_name' => 'Transferee'],
            ['purpose_name' => 'Inc'],
        ];
        Purpose::insert($purpose_lists);

        $programs = [
            ['course_name' => 'Bachelor of Elementary Education', 'code' => 'BEE', 'department'=>'DTE'],
            ['course_name' => 'Bachelor of Secondary Education Major in English', 'code' => 'BSEDE', 'department'=>'DTE'],
            ['course_name' => 'Bachelor of Secondary Education Major in Filipino', 'code' => 'BSEDF', 'department'=>'DTE'],
            ['course_name' => 'Bachelor of Secondary Education Major in Mathematics', 'code' => 'BSEDM', 'department'=>'DTE'],
            ['course_name' => 'Bachelor of Secondary Education Major in Science', 'code' => 'BSEDS', 'department'=>'DTE'],
            ['course_name' => 'Bachelor of Science in Information Technology', 'code' => 'BSIT', 'department'=>'DCI'],
            ['course_name' => 'Bachelor of Science in Computer Science', 'code' => 'BSCS', 'department'=>'DCI'],
            ['course_name' => 'Bachelor of Science in Accountancy', 'code' => 'BSA', 'department'=>'DBA'],
            ['course_name' => 'Bachelor of Science in Accounting Information', 'code' => 'BSAI', 'department'=>'DBA'],
            ['course_name' => 'Bachelor of Science of Arts in Psychology', 'code' => 'BSAP', 'department'=>'DAS'],
        ];

        Course::insert($programs);

        User::factory()->create(
            ['student_id' => '2022-30304', 'first_name' => 'John', 'last_name' => 'Zoe', 'email' => 'cashier@example.com', 'role' => 'treasurer'],
        );

        User::factory()->create(
            ['student_id' => '2022-20305', 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'registrar@example.com', 'role' => 'admin']
        );

        User::factory()->create(
            ['student_id' => '2022-20306', 'first_name' => 'John', 'last_name' => 'Boe', 'email' => 'student@example.com', 'role' => null]
        );
    }
}

