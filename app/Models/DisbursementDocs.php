<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisbursementDocs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_disbursement_docs';
    protected $fillable = [
        'appid',
        'cid',
        'file_name',
        'doc_path',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
