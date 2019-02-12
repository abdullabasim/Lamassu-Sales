<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Printing as printingModel;
use App\Model\Printing_type as printingTypeModel;
use App\Model\Printing_Company as printingCompanyModel;
use App\Http\Requests\Printing\GetCompany as GetCompanyRequest;
use App\Http\Requests\Printing\AddPrinting as addPrintingRequest;
use App\Http\Requests\Printing\EditPrinting as editPrintingRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use App\Http\Requests\Printing\AddCompanyPrinting as addCompanyPrintingRequest;
use App\Http\Requests\Printing\EditCompanyPrinting as editCompanyPrintingRequest;
use Carbon\Carbon;


class Printing extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     *use to manage printing inside and outside countery
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $printings = printingModel::orderBy('id', 'DESC')->
        paginate(24);


        $sum =$printings->sum(function ($printing) {
            return $printing->amount;
        });

        $locations = printingTypeModel::all();


        return view('printing.printing_manage', [
            'printings' => $printings,
            'status' => "none",
            'sum'=>$sum,
            'locations'=>$locations
        ]);
    }

    /**
     *get Company when selected company location
     * @param GetCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompany(GetCompanyRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            $company =printingCompanyModel::orderBy('id', 'DESC')->
            WhereHas('printing_company_type', function ($query) use ($request) {
                $query->where('id', 'LIKE', "%" . $request->location . "%");
            })->
            pluck('title')->unique();

            // dd($client);
            return response()->json($company);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());
        }
    }

    /**
     *
     * Use to delete printing record
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function printingDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $printing = printingModel::findOrFail($id);

            printingModel::destroy(($printing->id));

            return back()
                ->with('success', 'Printing Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Printing not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show printing Add Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function printingAddPage()
   {
       \Auth::user()->authorizeRoles(['Admin']);
       $locations = printingTypeModel::all();

       return view('printing.printing_add', [
           'locations'=>$locations
       ]);
   }

    /**
     *ust to add new printing
     * @param addPrintingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function printingAdd(addPrintingRequest $request)
   {
       \Auth::user()->authorizeRoles(['Admin']);
       try {
           $company = printingCompanyModel::where('title','=',$request->company)->
                                              first();
           printingModel::create([
               'printing_company_id' => $company->id,
               'amount' => $request->amount,
               'exchange_date' => $request->date,
               'note' => $request->note,

           ]);

           return redirect('/printingManage')
               ->with('success', 'Printing Add successfully.');
       } catch (\Exception $e) {

           return back()
               ->with('error', 'Printing not Add Please Try Again!!');
       }
   }

    /**
     * use to show printing edit page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function printingEditPage($id)
   {
       \Auth::user()->authorizeRoles(['Admin']);
       $locations = printingTypeModel::all();

       $printing = printingModel::findOrFail($id);

       return view('printing.printing_edit', [
           'locations'=>$locations,
           'printing'=>$printing
       ]);
   }

    /**
     * use to printing edit
     *
     * @param editPrintingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function printingEdit(editPrintingRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $company = printingCompanyModel::where('title','=',$request->company)->
                                            first();
            printingModel::where('id',$request->printingID)->
                        update([
                            'printing_company_id' => $company->id,
                            'amount' => $request->amount,
                            'exchange_date' => $request->date,
                            'note' => $request->note,

                        ]);

            return redirect('/printingManage')
                ->with('success', 'Printing Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Printing not Edit Please Try Again!!');
        }
    }

    /**
     * use to search base on id, printing company, amount ,location,Note
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $printings = printingModel::where('amount', 'LIKE', "%" . $request->search . "%")->
        orwhere('note', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orWhereHas('printing_company',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('printing_company.printing_company_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $locations = printingTypeModel::all();

        $sum =$printings->sum(function ($printing) {
            return $printing->amount;
        });

        return view('printing.printing_manage', [
            'printings' => $printings,
            'status' => 'search Form',
            'sum'=>$sum,
            'locations'=>$locations
        ]);

    }

    /**
     * use to search between two date and other condations
     *
     * @param dateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        if(is_null($request->location))
        {
            $printings =printingModel::whereBetween('exchange_date', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        elseif(is_null($request->company))
        {
            $printings =printingModel::whereBetween('exchange_date', array($request->startDate,$endDate))->
            WhereHas('printing_company.printing_company_type',function ( $query )use ( $request ){
                $query->where('id','LIKE', "%".$request->location."%" );
            })->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        else
        {
            $printings =printingModel::whereBetween('exchange_date', array($request->startDate,$endDate))->
            WhereHas('printing_company',function ( $query )use ( $request ){
                $query->where('title','LIKE', "%".$request->company."%" );
            })->
            WhereHas('printing_company.printing_company_type',function ( $query )use ( $request ){
                $query->where('id','LIKE', "%".$request->location."%" );
            })->
            orderBy('id', 'DESC')
                ->paginate(24);
        }


        $locations = printingTypeModel::all();

        $sum =$printings->sum(function ($printing) {
            return $printing->amount;
        });

        return view('printing.printing_manage', [
            'printings' => $printings,
            'status' => 'search Form',
            'sum'=>$sum,
            'locations'=>$locations
        ]);
    }

    /**
     * use to Manage printing Company
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingCompanyManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $companies = printingCompanyModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('printing.printing_company_manage', [
            'companies' => $companies,
            'status' => "none",
        ]);
    }

    /**
     * use to delete printing company
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function printingCompanyDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $company = printingCompanyModel::findOrFail($id);

            printingCompanyModel::destroy(($company->id));

            return back()
                ->with('success', 'Printing Company Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Printing Company not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show printing company add
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingCompanyAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $locations = printingTypeModel::all();

        return view('printing.printing_company_add', [
            'locations'=>$locations
        ]);
    }

    /**
     * use to printing company add
     * @param addCompanyPrintingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function printingCompanyAdd(addCompanyPrintingRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            printingCompanyModel::create([
                'printing_company_type_id' =>$request->location ,
                'title' => $request->company,

            ]);

            return redirect('/printingCompanyManage')
                ->with('success', 'Printing Company Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Printing Company not Add Please Try Again!!');
        }
    }

    /**
     * use to show printing Company Edit Page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingCompanyEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $locations = printingTypeModel::all();

        $company = printingCompanyModel::findOrFail($id);

        return view('printing.printing_company_edit', [
            'locations'=>$locations,
            'company'=>$company
        ]);
    }

    /**
     * use to  printing Company Edit
     * @param editCompanyPrintingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function printingCompanyEdit(editCompanyPrintingRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            printingCompanyModel::where('id',$request->companyID)->
            update([
                'printing_company_type_id' =>$request->location ,
                'title' => $request->company,

            ]);

            return redirect('/printingCompanyManage')
                ->with('success', 'Printing Company Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Printing Company not Edit Please Try Again!!');
        }
    }

    /**
     * use to search in printing company
     *
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printingCompanyMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $companies = printingCompanyModel::where('title', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orWhereHas('printing_company_type',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);


        return view('printing.printing_company_manage', [
            'companies' => $companies,
            'status' => 'search Form',
        ]);
    }

}
