<?php

namespace App\Exports;

use App\Models\Timeslot;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTimeslot implements FromCollection
{
    protected $doctorId;
    function __construct($doctorId){
        $this->doctorId=$doctorId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Timeslot::where('doctor_id',$this->doctorId)
            ->where('booked',1)
            ->get();
    }
}
