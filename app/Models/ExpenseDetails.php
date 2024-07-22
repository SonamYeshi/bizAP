<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tbl_expense_details';
    protected $fillable = [
        'BudgetDetailsID',
        'ExpenseAmount',
        'Description',
        'created_by',
        'created_on',
        'updated_by',
        'updated_on'
    ];
}
