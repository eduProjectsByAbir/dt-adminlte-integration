<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Teacher\Entities\Teacher;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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

    public function starter()
    {
        return view('admin.starter');
    }
}
