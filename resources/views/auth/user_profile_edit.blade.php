@extends('layouts.default')
@section('title')
Edit Profile Picture
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


                <div class="col-md-10 col-md-offset-1  col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit Profile Picture</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/userPictureEdit')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        @include('alertMessages.alertMessages')

                        <div class=" col-md-4 col-md-offset-1">
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/userPictureEdit')}}" id="whereEntry" enctype="multipart/form-data">

                                {{ csrf_field() }}



                                <div class="form-group">
                                    <label class="control-label col-md-5 col-sm-5 col-xs-12">Select Picture<span class="required"> *</span></label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="file" name="poster" class="filestyle" data-buttonText="Select  Image">
                                    </div>

                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit"  class="btn btn-primary">Edit Profile Picture</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class=" col-md-4 col-md-offset-1">
                            <img style="border-radius: 50%;border-style: solid;border-width: 1px; border-color: #178ab4" width="200px" height="200px" class="img-circle" src="{!! asset('files/'.\Auth::user()->picture) !!}">

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