<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_budget_details';
    protected $fillable = [
        'BudgetHeadID',
        'FinancialYear',
        'Activity',
        'BudgetAmount',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
