<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ResultExport;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new ResultExport($request->id), 'Result.xlsx');
    }
}
