<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortlistStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_shortlist_statuses';
    protected $fillable = [
        'status',
    ];
}
