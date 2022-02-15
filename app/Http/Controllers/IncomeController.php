<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function comparisonData(Request $request){

        // today
        if($request->value == "today"){

            $incomeToday = Income::whereDate('created_at', Carbon::today())->get();
            $expenseToday = Expense::whereDate('created_at', Carbon::today())->get();

            $incomeAmount = 0;
            foreach($incomeToday as $t){
                $incomeAmount += $t->amount;
            }

            $expenseAmount = 0;
            foreach($expenseToday as $t){
                $expenseAmount += $t->amount;
            }

            return response()->json(['income' => 12, 'expense' => 16 ]);
        }

        // yesterday
        if($request->value == "yesterday"){

            $incomeYesterday = Income::whereDate('created_at', Carbon::yesterday())->get();
            $expenseYesterday = Expense::whereDate('created_at', Carbon::yesterday())->get();

            $incomeAmount = 0;
                foreach($incomeYesterday as $t){
                    $incomeAmount += $t->amount;
                }

                $expenseAmount = 0;
                foreach($expenseYesterday as $t){
                    $expenseAmount += $t->amount;
                }

            return response()->json(['income' => $incomeAmount, 'expense' => $expenseAmount ]);
        }
        // this Week
        if($request->value == "thisweek"){

            $incomeThisweek = Income::whereDate('created_at', '>',Carbon::now()->startOfWeek())->get();
            $expenseThisweek = Expense::whereDate('created_at', '>',Carbon::now()->startOfWeek())->get();

            $incomeAmount = 0;
                foreach($incomeThisweek as $t){
                    $incomeAmount += $t->amount;
                }

                $expenseAmount = 0;
                foreach($expenseThisweek as $t){
                    $expenseAmount += $t->amount;
                }

                return response()->json(['income' => $incomeAmount, 'expense' => $expenseAmount ]);

        }

        // last Week
        if($request->value == "lastweek"){

            $incomeLastweek = Income::whereDate('created_at', '>',Carbon::now()->endOfWeek())->get();
            $expenseLastweek = Expense::whereDate('created_at', '>',Carbon::now()->endOfWeek())->get();

            $incomeAmount = 0;
                foreach($incomeLastweek as $t){
                    $incomeAmount += $t->amount;
                }

            $expenseAmount = 0;
            foreach($expenseLastweek as $t){
                $expenseAmount += $t->amount;
            }

            return response()->json(['income' => $incomeAmount, 'expense' => $expenseAmount ]);
        }

        // this month
        if($request->value == "thismonth"){

            $incomeThisMonth = Income::where('created_at','>=',Carbon::now()->subdays(30))->get();
            $expenseThisMonth = Expense::where('created_at','>=',Carbon::now()->subdays(30))->get();

            $incomeAmount = 0;
                foreach($incomeThisMonth as $t){
                    $incomeAmount += $t->amount;
                }

                $expenseAmount = 0;
                foreach($expenseThisMonth as $t){
                    $expenseAmount += $t->amount;
                }

                return response()->json(['income' => $incomeAmount, 'expense' => $expenseAmount ]);

        }

        // THis Year
        if($request->value == "thisyear"){

            $incomeThisYear= Income::whereYear('created_at', date('Y', strtotime('1 year')))->get();
            $expenseThisYear= Expense::whereYear('created_at', date('Y', strtotime('1 year')))->get();

            $incomeAmount = 0;
                foreach($incomeThisYear as $t){
                    $incomeAmount += $t->amount;
                }

                $expenseAmount = 0;
                foreach($expenseThisYear as $t){
                    $expenseAmount += $t->amount;
                }

                return response()->json(['income' => $incomeAmount, 'expense' => $expenseAmount ]);

        }

        // Last Year
        if($request->value == "lastyear"){

            $incomeLastYear= Income:: whereYear('created_at', date('Y', strtotime('-1 year')))->get();
            $expenseLastYear= Expense:: whereYear('created_at', date('Y', strtotime('-1 year')))->get();

            $incomeAmount = 0;
                foreach($incomeLastYear as $t){
                    $incomeAmount += $t->amount;
                }

                $expenseAmount = 0;
                foreach($expenseLastYear as $t){
                    $expenseAmount += $t->amount;
                }

                return response()->json(['income' => $incomeAmount, 'expense' => $expenseAmount ]);

        }

    }
}
