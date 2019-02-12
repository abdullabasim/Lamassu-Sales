<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model2\Project_Type as projectTypeModel;
use App\Model2\Application_Manage as applicationManageModel;
use App\Http\Requests\ProjectsManagment\AddProjectType as addProjectTypeRequest;
use App\Http\Requests\ProjectsManagment\EditProjectType as editProjectTypeRequest;
use App\Http\Requests\ProjectsManagment\AddProject as addProjectRequest;
use App\Http\Requests\ProjectsManagment\EditProject as editProjectRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use Carbon\Carbon;

class ProjectManagment extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function projectManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $projectTypes = projectTypeModel::all();



        $projects = applicationManageModel::orderBy('id', 'DESC')->
        paginate(24);

        $sum =$projects->sum(function ($projects) {
            return $projects->price;
        });
        return view('application.project_manage', [
            'projects' => $projects,
            'projectTypes'=>$projectTypes,
            'status' => "none",
            'sum'=> $sum,


        ]);

    }

    /**
     * use to show project add page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $projectTypes = projectTypeModel::all();

        return view('application.project_add', [
            'projectTypes'=>$projectTypes
        ]);
    }

    /**
     * use to add project
     * @param addProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectAdd(addProjectRequest $request)
    {
        try {

            applicationManageModel::create([
                'full_name' => $request->name,
                'company_name' => $request->company,
                'phone_number' => $request->phone,
                'project_name' => $request->project,
                'project_type_id' => $request->projectType,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'email' => $request->email,
                'note'=> $request->note,
                'price'=> $request->price,
            ]);

            return  back()
                ->with('success', 'Project Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Project not Add Please Try Again!!');
        }
    }

    /**
     * use to delete project
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $type = applicationManageModel::findOrFail($id);

            applicationManageModel::destroy(($type->id));

            return back()
                ->with('success', 'Project  Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Project  not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show edit project page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function projectEditPage($id)
    {
        try {


            \Auth::user()->authorizeRoles(['Admin']);

            $projectTypes = projectTypeModel::all();

            $project = applicationManageModel::findOrFail($id);

            return view('application.project_edit', [
                'projectTypes' => $projectTypes,
                'project' => $project
            ]);
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Project not Found Please Try Again!!');
        }
    }

    /**
     * use to project edit
     * @param editProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectEdit(editProjectRequest $request)
    {

        \Auth::user()->authorizeRoles(['Admin']);
        try {

            applicationManageModel::where('id',$request->projectID)->
            update([
                'full_name' => $request->name,
                'company_name' => $request->company,
                'phone_number' => $request->phone,
                'project_name' => $request->project,
                'project_type_id' => $request->projectType,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'email' => $request->email,
                'note'=> $request->note,
                'price'=> $request->price,
            ]);

            return redirect('/projectManage')
                ->with('success', 'Prject Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Project not Edit Please Try Again!!');
        }
    }

    /**
     * use to search base on all feild
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $projects = applicationManageModel::where('full_name', 'LIKE', "%" . $request->search . "%")->
        orwhere('company_name', 'LIKE', "%" . $request->search . "%")->
        orwhere('phone_number', 'LIKE', "%" . $request->search . "%")->
        orwhere('project_name', 'LIKE', "%" . $request->search . "%")->
        orwhere('start_date', 'LIKE', "%" . $request->search . "%")->
        orwhere('end_date', 'LIKE', "%" . $request->search . "%")->
        orwhere('price', 'LIKE', "%" . $request->search . "%")->
        orwhere('note', 'LIKE', "%" . $request->search . "%")->
        orwhere('email', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->
        orWhereHas('projectType',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $sum =$projects->sum(function ($projects) {
            return $projects->price;
        });

        $projectTypes = applicationManageModel::orderBy('id', 'DESC')->
        get();

        return view('application.project_manage', [
            'projects' => $projects,
            'projectTypes'=>$projectTypes,
            'status' => "search Form",
            'sum'=>$sum,
        ]);

    }

    /**
     * use to search base on date and project type
     * @param dateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        if(is_null($request->project_type))
        {
            $projects =applicationManageModel::whereBetween('start_date', array($request->startDate,$endDate))->
            orderBy('id', 'DESC')
                ->paginate(24);
        }
        else
        {
            $projects =applicationManageModel::whereBetween('start_date', array($request->startDate,$endDate))->
            WhereHas('projectType',function ( $query )use ( $request ){
                $query->where('id','LIKE', "%".$request->location."%" );
            })->
            orderBy('id', 'DESC')
                ->paginate(24);
        }


        $sum =$projects->sum(function ($projects) {
            return $projects->price;
        });

        $projectTypes = projectTypeModel::orderBy('id', 'DESC')->
        get();

        return view('application.project_manage', [
            'projects' => $projects,
            'projectTypes'=>$projectTypes,
            'status' => "search Form",
            'sum'=>$sum,
        ]);
    }

    /**
     * use to show project type page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectTypeAddPage()
    {
        return view('application.project_type');
    }

    /**
     * use to add project type
     * @param addProjectTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectTypeAdd(addProjectTypeRequest $request)
    {
        try{
            $projectType= projectTypeModel::create([
                'title'=>$request->title
            ]);


            return redirect('projectTypeManage')
                ->with('success', 'Application Add successfully.');
        }
        catch (\Exception $e) {


            return redirect('projectTypeManage')
                ->with('error', 'Application not Add Please Try Again!!');
        }

    }

    /**
     * use to manage project type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectTypeManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $projects = projectTypeModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('application.project_type_manage', [
            'projects' => $projects,
            'status' => "none",
        ]);
    }

    /**
     * use to delete project type
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectTypeDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $type = projectTypeModel::findOrFail($id);

            projectTypeModel::destroy(($type->id));

            return back()
                ->with('success', 'Project Type Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Project Type not Deleted Please Try Again!!');
        }
    }

    /**
     * use to show edit project type page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectTypeEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $project = projectTypeModel::findOrFail($id);

        return view('application.project_type_edit', [
            'project'=>$project,
        ]);
    }

    /**
     * use to edit project type
     *
     * @param editProjectTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectTypeEdit(editProjectTypeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {

            projectTypeModel::where('id',$request->projectID)->
            update([
                'title' => $request->title,

            ]);

            return redirect('/projectTypeManage')
                ->with('success', 'Project Type  Edit successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Project Type not Edit Please Try Again!!');
        }
    }

    public function projectTypeMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $projects = projectTypeModel::where('title', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=',  $request->search)->

        orderBy('id', 'DESC')
            ->paginate(24);

        return view('application.project_type_manage', [
            'projects' => $projects,
            'status' => "search Form",
        ]);


    }


}
