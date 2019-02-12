@extends('layouts.default')
@section('title')
Department Manage
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Department Manage</h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/departmentSearch')}}">
                            {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for ...">
                            <span class= "input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>

                    </span>

                        </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">


                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Department Manage Table </h2>

                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/departmentManage')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Departments show from the oldest to the latest </p>


                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title">id</th>
                                        <th class="column-title">Title</th>


                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($departments as $department)
                                    <tr class="even pointer">

                                        <td class=" ">{{$department->id}}</td>
                                        <td class=" ">{{$department->title}}</td>
                                        <td >
                                            <a href="{{url('departmentEdit/'.$department->id)}}"><i title="Edit Department" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a><i title="Delete Department" data-file-id="{{$department->id}}" class="fa fa-trash btn-delete"></i></a></td>
                                        </td>
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$departments->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$departments->appends(request()->input())->links()}}</div>
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
                        <h4 class="modal-title">Delete Department</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Department ?</p>
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


    </div>
    <!-- /page content -->
@section('js')
    <script>

        $(document).ready(function(){
            // var fileID;
            var url = "/departmentDelete/";
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