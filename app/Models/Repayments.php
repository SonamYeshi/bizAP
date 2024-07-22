<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repayments extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_repayments';
    protected $fillable = [
        'fundid',
        'cid',
        'principal',
        'administrative_fee',
        'principal_repayment',
        'emi_amount',
        'closing_balance',
        'payment_date',
        'payment_mode',
        'cheque_date',
        'cheque_number',
        'reference_no_transaction_no',
        'emi_refund',
        'due_date',
        'penalty',
        'review_status',
        'review_remarks',
        'reviewed_by',
        'reviewed_on',
        'created_by',
        'created_on'
    ];
}
