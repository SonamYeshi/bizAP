<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_mailattachment';
    protected $fillable = [
        'cohortopen',
        'cohortopenno',
        'filename',
        'filepath'
    ];
}
