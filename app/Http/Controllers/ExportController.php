<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Carbon;

class ExportController extends Controller
{
    public function dailyStudents(){
        return json_decode(Student::whereDate('created_at', Carbon::today())->get(['name','created_at']));
    }

    public function weeklyStudents(){
        return json_decode(Student::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get());
    }

    public function monthlyStudents(){
        return json_decode(Student::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->get(['name','created_at']));
    }

    public function yearlyStudents(){
        return json_decode(Student::whereYear('created_at', date('Y'))
        ->get(['name','created_at']));
    }

}