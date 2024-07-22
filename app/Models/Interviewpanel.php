<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviewpanel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_interviewpannels';
    protected $fillable = [
        'trainingid',
        'name',
        'designation',
        'role',
    ];
}
