@extends('layouts.default')
@section('title')
Edit Password
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main" >
    <!-- top tiles -->
    @include('layouts.widget')
    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div >


                <div class="col-md-8 col-md-offset-2  col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit Password</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/passwordEdit')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/passwordEdit')}}" id="whereEntry" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <input type="hidden" name="passwordID" value="{{$password->id}}">


                                <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Old Password<span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="password" name="oldPassword" class="form-control" value="" placeholder="Please Enter Old Password">

                                        @if ($errors->has('oldPassword'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password<span class="required">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password<span class="required">*</span></label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>



                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" style="margin-left: 110px;" class="btn btn-primary">Edit Password</button>
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
