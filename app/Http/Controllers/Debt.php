<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Debt as debtModel;
use App\Model\Debt_Name as debtNameModel;
use App\Model\Debt_Paid as debtPaidModel;

use App\Http\Requests\Debt\DebtAdd as debtAddRequest;
use App\Http\Requests\Debt\DebtEdit as debtEditRequest;
use App\Http\Requests\Debt\DebtPay as debtPayRequest;
use App\Http\Requests\Debt\DebtNameAdd as debtNameAddRequest;
use App\Http\Requests\Debt\DebtNameEdit as debtNameEditRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use Carbon\Carbon;

class Debt extends Controller
{
    public function __construct()
    {


        $this->middleware('auth');
    }

    /**
     * use to debt manage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debts = debtModel::orderBy('id', 'DESC')->
        paginate(24);

        $sum =$debts->sum(function ($debt) {
            return $debt->amount;
        });

        $debtNames = debtNameModel::all();

        return view('debt.debt_manage', [
            'debts' => $debts,
            'status' => "none",
            'sum'=>$sum,
            'debtNames'=>$debtNames
        ]);
    }

    /**
     * use to delete debt
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $debt = debtModel::findOrFail($id);

            debtModel::destroy(($debt->id));

            return back()
                ->with('success', 'Debt Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Debt not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show add debt page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debtNames = debtNameModel::all();

        return view('debt.debt_add', [
            'debtNames'=>$debtNames
        ]);
    }

    /**
     * use to add debt
     * @param debtAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtAdd(debtAddRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            debtModel::create([
                'debt_name_id' => $request->debtName,
                'amount' => $request->amount,
                'remaining' => $request->amount,
                'date' => $request->date,
                'note'=>$request->note
            ]);

            return redirect('/debtManage')
                ->with('success', 'Debt Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Debt not Add Please Try Again!!');
        }
    }

    /**
     * use to show edit debt page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function debtEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $debt = debtModel::findOrFail($id);

            $debtNames = debtNameModel::orderBy('id', 'DESC')->get();

            return view('debt.debt_edit', [
                'debt' => $debt,
                'debtNames' => $debtNames
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Debt Info. not Update Please Try Again!!');
        }
    }

    /**
     * use to edit debt
     * @param debtEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtEdit(debtEditRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $debt=debtModel::findOrFail($request->debtID);

            if($debt->amount == $debt->remaining )
            {
            debtModel::where('id', '=', $debt->id)->
            update([
                'debt_name_id' => $request->debtName,
                'amount' => $request->amount,
                'remaining' => $request->amount,
                'date' => $request->date,
                'note'=>$request->note
            ]);
            }
            else
            {
                debtModel::where('id', '=', $debt->id)->
                update([
                    'debt_name_id' => $request->debtName,
                    'amount' => $request->amount,
                    'remaining' => $request->amount - ($debt->amount - $debt->amount)  ,
                    'date' => $request->date,
                    'note'=>$request->note
                ]);
            }

            return redirect('/debtManage')
                ->with('success', 'Debt Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Debt Info. not Update Please Try Again!!');
        }
    }

    /**
     * use to pay the debt
     * @param debtPayRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtPay(debtPayRequest $request)
    {

        \Auth::user()->authorizeRoles(['Admin']);
        try {

            $debt = debtModel::findOrFail($request->debtID);


           if($request->pay > 0 && $request->pay <= $debt->amount )
           {
               if(($request->pay - $debt->amount) == 0)
               {
                   debtPaidModel::create([
                       'debt_id'=>$debt->id,
                       'debt_name_id'=>$debt->debt_name_id,
                       'amount'=>$request->pay,
                       'note'=>$debt->note,

                   ]);

                   debtModel::where('id', '=', $debt->id)->
                   update([
                       'remaining' => $debt->amount - $request->pay,
                   ]);

                   return back()
                       ->with('success', 'Debt pay successfully.');
               }
               else
               {

                   debtPaidModel::create([
                       'debt_id'=>$debt->id,
                       'debt_name_id'=>$debt->debt_name_id,
                       'amount'=>$request->pay,
                       'note'=>$debt->note,

                   ]);

                  // dd($debt->remaining - $request->pay);
                  debtModel::where('id', '=', $debt->id)->
                   update([
                      'remaining' => $debt->remaining - $request->pay,
                   ]) ;

                   return back()
                       ->with('success', 'Debt pay successfully.');
               }

           }
           else
           {
               return back()
                   ->with('error', 'Something not Correct in your input , Please Try Again!!');
           }

        } catch (\Exception $e) {

            return back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * use to search in dept
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debts = debtModel::where('amount', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orWhere('note', 'LIKE', "%" . $request->search . "%")->
        orWhereHas('depts_name',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $debtNames = debtNameModel::all();

        $sum =$debts->sum(function ($debt) {
            return $debt->amount;
        });

        return view('debt.debt_manage', [
            'debts' => $debts,
            'status' => "search Form",
            'sum'=>$sum,
            'debtNames'=>$debtNames
        ]);


    }

    /**
     * use to search base on date in Creditor
     * @param dateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        if(is_null($request->debtName))
        {
            $debts =debtModel::whereBetween('date', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        else
        {
           // dd($request->all());
            $debts =debtModel::whereBetween('date', array($request->startDate,$endDate))->
            WhereHas('depts_name',function ( $query )use ( $request ){
                $query->where('id','LIKE', "%".$request->debtName."%" );
            })->
            orderBy('id', 'DESC')
                ->paginate(24);
        }


        $debtNames = debtNameModel::all();

        $sum =$debts->sum(function ($debt) {
            return $debt->amount;
        });

        return view('debt.debt_manage', [
            'debts' => $debts,
            'status' => "search Form",
            'sum'=>$sum,
            'debtNames'=>$debtNames
        ]);
    }

    /**
     * use to manage Creditor names
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtNameManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debtNames = debtNameModel::orderBy('id', 'DESC')->
        paginate(24);


        return view('debt.debt_name_manage', [
            'debtNames' => $debtNames,
            'status' => "none",
        ]);
    }

    /**
     * use to delete creditor names
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtNameDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $debtName = debtNameModel::findOrFail($id);

            debtNameModel::destroy(($debtName->id));

            return back()
                ->with('success', 'Creditor Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Creditor not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show Creditor page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtNameAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        return view('debt.debt_name_add');
    }

    /**
     * use to add creditor
     * @param debtNameAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtNameAdd(debtNameAddRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            debtNameModel::create([
                'title' => $request->title,
            ]);

            return redirect('/debtNameManage')
                ->with('success', 'Creditor Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Creditor not Add Please Try Again!!');
        }
    }

    /**
     * use to show creditor edit page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtNameEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debtName = debtNameModel::findOrFail($id);

        return view('debt.debt_name_edit', [
            'debtName'=>$debtName,
        ]);
    }

    /**
     * use to edit creditor
     * @param debtNameEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtNameEdit(debtNameEditRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            debtNameModel::where('id',$request->debtNameID)->
            update([
                'title' => $request->title,
            ]);

            return redirect('/debtNameManage')
                ->with('success', 'Creditor Name Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Creditor  Name not Edit Please Try Again!!');
        }
    }

    /**
     * use to search in debt name
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtNameMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debtNames = debtNameModel::where('title', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->

        orderBy('id', 'DESC')
            ->paginate(24);



        return view('debt.debt_name_manage', [
            'debtNames' => $debtNames,
            'status' => "search Form",
        ]);


    }

    /**
     *use to Manage debt Paid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtPaidManage()
    {
        $debtPaid = debtPaidModel::orderBy('id', 'DESC')->
        paginate(24);

        $sum =$debtPaid->sum(function ($debt) {
            return $debt->amount;
        });

        $debtNames = debtNameModel::all();

        return view('debt.debt_paid_manage', [
            'debtPaid' => $debtPaid,
            'status' => "none",
            'sum'=>$sum,
            'debtNames'=>$debtNames
        ]);
    }

    /**
     * use to show Debt Paid Details
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtPaidDetailsManage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debts = debtModel::findOrFail($id);


        $sum =$debts->dept_paid->sum(function ($debt) {

            return $debt->amount;
        });

        return view('debt.debt_paid_spis_manage', [
            'debts' => $debts,
            'sum'=>$sum
        ]);
    }

    /**
     * use to delete dept paid and back money as debt
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function debtPaidDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $debtPaid = debtPaidModel::findOrFail($id);

            $debt = debtModel::where('id','=',$debtPaid->debt_id)->first();

            debtModel::where('id','=',$debtPaid->debt_id)->
                        update([
                            'amount'=>$debt->amount + $debtPaid->amount
            ]);

            debtPaidModel::destroy(($debtPaid->id));

            return back()
                ->with('success', 'Debt Paid Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Debt Paid not Deleted Please Try Again!!');
        }
    }

    /**
     * use to Main search base on id ,amount ,creditor
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtPaidMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $debtPaid = debtPaidModel::where('amount', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orWhere('note', 'LIKE', "%" . $request->search . "%")->
        orWhereHas('depts_name',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $sum =$debtPaid->sum(function ($debt) {
            return $debt->amount;
        });

        $debtNames = debtNameModel::all();

        return view('debt.debt_paid_manage', [
            'debtPaid' => $debtPaid,
            'status' => "search Form",
            'sum'=>$sum,
            'debtNames'=>$debtNames

        ]);



    }

    /**
     * use to search base on 2 date and creditor
     * @param dateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function debtPaidDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        if(is_null($request->debtName))
        {
            $debtPaid =debtPaidModel::whereBetween('created_at', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        else
        {
            $debtPaid =debtPaidModel::whereBetween('created_at', array($request->startDate,$endDate))->
            WhereHas('depts_name',function ( $query )use ( $request ){
                $query->where('id','LIKE', "%".$request->debtName."%" );
            })->
            orderBy('id', 'DESC')
                ->paginate(24);
        }


        $sum =$debtPaid->sum(function ($debt) {
            return $debt->amount;
        });

        $debtNames = debtNameModel::all();

        return view('debt.debt_paid_manage', [
            'debtPaid' => $debtPaid,
            'status' => "search Form",
            'sum'=>$sum,
            'debtNames'=>$debtNames

        ]);
    }


}
