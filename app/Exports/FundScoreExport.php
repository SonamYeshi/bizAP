<?php

namespace App\Exports;

use App\Models\Presentationpanel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FundScoreExport implements FromCollection, WithHeadings
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
        return Presentationpanel::where('fundid',$this->id)
        ->select('id', 'fundid','name', 'designation')
        ->get();
    }


    public function headings() :array
    {
        return ["id", "fundid", "name", "designation", "score", 'remarks'];
    }
}
