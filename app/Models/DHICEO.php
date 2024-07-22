<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DHICEO extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_dhi_ceo';
    protected $fillable = [
        'name'
    ];

}