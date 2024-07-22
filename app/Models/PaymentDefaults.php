<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDefaults extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_payment_defaults';
    protected $fillable = [
        'cid',
        'duedate',
        'emi'
    ];
}
