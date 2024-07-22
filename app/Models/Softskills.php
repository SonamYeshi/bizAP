<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Softskills extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_soft_skills';
    protected $fillable = [
        'skill',
    ];
}
