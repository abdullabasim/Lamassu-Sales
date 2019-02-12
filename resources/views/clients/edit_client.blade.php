@extends('layouts.default')
@section('title')
    Edit Clients
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
                            <h2>Edit Clients </h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/editClient')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/clientEdit')}}" id="whereEntry">

                                {{ csrf_field() }}
                                     <input type="hidden" name="clientId" value="{{$client->id}}">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required"> *</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" id="auto-complete" autocomplete="off" name="company_name" class="form-control" value="{{$client->company_name}}" placeholder="Please Enter Company Name">
                                        </div>

                                    </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Specialty<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select  name="specialty" class="form-control">
                                            <option></option>
                                            @foreach($specialties as $specialty )
                                                @if ($client->specialty->title == $specialty->title  )
                                                <option selected value="{{$specialty->id}}">{{$specialty->title}}</option>
                                                @else
                                                    <option value="{{$specialty->id}}">{{$specialty->title}}</option>
                                                 @endif

                                                    @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Name<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="client_name" class="form-control" value="{{$client->client_name}}" placeholder="Please Enter Client Name">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Address</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="email" value="{{$client->email}}" class="form-control" placeholder="Please Enter Email Address">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Phone<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="client_phone" class="form-control" value="{{$client->client_phone}}" placeholder="Please Enter Client Phone">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Address<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="auto-completes" autocomplete="off" name="address" class="form-control" value="{{$client->address}}" placeholder="Please Enter Address">
                                    </div>

                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" style="margin-left: 110px;" class="btn btn-primary">Edit Client</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

    <script>
        $(document).ready(function(){

            $('#auto-complete').typeahead({

                source: function(query, result)
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url:"/companyAutoComplete",
                        method:"post",
                        data:{query:query},
                        dataType:"json",
                        success:function(data)
                        {
                            result($.map(data, function(item){
                                return item;
                            }));
                        }
                    })
                }
            });

            $('#auto-completes').typeahead({

                source: function(query, result)
                {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url:"/autoCompleteLocation",
                        method:"post",
                        data:{query:query},
                        dataType:"json",
                        success:function(data)
                        {
                            result($.map(data, function(item){
                                return item;
                            }));
                        }
                    })
                }
            });

        });
    </script>
@endsection


@endsection