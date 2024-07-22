<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundRequest extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_fund_request';
    protected $fillable = [
        'fundid',
        'tranche',
        'usage',
        'proof',
        'receipt',
        'paid_to',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'review',
        'approve_ach',
        'approve_asd',
        'disbursement',
        'disbursement_date',
        'bank_review'
    ];
}
