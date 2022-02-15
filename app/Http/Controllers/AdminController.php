<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Modules\Teacher\Entities\Teacher;

use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = Teacher::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$i] = $usermcount[$i];
            } else {
                $userArr[$i] = 0;
            }
        }

        $teachersdata = implode(', ', $userArr);
        return view('admin.index')->with('data', $teachersdata);
    }

    public function chartData(){
        $students = Student::select('id', 'created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

    $studentsCount = [];
    $StudentsArr = [];

    foreach ($students as $key => $value) {
        $studentsCount[(int)$key] = count($value);
    }

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($studentsCount[$i])) {
            $StudentsArr[$i] = $studentsCount[$i];
        } else {
            $StudentsArr[$i] = 0;
        }
    }

    $userJoiningData = [];

    foreach($StudentsArr as $student){
        $userJoiningData[] = $student;
    }
    // return $StudentsArr;
    $StudentsArr = json_encode($userJoiningData);

    return view('admin.chart-data',compact('StudentsArr'));
    }

    public function starter()
    {
        return view('admin.starter');
    }
}
