<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sales AS salesModel;
use App\Model\Month_Salary as monthSalaryModel;
use App\Model\Expenses as expensesModel;
use App\Model\Printing as printingModel;
use App\Model\Promotion_Item as promotionItemModel;
use App\Model\Delivery as deliveryModel;
use App\Model\Debt as debtModel;
use App\Http\Requests\Invoice\DateSearch as dateSearchRequest;
use App\Http\Requests\Invoice\SingalDate as SingalDateRequest;
use DB;
use Carbon\Carbon;


class Analysis extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function analysisMoney()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $total = salesModel::sum('total_amount');

        $paid = salesModel::sum('paid_amount');

        $remaining = salesModel::sum('remaining_amount');




        $allSalaries = monthSalaryModel::get();

        $salaries =$allSalaries->sum(function ($salary) {
            return ($salary->employee->basic_salary + $salary->bonas ) - $salary->subtract;
        });

        $TotalExpenses = expensesModel::orderBy('id', 'DESC')->
        paginate(24);

        $expenses =$TotalExpenses->sum(function ($expense) {
            return $expense->amount;
        });

        $TotalPrinting = printingModel::orderBy('id', 'DESC')->
        paginate(24);


        $printing =$TotalPrinting->sum(function ($printing) {
            return $printing->amount;
        });

        $promotionsItem = promotionItemModel::orderBy('id', 'DESC')->
        paginate(24);



        $promotions =$promotionsItem->sum(function ($promotion) {
            return $promotion->amount;
        });

        $deliveries = deliveryModel::orderBy('id', 'DESC')->
        paginate(24);

        $delivery =$deliveries->sum(function ($delivery) {
            return $delivery->amount;
        });

        $Totaldebt = debtModel::orderBy('id', 'DESC')->
        paginate(24);

        $debts =$Totaldebt->sum(function ($debt) {
            return $debt->amount;
        });

        $totalPaid = $salaries + $expenses + $printing + $promotions + $delivery + $debts;

        return view('analysis.show_analysis',[
            'total'=>$total,
            'paid'=>$paid,
            'remaining'=>$remaining,

            'salaries'=>$salaries,
            'expenses'=>$expenses,
            'printing'=>$printing,
            'promotions'=>$promotions,
            'delivery'=>$delivery,
            'debts'=>$debts,
            'totalPaid'=>$totalPaid
        ]);
    }

    public function analysisDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(24);


            $total = salesModel::whereBetween('date_issue', array($request->startDate,$endDate))->
            sum('total_amount');

            $paid = salesModel::whereBetween('date_issue', array($request->startDate,$endDate))->
            sum('paid_amount');

            $remaining = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            sum('remaining_amount');



        $Totalsalaries =monthSalaryModel::whereBetween('created_at', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->get();

        $salaries =$Totalsalaries->sum(function ($salary) {
            return ($salary->employee->basic_salary + $salary->bonas ) - $salary->subtract;
        });


        $Totalexpenses =expensesModel::whereBetween('date', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->get();

        $expenses =$Totalexpenses->sum(function ($expense) {
            return $expense->amount;
        });

        $Totalprintings =printingModel::whereBetween('exchange_date', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->paginate(24);

        $printing =$Totalprintings->sum(function ($printing) {
            return $printing->amount;
        });

        $promotionsItem =promotionItemModel::whereBetween('exchange_date', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->get();

        $promotions =$promotionsItem->sum(function ($promotion) {
            return $promotion->amount;
        });

        $deliveriess =deliveryModel::whereBetween('delivery_date', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->get();

        $delivery =$deliveriess->sum(function ($delivery) {
            return $delivery->amount;
        });


        $Totaldebts =debtModel::whereBetween('date', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->get();

        $debts =$Totaldebts->sum(function ($debt) {
            return $debt->amount;
        });



        $totalPaid = $salaries + $expenses + $printing + $promotions + $delivery + $debts;

        return view('analysis.show_analysis',[
            'total'=>$total,
            'paid'=>$paid,
            'remaining'=>$remaining,

            'salaries'=>$salaries,
            'expenses'=>$expenses,
            'printing'=>$printing,
            'promotions'=>$promotions,
            'delivery'=>$delivery,
            'debts'=>$debts,
            'totalPaid'=>$totalPaid
        ]);


    }

    public function profitChart()
    {
        $now = Carbon::now();

        $expenses = DB::table("sales")
            ->select(DB::raw("SUM(paid_amount) as visits, MONTHNAME(date_issue) as country"))
            ->whereYear('date_issue', '=', $now->year)
            ->orderBy("date_issue")
            ->groupBy(DB::raw('MONTH(date_issue)'))
            ->get();


        $remaining = DB::table("sales")
            ->select(DB::raw("SUM(remaining_amount) as visits, MONTHNAME(date_issue) as country"))
            ->whereYear('date_issue', '=', $now->year)
            ->orderBy("date_issue")
            ->groupBy(DB::raw('MONTH(date_issue)'))
            ->get();


        return view('analysis.profit_chart',[
            'data'=>$expenses,
            'remaining'=>$remaining
        ]);

    }

    public function profitChartDate(SingalDateRequest $request)
    {
        $now = Carbon::parse($request->startDate);


        $expenses = DB::table("sales")
            ->select(DB::raw("SUM(paid_amount) as visits, MONTHNAME(date_issue) as country"))
            ->whereYear('date_issue', '=', $now->year)
            ->orderBy("date_issue")
            ->groupBy(DB::raw('MONTH(date_issue)'))
            ->get();

        $remaining = DB::table("sales")
            ->select(DB::raw("SUM(remaining_amount) as visits, MONTHNAME(date_issue) as country"))
            ->whereYear('date_issue', '=', $now->year)
            ->orderBy("date_issue")
            ->groupBy(DB::raw('MONTH(date_issue)'))
            ->get();

       // dd($remaining);

        return view('analysis.profit_chart',[
            'data'=>$expenses,
            'remaining'=>$remaining
        ]);

    }
}
