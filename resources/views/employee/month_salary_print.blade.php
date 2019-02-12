<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Month Salary Print</title>

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
                             <h1 style="margin-top: 90px;"><i class="fa fa-globe"></i>Salary Statement.</h1>
                            </div>
                            <div   class="col-md-6  col-xs-6 pull-right">
                              <img width="300px" height="200px" src="{!! asset('images/lamassu.png') !!}" />
                            </div>
                          </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">

                       
                      
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
                     
                      </div>
                      <!-- Table row -->
                      <hr>
                      <div class="x_content">
                        <span><b>Employee ID: </b>{{$employee->employee->id}}</span><br><br>
                        <span><b>Employee Name: </b>{{$employee->employee->full_name}}</span><br><br>
                        <span><b>Employee Department: </b>{{$employee->employee->department->title}}</span><br><br>
                        <span><b>Date: </b>{{$employee->created_at->format('d/m/Y')}}</span><br><br>

                        <table class="table table-bordered">
                          <thead>
                          <tr>

                            <th>Basic Salary</th>
                            <th>Bonas</th>
                            <th>Bonas Note</th>
                            <th>Subtract</th>
                            <th>Subtract Note</th>
                            <th>Total</th>
                          </tr>
                          </thead>
                          <tbody>

                            <tr>


                              <td class=" ">$ @if(isset($employee->employee->basic_salary)){{$employee->employee->basic_salary}} @else None @endif</td>
                              <td class=" ">$ {{number_format( $employee->bonas, 3, ",", "," )}}</td>
                              <td class=" "> {{ $employee->bonas_note}}</td>
                              <td class=" ">$ {{number_format( $employee->subtract, 3, ",", "," )}}</td>
                              <td class=" "> {{ $employee->subtract_note}}</td>
                              <td class=" ">$ {{number_format( ($employee->employee->basic_salary - $employee->subtract ) + $employee->bonas, 3, ",", "," )}}</td>

                            </tr>


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