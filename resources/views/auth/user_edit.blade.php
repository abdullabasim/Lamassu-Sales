@extends('layouts.default')
@section('title')
Edit User
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
                            <h2>Edit User</h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/userEdit/'.$user->id)}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>


                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/userEdit')}}" id="whereEntry" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <input type="hidden" name="userID" value="{{$user->id}}">


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Please Enter Full Name">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder="Please Enter Email Address">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile Picture</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="file" name="picture" class="form-control" value="{{$user->picture}}" >
                                    </div>

                                </div>
                                <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                                    <label for="permission" class="control-label col-md-3 col-sm-3 col-xs-12">Permission</label>

                                    <div   class="col-md-9 col-sm-9 col-xs-12">
                                        <select class="form-control input-height" name="permission">
                                            @foreach($roles as $role)
                                                @if($user->roles()->first()->name == $role->name )
                                                <option selected value="{{$role->id}}" >{{$role->name}} </option>
                                                @else
                                                    <option value="{{$role->id}}" >{{$role->name}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('permission'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <button type="submit" style="margin-left: 110px;" class="btn btn-primary">Edit User</button>
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