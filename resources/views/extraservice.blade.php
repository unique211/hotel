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
                <li class="active">@lang('extraservicedata.extraservicemaster')</li>
            </ul>
            {{--  END BREADCRUMB  --}}
            {{-- PAGE CONTENT WRAPPER --}}
            <div class="page-content-wrap">
                {{--NEWS SECTION--}}
                <div class="row tablehideshow" style="display: none">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('extraservicedata.extraservicemaster')</h3>
                                <ul class="panel-controls">
                                    <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_master">
											<table id="usertb" class="table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th width="10%">@lang('extraservicedata.srno')</th>
															<th width="30%">@lang('extraservicedata.servicename')</th>
															<th width="10%">@lang('extraservicedata.unit')</th>
															<th width="10%">@lang('extraservicedata.rate')</th>
														    <th width="20%">@lang('extraservicedata.action')</th>
														</tr>
													</thead>
													<tbody id="tablebody">
													</tbody>
												</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END SIMPLE DATATABLE --}}
                    </div>
                </div>
                {{--NEWS SECTION END--}}
                {{-- strat notification --}}
                <div class="row formhideshow" style="display: none">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side" id="form1">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('extraservicedata.extraservicemaster')</h3>
                                <div class="pull-right">
                                    <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" id="master_form" name="master_form">
                                        <div class="row">

                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('extraservicedata.servicename')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="servicename" name="servicename" placeholder="@lang('extraservicedata.servicename')" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('extraservicedata.unit')
                                                        *</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" value="1" style="text-align:right;" class="form-control" min="0" id="unit" name="unit" placeholder="@lang('extraservicedata.unit')" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('extraservicedata.rate')<?php echo "(".$val=Session::get('savecurrency').")";?>*</label>
                                                </div>
                                                <div class="col-sm-3">
													<input type="number" value="0" min="0" style="text-align:right;" class="form-control" id="rate" name="rate" placeholder="@lang('extraservicedata.rate')" required>

                                                </div>

                                            </div>


                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
                                            <button class="btn btn-primary" id="btn_submit" type="submit">@lang('extraservicedata.savedata')</button>

                                            <button type="button" class="btn btn-info " id="reset">@lang('extraservicedata.reset')</button>
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
        var inserturl="{{route('service.store') }}";
        var displayurl="{{url('getservice')}}";
        var existservice="{{url('checkservice')}}";
        var doc_token="{{csrf_token()}}";

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
	<script src="{{ URL::asset('resources/js/myjs/extraservice.js') }}">
    </script>
</body>

</html>
