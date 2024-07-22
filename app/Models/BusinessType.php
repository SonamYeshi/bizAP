<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_business_type';
    protected $fillable = [
        'business_type'
    ];
}
