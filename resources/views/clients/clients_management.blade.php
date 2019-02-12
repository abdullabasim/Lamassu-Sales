@extends('layouts.default')
@section('title')
    Clients Management
@endsection
@section('content')
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Clients <small>Least Clients </small></h3>

                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                        <form method="get" action="{{url('/clientSearch')}}">
                            {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search for...">
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
                            <h2>Clients Table </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a href="{{url('/clientManagement')}}"  ><i class="fa fa-repeat"></i></a>

                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            @include('alertMessages.alertMessages')
                            <p>Clients show from the latest to the oldest</p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title"> #Id</th>
                                        <th class="column-title">Company Name</th>
                                        <th class="column-title">Specialty</th>
                                        <th class="column-title">Client Name </th>
                                        <th class="column-title">Client Phone</th>
                                        <th class="column-title">Email Address</th>
                                        <th class="column-title">Address</th>
                                        @if(Auth::user()->roles()->first()->name != 'Accountant')
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                        @endif
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($clients as $client)
                                    <tr class="even pointer">

                                        <td class=" ">{{$client->id}}</td>
                                        <td class=" ">{{$client->company_name}}</td>
                                        <td class=" ">@if(isset($client->specialty->title)) {{$client->specialty->title}} @else None @endif</td>
                                        <td class=" ">{{$client->client_name}}</td>
                                        <td class=" ">{{$client->client_phone}}</td>
                                        <td class=" ">{{$client->email}}</td>
                                        <td class=" ">{{$client->address}}</td>
                                        @if(Auth::user()->roles()->first()->name != 'Accountant')
                                        <td >
                                            <a href="{{url('clientEdit/'.$client->id)}}"><i title="Edit CLient" style="margin-left: 10px;"  class="fa fa-pencil-square-o btn-color"></i></a>
                                            <a><i title="Delete Client" data-file-id="{{$client->id}}" class="fa fa-trash btn-delete"></i></a></td>
                                        </td>
                                        @endif
                                    </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <br>
                            @if($status != "search Form")
                                <div style="margin-left: 10px"> {{$clients->links()}}</div>
                            @else
                                <div style="margin-left: 10px"> {{$clients->appends(request()->input())->links()}}</div>
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
                        <h4 class="modal-title">Delete Client</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you Sure you want to delete this Client?</p>
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
            var url = "/clientDelete/";
            $('.btn-delete').click(function(){

                $('#myModalDelete').modal('show');
                url= url+ $(this).data('file-id')
            });


            $(".btn-yes").click(function (e) {

                window.location = url;
            });
        });

    </script>

@endsection
@endsection