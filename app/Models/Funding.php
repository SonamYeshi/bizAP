<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funding extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tb_fund_annoucements';
    protected $fillable = [
        'opencohort',
        'opencohortno',
        'title',
        'details',
        'submission_date',
        'submission_time',
        'email',
        'phone',
        'active',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on',
        'tenure',
        'intres_rate'
    ];
}
