<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_refund';
    protected $fillable = [
        'fundid',
        'refund_amount',
        'refund_date',
        'created_by',
        'created_on'
    ];
}
