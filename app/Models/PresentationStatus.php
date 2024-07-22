<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresentationStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_presentation_statuses';
    protected $fillable = [
        'fundID',
        'appID',
        'pannelID',
        'score',
        'remarks',
    ];
}
