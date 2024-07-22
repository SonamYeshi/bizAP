<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosttrainingActivity extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_posttraining_activities';
    protected $fillable = [
        'status',
    ];
}
