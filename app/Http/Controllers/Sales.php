<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Model\Sales AS salesModel;
use App\Model\Invoice_Transaction AS InvoiceTransactionModel;
use App\Model\Item as itemModel;
use App\Model\Sales_Type as salesTypeModel;
use App\Model\Client as clientModel;
use App\Model\Payment_Method as paymentMethodModel;
use App\Model\WriteHelper as writeHelperModel;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Invoice\DateSearch as dateSearchRequest;
use App\Http\Requests\Invoice\TransactionInvoice as transactionInvoiceRequest;
use App\Http\Requests\Invoice\AddInvoiceType as addInvoiceTypeRequest;
use App\Http\Requests\Invoice\EditInvoiceType as editInvoiceTypeRequest;
use App\Http\Requests\Invoice\GetClient as getClientRequest;
use App\Http\Requests\Invoice\AddInvoice as addInvoiceRequest;
use App\Http\Requests\Invoice\EditInvoice as editInvoiceRequest;
use App\Http\Requests\Invoice\WriteHelper as writeHelperRequest;
use App\Http\Requests\Client\AutoCompletes as autoCompleteRequest;
use Carbon\Carbon;
use Auth;

class Sales extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function  index()
    {


        $invoices = salesModel::orderBy('id', 'DESC')->
        paginate(24);

        $total = salesModel::sum('total_amount');

        $paid = salesModel::sum('paid_amount');

        $remaining = salesModel::sum('remaining_amount');

        $company =clientModel::orderBy('id', 'DESC')->pluck('company_name')->unique();

        $salesType =salesTypeModel::orderBy('id', 'DESC')->get();
        
        if(\Auth::user()->roles()->first()->name == 'Admin' )
        $user = 'auth';
        else
        $user = 'other';
        
        
        

        return view('index',[
            'invoices'=>$invoices,
            'total'=>$total,
            'paid'=>$paid,
            'remaining'=>$remaining,
            'company'=>$company,
            'salesType'=>$salesType,
            'status'=>"none",
            'user'=>$user
        ]);
    }

    /**
     * use to pay the reminding from invoice
     * @param transactionInvoiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invoicePay(transactionInvoiceRequest $request)
    {
        try {

            $invoice = salesModel::findOrFail($request->invoiceIDs);

            if($request->pay > 0 && $request->pay <= $invoice->remaining_amount )
            {
                if(($request->pay - $invoice->amount) == 0)
                {
                    InvoiceTransactionModel::create([
                        'invoice_id'=>$invoice->id,
                        'amount'=>$request->pay,
                        'note'=>$request->note,
                        'user_id'=>\Auth::user()->id

                    ]);

                    salesModel::where('id', '=', $invoice->id)->
                    update([
                        'remaining_amount' => $invoice->remaining_amount - $request->pay,
                        'paid_amount'=> $invoice->paid_amount + $request->pay
                    ]);

                    return back()
                        ->with('success', 'Invoice Transaction Add successfully.');
                }
                else
                {

                    InvoiceTransactionModel::create([
                        'invoice_id'=>$invoice->id,
                        'amount'=>$request->pay,
                        'note'=>$request->note,
                        'user_id'=>\Auth::user()->id

                    ]);

                    salesModel::where('id', '=', $invoice->id)->
                    update([
                        'remaining_amount' => $invoice->remaining_amount - $request->pay,
                        'paid_amount'=> $invoice->paid_amount + $request->pay
                    ]);

                    return back()
                        ->with('success', 'Invoice Transaction add successfully.');
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
     * show invoice trasactions
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoiceDetailsPaid($id)
    {
         
            
        $invoice= salesModel::findOrFail($id);

        $sum =$invoice->transaction->sum(function ($debt) {

            return $debt->amount;
        });

      //  dd($invoice);
        return view('sales.invoice_paid_manage', [
            'invoice' => $invoice,
            'sum'=>$sum
        ]);

    }

    /**
     * use to delete each invoice transaction
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invoicePaidDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            $invoiceTransaction = InvoiceTransactionModel::findOrFail($id);

            $invoice = salesModel::findOrFail($invoiceTransaction->invoice_id);

            salesModel::where('id','=',$invoiceTransaction->invoice_id)->
            update([
                'paid_amount'=>$invoice->paid_amount - $invoiceTransaction->amount,
                'remaining_amount' => $invoice->remaining_amount + $invoiceTransaction->amount
            ]);

            InvoiceTransactionModel::destroy(($invoiceTransaction->id));

            return back()
                ->with('success', 'Invoice Paid Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Invoice Paid not Deleted Please Try Again!!');
        }
    }

    /**
     * Show Add Invoice Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoiceAddPage()
    {
        $company =clientModel::orderBy('id', 'DESC')->pluck('company_name')->unique();
        $salesType =salesTypeModel::orderBy('id', 'DESC')->get();
        $paymentMethods =paymentMethodModel::get();

        return view('sales.sales_add',[
            'company'=>$company,
            'salesType'=>$salesType,
            'paymentMethods'=>$paymentMethods
        ]);
    }

    /**
     * use to Add invoice
     * @param addInvoiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invoiceAdd(addInvoiceRequest $request)
    {


        if($request->remainingAmount != '0' &&  is_null($request->paidDate ) )
        {
            return back()
                ->with('error', 'Please Enter paid Data.');
        }

        if($request->remainingAmount < '0' ||  $request->paidAmount < '0' ||    $request->discount < '0' )
        {
            return back()
                ->with('error', 'Your input date in minus!!');
        }

        foreach ($request->title as $key => $titles) {

            if($request->input('amount')[$key] < '0')
                return back()
                    ->with('error', 'Your input Data in minus!!');
        }

        \DB::beginTransaction();

        try {
            $clientId = clientModel::where('company_name', '=', $request->company)->where('client_name', '=',     $request->client)->first();

            $invoice = salesModel::create([
                'client_id' => $clientId->id,
                'sales_type_id' => $request->sales_type,
                'discount' => $request->discount,
                'total_amount' => $request->totalAmount,
                'paid_amount' => $request->paidAmount,
                'remaining_amount' => $request->remainingAmount,
                'paid_date' => $request->paidDate,
                'payment_id'=>$request->payment_method,
                'sales_employee_id' => 1,
                'user_id' => \Auth::user()->id,
                'date_issue'=>$request->dateIssue
            ]);

            InvoiceTransactionModel::create([
                'invoice_id'=>$invoice->id,
                'amount'=>$request->paidAmount,
                'note'=>"First Paid",
                'user_id'=>\Auth::user()->id

            ]);

            foreach ($request->title as $key => $titles) {
                itemModel::create([
                    'title' => $titles,
                    'quantity' => $request->input('qty')[$key],
                    'amount' => $request->input('amount')[$key],
                    'description' => $request->input('desc')[$key],
                    'sales_id' => $invoice->id,

                ]);

            }
            \DB::commit();

            return redirect('/')
                ->with('success', 'Invoice Add Successfully.');

            }
            catch (\Exception $e)
            {
            \DB::rollBack();

            return back()
                ->with('error', 'Please Try Again!!.');
        }


    }

    /**
     *Use to show invoice edit page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoiceEditPage($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        $invoice = salesModel::findOrFail($id);

        $company =clientModel::orderBy('id', 'DESC')->pluck('company_name')->unique();

        $salesType =salesTypeModel::orderBy('id', 'DESC')->get();

        $paymentMethods =paymentMethodModel::get();

        return view('sales.sales_edit',[
            'company'=>$company,
            'salesType'=>$salesType,
            'invoice'=>$invoice,
            'paymentMethods'=>$paymentMethods
        ]);
    }

    /**
     * use to edit Invoice
     * @param editInvoiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invoiceEdit(editInvoiceRequest $request)
    {

         if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }

        if($request->remainingAmount != '0' &&  is_null($request->paidDate ) )
        {
            return back()
                ->with('error', 'Please Enter paid Date.');
        }

        \DB::beginTransaction();

        try {

            $invoice = salesModel::findOrFail($request->invoiceId);

            $clientId = clientModel::where('company_name', '=', $request->company)->where('client_name', '=',     $request->client)->first();



            salesModel::where('id', '=', $request->invoiceId)
                ->update([
                'client_id' => $clientId->id,
                'sales_type_id' => $request->sales_type,
                'discount' => $request->discount,
                'total_amount' => $request->totalAmount,
                'paid_amount' => $request->paidAmount,
                'remaining_amount' => $request->remainingAmount,
                'paid_date' => $request->paidDate,
                'payment_id'=>$request->payment_method,
               // 'sales_employee_id' => 1,
                'user_id' => \Auth::user()->id,
                'date_issue'=>$request->dateIssue
                ]);

            foreach ($invoice->item as $items)
            {
                itemModel::where('sales_id', '=', $invoice->id)->
                         delete();
            }
            foreach ($request->title as $key => $titles) {
                itemModel::create([
                    'title' => $titles,
                    'quantity' => $request->input('qty')[$key],
                    'amount' => $request->input('amount')[$key],
                    'description' => $request->input('desc')[$key],
                    'sales_id' => $invoice->id,

                ]);

            }
            \DB::commit();

            return redirect('/')
                ->with('success', 'Invoice Update Successfully.');

        }
        catch (\Exception $e)
        {
            \DB::rollBack();

            return back()
                ->with('error', $e->getMessage());
        }


    }

    /*
     * Show invoice Details
     */
    public  function  invoiceDetails($id)
    {
        $invoices = salesModel::find($id);
        //  dd($invoices);
        return view('sales.sales_details', [
            'invoices' => $invoices
        ]);
    }

    /*
     * Delete Invoice
     */
    public  function  invoiceDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
        $invoice = salesModel::findOrFail($id);

        foreach ($invoice->item as $items) {

            itemModel::where('sales_id', $invoice->id)->delete();
        }

            foreach ($invoice->transaction as $items) {

                InvoiceTransactionModel::where('invoice_id', $invoice->id)->delete();
            }

        salesModel::destroy(($invoice->id));

            return back()
                ->with('success', 'Invoice Delete Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Invoice  not Deleted Please Try Again!!');
        }
    }

    /*
     * Search using invoice type,company name,client name,client phone,description,total amount,
     * paid amount,remaining amount and user(admin)
     */
    public function invoiceMainSearch(mainSearchRequest $request)
    {

        $invoices = salesModel::WhereHas('sales_type',function ( $query )use ( $request ){
                                $query->where('title','LIKE', "%".$request->search."%" );
                              })->
                                orWhereHas('client',function ( $query )use ( $request ){
                                    $query->where('company_name','LIKE', "%".$request->search."%" );
                                })->
                                orWhereHas('client',function ( $query )use ( $request ){
                                    $query->where('client_name','LIKE', "%".$request->search."%" );
                                })->
                                orWhereHas('client',function ( $query )use ( $request ){
                                    $query->where('client_phone','LIKE', "%".$request->search."%" );
                                })->
                             orwhere('id','=',$request->search)->
                             orwhere('total_amount','LIKE',"%".$request->search."%")->
                             orwhere('paid_amount','LIKE',"%".$request->search."%")->
                             orwhere('remaining_amount','LIKE',"%".$request->search."%")->
                             orWhereHas('user',function ( $query )use ( $request ){
                                $query->where('name','LIKE', "%".$request->search."%" );
                             })->
                             orderBy('id', 'DESC')
                                ->paginate(24);


        $total = salesModel::WhereHas('sales_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('company_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('client_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('client_phone','LIKE', "%".$request->search."%" );
        })->
        orwhere('total_amount','LIKE',"%".$request->search."%")->
        orwhere('paid_amount','LIKE',"%".$request->search."%")->
        orwhere('remaining_amount','LIKE',"%".$request->search."%")->
        orWhereHas('user',function ( $query )use ( $request ){
            $query->where('name','LIKE', "%".$request->search."%" );
        })->sum('total_amount');



        $paid = salesModel::WhereHas('sales_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('company_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('client_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('client_phone','LIKE', "%".$request->search."%" );
        })->
        orwhere('total_amount','LIKE',"%".$request->search."%")->
        orwhere('paid_amount','LIKE',"%".$request->search."%")->
        orwhere('remaining_amount','LIKE',"%".$request->search."%")->
        orWhereHas('user',function ( $query )use ( $request ){
            $query->where('name','LIKE', "%".$request->search."%" );
        })->sum('paid_amount');

        $remaining = salesModel::WhereHas('sales_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('company_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('client_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('client',function ( $query )use ( $request ){
            $query->where('client_phone','LIKE', "%".$request->search."%" );
        })->
        orwhere('total_amount','LIKE',"%".$request->search."%")->
        orwhere('paid_amount','LIKE',"%".$request->search."%")->
        orwhere('remaining_amount','LIKE',"%".$request->search."%")->
        orWhereHas('user',function ( $query )use ( $request ){
            $query->where('name','LIKE', "%".$request->search."%" );
        })->sum('remaining_amount');

        $company =clientModel::orderBy('id', 'DESC')->pluck('company_name')->unique();

        $salesType =salesTypeModel::orderBy('id', 'DESC')->get();

        if(\Auth::user()->roles()->first()->name == 'Admin' )
                        $user = 'auth';
                        else
                        $user = 'other';

        return view('index',[
            'invoices'=> $invoices,
            'status'=>'search Form',
            'total'=>$total,
            'paid'=>$paid,
            'company'=>$company,
            'salesType'=>$salesType,
            'remaining'=>$remaining,
            'user'=>$user
        ]);
    }

    /*
     * search between two date
     */
    public function invoiceDateSearch(dateSearchRequest $request)
    {

        if(is_null($request->company) && is_null($request->client) && is_null($request->sales_type) )
        {
            $endDate = Carbon::parse($request->endDate)->addHour(24);

            $invoices =salesModel::whereBetween('date_issue', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);

            $total = salesModel::whereBetween('date_issue', array($request->startDate,$endDate))->
                                 sum('total_amount');

            $paid = salesModel::whereBetween('date_issue', array($request->startDate,$endDate))->
                               sum('paid_amount');

            $remaining = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
                                   sum('remaining_amount');

        }

        elseif(is_null($request->company) && is_null($request->client)) {
            $endDate = Carbon::parse($request->endDate)->addHour(24);
            $invoices = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->
            orderBy('id', 'DESC')
                ->paginate(24);


            $total = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('total_amount');


            $paid = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('paid_amount');


            $remaining = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('remaining_amount');

        }

        elseif(is_null($request->client) ) {

            $endDate = Carbon::parse($request->endDate)->addHour(24);
            $invoices = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->
            orderBy('id', 'DESC')
                ->paginate(24);


            $total = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('total_amount');


            $paid = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('paid_amount');


            $remaining = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('remaining_amount');

        }

        elseif(is_null($request->sales_type) )
        {
            $endDate = Carbon::parse($request->endDate)->addHour(24);
            $invoices = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
            orderBy('id', 'DESC')
                ->paginate(24);


            $total = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
             sum('total_amount');


            $paid = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
              sum('paid_amount');


            $remaining = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
               sum('remaining_amount');

        }

        else {
            $endDate = Carbon::parse($request->endDate)->addHour(24);
            $invoices = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->
            orderBy('id', 'DESC')
                ->paginate(24);


            $total = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('total_amount');


            $paid = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('paid_amount');


            $remaining = salesModel::whereBetween('date_issue', array($request->startDate, $endDate))->
            WhereHas('client', function ($query) use ($request) {
                $query->where('company_name', 'LIKE', "%" . $request->company . "%");
            })->
            WhereHas('client', function ($query) use ($request) {
                $query->where('client_name', 'LIKE', "%" . $request->client . "%");
            })->
            WhereHas('sales_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->sales_type . "%");
            })->sum('remaining_amount');

        }
        $company =clientModel::orderBy('id', 'DESC')->pluck('company_name')->unique();

        $salesType =salesTypeModel::orderBy('id', 'DESC')->get();

         if(\Auth::user()->roles()->first()->name == 'Admin' )
                $user = 'auth';
                else
                $user = 'other';

        return view('index',[
            'invoices'=> $invoices,
            'status'=>'search Form',
            'total'=>$total,
            'paid'=>$paid,
            'company'=>$company,
            'salesType'=>$salesType,
            'remaining'=>$remaining,
            'user'=>$user
        ]);


    }

    /**
     * Show Invoice Type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function invoiceType()
    {
        
        $types = salesTypeModel::orderBy('id', 'DESC')->
        paginate(20);


        return view('sales.sales_type',[
            'types'=>$types,
            'status'=>"none"
        ]);
    }

    /**
     * Delete invoice Type
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invoiceTypeDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            $type = salesTypeModel::findOrFail($id);

            salesTypeModel::destroy(($type->id));

            return back()
                ->with('success', 'Invoice Type Delete successfully.');
        } catch (\Exception $e) {


            return back()
                ->with('error', 'Invoice Type not Deleted Please Try Again!!');
        }
    }

    /**
     * Use to Search in invoice type
     *
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function typeMainSearch(mainSearchRequest $request)
    {


        $types = salesTypeModel::

        where('title','LIKE',"%".$request->search."%")->
        orwhere('id','=',$request->search)->
        orderBy('id', 'DESC')
            ->paginate(24);

        //dd($types);
        return view('sales.sales_type',[
            'types'=> $types,
            'status'=>'search Form',

        ]);
    }

    /**
     * Show add Invoice Type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddInvoiceType()
        {

            return view('sales.add_type');
        }

    /**
     * Add Invoice Type
     * @param addInvoiceTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addInvoiceType(addInvoiceTypeRequest $request)
    {
        try {
        salesTypeModel::create(['title'=>$request->title]);

        return back()
            ->with('success', 'Invoice Type Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Invoice type not Add Please Try Again!!');
        }
    }

    /**
     * Show Edit Invoice Type
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     */
    public function showEditInvoiceType($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            $type=salesTypeModel::findOrFail($id);

            return view('sales.edit_type',[
                'type'=>$type
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Invoice type not Update Please Try Again!!');
        }

    }

    /**
     * Edit Invoice Type
     * @param editInvoiceTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editInvoiceType(editInvoiceTypeRequest $request)
   {
       if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
       try {
       $type=salesTypeModel::findOrFail($request->typeId);

           salesTypeModel::where('id', '=', $type->id)->
           update(['title' => $request->title]);

           return redirect('/invoiceType')
               ->with('success', 'Invoice Type Update Successfully.');

       } catch (\Exception $e) {

           return back()
               ->with('error', 'Invoice type not Update Please Try Again!!');
       }

   }

    /**
     *Get all Clients for company
     *
     * @param getClientRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getClients(getClientRequest $request)
    {
        try {

            $client =clientModel::orderBy('id', 'DESC')->
            where('company_name','=',$request->company)->
            pluck('client_name')->unique();

           // dd($client);
            return response()->json($client);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());
        }

    }

    /**
     * print invoice
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printInvoice($id)
    {
        $invoice = salesModel::findOrFail($id);

        return view('sales.invoicePrint',[
           'invoice'=>$invoice
        ]);
    }

    /**
     * print invoice details
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printDetailsInvoice($id)
    {
        $invoice = salesModel::findOrFail($id);

        return view('sales.invoiceDetailsPrint',[
            'invoices'=>$invoice
        ]);
    }

    /**
     * print payment statement
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printStatementInvoice($id)
    {
        $invoice = salesModel::findOrFail($id);

        return view('sales.invoiceStatmentPrint',[
            'invoices'=>$invoice
        ]);
    }

   public function addWriteHelperPage()
   {
       return view('sales.write_helper_add');
   }

   public function addWriteHelper(writeHelperRequest $request)
   {

       writeHelperModel::create([
           'title'=>$request->title
       ]);

       return back()
           ->with('success', 'Write Helper Add successfully.');
   }

   public function  manageWriteHelper()
   {
       $helperWrites= writeHelperModel::orderBy('id', 'DESC')->
       paginate(2);

       return view('sales.write_helper_manage',[
           'helperWrites'=>$helperWrites,
           'status'=>"none"
       ]);
   }

    public function WriteHelperDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
        {
            return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
        }

        try {
            $type = writeHelperModel::findOrFail($id);

            writeHelperModel::destroy(($type->id));

            return back()
                ->with('success', 'Write Helper Delete successfully.');
        } catch (\Exception $e) {


            return back()
                ->with('error', 'Write Helper not Deleted Please Try Again!!');
        }
    }

    public function autoCompleteHelper(autoCompleteRequest $request)
    {
        $company = writeHelperModel::where("title","LIKE","%{$request->input('query')}%")->
        pluck('title')->
        unique("title")->
        take(8)->
        toArray();


        return response()->json($company);
    }
}
