<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundShortlistStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_fundshortlist_statuses';
    protected $fillable = [
        'status',
    ];
}
