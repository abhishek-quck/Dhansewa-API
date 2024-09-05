<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raw = [
            [
                'abbr' => 'BM',
                'name' => 'Branch Manager',
            ],
            [
                'abbr' => 'AM',
                'name' => 'Area Manager',
            ],
            [
                'abbr' => 'CM',
                'name' => 'Center Manager',
            ],
            [
                'abbr' => 'FI',
                'name' => 'FI Officer',
            ],
            [
                'abbr' => 'HR',
                'name' => 'HR',
            ],
            [
                'abbr' => 'A/C',
                'name' => 'Account',
            ],
        ];
        Designation::truncate();
        foreach($raw as $row){
            Designation::create([
                'abbr' => $row['abbr'],
                'name' => $row['name'],
            ]);
        }
    }
}
