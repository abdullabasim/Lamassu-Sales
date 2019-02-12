<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Employee as employeeModel;
use App\Model\Department as departmentModel;
use App\Model\Month_Salary as monthSalaryModel;
use App\Http\Requests\Employee\AddEmployee as addEmployeeRequest;
use App\Http\Requests\Employee\EditEmployee as editEmployeeRequest;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Employee\AddSalary as addSalaryRequest;
use App\Http\Requests\Employee\EditSalary as editSalaryRequest;
use App\Http\Requests\Employee\DateSearch as dateSearchRequest;
use App\Http\Requests\Employee\AddDepartment as addDepartmentRequest;
use App\Http\Requests\Employee\EditDepartment as editDepartmentRequest;


use Carbon\Carbon;

class Employee extends Controller
{

    public function __construct()
    {
       // \Auth::user()->authorizeRoles(['Admin']);

        $this->middleware('auth');
    }

    /**
     * use for Employee manage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $employees = employeeModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('employee.employees_manage', [
            'employees' => $employees,
            'status' => "none"
        ]);
    }

    /**
     * used for Employee Delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function employeeDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        try {
            $employee = employeeModel::findOrFail($id);

            employeeModel::destroy(($employee->id));

            return back()
                ->with('success', 'Employee Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Employee not Deleted Please Try Again!!');
        }
    }

    /**
     * use for Show Employee Add Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $departments = departmentModel::orderBy('id', 'DESC')->get();

        return view('employee.employee_add', [
            'departments' => $departments
        ]);
    }

    /**
     * use for Employee Add
     * @param addEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function employeeAdd(addEmployeeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        try {
            $employee = employeeModel::create([
                'full_name' => $request->fullName,
                'basic_salary' => $request->basicSalary,
                'department_id' => $request->department,
                'start_date' => $request->startDate

            ]);

            return redirect('/employeeManage')
                ->with('success', 'Employee Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Employee not Add Please Try Again!!');
        }
    }

    /**
     * Used for show Employee Edit Page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function employeeEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        try {
            $employee = employeeModel::findOrFail($id);

            $departments = departmentModel::orderBy('id', 'DESC')->get();

            return view('employee.employee_edit', [
                'employee' => $employee,
                'departments' => $departments
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Employee Info. not Update Please Try Again!!');
        }
    }

    /**
     * used for Employee edit
     * @param editEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function employeeEdit(editEmployeeRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        try {
            $employee=employeeModel::findOrFail($request->employeeID);

            employeeModel::where('id', '=', $employee->id)->
            update([

                'full_name' => $request->fullName,
                'basic_salary' => $request->basicSalary,
                'department_id' => $request->department,
                'start_date' => $request->startDate
            ]);

            return redirect('/employeeManage')
                ->with('success', 'Employee Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Employee Info. not Update Please Try Again!!');
        }
    }

    /**
     * Used for Employee Main Search
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $employees = employeeModel::where('full_name', 'LIKE', "%" . $request->search . "%")->
                                orwhere('basic_salary', 'LIKE', "%" . $request->search . "%")->
                                orwhere('start_date', 'LIKE', "%" . $request->search . "%")->
                                orwhere('id', '=', $request->search)->
                                orWhereHas('department',function ( $query )use ( $request ){
                                    $query->where('title','LIKE', "%".$request->search."%" );
                                })->
                                orderBy('id', 'DESC')
                                    ->paginate(24);

        //dd($types);
        return view('employee.employees_manage', [
            'employees' => $employees,
            'status' => 'search Form',

        ]);

    }

    /**
     * Used for month Salary Manage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function monthSalaryManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $salaries = monthSalaryModel::orderBy('id', 'DESC')->
        paginate(24);

        $sum =$salaries->sum(function ($salary) {
            return ($salary->employee->basic_salary + $salary->bonas ) - $salary->subtract;
        });

        return view('employee.month_salary_manage', [
            'salaries' => $salaries,
            'status' => "none",
            'sum'=>$sum
        ]);

    }

    /**
     * use for month Salary Delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function monthSalaryDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $salary = monthSalaryModel::findOrFail($id);

            monthSalaryModel::destroy(($salary->id));

            return back()
                ->with('success', 'Month Salary Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Month Salary Deleted Please Try Again!!');
        }
    }

    /**
     * use for show month Salary Add Page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function monthSalaryAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $fullNames = employeeModel::orderBy('id', 'DESC')->get();

        return view('employee.month_salary_add', [
            'fullNames' => $fullNames
        ]);
    }

    /**
     * use for month Salary Add
     * @param addSalaryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function monthSalaryAdd(addSalaryRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
             monthSalaryModel::create([
                'bonas' => $request->bonas,
                'subtract' => $request->subtract,
                'employee_id' => $request->fullName,
                'salary_date' => $request->salaryDate,
                'bonas_note'=>$request->bonas_note,
                'subtract_note'=>$request->subtract_note,

            ]);

            return redirect('/monthSalaryManage')
                ->with('success', 'Salary Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Salary not Add Please Try Again!!');
        }
    }

    /**
     * use for show month Salary Edit Page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function monthSalaryEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $salary = monthSalaryModel::findOrFail($id);

            $fullNames = employeeModel::orderBy('id', 'DESC')->get();

            return view('employee.month_salary_edit', [
                'salary' => $salary,
                'fullNames' => $fullNames
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Employee Info. not Update Please Try Again!!');
        }
    }

    /**
     * use for month Salary Edit
     * @param editSalaryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function monthSalaryEdit(editSalaryRequest $request)
    {
     //  \Auth::user()->authorizeRoles(['Admin']);
      
        try {
            $salary=monthSalaryModel::findOrFail($request->salaryID);

            monthSalaryModel::where('id', '=', $salary->id)->
            update([

                'bonas' => $request->bonas,
                'subtract' => $request->subtract,
                'employee_id' => $request->fullName,
                'salary_date' => $request->salaryDate,
                'bonas_note' => $request->bonas_note,
                'subtract_note' => $request->subtract_note,
            ]);

            return redirect('/monthSalaryManage')
                ->with('success', 'Month Salary Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Month Salary Info. not Update Please Try Again!!');
        }
    }

    /**
     * use for search in month Salary base on id,Full name,Department and Salary date
     *
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function monthSalaryMainSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $salaries = monthSalaryModel::where('bonas', 'LIKE', "%" . $request->search . "%")->
        orwhere('subtract', 'LIKE', "%" . $request->search . "%")->
        orwhere('salary_date', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=', $request->search)->
        orWhereHas('employee',function ( $query )use ( $request ){
            $query->where('full_name','LIKE', "%".$request->search."%" );
        })->
        orWhereHas('employee.department',function ( $query )use ( $request ){
            $query->where('title','LIKE', "%".$request->search."%" );
        })->
        orderBy('id', 'DESC')
            ->paginate(24);

        $sum =$salaries->sum(function ($salary) {
            return ($salary->employee->basic_salary + $salary->bonas ) - $salary->subtract;
        });

        return view('employee.month_salary_manage', [
            'salaries' => $salaries,
            'status' => 'search Form',
            'sum'=>$sum

        ]);

    }

    /**
     * Use search between 2 date
     *
     * @param dateSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function monthSalaryDateSearch(dateSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $endDate = Carbon::parse($request->endDate)->addHour(23)->addMinute(59);

        $salaries =monthSalaryModel::whereBetween('created_at', array($request->startDate,$endDate))->
        orderBy('id', 'DESC')
            ->paginate(24);

        $sum =$salaries->sum(function ($salary) {
            return ($salary->employee->basic_salary + $salary->bonas ) - $salary->subtract;
        });

        return view('employee.month_salary_manage', [
            'salaries' => $salaries,
            'status'=>'search Form',
            'sum'=>$sum
        ]);
    }

    /**
     * use to manage department
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function departmentManage()
    {
        $departments = departmentModel::orderBy('id', 'DESC')
                       ->paginate(24);

        return view('employee.department_manage', [
            'departments' => $departments,
            'status' => "none"
        ]);
    }

    /**
     *  use to delete department
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function departmentDelete($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $department = departmentModel::findOrFail($id);

            departmentModel::destroy(($department->id));

            return back()
                ->with('success', 'Department Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Department Deleted Please Try Again!!');
        }
    }

    /**
     * use to show department page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function departmentAddPage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        return view('employee.department_add');
    }

    /**
     * Use to add department
     * @param addDepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function departmentAdd(addDepartmentRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            departmentModel::create([
                'title' => $request->title,


            ]);

            return redirect('/departmentManage')
                ->with('success', 'department Add successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'Department not Add Please Try Again!!');
        }
    }

    /**
     * use to edit department
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function departmentEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $department = departmentModel::findOrFail($id);

            return view('employee.department_edit', [
                'department' => $department,

            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Department Info. not Update Please Try Again!!');
        }
    }

    /**
     * use to edit department
     * @param editDepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function departmentEdit(editDepartmentRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        try {
            $department=departmentModel::findOrFail($request->departmentID);

            departmentModel::where('id', '=', $department->id)->
            update([

                'title'=>$request->title,
            ]);

            return redirect('/departmentManage')
                ->with('success', 'Department Info. Update Successfully.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Department Info. not Update Please Try Again!!');
        }
    }

    /**
     * use to search in department
     * @param mainSearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function departmentSearch(mainSearchRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        $departments = departmentModel::where('title', 'LIKE', "%" . $request->search . "%")->
        orwhere('id', '=', $request->search)->

        orderBy('id', 'DESC')
            ->paginate(24);


        return view('employee.department_manage', [
            'departments' => $departments,
            'status' => 'search Form',


        ]);

    }

    public function printMonthSalary($id)
    {
        $employee = monthSalaryModel::findOrFail($id);


        return view('employee.month_salary_print',[
            'employee'=>$employee
        ]);
    }

}
