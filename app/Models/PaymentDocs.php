<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDocs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_payment_docs';
    protected $fillable = [
        'paymentid',
        'fundid',
        'file_name',
        'doc_path',
        'created_by',
        'created_at'
    ];
}
