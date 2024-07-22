<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panelrole extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_panelroles';
    protected $fillable = [
        'rolename',
    ];
}
