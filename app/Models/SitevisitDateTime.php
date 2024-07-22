<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitevisitDateTime extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_sitevisit_schedules';
    protected $fillable = [
        'fundid',
        'date',
        'time',
        'mode',
        'agenda',
        'actualdate',
        'actualtime',
        'observations',
        'instructions',
        'siteVisitReport',
        'virtual_form',
        'virtual_form_ent',
        'status',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
