<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentroingDocs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_mentoring_docs';
    protected $fillable = [
        'mentoringid',
        'file_name',
        'doc_path',
        'created_by',
        'created_at'
    ];
}
