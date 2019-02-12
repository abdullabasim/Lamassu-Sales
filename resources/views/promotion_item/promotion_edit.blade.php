@extends('layouts.default')
@section('title')
Edit Promotion Item
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main" >
    <!-- top tiles -->

    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div >


                <div class="col-md-8 col-md-offset-2  col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit Promotion Item</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/promotionItemEdit/'.$promotion->id)}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/promotionItemEdit')}}" id="whereEntry">

                                {{ csrf_field() }}



                                <input type="hidden" name="promotionID" value="{{$promotion->id}}">



                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Location<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="location" name="location" class="form-control select2">
                                            <option></option>
                                            @foreach($deliveryType as $deliveryTypes )
                                                @if($promotion->promotion_item_company->title == $deliveryTypes->title )
                                                    <option selected value="{{$deliveryTypes->id}}">{{$deliveryTypes->title}}</option>
                                                @else
                                                    <option value="{{$deliveryTypes->id}}">{{$deliveryTypes->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>













                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Note<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea  class="form-control" rows="5" name="note">{{$promotion->note}}</textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="amount" class="form-control" value="{{$promotion->amount}}" placeholder="Please Enter Amount">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Exchange Date <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 " >
                                        <input  class="form-control"   value="{{Carbon\Carbon::parse($promotion->exchange_date)->format('Y-m-d')}}" type="date" name="date" >

                                    </div>

                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" style="margin-left: 110px;" class="btn btn-primary">Edit Promotion Item</button>
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