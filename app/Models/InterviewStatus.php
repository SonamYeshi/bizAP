<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_interview_statuses';
    protected $fillable = [
        'trainingID',
        'appID',
        'pannelID',
        'score',
        'remarks',
    ];
}
