<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankEmail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_bank_email';
    protected $fillable = [
        'name',
        'email'
    ];

}
