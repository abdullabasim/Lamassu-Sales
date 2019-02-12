<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Delivery as deliveryModel;
use App\Model\Delivery_Type as deliveryTypeModel;
use App\Http\Requests\Delivery\AddDelivery as addDeliveryRequest;
use App\Http\Requests\Delivery\EditDelivery as editDeliveryRequest;
use App\Http\Requests\Delivery\AddDeliveryType as addDeliveryTypeRequest;
use App\Http\Requests\Delivery\EditDeliveryType as editDeliveryTypeRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use Carbon\Carbon;

class Delivery extends Controller
{
    public function __construct()
    {


        $this->middleware('auth');
    }

    public function deliveryManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $deliveries = deliveryModel::orderBy('id', 'DESC')->
        paginate(24);

        $sum =$deliveries->sum(function ($delivery) {
            return $delivery->amount;
        });

        $deliveryType = deliveryTypeModel::orderBy('id', 'DESC')->
                                           get();

        return view('delivery.delivery_manage', [
            'deliveries' => $deliveries,
            'deliveryType'=>$deliveryType,
            'status' => "none",
            'sum'=>$sum,
        ]);
    }

    public function deliveryDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $delivery = deliveryModel::findOrFail($id);

            deliveryModel::destroy(($delivery->id));

            return back()
                ->with('success', 'Delivery Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Delivery not Deleted Please Try Again!!');
        }
    }

    public function deliveryAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $deliveryType = deliveryTypeModel::all();

        return view('delivery.delivery_add', [
            'deliveryType'=>$deliveryType
        ]);
    }

    public function deliveryAdd(addDeliveryRequest $request)
    {
        try {

            deliveryModel::create([
                'delivery_type_id' => $request->location,
                'amount' => $request->amount,
                'delivery_date' => $request->date,
                'note'=> $request->note,
            ]);

            return redirect('/deliveryManage')
                ->with('success', 'Delivery Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Delivery not Add Please Try Again!!');
        }
    }

    public function deliveryEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $deliveryType = deliveryTypeModel::all();

        $delivery = deliveryModel::findOrFail($id);

        return view('delivery.delivery_edit', [
            'deliveryType'=>$deliveryType,
            'delivery'=>$delivery
        ]);
    }

    public function deliveryEdit(editDeliveryRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            deliveryModel::where('id',$request->deliveryID)->
            update([
                'delivery_type_id' => $request->location,
                'amount' => $request->amount,
                'delivery_date' => $request->date,
                'note'=> $request->note,
            ]);

            return redirect('/deliveryManage')
                ->with('success', 'Delivery Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Delivery not Edit Please Try Again!!');
        }
    }

    public function deliveryTypeManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $types = deliveryTypeModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('delivery.delivery_type_manage', [
            'types' => $types,
            'status' => "none",
        ]);
    }

    public function deliveryTypeDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $type = deliveryTypeModel::findOrFail($id);

            deliveryTypeModel::destroy(($type->id));

            return back()
                ->with('success', 'Delivery Type Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Delivery Type Company not Deleted Please Try Again!!');
        }
    }

    public function deliveryTypeAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        return view('delivery.delivery_type_add');
    }

    public function deliveryTypeAdd(addDeliveryTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            deliveryTypeModel::create([
                'title' => $request->title,
            ]);

            return redirect('/deliveryTypeManage')
                ->with('success', 'Delivery Type Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Delivery Type not Add Please Try Again!!');
        }
    }

    public function deliveryTypeEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $type = deliveryTypeModel::findOrFail($id);

        return view('delivery.delivery_type_edit', [
            'type'=>$type,
        ]);
    }

    public function deliveryTypeEdit(editDeliveryTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            deliveryTypeModel::where('id',$request->typeID)->
            update([
                'title' => $request->title,

            ]);

            return redirect('/deliveryTypeManage')
                ->with('success', 'Delivery Type Company Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Delivery Type not Edit Please Try Again!!');
        }
    }

    public function deliveryMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $deliveries = deliveryModel::where('amount', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orWhereHas('delivery_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $sum =$deliveries->sum(function ($delivery) {
            return $delivery->amount;
        });

        $deliveryType = deliveryTypeModel::orderBy('id', 'DESC')->
        get();

        return view('delivery.delivery_manage', [
            'deliveries' => $deliveries,
            'deliveryType'=>$deliveryType,
            'status' => "search Form",
            'sum'=>$sum,
        ]);

    }

    public function deliveryDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        if(is_null($request->location))
        {
            $deliveries =deliveryModel::whereBetween('delivery_date', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        else
        {
            $deliveries =deliveryModel::whereBetween('delivery_date', array($request->startDate,$endDate))->
            WhereHas('delivery_type',function ( $query )use ( $request ){
                $query->where('id','LIKE', "%".$request->location."%" );
            })->
            orderBy('id', 'DESC')
                ->paginate(24);
        }


        $sum =$deliveries->sum(function ($delivery) {
            return $delivery->amount;
        });

        $deliveryType = deliveryTypeModel::orderBy('id', 'DESC')->
                                          get();

        return view('delivery.delivery_manage', [
            'deliveries' => $deliveries,
            'deliveryType'=>$deliveryType,
            'status' => "search Form",
            'sum'=>$sum,
        ]);
    }

    public function deliveryTypeMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $types = deliveryTypeModel::where('title', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->

        orderBy('id', 'DESC')
            ->paginate(24);

        return view('delivery.delivery_type_manage', [
            'types' => $types,
            'status' => "search Form",
        ]);


    }

}
