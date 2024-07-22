<?php

namespace App\Imports;

use App\Models\InterviewStatus;
use App\Models\TrainingApplication;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;

class TrainingScoreImport implements ToModel, WithHeadingRow
{
    protected $id;
    function __construct($appid)
        {
        $this->appid = $appid;
        }
    public function model(array $row)
    {
        return new InterviewStatus([
            'trainingID' => $row['trainingid'],
            'appID'      => $this->appid,
            'pannelID'   => $row['id'],
            'score'      => $row['score'],
            'remarks'    => $row['remarks'],
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d'),
        ]);

    }
}
