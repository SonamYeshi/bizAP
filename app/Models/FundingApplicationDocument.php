<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingApplicationDocument extends Model
{
    use HasFactory;
    protected $table='funding_application_documents';
    protected $fillable = [
        'appid',
        'passport',
        'cid',
        'cib',
        'acc_statement',
        'business_proposal',
        'cv',
        'business_license',
        'sc',
        'tax_clearance',
        'recomendation',
        'doc_path',
    ];
}
