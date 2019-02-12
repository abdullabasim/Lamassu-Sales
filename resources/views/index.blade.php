@extends('layouts.default')
@section('title')
    Index
@endsection
@section('content')
    <div class="right_col" role="main">
        @include('layouts.widget')
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Invoice <small>Least Invoice </small></h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/search/main')}}">
                            {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
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
                 @if($user == 'auth')
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Invoice Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Invoice show from the latest to the oldest</p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">Invoice id</th>
                                        <th class="column-title">Invoice Type</th>
                                        <th class="column-title">Company Name</th>
                                        <th class="column-title">Client Name </th>
                                        <th class="column-title">Phone Number</th>
                                        <th class="column-title">Total Amount </th>
                                        <th class="column-title">Paid Amount </th>
                                        <th class="column-title">Remaining Amount </th>
                                        <th class="column-title">Due Date </th>
                                        <th class="column-title">Date Issue </th>

                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($invoices as $invoice)
                                    <tr class="even pointer">

                                        <td class=" "><a href="{{url('invoiceShow/'.$invoice->id)}}">{{$invoice->id}}</a></td>
                                        <td class=" "><a href="{{url('invoiceShow/'.$invoice->id)}}">@if(isset($invoice->sales_type->title)){{$invoice->sales_type->title}} @else None @endif</a></td>
                                        <td class=" "><a href="{{url('invoiceShow/'.$invoice->id)}}">@if(isset($invoice->client->company_name)){{$invoice->client->company_name}} @else None @endif </a></td>
                                        <td class=" "><a href="{{url('invoiceShow/'.$invoice->id)}}">@if(isset($invoice->client->client_name)){{$invoice->client->client_name}} @else None @endif</a></td>
                                        <td class=" "><a href="{{url('invoiceShow/'.$invoice->id)}}">@if(isset($invoice->client->client_phone)){{$invoice->client->client_phone}} @else None @endif</a></td>
                                        <td class=" " style="text-align:center;"><a href="{{url('invoiceShow/'.$invoice->id)}}">${{number_format( $invoice->total_amount, 3, ",", "," )}}</a></td>
                                        <td class=" " style="text-align:center;"><a href="{{url('invoiceShow/'.$invoice->id)}}">${{number_format( $invoice->paid_amount, 3, ",", "," ) }}</a></td>
                                        <td class=" " id="remining" style="text-align:center;"><a href="{{url('invoiceShow/'.$invoice->id)}}">${{number_format( $invoice->remaining_amount, 3, ",", "," ) }}</a></td>
                                        @if(isset($invoice->paid_date))
                                        <td class=" "><a href="{{url('invoiceShow/'.$invoice->id)}}">{{Carbon\Carbon::parse($invoice->paid_date)->format('d/m/Y')}}</a></td>
                                        @else
                                            <td class=" ">---------------</td>
                                        @endif
                                        <td class=" "> @if(isset($invoice->date_issue)){{Carbon\Carbon::parse($invoice->date_issue)->format('d/m/Y')}} @else None @endif</td>
                                        <td >
                                            @if(\Auth::user()->roles()->first()->name != 'Accountant')
                                            <a href="{{url('invoiceEdit/'.$invoice->id)}}" style="margin-left: 1px;"><i title="Edit Invoice" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a><i title="Delete Invoice" data-file-id="{{$invoice->id}}" style="margin-left: 1px;" class="fa fa-trash btn-delete"></i></a>
                                            @endif
                                            @if($invoice->remaining_amount >0)
                                            <a style="margin-left: 1px;"><i title="Invoice Pay" data-id="{{$invoice->id}}" @if(isset($invoice->client->company_name))data-name="{{$invoice->client->company_name}}" @else None @endif   data-amount="{{$invoice->remaining_amount}}" class="fa fa-money btn-pay "></i></a>
                                             @else
                                                <a style="margin-left: 1px;"><i title="Invoice Pay"  class="fa fa-money "></i></a>

                                            @endif
                                            <a  href="{{url('invoiceDetailsPaid/'.$invoice->id)}}" style="margin-left: 1px;" ><i title="Invoice Pay Information" data-file-id="{{$invoice->id}}" class="fa fa-table "></i></a>
                                            <a  href="{{url('printInvoice/'.$invoice->id)}}"  ><i title="Print Invoice"  class="fa fa-print "></i></a>


                                        </td>
                                        </td>
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            @if(Auth::user()->roles()->first()->name == 'Admin')
                            <div class="pull-right">
                            <span ><b>Total : $    {{number_format( $total, 3, ",", "," )}}</b></span><br>
                            <span ><b>Paid  : $     {{number_format( $paid, 3, ",", "," )}}</b></span><br>
                            <span ><b>Remaining : $ {{ number_format( $remaining, 3, ",", "," )}}</b></span><br>
                            </div>
                            @endif
                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$invoices->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$invoices->appends(request()->input())->links()}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="modal fade" id="myModalDelete" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Invoice</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Invoice?</p>
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
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('search/dateSearch')}}" class="form-horizontal" novalidate="">
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id ="company" name="company" class="form-control ">
                                            <option></option>
                                            @foreach($company as $compan )
                                                <option>{{$compan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Name</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="client" name="client" class="form-control ">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Type</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="sales_type" class="form-control ">
                                            <option></option>
                                            @foreach($salesType as $salesTypes )
                                                <option value="{{$salesTypes->id}}">{{$salesTypes->title}}</option>
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
                        <form id="frmTasks2" name="frmTasks2" method="post" action="{{url('/invoicePay')}}" class="form-horizontal" novalidate="">
                            {{ csrf_field() }}
                            <input type="hidden" id="invoiceIDs" name="invoiceIDs" value="">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" id="companies" value=""  type="text" name="companies" readonly >

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

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" id="note"  placeholder="Enter Your Note" value="None" type="text" name="note"  >

                                </div></div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right "  value="add">Pay Remaining Invoice</button>
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
            var url = "/invoiceDelete/";
            $('.btn-delete').click(function(){

                $('#myModalDelete').modal('show');
                url= url+ $(this).data('file-id')
            });


            $(".btn-yes").click(function (e) {

                window.location = url;
            });
        });

        $(document).ready(function(){

            $('.btn-add').click(function(){

                $this = $(this);
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });



        });

        $(document).ready(function(){


            $('.btn-pay').click(function(){


                // alert($(this).data('id'));
                $('#frmTasks2').trigger("reset");
                $('#myModal2').modal('show');
                $('#companies').val($(this).data('name'));
                $('#amounts').val($(this).data('amount'));
                $('#invoiceIDs').val($(this).data('id'));
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

    <script>
        $(document).ready(function(){


            $("#company").change(function (e) {

                var element = $(this);
                var selection = this.value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = {
                    company:selection ,

                }

                console.log(formData);

                $.ajax({

                    type: "post",
                    url: "/getClient",
                    data: formData,
                    dataType    : 'json',
                    success: function (data) {



                        console.log(data);
                        document.getElementById('client').options.length = 0;
                        var select = document.getElementById("client");


                        var el = document.createElement("option");
                        el.textContent = "";
                        el.value = "";
                        select.appendChild(el);

                        for(var i = 0; i < data.length; i++) {
                            var opt = data[i];
                            var el = document.createElement("option");
                            el.textContent = opt;
                            el.value = opt;
                            select.appendChild(el);
                        }
                    },
                    error: function (data) {


                        console.log(data);

                    }
                });
            });



        });
    </script>




@endsection
@endsection