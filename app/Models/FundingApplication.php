<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingApplication extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='tb_dhifund_applications';
    protected $fillable = [
        'fundid',
        'cohortopen',
        'cohortopenno',
        'cid',
        'initial',
        'name',
        'dob',
        'mobileno',
        'email',
        'current_address',
        'source_of_income',
        'source_of_income_others',
        'business_type',
        'business_name',
        'business_location',
        'business_description',
        'business_sector',
        'business_sector_others',
        'business_to_address',
        'business_activity',
        'business_status',
        'revenue',
        'customer_target',
        'no_of_current_customer',
        'company_start_date',
        'money_invested',
        'raise_finance',
        'employees_hired',
        'team',
        'team_others',
        'biggest_challenge',
        'specific_resources',
        'business_opportunity',
        'screening_status',
        'shortlist_status',
        'presentation_status',
        'selected',
        'created_on',
        'updated_on',
        'business_licence_no',
        'financing_account_no',
        'bank_account_no',
        'selected_by',
        'selected_on',
        'totalscore',
        'total_disbursed',
        'actual_disbursed',
        'disbursed_date',
        'approved_date',
        'disbursement'
    ];
}
