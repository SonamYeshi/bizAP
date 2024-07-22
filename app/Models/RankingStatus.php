<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankingStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_ranking_statuses';
    protected $fillable = [
        'trainingID',
        'appID',
        'status',
    ];
}
