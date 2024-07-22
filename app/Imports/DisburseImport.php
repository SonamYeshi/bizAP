<?php

namespace App\Imports;

use App\Models\FundingApplication;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DisburseImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
        {
        return new FundingApplication([
            'cohortopen' => $row['cohortopen'],
            'cohortopenno'      => $row['cohortopenno'],
            'cid'      => $row['cid'],
            'name'      => $row['name'],
            'mobileno'      => $row['mobileno'],
            'email'      => $row['email'],
            'business_type'      => $row['business_type'],
            'business_name'      => $row['business_name'],
            'business_licence_no'      => $row['business_licence_no'],
            'approved_date'   => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['approved_date'])->format('Y-m-d'),
            'disbursed_date'   => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['disbursed_date'])->format('Y-m-d'),
            'total_disbursed'      => $row['total_disbursed'],
            'screening_status'      => 1,
            'shortlist_status'      => 1,
            'presentation_status'      => 1,
            'selected'      => 1,
            'selected_by'      => 1
        ]);
    }
}
