@extends('layouts.default')
@section('title')
Invoice Paid Details Manage
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Invoice Paid Details Manage</h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">



                    </div>

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">

                            <h2>Invoice Paid Details for : <b>@if(isset($invoice->client->company_name)){{$invoice->client->company_name}} @else None @endif</b> (@if(isset($invoice->client->client_name)){{$invoice->client->client_name}}) @else None) @endif  </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/invoiceDetailsPaid/'.$invoice->id)}}"  ><i class="fa fa-repeat"></i></a>
                                <li><a title="Print" href="{{url('/printStatementInvoice/'.$invoice->id)}}"  ><i class="fa fa-print"></i></a>


                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Invoice Paid Details show from the oldest to the latest </p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">id</th>
                                        <th class="column-title">Company Name</th>
                                        <th class="column-title">Amount</th>
                                        <th class="column-title">Note</th>
                                        <th class="column-title">Date</th>

                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($invoice->transaction as $invoices)
                                    <tr class="even pointer">

                                        <td class=" ">{{$invoices->id}}</td>
                                        <td class=" ">@if(isset($invoice->client->company_name)){{$invoice->client->company_name}} @else None @endif</td>
                                        <td class=" ">{{number_format( $invoices->amount, 3, ",", "," )}}</td>
                                        <td class=" ">{{$invoices->note}}</td>
                                        <td class=" ">{{Carbon\Carbon::parse($invoices->created_at)->format('d/m/Y')}}</td>
                                     
                                        <td >
                                            <a style="margin-left: 5px;"><i title="Invoice Paid Delete" data-file-id="{{$invoices->id}}" class="fa fa-trash btn-delete"></i></a>
                                        </td>
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            <span style="margin-left: 850px"><b>Total Paid : $    {{number_format( $sum,3, ",", "," )}}</b></span><br>
                            <span style="margin-left: 850px"><b>Remaining  : $    {{number_format( $invoice->remaining_amount, 3, ",", "," )}}</b></span><br>
                            <br>

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
                        <h4 class="modal-title">Delete Invoice Paid</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Invoice Paid Record?</p>
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

    </div>
    <!-- /page content -->
@section('js')
    <script>
        var amount ;
        $(document).ready(function(){
            // var fileID;
            var url = "/invoicePaidDelete/";
            $('.btn-delete').click(function(){

                $('#myModalDelete').modal('show');
                url= url+ $(this).data('file-id')
            });


            $(".btn-yes").click(function (e) {

                window.location = url;
            });
        });



    </script>

@endsection
@endsection