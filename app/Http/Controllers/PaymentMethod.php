<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentMethod\AddPaymentMethod as addPaymentMethodRequest;
use App\Http\Requests\PaymentMethod\EditPaymentMethod as editPaymentMethodRequest;
use App\Http\Requests\PaymentMethod\SearchPaymentMethod as searchPaymentMethodRequest;
use Auth;

use App\Model\Payment_Method as paymentMethodModel;

class PaymentMethod extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Use to show Add Payment method Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addPaymentPage()
    {
        return view('payment_method.add_payment');
    }

    /**
     * use to add payment method
     * @param addPaymentMethodRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addPayment(addPaymentMethodRequest $request)
    {
        try
        {
        paymentMethodModel::create([
            'title'=>$request->title,
        ]);

            return redirect('/paymentMethod')
            ->with('success', 'Payment Method add Successfully.');
        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Please Try Again!!.');
        }

    }

    /**
     * use to show mange payment Method page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentMethod()
    {
        $payments = paymentMethodModel::paginate(24);

        return view('payment_method.payment',[
            'payments'=>$payments,
            'status'=>"none"
        ]);
    }

    /**
     * use to delete payment Method
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function paymentMethodDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try
        {
            paymentMethodModel::destroy($id);

            return back()
                ->with('success', 'Payment Method Delete Successfully.');
        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    /**
     * use to show edit payment Method page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editPaymentPage($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try
        {
            $payment=paymentMethodModel::findOrFail($id);

            return view('payment_method.edit_payment',[
                'payment'=>$payment,

            ]);
        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    /**
     * use to  edit payment Method
     * @param editPaymentMethodRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPayment(editPaymentMethodRequest $request)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try
        {
            paymentMethodModel::where('id','=',$request->paymentId)->
                                         update([
                                             'title'=>$request->title
                                               ]);

            return redirect('/paymentMethod')
                ->with('success', 'Payment Method Update Successfully.');
        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Please Try Again!!.');
        }
    }

    /**
     * use to search in Payment Method
     * @param SearchPaymentMethod $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPayment(searchPaymentMethodRequest $request)
    {
        $payments = paymentMethodModel::where('title','LIKE',"%".$request->search."%")->
                    orwhere('id','=',$request->search)->
                    orderBy('id', 'DESC')
                        ->paginate(24);


        return view('payment_method.payment',[
            'payments'=>$payments,
            'status'=>'search Form',

        ]);
    }
}
