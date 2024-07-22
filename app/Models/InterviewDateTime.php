<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewDateTime extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_interview_dates';
    protected $fillable = [
        'appID',
        'trainingID',
        'training_date',
        'training_time',
        'sent',
        'senton',
        'active'
    ];
}
