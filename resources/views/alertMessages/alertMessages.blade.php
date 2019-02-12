@if (count($errors) > 0)
    <div id="alert_message" class=" alert alert-danger ">
        <strong>Whoops!</strong> There were some problems .<br>

        @foreach ($errors->all() as $error)
            <span>*</span> {{ $error }}<br/>
        @endforeach

    </div>
@endif

@if ($message = \Session::get('success'))
    <div id="alert_message" class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div id="alert_message" class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif