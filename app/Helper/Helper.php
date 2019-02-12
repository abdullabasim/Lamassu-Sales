<?php

namespace App\Helper;

use Illuminate\Http\Request;
use App\Model\Sales AS salesModel;
use App\Model\Month_Salary as monthSalaryModel;
use App\Model\Expenses as expensesModel;
use App\Model\Printing as printingModel;
use App\Model\Promotion_Item as promotionItemModel;
use App\Model\Delivery as deliveryModel;
use App\Model\Debt_Paid as debtPaidModel;
use App\Model\Debt as debtModel;
use App\Model\Last_Update as lastUpdateModel;
use Carbon\Carbon;
use Auth;


Class Helper {

    /**
     * use to find invoice total paid
     * @return mixed
     */
    public static function total()
    {
        return salesModel::sum('total_amount');
    }

    /**
     * use to return Total month
     * @return mixed
     */
    public static function totalMonth()
    {

        $invoice=salesModel::whereBetween('date_issue',array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->get();

        return $invoice->sum(function ($invoices) {
            return $invoices->total_amount;
        });

    }

    /**
     * use to find invoice client paid
     * @return mixed
     */
    public static function paid()
    {
        return salesModel::sum('paid_amount');
    }

    /**
     * use to find paid invoice in this month
     * @return mixed
     */
    public static function paidMonth()
    {

        $invoice=salesModel::whereBetween('date_issue',array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->get();

        return $invoice->sum(function ($invoices) {
            return $invoices->paid_amount;
        });

    }


    /**
     * use to find remaining invoice
     * @return mixed
     */
    public static function remaining()
    {
        return salesModel::sum('remaining_amount');
    }

    /**
     * use to find remaining invoice in this month
     * @return mixed
     */
    public static function remainingMonth()
    {

        $invoice=salesModel::whereBetween('date_issue',array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->get();

        return $invoice->sum(function ($invoices) {
            return $invoices->remaining_amount;
        });

    }

    /**
     * Total Expenses of company
     * @return mixed
     */
    public static function expenses()
    {
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

        return $salaries + $expenses + $printing + $promotions + $delivery + $debts;
    }

    public static function expensesMonth()
    {

        $Totalsalaries =monthSalaryModel::whereBetween('created_at', array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->
        orderBy('id', 'DESC')
            ->get();

        $salaries =$Totalsalaries->sum(function ($salary) {
            return ($salary->employee->basic_salary + $salary->bonas ) - $salary->subtract;
        });


        $Totalexpenses =expensesModel::whereBetween('date', array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->
        orderBy('id', 'DESC')
            ->get();

        $expenses =$Totalexpenses->sum(function ($expense) {
            return $expense->amount;
        });

        $Totalprintings =printingModel::whereBetween('exchange_date', array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->
        orderBy('id', 'DESC')
            ->paginate(24);

        $printing =$Totalprintings->sum(function ($printing) {
            return $printing->amount;
        });

        $promotionsItem =promotionItemModel::whereBetween('exchange_date',array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->
        orderBy('id', 'DESC')
            ->get();

        $promotions =$promotionsItem->sum(function ($promotion) {
            return $promotion->amount;
        });

        $deliveriess =deliveryModel::whereBetween('delivery_date', array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->
        orderBy('id', 'DESC')
            ->get();

        $delivery =$deliveriess->sum(function ($delivery) {
            return $delivery->amount;
        });


        $Totaldebts =debtModel::whereBetween('date', array(Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()))->
        orderBy('id', 'DESC')
            ->get();

        $debts =$Totaldebts->sum(function ($debt) {
            return $debt->amount;
        });



        return $salaries + $expenses + $printing + $promotions + $delivery + $debts;
    }

    public static function Deptremining($id,$total)
    {

        $paidSum = debtPaidModel::WhereHas('dept',function ( $query )use ( $id ){
            $query->where('id', $id );
        })->sum('amount');

        return($total- $paidSum);

    }

    /**
     * get last update of online server
     * @return mixed
     */
    public static function lastUpdate()
    {
        $last =lastUpdateModel::find(1);

        return $last->date;
    }

}