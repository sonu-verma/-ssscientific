<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_id','invoice_no','po_no','gst_no','freight','status'
    ];

    public static function invoiceNumber(){
        return "SSS/INV.".(SELF::latest()->value('id')+1)."./FY ".getFinancialYear();
    }

    public function quote(){
        return $this->belongsTo(Quote::class,'quote_id','id');
    }

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class,'po_no','id');
    }
}
