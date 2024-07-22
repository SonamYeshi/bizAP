<?php

namespace App\Imports;

use App\Models\PresentationStatus;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FundScoreImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $appid;

    function __construct($appid)
        {
        $this->appid = $appid;
        }
    public function model(array $row)
    {
        return new PresentationStatus([
            'fundID' => $row['fundid'],
            'appID'      => $this->appid,
            'pannelID'   => $row['id'],
            'score'      => $row['score'],
            'remarks'    => $row['remarks'],
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d'),
        ]);
    }
}
