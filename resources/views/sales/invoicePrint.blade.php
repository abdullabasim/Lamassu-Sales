<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoice</title>

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
                             <h1 style="margin-top: 90px;"><i class="fa fa-globe"></i> Invoice.</h1>
                            </div>
                            <div   class="col-md-6  col-xs-6 pull-right">
                              <img class="pull-right" style="margin-right: 50px;" width="200px" height="200px" src="{!! asset('images/lamassu.png') !!}" />
                            </div>
                          </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">

                        <!-- /.col -->
                        <div  class="col-sm-4 invoice-col pull-right " style="margin-right: 70px;">
                          <b>Date Issue : {{Carbon\Carbon::parse($invoice->date_issue)->format('d/m/Y')}}</b>
                          <br>
                          <b>Invoice # {{$invoice->id}}</b>
                          <br>
                          <b>Customer ID : </b> @if(isset($invoice->client->id)){{$invoice->client->id}} @else None @endif


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
                            Name :<strong>@if(isset($invoice->client->client_name)){{$invoice->client->client_name}} @else None @endif</strong>
                            <br>Company :@if(isset($invoice->client->company_name)){{$invoice->client->company_name}} @else None @endif
                            <br>Phone Number :@if(isset($invoice->client->client_phone)){{$invoice->client->client_phone}} @else None @endif
                            <br>Address :@if(isset($invoice->client->address)){{$invoice->client->address}} @else None @endif

                          </address>
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                      </div>
                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Qty</th>
                                <th>Item</th>
                                <th style="width: 59%">Description</th>
                                <th>Item Price</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach($invoice->item as $key => $items)
                              <tr>
                                <td>{{$items->quantity}}</td>
                                <td>{{$items->title}}</td>
                                <td>{{$items->description}}</td>
                                <td>$ {{number_format( $items->amount, 3, ",", "," )}}</td>
                                <td>$ {{number_format( $items->amount * $items->quantity, 3, ",", "," )}}</td>
                                
                              </tr>
                              @endforeach


                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          {{--<p class="lead">Payment Methods:</p>--}}
                         
                          {{--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">--}}
                            {{--Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                          {{--</p>--}}
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          {{--<p class="lead">Amount Due {{date('Y/m/d')}}</p>--}}
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Total :</th>
                                  <td>$ {{number_format( $invoice->total_amount, 3, ",", "," )}}</td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Discount :</th>
                                  <td>$ {{number_format( $invoice->discount, 3, ",", "," )}}</td>
                                </tr>
                                <tr>
                                  <th>Paid :</th>
                                  <td>$ {{number_format( $invoice->paid_amount, 3, ",", "," )}}</td>
                                </tr>
                                <tr>
                                  <th>Remaining:</th>
                                  <td>$ {{number_format( $invoice->remaining_amount, 3, ",", "," )}}</td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
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
