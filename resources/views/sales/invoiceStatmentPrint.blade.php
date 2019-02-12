<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice Statement</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom styling plus plugins -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>
  <style>
    html,body{
      height:297mm;
      width:210mm;
    }
  </style>
  <body onload="window.print(); history.go(-1);" >
    <div class="container body">
      <div >




        <!-- page content -->
        <div class="right_col" role="main">


            <div class="clearfix"></div>

            <div >
              <div class="col-md-12">
                <div style=" height:297mm;
      width:210mm;" >

                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div >

                          <div class="row ">
                            <div class="col-md-6 col-xs-6">
                             <h1 style="margin-top: 90px;"><i class="fa fa-globe"></i> Account Statement.</h1>
                            </div>
                            <div   class="col-md-6  col-xs-6 pull-right">
                              <img width="300px" height="200px" src="{!! asset('images/lamassu.png') !!}" />
                            </div>
                          </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">

                        <!-- /.col -->
                        <div  class="col-sm-4 invoice-col pull-right " style="margin-right: 70px;">
                          <b>Date : {{Carbon\Carbon::parse($invoices->date_issue)->format('d/m/Y')}}</b>
                          <br>
                          <b>Invoice # {{$invoices->id}}</b>
                          <br>
                          <b>Customer ID : </b> @if(isset($invoices->client->id)){{$invoices->client->id}} @else None @endif


                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col" style="margin-left: 20px">

                          <address>
                            <strong>Lamassu Advirtising Agency</strong>
                            <br> Baghdad – Al - Mansour
                            <br>Al – Mass Building
                            <br>www.lamassu-iq.com
                            <br>+964 7826212508
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col pull-right" style="margin-right: 100px;">
                          To:
                          <address>
                            Name :<strong>@if(isset($invoices->client->client_name)){{$invoices->client->client_name}} @else None @endif</strong>
                            <br>Company :@if(isset($invoices->client->company_name)){{$invoices->client->company_name}} @else None @endif
                            <br>Phone Number :@if(isset($invoices->client->client_phone)){{$invoices->client->client_phone}} @else None @endif
                            <br>Address :@if(isset($invoices->client->address)){{$invoices->client->address}} @else None @endif

                          </address>
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                      </div>
                      <!-- Table row -->
                      <hr>
                     
                      <div class="x_content">
                        <span><b>Invoice ID: </b>{{$invoices->id}}</span><br><br>
                        <span><b>Invoice Date: </b>{{Carbon\Carbon::parse($invoices->date_issue)->format('d/m/Y')}}</span><br><br>
                        <span><b>Invoice Type: </b>@if(isset($invoices->sales_type->title)){{$invoices->sales_type->title}} @else None @endif</span><br><br>
                        <span><b>Total Amount: </b>${{number_format( $invoices->total_amount, 3, ",", "," )}}</span><br><br>
                        <span><b>Paid Amount: </b>$ {{number_format( $invoices->paid_amount, 3, ",", "," )}}</span><br><br>
                        <span><b>Payment Method: </b>@if(isset($invoices->payment_method->title)){{$invoices->payment_method->title}}@else None @endif</span><br><br>
                        <span><b>Due Date: </b>{{Carbon\Carbon::parse($invoices->paid_date)->format('d/m/Y')}}</span><br><br>
                        <table class="table table-bordered">
                          <thead>
                              
                          <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Date</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($invoices->transaction as $key =>$invoice)

                            <tr>
                              <th scope="row">{{++$key}}</th>
                              <td>$ {{number_format( $invoice->amount, 3, ",", "," )}}</td>
                              <td>{{$invoice->note}}</td>
                              <td>{{Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y')}}</td>
 
                            </tr>
                          @endforeach

                          </tbody>
                        </table>

                      </div>
                      <!-- /.row -->


                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div  class="col-xs-12 ">
                          {{--<button  id="printPageButton" onClick="window.print();" class="btn btn-default " ><i class="fa fa-print"></i> Print</button>--}}

                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="../css/print.css"></script>
    <script>
//       window.print();


    </script>
  </body>
</html>
