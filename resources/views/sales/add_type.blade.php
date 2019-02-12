@extends('layouts.default')
@section('title')
    Add Invoice Type
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main" >
    <!-- top tiles -->

    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div >


                <div class="col-md-6 col-md-offset-3  col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Create Invoice Type </h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/invoiceTypeAdd')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/invoiceTypeAdd')}}" id="whereEntry">

                                {{ csrf_field() }}

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required"> *</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" name="title" class="form-control" placeholder="Please Enter Invoice Type Title ">
                                        </div>

                                    </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" style="margin-left: 110px;" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
    <br />





</div>
<!-- /page content -->



@endsection