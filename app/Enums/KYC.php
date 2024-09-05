<?php

namespace App\Enums;

interface KYC
{
    const options = [
        'passBook' => 1,
        'aadhaar'  => 2,
        'voterID'  => 3
    ]; 
}
