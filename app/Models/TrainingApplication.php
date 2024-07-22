<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingApplication extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tb_training_applications';
    protected $fillable = [
        'opencohort',
        'opencohortno',
        'trainingid',
        'cid',
        'name',
        'email',
        'mobileno',
        'dob',
        'gender',
        'qualification',
        'businessanme_qualification',
        'dzongkhag',
        'job_status',
        'commit_hr',
        'commit_period',
        'challenge',
        'youtubelink',
        'rfname1',
        'rfposition1',
        'rforg1',
        'rfrelation1',
        'rfmobileno1',
        'rfemail1',
        'rfname2',
        'rfposition2',
        'rforg2',
        'rfrelation2',
        'rfmobileno2',
        'rfemail2',
        'awareness',
        'agree',
        'screening_status',
        'shortlist_status', 'interview_status', 'totalscore', 'created_on', 'updated_on'
    ];
}
