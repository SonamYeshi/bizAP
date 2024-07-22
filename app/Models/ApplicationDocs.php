<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDocs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_application_docs';
    protected $fillable = [
        'appid',
        'filecat',
        'file_name',
        'doc_path',
    ];
}
