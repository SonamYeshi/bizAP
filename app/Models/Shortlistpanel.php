<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shortlistpanel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_shortlistpannels';
    protected $fillable = [
        'trainingid',
        'name',
        'designation',
        'role',
    ];
}
