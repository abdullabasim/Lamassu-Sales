@if(Auth::user()->roles()->first()->name == 'Admin')
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-google-wallet"></i> Total Invoice</span>
            <div class="count"><h3><b>$ {{ number_format( Helper::total(), 2, ",", "," )}}</b></h3></div>
            <span class="count_bottom"><i ><b>$ {{ number_format( Helper::totalMonth(), 2, ",", "," )}} </b></i> This Month</span>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-arrow-circle-up"></i> Paid Invoice</span>
            <div class="count"><h3><b>$ {{number_format( Helper::paid(), 2, ",", "," )}}</b></h3></div>
            <span class="count_bottom"><i ><i ></i><b>$ {{number_format( Helper::paidMonth(), 2, ",", "," )}} </b> </i>  This Month</span>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-table"></i> Remaining Invoice</span>
            <div class="count"><h3><b>$ {{number_format( Helper::remaining(), 2, ",", "," )}}</b></h3></div>
            <span class="count_bottom"><i ><i ></i><b>$ {{number_format( Helper::remainingMonth(), 2, ",", "," )}} </b> </i>  This Month</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-arrow-circle-down"></i> Total Expenses</span>
            <div class="count"><h3><b>$ {{number_format( Helper::expenses(), 2, ",", "," )}}</b></h3></div>
            <span class="count_bottom"><i ><i ></i><b>$ {{number_format( Helper::expensesMonth(), 2, ",", "," )}} </b> </i>  This Month</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-plus-square"></i> Total Profit</span>
            @if((Helper::paid() - Helper::expenses()) >= 0 )
                <div class="count "><h3><b>$ {{number_format( Helper::paid() - Helper::expenses(), 2, ",", "," ) }}</b></h3></div>
            @else
                <div class="count red"><h3><b>$ {{number_format( Helper::paid() - Helper::expenses(), 2, ",", "," )}}</b></h3></div>
            @endif
            @if((Helper::paidMonth() - Helper::expensesMonth()) >= 0)
                <span class="count_bottom "><i ><i ></i><b>$ {{number_format( Helper::paidMonth() - Helper::expensesMonth(), 2, ",", "," )}} </b> </i>  This Month</span>
            @else
                <span class="count_bottom red"><i ><i ></i><b>$ {{number_format( Helper::paidMonth() - Helper::expensesMonth(), 2, ",", "," )}} </b> </i>  This Month</span>
            @endif

        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Last Update</span>

            <div class="count "><h4><b>{{ Carbon\Carbon::parse(Helper::lastUpdate())->format('d/m/Y g:ia')}}</b></h4></div>


        </div>
    </div>

@endif