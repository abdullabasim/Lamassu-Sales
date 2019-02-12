<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Promotion_Item as promotionItemModel;
use App\Model\PromotionItemCompany as promotionItemCompanyModel;
use App\Http\Requests\PromotionItem\AddPromotionItem as addPromotionItemRequest;
use App\Http\Requests\PromotionItem\EditPromotionItem as editPromotionItemRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use App\Http\Requests\Delivery\AddDeliveryType as addDeliveryTypeRequest;
use App\Http\Requests\Delivery\EditDeliveryType as editDeliveryTypeRequest;

use Carbon\Carbon;

class PromotionItem extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     *use to smanage promotion item manage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function promotionItemManage()
   {
       \Auth::user()->authorizeRoles(['Admin']);
       $promotions = promotionItemModel::orderBy('id', 'DESC')->
       paginate(24);



       $sum =$promotions->sum(function ($promotion) {
           return $promotion->amount;
       });

       return view('promotion_item.promtion_manage', [
           'promotions' => $promotions,
           'status' => "none",
           'sum'=>$sum,

       ]);
   }

    /**
     * use to show add promotion item page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promotionItemAddPage()
   {
       \Auth::user()->authorizeRoles(['Admin']);

       $promotionCompany = promotionItemCompanyModel::all();

       return view('promotion_item.promotion_add',[
           'promotionCompany'=>$promotionCompany
       ]);
   }

    /**
     * use to add promotion item
     * @param addPromotionItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promotionItemAdd(addPromotionItemRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            promotionItemModel::create([
                'amount' => $request->amount,
                'exchange_date' => $request->date,
                'note' => $request->note,
                'promotion_item_company_id'=>$request->location

            ]);

            return redirect('/promotionItemManage')
                ->with('success', 'promotion Item Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'promotion Item not Add Please Try Again!!');
        }
    }

    /**
     *
     * use to delete promotion item
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promotionItemDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $promoation = promotionItemModel::findOrFail($id);

            promotionItemModel::destroy(($promoation->id));

            return back()
                ->with('success', 'Promotion Item Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Promotion Item not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show edit promotion item
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promotionItemEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $promotion = promotionItemModel::findOrFail($id);

        $deliveryType = promotionItemCompanyModel::all();

      //  $delivery = deliveryModel::findOrFail($id);

        return view('promotion_item.promotion_edit', [
            'promotion'=>$promotion,
            'deliveryType'=>$deliveryType

        ]);
    }

    /**
     * use to edit Promotion Item
     * @param editPromotionItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promotionItemEdit(editPromotionItemRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            promotionItemModel::where('id',$request->promotionID)->
            update([
                'amount' => $request->amount,
                'exchange_date' => $request->date,
                'note' => $request->note,
                'promotion_item_company_id'=>$request->location

            ]);

            return redirect('/promotionItemManage')
                ->with('success', 'Promotion Item Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Promotion Item not Edit Please Try Again!!');
        }
    }

    public function promotionItemMainSearch(mainSearchRequest $request)
    {

        \Auth::user()->authorizeRoles(['Admin']);
        $promotions = promotionItemModel::where('amount', 'LIKE', "%" . $request->search . "%")->
        orwhere('note', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orderBy('id', 'DESC')
            ->paginate(24);


        $sum =$promotions->sum(function ($promotion) {
            return $promotion->amount;
        });

        return view('promotion_item.promtion_manage', [
            'promotions' => $promotions,
            'status' => 'search Form',
            'sum'=>$sum,

        ]);

    }

    public function promotionItemDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        $promotions =promotionItemModel::whereBetween('exchange_date', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);

        $sum =$promotions->sum(function ($promotion) {
            return $promotion->amount;
        });

        return view('promotion_item.promtion_manage', [
            'promotions' => $promotions,
            'status' => 'search Form',
            'sum'=>$sum,

        ]);
    }

    public function companyAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        return view('promotion_item.promotion_item_company_add');
    }

    public function companyAdd(addDeliveryTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            promotionItemCompanyModel::create([
                'title' => $request->title,
            ]);

            return redirect('/promotionItemCompanyManage')
                ->with('success', 'Company Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Company not Add Please Try Again!!');
        }
    }

    public function promotionItemCompanyManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $types = promotionItemCompanyModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('promotion_item.promotion_item_company_manage', [
            'types' => $types,
            'status' => "none",
        ]);
    }

    public function promotionItemCompanyDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $type = promotionItemCompanyModel::findOrFail($id);

            promotionItemCompanyModel::destroy(($type->id));

            return back()
                ->with('success', 'Promoation Item Company Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Promoation Item Company not Deleted Please Try Again!!');
        }
    }

    public function promotionItemCompanyEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $type = promotionItemCompanyModel::findOrFail($id);

        return view('promotion_item.promotion_item_company_edit', [
            'type'=>$type,
        ]);
    }

    public function promotionItemCompanyEdit(editDeliveryTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            promotionItemCompanyModel::where('id',$request->typeID)->
            update([
                'title' => $request->title,

            ]);

            return redirect('/promotionItemCompanyManage')
                ->with('success', 'Promoation item Company Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Promoation item not Edit Please Try Again!!');
        }
    }

    public function promotionItemCompanySearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $types = promotionItemCompanyModel::where('title', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->

        orderBy('id', 'DESC')
            ->paginate(24);

        return view('promotion_item.promotion_item_company_manage', [
            'types' => $types,
            'status' => "search Form",
        ]);


    }

}
