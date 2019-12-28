@include('layouts.header')
<?php
	$checkinid = '';
	$title1 = '';
if(isset($id)){
	$checkinid = $id;

}
?>

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
                <li class="active">@lang('vcheckout.visitorcheckout')</li>
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
                                <h3 class="panel-title">@lang('vcheckout.visitorcheckout')</h3>
                                <ul class="panel-controls">
                                    {{-- <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li> --}}
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive">
                                            <table id="visitercheckouttb" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th >@lang('vcheckout.srno')</th>
                                                            <th >@lang('vcheckout.vname')</th>
                                                            <th >@lang('vcheckout.vchechintime')</th>
                                                            <th >@lang('vcheckout.vcheckouttime') </th>
                                                            <th style="display:none;">Visitorid </th>
                                                            <th style="display:none;">Totalamout</th>
                                                            <th style="display:none;">mode</th>
                                                            <th style="display:none;">transactiondetal</th>
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
                                <h3 class="panel-title">@lang('vcheckout.visitorcheckout')</h3>
                                <div class="pull-right">
                                    {{-- <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button> --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" id="master_form" name="master_form">
                                        <div class="row">

                                            {{-- <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label>@lang('vcheckout.vsearchvisitor')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="searchvisitor" name="searchvisitor"
                                                    placeholder="@lang('vcheckout.vsearchvisitor')" >
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('vcheckout.vsearchvisitor')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="searchroom" name="searchroom"
                                                    placeholder="Room No">
                                                </div>
                                            </div> --}}
                                            <div class="form-group row ">
                                                <div class="table-responsive">

                                                        <table id="searchtb"
                                                            class="table table-striped table-bordered"
                                                            style="width:100%">
                                                            <thead>
                                                                {{-- <tr>
                                                                    <th width="20%">@lang('vcheckout.vname').</th>
                                                                    <th width="20%">@lang('vcheckout.vlastname').</th>
                                                                    <th width="20%">@lang('vcheckout.mobileno')</th>

                                                                </tr> --}}
                                                            </thead>
                                                            <tbody id="searchtbody">
                                                            </tbody>
                                                        </table>


                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label>@lang('vcheckout.vname')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="visitorname" name="visitorname"
                                                    placeholder="Visitor Name">
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('vcheckout.vchechintime')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class='input-group datetimepicker' id='datetimepicker2'>
                                                        <input type='text' class="form-control" style="width:100%"
                                                            id="checktime" name="checktime" required />
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('vcheckout.vcheckouttime')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class='input-group datetimepicker' id='datetimepicker2'>
                                                        <input type='text' class="form-control" style="width:100%"
                                                            id="checkouttime" name="checkouttime" required />
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">

                                                <h4><b>@lang('vcheckout.vroomdetalis')</b></h4>


                                            </div><br>

                                            <div class="form-group row " id="serachdiv">
                                                <div class="table-responsive" id="show_master1">

                                                </div>
                                            </div>
                                            <div class="form-group row " id="extraservicedata">
                                                <div class="table-responsive" id="show_master2">
                                                    <table id="servicedata" class="table table-striped">
                                                            <thead>
                                                                    <tr>
                                                                            <th style="white-space:nowrap;text-align:left;padding:10px 10px;">Date</th>
                                                                            <th style="white-space:nowrap;text-align:left;padding:10px 10px;">Service Name </th>
                                                                            <th style="white-space:nowrap;text-align:left;padding:10px 10px;">Rate</th>
                                                                            <th style="white-space:nowrap;text-align:left;padding:10px 10px;">qty</th>
                                                                            <th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>


                                                                    </tr>
                                                            </thead>
                                                            <tbody id="servicetb_tbody">

                                                            </tbody>

                                                    </table>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('vcheckout.totalamount')<?php echo "(".$val=Session::get('savecurrency').")";?></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" id="amount"
                                                            name="amount" placeholder="Amount" value="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div  class="form-group hidepayment">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('invoicedata.paymentmode')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select id="amtmode" name="amtmode" class="form-control mainformcon" style="width:100%">
                                                            <option selected disabled value="">Select</option>
                                                            <option value="Case">Case</option>
                                                            <option value="Card">Card</option>
                                                            <option value="Paytam">Paytam</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group hidepayment">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('vcheckout.transcationdetalis')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="transactiondetalis" name="transactiondetalis"
                                                        placeholder="@lang('vcheckout.transcationdetalis')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
                                            <input type="hidden" id="visiterid" name="visiterid" value="" />
                                            <input type="hidden" id="cheinidvisiterid" name="cheinidvisiterid" value="" />
                                            <input type="hidden" id="noofdays" name="numofdays" value="">
                                            <br>
                                            <button class="btn btn-primary" id="btn_submit" type="submit">@lang('vcheckout.savedata')</button>

                                            <button type="button" class="btn btn-info " id="reset">@lang('vcheckout.reset')</button>
                                        </div>
                                        <div class="btn-group pull-left">
                                        <button type="button" class="btn btn-info " id="close">@lang('vcheckout.close')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        {{--panel panel default--}}
                        {{-- END SIMPLE DATATABLE --}}
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

    var searchurl="{{ url('getvisitersearch') }}";
    var getvisiterinfo="{{ url('checkingetvisiterdata')}}";
    var token="{{csrf_token()}}";
    var roomwisearch="{{ url('roomwisesearch')}}";
    var getcheckvistertime="{{ url('getvisterchecktime')}}";
    var inserturl="{{ route('visitercheckout.store')}}";
    var checkouturl="{{url('visitercheckoutupdate') }}";
    var showcheckoutuser="{{ url('showallcheckoutuser')}}";
    var geteditvisitor="{{url('geteditallocateroom')}}";
     var getcheckinvisitor="{{url('getcheckinvisitor')}}";
      var checkinid="<?php echo $checkinid?>";
      var getcheckincustomerinfo="{{ url('vistorcheckininfo') }}";
      var updatestatus="{{ url('updatestatus') }}";
      var changet= "<?php echo $val=Session::get('savetime');?>";
      var getserviceinformation= "{{ url('getvisitorserviceinformation') }}";
      var roomwiseservice="{{ url('roomwiseservices') }}";
      var imgurl="<?php  echo url('/') ?>";
     
        </script>

    <script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/visitercheckout.js') }}">
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
