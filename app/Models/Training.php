<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table='tbl_trainings';
    protected $fillable = [
        'opencohort',
        'opencohortno',
        'training_title',
        'announcement_details',
        'training_provider',
        'training_date',
        'training_time',
        'email',
        'phone',
    ];
}
