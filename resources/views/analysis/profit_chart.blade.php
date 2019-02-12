@extends('layouts.default')
@section('title')
Profit Chart
@endsection

@section('content')
    <div class="right_col" role="main">
        @include('layouts.widget')
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Analysis <small>Chart </small></h3>

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
                    <span class="pull-right btn-add" style="margin-right: 10px; margin-top: 17px;"><a href="#" >Specific Year</a></span>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Profit Chart(Paid)</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/profitChart')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">


                            <div style="width: 100%;height:500px;font-size	: 11px;"  id="chartdiv"></div>


                        </div>



                    </div>

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Remaining Chart</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                {{--<li><a href="{{url('/profitChart')}}"  ><i class="fa fa-repeat"></i></a>--}}

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">


                            <div style="width: 100%;height:500px;font-size	: 11px;"  id="chartdiv2"></div>


                        </div>



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
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('profitChartDate')}}" class="form-horizontal" novalidate="">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date <span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" placeholder="" type="date" name="startDate" >

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


    <script src="../js/amcharts.js"></script>
    <script src="../js/serial.js"></script>
    <script src="../js/export.min.js"></script>
    <link rel="stylesheet" href="../js/export.css" type="text/css" media="all" />
    <script src="../js/light.js"></script>
  <script>

      $(document).ready(function(){

          $('.btn-add').click(function(){


              $('#frmTasks').trigger("reset");
              $('#myModal').modal('show');
          });



      });
  </script>


    <script type="text/javascript">
        var data ='{!! json_encode($data) !!}';
        data = JSON.parse(data);

        var remaining ='{!! json_encode($remaining) !!}';
        remaining = JSON.parse(remaining);

        var chart = AmCharts.makeChart( "chartdiv", {
            "type": "serial",
            "theme": "light",
            "dataProvider": data,
            "valueAxes": [ {
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            } ],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [ {
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            } ],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            },


        } );

        var charts = AmCharts.makeChart( "chartdiv2", {
            "type": "serial",
            "theme": "light",
            "dataProvider": remaining,
            "valueAxes": [ {
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            } ],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [ {
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "visits"
            } ],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            },


        } );
    </script>


@endsection
@endsection