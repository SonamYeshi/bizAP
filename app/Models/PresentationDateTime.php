<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationDateTime extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_presentation_dates';
    protected $fillable = [
        'appID',
        'fundID',
        'ppt_date',
        'ppt_time',
        'sent',
        'senton'
    ];
}
