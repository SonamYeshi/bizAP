<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetHead extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_budget_head';
    protected $fillable = [
        'HeadName',
        'HeadCode',
        'HeadDescription',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
