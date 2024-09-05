<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserReportAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run(): void
    {
        DB::statement('TRUNCATE TABLE report_access');
        DB::table("report_access")->insert([
            ['name' => 'General', 'slug' => 'general'],
            ['name' => 'HR & Payroll', 'slug' => 'hr'],
            ['name' => 'Members', 'slug' => 'members'],
            ['name' => 'Accounts', 'slug' => 'accounts'],
            ['name' => 'Collections', 'slug' => 'collections'],
            ['name' => 'NPA', 'slug' => 'npa'],
            ['name' => 'Loan', 'slug' => 'loan'],
            ['name' => 'Banking', 'slug' => 'banking'],
            ['name' => 'Advance', 'slug' => 'advance'],
        ]);
    }
}
