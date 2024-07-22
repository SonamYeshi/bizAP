<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentationpanel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_presentationpannels';
    protected $fillable = [
        'appid',
        'name',
        'designation',
        'role',
    ];
}
