@extends('layouts.default')
@section('title')
Printing Manage
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Printing Manage</h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/printingMainSearch')}}">
                            {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for ...">
                            <span class= "input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>

                    </span>

                        </div>
                        </form>

                    </div>
                    <span class="pull-right btn-add" style="margin-right: 10px; margin-top: 17px;"><a href="#" >Advance Search</a></span>

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Printing Manage Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/printingManage')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Printing show from the oldest to the latest </p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">id</th>
                                        <th class="column-title">printing Company</th>
                                        <th class="column-title">Amount</th>
                                        <th class="column-title">Location</th>
                                        <th class="column-title">Exchange Date</th>
                                        <th class="column-title">Note</th>




                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($printings as $printing)
                                    <tr class="even pointer">

                                        <td class=" ">{{$printing->id}}</td>
                                        <td class=" ">@if(isset($printing->printing_company->title)){{$printing->printing_company->title}} @else None @endif  </td>
                                        <td class=" ">{{number_format( $printing->amount, 3, ",", "," )}}</td>
                                        <td class=" ">@if(isset($printing->printing_company->printing_company_type->title)){{$printing->printing_company->printing_company_type->title}} @else None @endif</td>
                                        <td class=" ">{{Carbon\Carbon::parse($printing->exchange_date)->format('d/m/Y')}}</td>
                                        <td class=" ">{{$printing->note }}</td>
                                        <td >

                                            <a href="{{url('printingEdit/'.$printing->id)}}"><i title="Edit Printing" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a><i title="Delete Printing" data-file-id="{{$printing->id}}" class="fa fa-trash btn-delete"></i></a></td>
                                        </td>
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            <span style="margin-left: 900px"><b>Total : $    {{number_format( $sum, 3, ",", "," )}}</b></span>
                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$printings->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$printings->appends(request()->input())->links()}}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModalDelete" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete Printing</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Printing Record?</p>
                        <div style="margin-left: 70px">
                            <button type="button" class="btn btn-info btn-yes" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header ">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Advance Search</h4>
                        <div id ="form-errors"></div>
                    </div>
                    <div class="modal-body">
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('printingDateSearch')}}" class="form-horizontal" novalidate="">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date <span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" placeholder="" type="date" name="startDate" >

                                </div></div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date <span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12 " >
                                    <input class="form-control" placeholder="" type="date" name="endDate" >

                                </div></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Location<span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="location" name="location" class="form-control">
                                        <option></option>
                                        @foreach($locations as $location )
                                            <option value="{{$location->id}}">{{$location->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name<span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="company" name="company" class="form-control">

                                    </select>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right "  value="add">Search</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>


    </div>
    <!-- /page content -->
@section('js')
    <script>

        $(document).ready(function(){
            // var fileID;
            var url = "/printingDelete/";
            $('.btn-delete').click(function(){

                $('#myModalDelete').modal('show');
                url= url+ $(this).data('file-id')
            });


            $(".btn-yes").click(function (e) {

                window.location = url;
            });
        });
        $(document).ready(function(){

            var url = "file/message";
            $('.btn-add').click(function(){

                $this = $(this);
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });



        });

    </script>

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

                console.log(formData);

                $.ajax({

                    type: "post",
                    url: "/getCompany",
                    data: formData,
                    dataType    : 'json',
                    success: function (data) {



                        console.log(data);


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


                        console.log(data);

                    }
                });
            });



        });
    </script>
@endsection
@endsection