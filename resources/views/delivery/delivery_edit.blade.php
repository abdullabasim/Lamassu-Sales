@extends('layouts.default')
@section('title')
Edit Delivery
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
                            <h2>Edit Delivery</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/deliveryEdit/'.$delivery->id)}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/deliveryEdit')}}" id="whereEntry">

                                {{ csrf_field() }}

                                <input type="hidden" name="deliveryID" value="{{$delivery->id}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Location<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="location" name="location" class="form-control select2">
                                            <option></option>
                                            @foreach($deliveryType as $deliveryTypes )
                                                   @if($delivery->delivery_type->title == $deliveryTypes->title )
                                                <option selected value="{{$deliveryTypes->id}}">{{$deliveryTypes->title}}</option>
                                                @else
                                                <option value="{{$deliveryTypes->id}}">{{$deliveryTypes->title}}</option>
                                                 @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="amount" class="form-control" value="{{$delivery->amount}}" placeholder="Please Enter Amount">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Exchange Date<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 " >
                                        <input  class="form-control"   value="{{Carbon\Carbon::parse($delivery->delivery_date)->format('Y-m-d')}}" type="date" name="date" >

                                    </div>

                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Note
                                        <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea class="form-control" name="note"  rows="3" placeholder='Please Enter Note '>{{$delivery->note}}</textarea>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" style="margin-left: 110px;" class="btn btn-primary">Edit Delivery</button>
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

@section('js')


    <script>
        $(document).ready(function(){


            $("#location").change(function (e) {

                var element = $(this);
                var selection = this.value;


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = {
                    location:selection ,

                }



                $.ajax({

                    type: "post",
                    url: "/getCompany",
                    data: formData,
                    dataType    : 'json',
                    success: function (data) {






                        document.getElementById('company').options.length = 0;
                        var select = document.getElementById("company");


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




                    }
                });
            });



        });
    </script>
@endsection

@endsection