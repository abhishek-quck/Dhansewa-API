<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateCode extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('state_codes')->insert([
            ['code'=>1, 'state'=>'JAMMU AND KASHMIR'],
            ['code'=>2, 'state'=>'HIMACHAL PRADESH'],
            ['code'=>3, 'state'=>'PUNJAB'],
            ['code'=>4, 'state'=>'CHANDIGARH'],
            ['code'=>5, 'state'=>'UTTARAKHAND'],
            ['code'=>6, 'state'=>'HARYANA'],
            ['code'=>7, 'state'=>'DELHI'],
            ['code'=>8, 'state'=>'RAJASTHAN'],
            ['code'=>9, 'state'=>'UTTAR PRADESH'],
            ['code'=>10, 'state'=> 'BIHAR'],
            ['code'=>11, 'state'=> 'SIKKIM'],
            ['code'=>12, 'state'=> 'ARUNACHAL PRADESH'],
            ['code'=>13, 'state'=> 'NAGALAND'],
            ['code'=>14, 'state'=> 'MANIPUR'],
            ['code'=>15, 'state'=> 'MIZORAM'],
            ['code'=>16, 'state'=> 'TRIPURA'],
            ['code'=>17, 'state'=> 'MEGHALAYA'],
            ['code'=>18, 'state'=> 'ASSAM'],
            ['code'=>19, 'state'=> 'WEST BENGAL'],
            ['code'=>20, 'state'=> 'JHARKHAND'],
            ['code'=>21, 'state'=> 'ORISSA'],
            ['code'=>22, 'state'=> 'CHHATTISGARH'],
            ['code'=>23, 'state'=> 'MADHYA PRADESH'],
            ['code'=>24, 'state'=> 'GUJARAT'],
            ['code'=>25, 'state'=> 'DAMAN AND DIU'],
            ['code'=>26, 'state'=> 'DADAR AND NAGAR HAVELI'],
            ['code'=>27, 'state'=> 'MAHARASTRA'],
            ['code'=>29, 'state'=> 'KARNATAKA'],
            ['code'=>30, 'state'=> 'GOA'],
            ['code'=>31, 'state'=> 'LAKSHADWEEP'],
            ['code'=>32, 'state'=> 'KERALA'],
            ['code'=>33, 'state'=> 'TAMIL NADU'],
            ['code'=>34, 'state'=> 'PUDUCHERRY'],
            ['code'=>35, 'state'=> 'ANDAMAN AND NICOBAR'],
            ['code'=>36, 'state'=> 'TELANGANA'],
            ['code'=>37, 'state'=> 'ANDHRA PRADESH']
        ]);
    }
}
