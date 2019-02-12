<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Expenses as expensesModel;
use App\Model\Expenses_Type as Expenses_TypeModel;
use App\Http\Requests\Expenses\AddExpenses as addExpensesRequest;
use App\Http\Requests\Expenses\EditExpenses as editExpensesRequest;
use App\Http\Requests\Expenses\AddExpensesType as addExpensesTypeRequest;
use App\Http\Requests\Expenses\editExpensesType as editExpensesTypeRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use Carbon\Carbon;


class Expenses extends Controller
{

    public function __construct()
    {


        $this->middleware('auth');
    }

    public function expensesManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $expenses = expensesModel::orderBy('id', 'DESC')->
                            paginate(24);

        $sum =$expenses->sum(function ($expense) {
            return $expense->amount;
        });

        $expenses_types = Expenses_TypeModel::orderBy('id', 'DESC')->get();

        return view('expenses.expenses_manage', [
            'expenses' => $expenses,
            'status' => "none",
            'sum'=>$sum,
            'expenses_types' => $expenses_types
        ]);
    }

    public function expensesDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $employee = expensesModel::findOrFail($id);

            expensesModel::destroy(($employee->id));

            return back()
                ->with('success', 'Expense Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expense not Deleted Please Try Again!!');
        }
    }

    public function expensesAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $expenses_types = Expenses_TypeModel::orderBy('id', 'DESC')->get();

        return view('expenses.expenses_add', [
            'expenses_types' => $expenses_types
        ]);
    }

    public function expensesAdd(addExpensesRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            expensesModel::create([
                'expenses_type_id' => $request->expensesType,
                'amount' => $request->amount,
                'note' => $request->note,
                'date' => $request->date

            ]);

            return redirect('/expensesManage')
                ->with('success', 'Expense Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expense not Add Please Try Again!!');
        }
    }

    public function expensesEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $expenses = expensesModel::findOrFail($id);

            $expenses_types = Expenses_TypeModel::orderBy('id', 'DESC')->get();

            return view('expenses.expenses_edit', [
                'expenses' => $expenses,
                'expenses_types' => $expenses_types
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expenses Info. not Update Please Try Again!!');
        }
    }

    public function expensesEdit(editExpensesRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $expenses=expensesModel::findOrFail($request->expensesID);

            expensesModel::where('id', '=', $expenses->id)->
            update([

                'expenses_type_id' => $request->expensesType,
                'amount' => $request->amount,
                'note' => $request->note,
                'date' => $request->date
            ]);

            return redirect('/expensesManage')
                ->with('success', 'Expenses Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expenses Info. not Update Please Try Again!!');
        }
    }

    public function expensesTypeManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $types= Expenses_TypeModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('expenses.expenses_type_manage', [
            'types' => $types,
            'status' => "none"
        ]);
    }

    public function expensesTypeDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $expenses_type = Expenses_TypeModel::findOrFail($id);


            Expenses_TypeModel::destroy(($expenses_type->id));

            return back()
                ->with('success', 'Expense Type Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expense Type not Deleted Please Try Again!!');
        }
    }

    public function expensesTypeAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        return view('expenses.expenses_type_add');
    }

    public function expensesTypeAdd(addExpensesTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            Expenses_TypeModel::create([
                'title' => $request->title,
                'note' => $request->note,

            ]);

            return redirect('/expensesTypeManage')
                ->with('success', 'Expense Type Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expense Type not Add Please Try Again!!');
        }
    }

    public function expensesTypeEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $type = Expenses_TypeModel::findOrFail($id);

            return view('expenses.expenses_type_edit', [
                'type' => $type,
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expenses Type Info. not Update Please Try Again!!');
        }
    }

    public function expensesTypeEdit(editExpensesTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $type=Expenses_TypeModel::findOrFail($request->typeID);

            Expenses_TypeModel::where('id', '=', $type->id)->
            update([
                'title' => $request->title,
                'note' => $request->note,
            ]);

            return redirect('/expensesTypeManage')
                ->with('success', 'Expenses Type Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Expenses Type Info. not Update Please Try Again!!');
        }
    }

    public function expensesMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $expenses = expensesModel::where('amount', 'LIKE', "%" . $request->search . "%")->
        orwhere('note', 'LIKE', "%" . $request->search . "%")->
        orWhereHas('expenses_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $sum =$expenses->sum(function ($expense) {
            return $expense->amount;
        });

        $expenses_types = Expenses_TypeModel::orderBy('id', 'DESC')->get();

        return view('expenses.expenses_manage', [
            'expenses' => $expenses,
            'status' => 'search Form',
            'sum'=>$sum,
            'expenses_types' =>$expenses_types

        ]);

    }

    public function expensesDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        if(is_null($request->expensesType))
        {
            $expenses =expensesModel::whereBetween('date', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        else
        {
            $expenses =expensesModel::whereBetween('date', array($request->startDate,$endDate))->
            where('expenses_type_id',$request->expensesType)->
            orderBy('id', 'DESC')
                ->paginate(24);
        }


        $sum =$expenses->sum(function ($expense) {
            return $expense->amount;
        });

        $expenses_types = Expenses_TypeModel::orderBy('id', 'DESC')->get();

        return view('expenses.expenses_manage', [
            'expenses' => $expenses,
            'status'=>'search Form',
            'sum'=>$sum,
            'expenses_types' =>$expenses_types
        ]);
    }



}
