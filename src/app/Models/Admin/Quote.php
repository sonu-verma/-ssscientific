<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \App\Models\User;
class Quote extends BaseModel
{
    use HasFactory;

    const QUOTE_DRAFT = 0;
    const QUOTE_REQUESTED = 1;
    const QUOTE_CREATED = 2;
    const PROPOSAL_CREATED = 3;
    const PROPOSAL_SENT = 4;
    const PROPOSAL_APPROVED = 5;
    const ORDER_PLACED = 6;
    const QUOTE_TEST = 7;
    const DOCUSIGN_SENT = 8;
    const AGREEMENT_SIGNED = 9;

    const STATUS_ACTIVE = 1;

    const ACTION_STATUS_APPROVED = 1;
    const ACTION_STATUS_REJECTED = 2;
    const ACTION_STATUS_HOLD = 3;

    const CURRENCY_TYPES = [
        "INR" => "INR",
        "USD" => "USD",
    ];

    protected $table = 'quotes';
//    protected $dateFormat = 'U';
    protected $fillable = [
        'quote_no',
        'token',
        'reference',
        'cust_id',
        'phone_number',
        'email',
        'address',
        'apt_no',
        'zipcode',
        'city',
        'state',
        'billing_option',
        'billing_address',
        'billing_apt_no',
        'billing_zipcode',
        'billing_city',
        'billing_state',
        'relation',
        'reference_from',
        'referral',
        'referral_agency',
        'is_enquired',
        'currency_type',
        'notes',
        'status',
        'approved_by',
        'approved_at',
        'created_at',
        'created_by',
        'updated_at',
    ];

    protected $appends = ['property_address'];

    public function user(){
        return $this->belongsTo(User::class,'cust_id','id');
    }

    public function getPropertyAddressAttribute() {
        $array = [
            $this->address,
            $this->apt_no,
            $this->city,
            $this->state,
            $this->zipcode,
        ];

        $array = array_filter($array);
        return implode(', ', $array).' '.$this->zip_code;
    }

    public function items(){
        return $this->hasMany(ProductCartItems::class,'quote_id','id')
            ->with('product');
    }

}
