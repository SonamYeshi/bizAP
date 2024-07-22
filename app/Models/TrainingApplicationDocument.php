<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingApplicationDocument extends Model
{
    use HasFactory;
    protected $table='tbl_training_app_docs';
    protected $fillable = [
        'appid',
        'passport',
        'cid',
        'noc',
        'cv',
        'certificate',
        'supporting',
        'workexample',
        'sample1',
        'sample2',
        'doc_path',
    ];
}
