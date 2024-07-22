<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICTemail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_dhi_ict_email';
    protected $fillable = [
        'name',
        'email'
    ];

}
