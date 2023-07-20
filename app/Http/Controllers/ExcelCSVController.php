<?php

namespace App\Http\Controllers;

use App\Exports\ExportTimeslot;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;

class ExcelCSVController extends Controller
{

    public function index()
    {
        return view('import');
    }

    public function export()
    {
        return Excel::download(new ExportUsers, 'users.xlsx');
    }
    public function exportTimeslot($doctorId)
    {
//        return Excel::download(new ExportUsers, 'users.xlsx');
        return Excel::download(new ExportTimeslot($doctorId),'timeslots.xlsx');
    }


}
