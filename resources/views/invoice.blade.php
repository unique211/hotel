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
                <li class="active">@lang('invoicedata.invoice')</li>
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
                                <h3 class="panel-title">@lang('invoicedata.invoice')</h3>
                                <ul class="panel-controls">
                                    <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_master">
                                        <table id="invoicetb" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width:15%">@lang('invoicedata.srno').</th>
                                                    <th style="width:15%">@lang('invoicedata.linvoiceno')</th>
                                                    <th style="width:15%">@lang('invoicedata.linvoicedate')</th>
                                                    <!--  <th style="width:15%">Check Out Room No </th>-->
                                                    <th style="width:25%">@lang('invoicedata.lvisitorname')</th>
                                                    <th style="display:none;">Visiter Id</th>
                                                    <th style="display:none;">Check Room Id</th>
                                                    <th style="display:none;">Paid Amount</th>
                                                    <th style="display:none;">Payment Mode</th>
                                                    <th style="display:none;">Remark</th>
                                                    <th style="width:15%">@lang('invoicedata.action')</th>
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
                                <h3 class="panel-title">@lang('invoicedata.invoice')</h3>
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
                                                <div class="col-sm-2">
                                                    <label>@lang('invoicedata.linvoiceno')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" id="invoiceno"
                                                        name="invoiceno" placeholder="Invoice No" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('invoicedata.linvoicedate')</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class='input-group datetimepicker' id='datetimepicker2'>
                                                        <input type='text' class="form-control" style="width:100%"
                                                            id="date" name="date" required />
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('invoicedata.lvisitorname')*</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select class="form-control input-sm select2 placeholdesize"
                                                        id="vistername" name="vistername">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-2">
                                                        <input type="checkbox" id="checkdata" name="chechdata" value="1">@lang('invoicedata.lroomwiseinvoice')
                                                    </div>
                                                    <div class="col-sm-2 roominfo">
                                                        <label>@lang('invoicedata.selectroom')</label>
                                                    </div>
                                                    <div class="col-sm-2 roominfo">
                                                        <select class="form-control input-sm select2 placeholdesize"
                                                                 id="roomno" name="roomno"></select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                            




                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">

                                                <h4><b>@lang('invoicedata.roomdetalis')</b></h4>


                                            </div><br>

                                            <div class="form-group row " id="serachdiv">
                                                <div class="table-responsive" id="show_master1">

                                                </div>
                                            </div>

                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;"
                                                id="extraservicedata">

                                                <h4><b>@lang('invoicedata.extraservicedetalis')</b></h4>


                                            </div><br>

                                            <div class="form-group row">
                                                <div class="table-responsive" id="show_master2">

                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">
                                                            @lang('invoicedata.totalamount')<?php echo "(".$val=Session::get('savecurrency').")";?></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" id="totalamt"
                                                            name="totalamt" style="text-align:right;" placeholder="@lang('invoicedata.totalamount')" >

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('invoicedata.paidamount')<?php echo "(".$val=Session::get('savecurrency').")";?>
                                                            </label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" id="paidamt"
                                                            name="paidamt" style="text-align:right;" placeholder="@lang('invoicedata.paidamount')" value="0">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('invoicedata.paymentmode')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                            <select id="amtmode" name="amtmode" class="form-control" style="width:100%">
                                                                    <option selected disabled value="" >Select</option>
                                                                    <option value="Cash">Cash</option>
                                                                        <option value="Card">Card</option>
                                                                        <option value="Paytam">Paytam</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('invoicedata.remark')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <textarea   class="form-control" id="remark" name="remark" placeholder="@lang('invoicedata.remark')"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
                                            <input type="hidden" id="visiterid" name="visiterid" value="" />
                                            <input type="hidden" id="noofdays" name="numofdays" value="">
                                            <br>
                                            <button class="btn btn-primary" id="btn_submit" type="submit">@lang('invoicedata.savedata')</button>

                                            <button type="button" class="btn btn-info " id="reset">@lang('invoicedata.reset')</button>
                                            {{-- <button type="button" class="btn btn-info " id="print"></button> --}}
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
            var inserturl="{{ route('invoice.store') }}";
var searchroom="{{url('searchroom')}}";
var getdropdown="{{url('dropdowndata')}}";
var doc_token="{{csrf_token()}}";
var invoice_detalis="{{route('invoicedetalis.store')}}";
var getallinvoice="{{url('getallinvoice')}}";
var updateurl="{{ route('invoice.update') }}";
var invoicegeteditdata="{{url('geteditsearch')}}";
var getvisitorbookedroom="{{url('getvisitorbookedroomdata')}}";
var getroomwiseserviceinfo="{{ url('getroomwiseservices')}}";
var geteditvisitor="{{ url('geteditvisitor') }}";
var geteditserviceinfo="{{ url('geteditserviceinfodata') }}";
var getallocateroominfo="{{ url('getvisallocateroom') }}";
var getroomwiseinvoice="{{ url('roomwiseinvoice') }}";
var getroomservice="{{ url('roomservicedetalis') }}";
var geteditroomnno="{{ url('editroomnoinfo') }}";
var checkinvoiceno="{{ url('checkinvoicenoexists') }}";
var checkeditinvoiceno="{{ url('checkeditinvoicenoexists') }}";
var changet= "<?php echo $val=Session::get('savetime');?>";

var user="<?php echo$val=Session::get('userid');?>";

        
        </script>

        <script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/invoice.js') }}">
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