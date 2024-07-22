<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_budget_expenses';
    protected $fillable = [
        'BudgetHeadID',
        'ExpenseHeadName',
        'ExpenseHeadCode',
        'ExpenseHeadDescription',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
