<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitevisitLast extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_last_sitevisit';
    protected $fillable = [
        'fundid',
        'lastvisitdate',
        'laststatus'
    ];
}
