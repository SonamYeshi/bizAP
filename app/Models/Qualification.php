<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_qualifications';
    protected $fillable = [
        'qualification',
    ];
}
