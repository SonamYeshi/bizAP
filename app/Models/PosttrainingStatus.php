<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosttrainingStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_posttraining_statuses';
    protected $fillable = [
        'appID',
        'status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
