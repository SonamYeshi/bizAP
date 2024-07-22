<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Interviewpanel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrainingScoreExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

 function __construct($id) {
        $this->id = $id;
 }

    public function collection()
    {
        return Interviewpanel::where('trainingid',$this->id)
        ->select('id', 'trainingid','name', 'designation')
        ->get();
    }


    public function headings() :array
    {
        return ["id", "trainingid", "name", "designation", "score", 'remarks'];
    }
}
