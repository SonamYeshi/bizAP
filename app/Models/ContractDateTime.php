<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDateTime extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_contract_dates';
    protected $fillable = [
        'appID',
        'fundID',
        'cid',
        'sign_date',
        'sign_time',
        'venue',
        'instructions',
    ];
}
