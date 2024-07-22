<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayCount extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_paymentdelay_count';
    protected $fillable = [
        'cid',
        'duedate',
        'paymentdate',
        'active',
    ];
}
