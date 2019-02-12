@extends('layouts.default')
@section('title')
Month Salary Manage
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Month Salary Manage </h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/monthSalaryMainSearch')}}">
                            {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for ...">
                            <span class= "input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>

                    </span>

                        </div>
                        </form>

                    </div>
                    <span class="pull-right btn-add" style="margin-right: 10px; margin-top: 17px;"><a href="#" >Advance Search</a></span>

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Month Salary Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/monthSalaryManage')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Month Salary show from the oldest to the latest </p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">id</th>
                                        <th class="column-title">Full Name</th>
                                        <th class="column-title">Department</th>
                                        <th class="column-title">Basic Salary</th>
                                        <th class="column-title">Bonas</th>
                                        <th class="column-title">Bonas Note</th>
                                        <th class="column-title">Subtract</th>
                                        <th class="column-title">Subtract Note</th>
                                        <th class="column-title">Total</th>
                                        <th class="column-title">Date</th>

                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($salaries as $salary)
                                    <tr class="even pointer">
                                        <td class=" ">{{$salary->id}}</td>
                                        <td class=" ">@if(isset($salary->employee->full_name)){{$salary->employee->full_name}} @else None @endif</td>
                                        <td class=" ">@if(isset($salary->employee->department->title)){{$salary->employee->department->title}} @else None @endif</td>
                                        <td class=" ">$ @if(isset($salary->employee->basic_salary)){{number_format( $salary->employee->basic_salary, 3, ",", "," )}} @else None @endif</td>
                                        <td class=" ">$ {{number_format( $salary->bonas, 3, ",", "," )}}</td>
                                        <td class=" " title="{{$salary->bonas_note}}"> {{ str_limit($salary->bonas_note,10)}}</td>
                                        <td class=" ">$ {{number_format( $salary->subtract, 3, ",", "," )}}</td>
                                        <td class=" " title="{{$salary->subtract_note}}"> {{ str_limit($salary->subtract_note,10)}}</td>
                                        <td class=" ">$ {{number_format( (($salary->employee->basic_salary - $salary->subtract ) + $salary->bonas), 3, ",", "," )}}</td>
                                        <td class=" ">{{$salary->created_at->format('d/m/Y')}}</td>
                                        <td >
                                            <a href="{{url('monthSalaryEdit/'.$salary->id)}}"><i title="Edit Payment Method" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a><i title="Delete File" data-file-id="{{$salary->id}}" class="fa fa-trash btn-delete"></i></a>
                                            <a  href="{{url('printMonthSalary/'.$salary->id)}}"  ><i title="Print Salary"  class="fa fa-print "></i></a>
                                        </td>

                                        </td>
                                    </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <span style="margin-left: 900px"><b>Total : $    {{number_format( $sum, 2, ",", "," )}}</b></span>
                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$salaries->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$salaries->appends(request()->input())->links()}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModalDelete" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Month Salary</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Month Salary?</p>
                        <div style="margin-left: 70px">
                            <button type="button" class="btn btn-info btn-yes" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header ">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Advance Search</h4>
                        <div id ="form-errors"></div>
                    </div>
                    <div class="modal-body">
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('monthSalaryDateSearch')}}" class="form-horizontal" novalidate="">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date <span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" placeholder="" type="date" name="startDate" >

                                </div></div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date <span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" placeholder="" type="date" name="endDate" >

                                </div></div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right "  value="add">Search</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>


    </div>
    <!-- /page content -->
@section('js')
    <script>

        $(document).ready(function(){
            // var fileID;
            var url = "/monthSalaryDelete/";
            $('.btn-delete').click(function(){

                $('#myModalDelete').modal('show');
                url= url+ $(this).data('file-id')
            });


            $(".btn-yes").click(function (e) {

                window.location = url;
            });
        });
        $(document).ready(function(){

            var url = "file/message";
            $('.btn-add').click(function(){

                $this = $(this);
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });



        });

    </script>

@endsection
@endsection