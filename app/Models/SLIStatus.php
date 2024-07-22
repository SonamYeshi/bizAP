<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SLIStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_sli_statuses';
    protected $fillable = [
        'trainingID',
        'appID',
        'pannelID',
        'score',
        'remarks',
    ];
}
