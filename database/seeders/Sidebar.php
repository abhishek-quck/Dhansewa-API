<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPOpenSourceSaver\JWTAuth\Providers\Auth\Illuminate;

class Sidebar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raw = [
            [
              'title' =>  "Dashboard",
              'href' =>  "/dashboard",
              'icon' =>  "bi bi-speedometer2",
              'name' => 'dashboard',
              'links' => json_encode([]),
            ],
            [
              'title' =>  "Enrollment",
              'href' =>  "#",
              'icon' =>  "bi bi-person",
              'name' => 'enroll',
              'links' => json_encode(["new-enrollment",'update-cis'])
            ],
            [
              'title' =>  "Centers Info",
              'href' =>  "#",
              'icon' =>  "fa-solid bi-building -circle-arrow-right",
              'name' => 'center',
              'links' => json_encode(["/center-master","/client-grt","/meeting-handover","/center-visit","/center-adv-update","/client-adv-update"])
            ],
            [
              'title' =>  "Accounts",
              'href' =>  "#", //   /buttons
              'icon' =>  "bi bi-book",
              'name' => 'accounts',
              'links' => json_encode(['/account-head','/accounts-master','/voucher-entry'])
            ],
            [
              'title' =>  "Group Loan",
              'href' =>  "#",
              'icon' =>  "bi bi-people",
              'name' => 'group',
              'links' => json_encode(["/speed-loan-disburse"])
            ],
            [
              'title' =>  "Today Activity",
              'href' =>  "#",
              'icon' =>  "bi-clipboard-check",//fa-cart-shopping
              'name' => 'activity',
              'links' => json_encode(['/collections','/arrear-collection','/day-close'])
            ],
            [
              'title' =>  "Management",
              'href' =>  "#", //  /management
              'icon' =>  "fa-solid bi-calendar-check",
              'name' => 'management',
              'links' => json_encode(['/loan-products', '/sale-products'])
            ],
            [
              'title' =>  "HR & Payroll",
              'href' =>  "#",
              'icon' =>  "bi bi-textarea-resize",
              'name' => 'payroll',
              'links' => json_encode([]),
            ],
            [
              'title' =>  "Credit Report",
              'href' =>  "/credit-report",
              'icon' =>  "fa-regular bi-folder2-open",
              'name' => '',
              'links' => json_encode([]),
            ],
            [
              'title' =>  "Advance Setting",
              'href' =>  "#",
              'icon' =>  "bi-gear",
              'name' => 'setting',
              'links' => json_encode(["/ledger-revise"])
            ],
            [
              'title' =>  "Insurance",
              'href' =>  "#", //about
              'icon' =>  "fa-brands fa-windows",
              'name' => 'insurance',
              'links' => json_encode([]),
            ],
          ];
        \Illuminate\Support\Facades\DB::table('sidebar-menu')->insert($raw);
    }
}
