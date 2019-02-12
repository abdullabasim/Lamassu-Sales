
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="right_col" role="main" >
        <!-- top tiles -->
        <br>
        <br>
        <br>
        <br>
        <!-- /top tiles -->

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div >


                    <div class="col-md-6 col-md-offset-3  col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Login</h2>




                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <br />
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

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
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                                        <label for="profile-picture" class="col-md-4 control-label">Profile Picture</label>

                                        <div class="col-md-6">
                                            <input id="profile-picture" type="file" class="form-control input-height"  value="" name="picture" />

                                            @if ($errors->has('picture'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('picture') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                                        <label for="permission" class="col-md-4 control-label">Permission</label>

                                        <div   class="col-md-6">
                                            <select class="form-control input-height" name="permission">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" >{{$role->name}} </option>
                                            @endforeach
                                            </select>
                                            @if ($errors->has('permission'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>






                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <br>

                        </div>
                    </div>



                </div>
            </div>

        </div>
        <br />





    </div>
</div>
</body>
</html>
