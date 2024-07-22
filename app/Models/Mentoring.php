<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_mentoring';
    protected $fillable = [
        'SupportType',
        'StartDate',
        'EndDate',
        'Mentor',
        'NoofPartipants',
        'Objective',
        'Requirements',
        'EligibleCohorts',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
