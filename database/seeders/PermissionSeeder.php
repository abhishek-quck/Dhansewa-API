<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $raw = [
            "Dashboard",
            "Enrollment",
            "CGT Entry",
            "New Enrollment",
            "Update CIS",
            "Speed Enrollments",
            "Centers Info",
            "Center Master",
            "Client GRT",
            "Meeting Handover",
            "Center Visit",
            "Center ADV Update",
            "Client ADV Update",
            "Accounts",
            "Account Head",
            "Accounts Master",
            "Voucher Entry",
            "Multi Voucher Entry",
            "Voucher Editor",
            "Group Loan",
            "Loan Proposal",
            "Loan Approve",
            "Cash Disbursement",
            "Speed Loan Disburse",
            "Proposal Revise",
            "Loan Switching",
            "Today Activity",
            "Center Collection",
            "Partial Collection",
            "Send DCR",
            "Arrear Collection",
            "Day Initialization",
            "Day Close",
            "Management",
            "Branches Master",
            "Funding Agency",
            "Funding Tranche",
            "Utilization Master",
            "Loan Products",
            "Loan Chart Master",
            "Our Bank A/C",
            "Bank IFSC Master",
            "Sale Products",
            "Notice Display",
            "HR & Payroll",
            "Employee Master",
            "User Access",
            "Salary Upload",
            "Credit Report",
            "Advance Setting",
            "Ledger Revise",
            "Branch Go Back",
            "Edit Loaning Info",
            "Data Truncate",
            "System Setup",
            "Company Profile",
            "Insurance",
            "Client Claim",
            "Hospi Cash Update",
            "Policy Update"
        ];
        Permission::truncate();
        foreach($raw as $entry)
        {
            Permission::create(['name'=> $entry]);
        }
    }
}
