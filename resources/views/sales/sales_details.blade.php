@extends('layouts.default')
@section('title')
    Invoice Details
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3></h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


                <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><b>Company name: </b>@if(isset($invoices->client->company_name)){{$invoices->client->company_name}} @else None @endif <small><b>Client Name: </b>@if(isset($invoices->client->client_name)) {{$invoices->client->client_name}} @else None @endif</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a href="{{url('/invoiceShow/'.$invoices->id)}}"  ><i class="fa fa-repeat"></i></a>

                    <li><a title="Print" href="{{url('/printDetailsInvoice/'.$invoices->id)}}"  ><i class="fa fa-print"></i></a>
                        

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <span><b>Invoice ID: </b>{{$invoices->id}}</span><br><br>
                {{--<span><b>Invoice Date: </b>{{$invoices->created_at->format('d/m/Y')}}</span><br><br>--}}
                <span><b>Invoice Type: </b>@if(isset($invoices->sales_type->title)){{$invoices->sales_type->title}} @else None @endif</span><br><br>
                <span><b>Total Amount: </b>$ {{number_format( $invoices->total_amount, 3, ",", "," )}}</span><br><br>
                <span><b>Paid Amount: </b>$ {{number_format( $invoices->paid_amount, 3, ",", "," )}}</span><br><br>
                <span><b>Payment Method: </b>@if(isset($invoices->payment_method->title)){{$invoices->payment_method->title}}@else None @endif</span><br><br>
                <span><b>Remaining Amount: </b>$ {{number_format( $invoices->remaining_amount, 3, ",", "," )}}</span><br><br>
                <span><b>Discount: </b>$ {{number_format( $invoices->discount, 3, ",", "," )}}</span><br><br>
                <span><b>Due Date: </b>{{Carbon\Carbon::parse($invoices->paid_date)->format('d/m/Y')}}</span><br><br>
                <span><b>Date Issue: </b>{{Carbon\Carbon::parse($invoices->date_issue)->format('d/m/Y')}}</span><br><br>
                <span><b>Admin: </b>@if(isset($invoices->user->name)){{$invoices->user->name}}@else None @endif</span><br><br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices->item as $key =>$invoice)

                    <tr>
                        <th scope="row">{{++$key}}</th>
                        <td>{{$invoice->title}}</td>
                        <td>{{$invoice->description}}</td>
                        <td>$ {{number_format( $invoice->amount, 3, ",", "," )}}</td>
                        <td>{{$invoice->quantity}}</td>

                    </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

            </div>
        </div>
    </div>


@endsection