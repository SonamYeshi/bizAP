<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProvider extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_training_providers';
    protected $fillable = [
        'name',
        'country',
        'address',
        'contact_person',
        'email',
        'phone',
    ];
}
