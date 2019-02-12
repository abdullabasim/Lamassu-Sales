@extends('layouts.default')
@section('title')
Debt Manage
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Debt Manage</h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/debtMainSearch')}}">
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
                            <h2>Debt Manage Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/debtManage')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Debt show from the oldest to the latest </p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">id</th>
                                        <th class="column-title">Creditor</th>
                                        <th class="column-title">Amount</th>
                                        <th class="column-title">Remaining</th>
                                        <th class="column-title">Note</th>
                                        <th class="column-title">Date</th>

                                        Deptremining
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($debts as $debt)
                                    <tr class="even pointer">

                                        <td class=" ">{{$debt->id}}</td>
                                        <td class=" ">@if(isset($debt->depts_name->title)){{$debt->depts_name->title}} @else None @endif</td>
                                        <td class=" ">{{number_format( $debt->amount, 3, ",", "," )}}</td>
                                        <td class=" ">{{number_format( $debt->remaining, 3, ",", "," )}}</td>
                                        <td class=" ">{{$debt->note}}</td>
                                        <td class=" ">{{Carbon\Carbon::parse($debt->date)->format('Y/m/d')}}</td>


                                        <td >
                                            <a href="{{url('debtEdit/'.$debt->id)}}"><i title="Edit Debt" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a style="margin-left: 5px;"><i title="Debt Delete" data-file-id="{{$debt->id}}" class="fa fa-trash btn-delete"></i></a>
                                            <a style="margin-left: 5px;"><i title="Debt Pay" data-id="{{$debt->id}}" @if(isset($debt->depts_name->title)) data-name="{{$debt->depts_name->title}}" @else None @endif  data-amount="{{$debt->remaining}}" class="fa fa-money btn-pay "></i></a>
                                            <a  href="{{url('debtPaidDetailsManage/'.$debt->id)}}" style="margin-left: 5px;" ><i title="Debt Pay Information" data-file-id="{{$debt->id}}" class="fa fa-table "></i></a>
                                        </td>
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            <span style="margin-left: 900px"><b>Total : $    {{number_format( $sum, 3, ",", "," )}}</b></span>
                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$debts->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$debts->appends(request()->input())->links()}}</div>
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
                        <h4 class="modal-title">Delete Debt</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Debt Record?</p>
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
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('debtDateSearch')}}" class="form-horizontal" novalidate="">
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
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Creditor<span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="debtName" name="debtName" class="form-control">
                                        <option></option>
                                        @foreach($debtNames as $debtName )
                                            <option value="{{$debtName->id}}">{{$debtName->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right "  value="add">Search</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>


        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header ">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pay Debt</h4>
                        <div id ="form-errors"></div>
                    </div>
                    <div class="modal-body">
                        <form id="frmTasks2" name="frmTasks2" method="post" action="{{url('/debtPay')}}" class="form-horizontal" novalidate="">
                            {{ csrf_field() }}
                            <input type="hidden" id="deptIDs" name="debtID" value="">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Creditor</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" id="creditors" value=""  type="text" name="creditor" readonly >

                                </div></div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Remaining</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" id="amounts"  type="text" name="amount" readonly >

                                </div></div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pay</label>
                                <div id="pay" class="col-md-9 col-sm-9 col-xs-12 " >

                                    <input class="form-control pay"   type="text" name="pay"  >

                                </div></div>



                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right "  value="add">Pay Dept</button>
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
        var amount ;
        $(document).ready(function(){
            // var fileID;
            var url = "/debtDelete/";
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

        $(document).ready(function(){


            $('.btn-pay').click(function(){

                $this = $(this);

                // alert($(this).data('id'));
                $('#frmTasks2').trigger("reset");
                $('#myModal2').modal('show');
                $('#creditors').val($(this).data('name'));
                $('#amounts').val($(this).data('amount'));
                $('#deptIDs').val($(this).data('id'));
                amount = $(this).data('amount');
            });

        });

        $('#pay').on("change",".pay", function(e){

            e.preventDefault();
            if (!isNaN( $('.pay').val()) && $('.pay').val() > 0  )

                $('#amounts').val(parseFloat($('#amounts').val()) -  parseFloat($('.pay').val()) );
            else
            {
                $('#pay').val(0);
                $('#amounts').val(amount);
                alert('Pay Value is incorrect');

            }

        });

    </script>

@endsection
@endsection
