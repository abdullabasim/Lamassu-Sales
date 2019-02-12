@extends('layouts.default')
@section('title')
Applications Manage
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Applications Manage</h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/projectMainSearch')}}">
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
                            <h2>Applications  Manage Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/projectManage')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Applications  show from the oldest to the latest </p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">Id</th>
                                        <th class="column-title">Full Name</th>
                                        <th class="column-title">Company </th>
                                        <th class="column-title">Phone Number</th>
                                        <th class="column-title">Email Address</th>
                                        <th class="column-title">Application Name</th>
                                        <th class="column-title">Application Type</th>
                                        <th class="column-title">Price</th>
                                        <th class="column-title">Start Date</th>
                                        <th class="column-title">End Date</th>
                                        <th class="column-title">Note</th>


                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($projects as $project)
                                    <tr class="even pointer">

                                        <td class=" ">{{$project->id}}</td>
                                        <td class=" ">{{$project->full_name}}</td>
                                        <td class=" ">{{$project->company_name}}</td>
                                        <td class=" ">{{$project->phone_number}}</td>
                                        <td class=" ">{{$project->email}}</td>
                                        <td class=" ">{{$project->project_name}}</td>
                                        <td class=" ">@if(isset($project->projectType->title)){{$project->projectType->title}} @else None @endif</td>
                                        <td class=" ">${{number_format( $project->price, 3, ",", "," )}}</td>
                                        <td class=" ">{{$project->start_date}}</td>
                                        <td class=" ">{{$project->end_date}}</td>
                                        <td class=" ">@if(isset($project->note)){{$project->note}} @else None @endif</td>

                                        <td >
                                            <a href="{{url('projectEdit/'.$project->id)}}"><i title="Edit Project" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a><i title="Delete Project" data-file-id="{{$project->id}}" class="fa fa-trash btn-delete"></i></a></td>
                                        </td>
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            <span style="margin-left: 900px"><b>Total : $    {{number_format( $sum, 3, ",", "," )}}</b></span>
                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$projects->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$projects->appends(request()->input())->links()}}</div>
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
                        <h4 class="modal-title">Delete Application</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Application Record?</p>
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
                        <form id="frmTasks" name="frmTasks" method="get" action="{{url('projectDateSearch')}}" class="form-horizontal" novalidate="">
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Project Type<span class="required"> *</span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="location" name="project_type" class="form-control">
                                        <option></option>
                                        @foreach($projectTypes as $projectType )
                                            <option value="{{$projectType->id}}">{{$projectType->title}}</option>
                                        @endforeach
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
            var url = "/projectDelete/";
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

@endsection
@endsection