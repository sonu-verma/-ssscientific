<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public static function invoiceNumber(){
        return "SSS/INV.".(SELF::latest()->value('id')+1)."./FY ".getFinancialYear();
    }
}
