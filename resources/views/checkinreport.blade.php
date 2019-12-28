@include('layouts.header')

<body>



    {{-- START PAGE CONTAINER --}}
    <div class="page-container page-navigation-toggled page-container-wide">
        {{-- START PAGE SIDEBAR --}}


        @include('layouts.sidebar')

        {{-- END PAGE SIDEBAR --}}
        {{-- PAGE CONTENT --}}
        <div class="page-content">
            {{-- START X-NAVIGATION VERTICAL --}}

            @include('layouts.topbar')
            {{-- END X-NAVIGATION VERTICAL --}}
            {{-- START BREADCRUMB --}}
            <ul class="breadcrumb">
                <li class="active">Visitor CheckIn Report</li>
            </ul>
            {{--  END BREADCRUMB  --}}
            {{-- PAGE CONTENT WRAPPER --}}
            <div class="page-content-wrap">
                
                {{-- strat notification --}}
                <div class="row" >
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side" id="form1">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                                <div class="pull-right">
                                   {{-- <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button> --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" id="mainform" name="mainform">
                                        <div class="row">
                                            
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label>@lang('report.fromdate')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                        <div class='input-group datetimepicker' id='datetimepicker2'>
                                                                <input type='text' class="form-control" style="width:100%"
                                                                    id="fromdate" name="fromdate"  />
                                                                <div class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('report.todate')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                        <div class='input-group datetimepicker' id='datetimepicker2'>
                                                                <input type='text' class="form-control" style="width:100%"
                                                                    id="todate" name="todate"  />
                                                                <div class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </div>
                                                            </div>
                                                </div>
                                                <div class="col-sm-2">
                                                        <button class="btn btn-primary" id="btn_submit" type="submit">@lang('report.search')</button>
                                                    </div>
                                            </div>
                                           
                                           
                                        
                                        </div>
                                  
                                    </form>
                                </div>
                            </div>

                        </div>
                        {{--panel panel default--}}
                        {{-- END SIMPLE DATATABLE --}}
                    </div>
                    {{------------------------form1-end-------------------------------}}
                    {{--------------------------------------------------------------------------------------------------------------------------}}
                </div>
                {{-- end notification --}}
                {{--NEWS SECTION--}}
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 right_side">
                            {{-- START SIMPLE DATATABLE --}}
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"></h3>
                                    <ul class="panel-controls">
                                        {{-- <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                                Add Detail</button></li> --}}
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-12 ">
                                        <div class="table-responsive" id="show_master">
                                                <table id="checkintable" class="table table-striped table-bordered" style="width:100%">
                                                        <thead>
                                                                <tr>
                                                                        <th style="width:10%"  ></th>
                                                                        <th style="width:40%" id="f_date"></th>
                                                                      
                                                                        <th style="width:30%" id="t_date"></th>
                                                                        <th style="display:none;"></th>
                                                                        <th style="width:10%"  ></th>
                                                                       
                                                                    </tr>
                                                            <tr>
                                                                <th style="width:10%" >@lang('report.srno')</th>
                                                                <th style="width:40%">@lang('report.visitername')</th>
                                                              
                                                                <th style="width:30%">@lang('report.checkindate')</th>
                                                                <th style="width:30%">@lang('report.getfullinfo')</th>
                                                                <th style="display:none;">Visiter id</th>
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablebody">
                                                        </tbody>        		
                                                </table>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 ">
                                            <div class="table-responsive" id="show_master1">
                                            </div>
                                    </div>
                                </div>
                            </div>
                            {{-- END SIMPLE DATATABLE --}}
                        </div>
                    </div>
                    {{--NEWS SECTION END--}}
            </div>
            {{-- END PAGE CONTENT WRAPPER --}}
        </div>
        {{-- END PAGE CONTENT --}}
    </div>
    {{-- END PAGE CONTAINER --}}
    {{-- MESSAGE BOX--}}

    @include('layouts.message_box')
    {{-- END MESSAGE BOX--}}
    {{-- START SCRIPTS --}}

    @include('layouts.footer_scripts')

    {{-- END SCRIPTS --}}
    <script type="text/javascript">
        $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

    });

    </script>

<script language="JavaScript" type="text/javascript">

    var inserturl="{{ url('getcustomercheck')}}";
    var doc_token="{{csrf_token()}}";
    var getfullinformation="{{url('getvisitorfullinforamtion')}}";
    
    varuser="<?php echo $val=Session::get('userid');?>";
    
    </script>

    <script type="text/javascript">
        $('.clockpicker').clockpicker();
    </script>
    <script>
        $('.date').datepicker({
                       'todayHighlight': true,
                       format: 'dd/mm/yyyy',
                       autoclose: true,
                  });
                  var date = new Date();
                  date = date.toString('DD/MM/YYYY');
                  $(".date").val(date);
                  //  $("#fdate").val(date);
	</script>
	
	
		
	
	
</body>

</html>
<script src="{{ URL::asset('resources/js/myjs/checkinreport.js') }}">
</script>
