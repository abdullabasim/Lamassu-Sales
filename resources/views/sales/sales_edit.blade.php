@extends('layouts.default')
@section('title')
    Edit Invoice
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main" >
    <!-- top tiles -->

    <!-- /top tiles -->

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div >


                <div class="col-md-10 col-md-offset-1  col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit Invoice </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/invoiceEdit/'.$invoice->id)}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            @include('alertMessages.alertMessages')
                            <br />
                            <form class="form-horizontal form-label-left" method="post" action="{{url('/invoiceEdit')}}" >

                                {{ csrf_field() }}
                                <input type="hidden" name="invoiceId" value="{{$invoice->id}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id ="company" name="company" class="form-control select2">
                                            <option></option>
                                            @foreach($company as $compan )
                                                @if($invoice->client->company_name == $compan)

                                            <option selected>{{$compan}}</option>
                                                @else
                                                    <option>{{$compan}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Name <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select id="client" name="client" class="form-control select2">

                                            <option >{{$invoice->client->client_name}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sales Type <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="sales_type" class="form-control select2">
                                            <option></option>
                                            @foreach($salesType as $salesTypes )
                                                 @if($invoice->sales_type->title == $salesTypes->title)
                                                <option value="{{$salesTypes->id}}" selected >{{$salesTypes->title}}</option>
                                                @else
                                                    <option value="{{$salesTypes->id}}" >{{$salesTypes->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id = "app">
                                <div id="item" >

                                    @foreach($invoice->item as $key => $items)
                                        <div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Item <span class="required"> *</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-10">
                                        <input type="text" name="title[]" class="form-control" value="{{$items->title}}"  placeholder="Enter Item Title">
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <input type="text"    name="qty[]" value="{{$items->quantity}}"  class="form-control qty" placeholder="Quantity" value="1">
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                        @if($key != 0)
                                        <span id="minus"  style="margin-top: 7px;" class="glyphicon glyphicon-minus"></span>
                                         @else
                                            <span id="plus"  style="margin-top: 7px;" class="glyphicon glyphicon-plus"></span>
                                            @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description
                                        <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <textarea class="form-control" name="desc[]" value="{{$items->description}}"  rows="3"  placeholder='Please Enter Description '>{{$items->description}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text"  name="amount[]" value="{{$items->amount}}"  class="form-control amount income_count" placeholder="Please Enter Item Amount ">
                                    </div>


                                </div>
                                    <br><br>
                                        </div>
                                        @endforeach


                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Discount <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div id="discount">
                                        <input type="text" id="discounts" name="discount" class="form-control discount " value="{{$invoice->discount}}"   placeholder="Enter Discount Amount ">
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount <span class="required"> *</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">

                                            <input type="text" id="income_sum" name="totalAmount" value="{{$invoice->total_amount}}" class="form-control"  readonly   placeholder="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Paid Amount <span class="required"> *</span></label>
                                        <div id="paidAmount" class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text"   name="paidAmount" class="form-control paidAmounts" value="{{$invoice->paid_amount}}" placeholder="Please Enter Paid Amount ">
                                        </div>

                                    </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Remaining Amount <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="text" id="remainingAmount" readonly name="remainingAmount" value="{{$invoice->remaining_amount}}" class="form-control remainingAmounts" placeholder="Remaining Amount ">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 " >
                                        <input id="paidDate" class="form-control" placeholder="" value="{{$invoice->paid_date}}" type="date" name="paidDate" >

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Issue <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12 " >
                                        <input id="paidDate" class="form-control" placeholder="" value="{{$invoice->date_issue}}" type="date" name="dateIssue" >

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Method <span class="required"> *</span></label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <select name="payment_method" class="form-control select2">
                                            <option></option>
                                            @foreach($paymentMethods as $paymentMethod )
                                                @if($invoice->payment_id == $paymentMethod->id )
                                                <option selected value="{{$paymentMethod->id}}">{{$paymentMethod->title}}</option>
                                                @else
                                                <option  value="{{$paymentMethod->id}}">{{$paymentMethod->title}}</option>
                                                @endif

                                                    @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 ">

                                        <button style="margin-left: 200px" type="submit" class="btn btn-success">Edit Invoice</button>
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
        var max_fields      = 10;
        var counter      = 1;
        var items = $("#item");
        var plus = $("#plus");
        var summands = items.find('.income_count')

        var sumDisplay = $('#income_sum');

        $(plus).click(function(e){
            e.preventDefault();
            if(counter < max_fields){

                counter++;
//                var qty = "qty" + counter;
            items.append(' <div> <div class="form-group">\n' +
                '                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Item '+counter+' <span class="required"> *</span></label>\n' +
                '                                    <div class="col-md-6 col-sm-6 col-xs-10">\n' +
                '                                        <input type="text" name="title[]" class="form-control" placeholder="Enter Item Title">\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-2 col-sm-2 col-xs-2">\n' +
                '                                        <input type="text"     name="qty[]"  class="form-control qty " placeholder="Quantity" value="1">\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-1 col-sm-1 col-xs-1">\n' +
                '                                        <span id="minus"  style="margin-top: 7px;" class="glyphicon glyphicon-minus"></span>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="form-group">\n' +
                '                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description '+counter+'\n' +
                '                                    <span class="required"> *</span></label>\n' +
                '                                    <div class="col-md-9 col-sm-9 col-xs-12">\n' +
                '                                        <textarea class="form-control" name="desc[]"  rows="3" placeholder=\'Please Enter Description \'>None</textarea>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="form-group">\n' +
                '                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount '+counter+' <span class="required"> *</span></label>\n' +
                '                                    <div class="col-md-9 col-sm-9 col-xs-12">\n' +
                '                                        <input type="text"  name="amount[]"  class="form-control amount income_count" placeholder="Please Enter Item Amount ">\n' +
                '                                    </div>\n' +
                '\n' +
                '\n' +
                '                              </div>  </div><br>');

            }

        });

        $(items).on("click","#minus", function(e){ //user click on remove text

            e.preventDefault();

            $(this).parent().parent().parent('div').remove();

            var sum = 0;
            var values = $('.amount').map(function() { return( this.value); }).get();
            var qty = $('.qty').map(function() { return( this.value); }).get();

            var count = 0;
            for(var i =0 ;i< values.length;i++)
            {

                var value = Number(parseFloat(values[i])) * Number(qty[count++]) ;

                if (!isNaN(value))
                    sum += value  ;

            }

            if (!isNaN( $('#discounts').val()))

                sumDisplay.val(parseFloat(sum) -  parseFloat($('#discounts').val()) );
            else
            {
                sumDisplay.val(0);
                alert('Discount Value is incorrect');

            }
        });

        $(items).on("change",".amount", function(e){ //user click on remove text

            e.preventDefault();

           var sum = 0;
           var values = $('.amount').map(function() { return( this.value); }).get();
           var qty = $('.qty').map(function() { return( this.value); }).get();

           var count = 0;
           for(var i =0 ;i< values.length;i++)
           {

               // alert();
                var value = Number(parseFloat(values[i])) * Number(qty[count++]) ;

                if (!isNaN(value))
                    sum += value  ;

           }
           if (!isNaN( $('#discounts').val()))

            sumDisplay.val(parseFloat(sum) -  parseFloat($('#discounts').val()) );
           else
           {
               sumDisplay.val(0);
               alert('Discount Value is incorrect');

           }



        });

        $(items).on("change",".qty", function(e){ //user click on remove text

            e.preventDefault();

            var sum = 0;
            var values = $('.amount').map(function() { return( this.value); }).get();
            var qty = $('.qty').map(function() { return( this.value); }).get();

            var count = 0;
            for(var i =0 ;i< values.length;i++)
            {

                // alert();
                var value = Number(parseFloat(values[i])) * Number( qty[count++]) ;

                if (!isNaN(value))
                    sum += value  ;

            }

            if (!isNaN( $('#discounts').val()))

                sumDisplay.val(parseFloat(sum) -  parseFloat($('#discounts').val()) );
            else
            {
                sumDisplay.val(0);
                alert('Discount Value is incorrect');

            }



        });

        $('#discount').on("change",".discount", function(e){ //user click on remove text


            e.preventDefault();

            var sum = 0;
            var values = $('.amount').map(function() { return( this.value); }).get();
            var qty = $('.qty').map(function() { return( this.value); }).get();

            var count = 0;
            for(var i =0 ;i< values.length;i++)
            {

                // alert();
                var value = Number(parseFloat(values[i])) * Number( qty[count++]) ;

                if (!isNaN(value))
                    sum += value  ;

            }

            if (!isNaN( $('#discounts').val()))

                sumDisplay.val(parseFloat(sum) -  parseFloat($('#discounts').val()) );
            else
            {
                sumDisplay.val(0);
                alert('Discount Value is incorrect');

            }



        });

        $('#paidAmount').on("change",".paidAmounts", function(e){ //user click on remove text

            e.preventDefault();
            $('#remainingAmount').val(parseFloat( sumDisplay.val() - $('.paidAmounts').val()) );

            if($('#remainingAmount').val() == 0 )
            {
                $('#paidDate').prop('readonly', true);
                $('#paidDate').val("");
            }
             else
                $('#paidDate').prop('readonly', false);


        });

    </script>

    <script>
        $(document).ready(function(){


            $("#company").change(function (e) {

                var element = $(this);
                var selection = this.value;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                e.preventDefault();
                var formData = {
                    company:selection ,

                }

                console.log(formData);

                $.ajax({

                    type: "post",
                    url: "/getClient",
                    data: formData,
                    dataType    : 'json',
                    success: function (data) {



                        console.log(data);
                        document.getElementById('client').options.length = 0;
                        var select = document.getElementById("client");

                        for(var i = 0; i < data.length; i++) {
                            var opt = data[i];
                            var el = document.createElement("option");
                            el.textContent = opt;
                            el.value = opt;
                            select.appendChild(el);
                        }
                    },
                    error: function (data) {


                        console.log(data);

                    }
                });
            });



        });
    </script>
    @endsection


@endsection