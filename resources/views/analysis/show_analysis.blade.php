@extends('layouts.default')
@section('title')
Analysis
@endsection
@section('content')
    <div class="right_col" role="main">
        @include('layouts.widget')
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Analysis <small>The Income and  Expenses </small></h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form >

                        <div class="input-group">
                            <input type="text" name="search" class="form-control" readonly placeholder="Search for...">
                            <span class= "input-group-btn">
                      <button class="btn btn-default" readonly="" >Go!</button>

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
                            <h2>Analysis Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/analysis')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')




                            <div class="table-responsive col-md-4 col-sm-4 col-xs-4 col-md-offset-1">
                                <p class="lead">Income</p>
                                <table class="table">
                                    <tbody>
                                    <tr>

                                        <th style="width:50%">Paid :</th>
                                        <td>$ {{number_format( $paid, 3, ",", "," )}}</td>
                                    </tr>
                                    <tr>
                                        <th>Remaining:</th>
                                        <td>$ {{number_format( $remaining, 3, ",", "," )}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total :</th>
                                        <td>$ {{number_format( $total, 3, ",", "," )}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive col-md-4 col-sm-4 col-xs-4 col-md-offset-1">
                                <p class="lead">Expenses</p>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th style="width:50%">Salaries :</th>
                                        <td>$ {{number_format( $salaries, 3, ",", "," )}}</td>
                                    </tr>
                                    <tr>
                                        <th>Expenses :</th>
                                        <td>$ {{number_format( $expenses, 3, ",", "," )}} </td>
                                    </tr>
                                    <tr>
                                        <th>Printing :</th>
                                        <td>$ {{number_format( $printing, 3, ",", "," )}}</td>
                                    </tr>
                                    <tr>
                                        <th>Promotions :</th>
                                        <td>$ {{number_format( $promotions, 3, ",", "," )}}</td>
                                    </tr>
                                    <tr>
                                        <th>Delivery :</th>
                                        <td>$ {{number_format( $delivery, 3, ",", "," )}}</td>
                                    </tr>
                                    <tr>
                                        <th>Debts :</th>
                                        <td>$ {{ number_format( $debts, 3, ",", "," )}}</td>
                                    </tr>

                                    <tr>
                                        <th><b>Total :</b></th>
                                        <td>$ {{number_format( $totalPaid, 3, ",", "," )}}</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>


                            <br>

                        </div>
                       <h3 style="margin-left: 120px;"> <b>Final Total :
                               @if(($paid - $totalPaid)<0)
                              <span style="color: red"> $ {{ number_format( $paid - $totalPaid, 3, ",", "," ) }}</span> <small>(Paid - Expenses)</small></b></h3>
                              @else
                                $ {{ number_format( $paid - $totalPaid, 3, ",", "," ) }}  <small>(Paid - Expenses)</small></b></h3>
                               @endif
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
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('analysisDateSearch')}}" class="form-horizontal" novalidate="">
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

@section('js')
    <script>
        var amount ;

        $(document).ready(function(){

            $('.btn-add').click(function(){


                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });



        });


    </script>


@endsection
@endsection