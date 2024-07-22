<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundRequestStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_fundrequest_statuses';
    protected $fillable = [
        'fundrequestid',
        'review_status',
        'review_remarks',
        'review_attachment',
        'reviewed_by',
        'review_date',
        'approve_asd',
        'approve_asd_remarks',
        'approevd_asd_by',
        'approved_asd_date',
        'approved_status_ach',
        'approved_ach_remarks',
        'approved_ach_by',
        'approved_ach_date'
    ];
}
