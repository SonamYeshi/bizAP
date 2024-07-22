<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_countries';
    protected $fillable = [
        'phone_code',
        'country_code',
        'country_name',
    ];
}
