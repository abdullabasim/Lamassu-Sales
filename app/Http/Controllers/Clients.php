<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Client\AddClient as addClientRequest;
use App\Http\Requests\Client\EditClient as editClientRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Client\AddSpecialty as addSpecialtyRequest;
use App\Http\Requests\Client\EditSpecialty as editSpecialtyRequest;
use App\Http\Requests\Client\AutoCompletes as autoCompleteRequest;
use Auth;
use App\Model\Client as clientModel;
use App\Model\Specialty as specialtyModel;


class Clients extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function showAddClient()
   {
       $specialties = specialtyModel::all();
       return view('clients.add_client',[
           'specialties'=>$specialties
       ]);
   }

    /**
     *Add new Client
     *
     * @param addClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addClient(addClientRequest $request)
    {
        try{
            clientModel::create([
                'company_name'=>$request->company_name,
                'specialty_id'=>$request->specialty,
                'client_name'=>$request->client_name,
                'client_phone'=>$request->client_phone,
                'email'=>$request->email,
                'address'=>$request->address,
                ]);

            return redirect('/clientManagement')
                ->with('success', 'Client Add successfully.');
    }
      catch (\Exception $e)
            {

                return back()
                ->with('error', 'Client not Add Please Try Again!!');
                }
            }

    /**
     * Use to show clients
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function clientManagement()
    {
        
            
        $clients = clientModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('clients.clients_management',[
            'clients'=>$clients,
            'status'=>"none"
        ]);
    }

    /**
     *Use to Delete Client
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clientDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            $client = clientModel::findOrFail($id);

            clientModel::destroy(($client->id));

            return back()
                ->with('success', 'Client Delete successfully.');
        } catch (\Exception $e) {


            return back()
                ->with('error', 'Client not Deleted Please Try Again!!');
        }
    }

    /**
     *Use to show Edit Client Page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showEditClient($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try
        {
            $specialties = specialtyModel::all();


            $client = clientModel::findOrFail($id);

            return view('clients.edit_client',[
                'client'=>$client,
                'specialties'=>$specialties
            ]);

    } catch (\Exception $e)
        {
            return back()
            ->with('error', 'Client not Update Please Try Again!!');
            }
        }

    /**
     * Use to Edit Client
     * @param editClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editClient(editClientRequest $request)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            $client=clientModel::findOrFail($request->clientId);

            clientModel::where('id', '=', $client->id)->
            update([
                'company_name' => $request->company_name,
                'specialty_id' => $request->specialty,
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'email' => $request->email,
                'address' => $request->address,

                ]);

            return redirect('/clientManagement')
                ->with('success', 'Client Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Client Info. not Update Please Try Again!!');
        }

    }

    public function clientSpecialtyManagement()
    {
        
        $specialties= specialtyModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('clients.specialty_client_manage',[
            'specialties'=>$specialties,
            'status'=>"none"
        ]);
    }

    public function clientSpecialtyDelete($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            $specialty = specialtyModel::findOrFail($id);

            specialtyModel::destroy(($specialty->id));

            return back()
                ->with('success', 'Specialty Client Delete successfully.');
        } catch (\Exception $e) {


            return back()
                ->with('error', 'Specialty Client not Deleted Please Try Again!!');
        }
    }

    public function clientSpecialtyAddPage()
    {
        return view('clients.specialty_client_add');
    }

    public function clientSpecialtyAdd(addSpecialtyRequest $request)
    {
        try{
            specialtyModel::create([
                'title'=>$request->title,

            ]);

            return redirect('/clientSpecialtyManagement')
                ->with('success', 'Client Specialty Add successfully.');
        }
        catch (\Exception $e)
        {

            return back()
                ->with('error', 'Client Specialty not Add Please Try Again!!');
        }
    }

    public function clientSpecialtyEditPage($id)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try
        {
            $specialty = specialtyModel::findOrFail($id);

            return view('clients.specialty_client_edit',[
                'specialty'=>$specialty
            ]);

        } catch (\Exception $e)
        {
            return back()
                ->with('error', 'Client not Update Please Try Again!!');
        }
    }

    public function clientSpecialtyEdit(editSpecialtyRequest $request)
    {
        if(Auth::user()->roles()->first()->name == 'Accountant')
            {
                return redirect('/')
                ->with('error', 'You are not authorized to perform this operation.');
            }
            
        try {
            $specialty=specialtyModel::findOrFail($request->specialtyID);

            specialtyModel::where('id', '=', $specialty->id)->
            update([
                'title' => $request->title,

            ]);

            return redirect('/clientSpecialtyManagement')
                ->with('success', 'Specialty Client Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Specialty Client not Update Please Try Again!!');
        }

    }

    public function ClientMainSearch(mainSearchRequest $request)
    {

        $clients = clientModel::where('id','=',$request->search)->
        orwhere('company_name','LIKE',"%".$request->search."%")->
        orWhereHas('specialty',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orwhere('client_name','LIKE',"%".$request->search."%")->
        orwhere('client_phone','LIKE',"%".$request->search."%")->
        orwhere('address','LIKE',"%".$request->search."%")->
        orderBy('id', 'DESC')
            ->paginate(24);


        return view('clients.clients_management',[
            'clients'=> $clients,
            'status'=>'search Form',
        ]);
    }

    public function clientSpecialtyMainSearch(mainSearchRequest $request)
    {

        $specialties = specialtyModel::where('id','=',$request->search)->
        orwhere('title','LIKE',"%".$request->search."%")->
        orderBy('id', 'DESC')
            ->paginate(24);


        return view('clients.specialty_client_manage',[
            'specialties'=> $specialties,
            'status'=>'search Form',
        ]);
    }

   public function autoCompleteCompany(autoCompleteRequest $request)
    {
        $company = clientModel::where("company_name","LIKE","%{$request->input('query')}%")->
                            pluck('company_name')->
                            unique("company_name")->
                            take(8)->
                            toArray();


        return response()->json($company);
    }

    public function autoCompleteLocation(autoCompleteRequest $request)
    {
        $location = clientModel::where("address","LIKE","%{$request->input('query')}%")->
        pluck('address')->
        unique("address")->
        take(8)->
        toArray();


        return response()->json($location);
    }

}
