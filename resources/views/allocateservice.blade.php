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
                <li class="active">@lang('allocateservicedata.allocateservice')</li>
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
                                <h3 class="panel-title">@lang('allocateservicedata.allocateservice')</h3>
                                <ul class="panel-controls">
                                    <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_master">
                                            <table id="allocatesevicetb" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:40%;">@lang('allocateservicedata.srno')</th>
                                                            <th style="display:none;">Room Id.</th>
                                                            <th style="width:40%;">@lang('allocateservicedata.roomno')</th>
                                                            <th style="width:20%;">@lang('allocateservicedata.action')</th>
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
                                <h3 class="panel-title">@lang('allocateservicedata.allocateservice')</h3>
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
                                                    <label>@lang('allocateservicedata.roomno')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <select id="allocaterom" name="allocaterom" class="form-control " required>

                                                        </select>
                                                </div>
                                                <div id="show_master1" class="card-body" style="width:100%;">
                            
                        
                                                    </div>

                                                
                                            </div>
                                            <input type="hidden" id="visiterid" name="visiterid" value="">
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                    <h4><b>@lang('allocateservicedata.allocateservicedetalis')
                                                        </b></h4>
                                                    <input type="hidden" id="doc_row_id" value="0">
                                                    <input type="hidden" id="doc_save_update">
                                                </div><br>
                                                <table class="table table-bordered table-striped" id="servicetb">
                                                        <thead>
                                                            <tr>
                                                                @csrf
                                                                <th width="20">
                                                                    <label class="control-label">@lang('allocateservicedata.datetime')*</label>
                                                                    <div class='input-group datetimepicker' id='datetimepicker2'>
                                                                            <input type='text' class="form-control" style="width:100%"
                                                                                id="datetime" name="datetime"  />
                                                                            <div class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </div>
                                                                        </div>
                                                                </th>
                                                                <th width="20%">
                                                                    <label class="control-label">@lang('allocateservicedata.servicename')*</label>
                                                                    <select id="servicename" name="servicename" class="form-control select2 mainformcon"
                                                                        style="width:100%" >

                                                                        
                                                                    </select>
                                                                    
                            
                            
                                                                </th>
                                                                <th width="20%">
                                                                    <br>
                                                                    <label class="control-label">@lang('allocateservicedata.rate')<?php echo "(".$val=Session::get('savecurrency').")";?></label>
                                                                    <input type="number" class="form-control" id="rate" name="rate" placeholder="Rate">
                                                                   
                            
                                                                </th>
                                                                <th width="20%">
                                                                    <br>
                                                                    <label class="control-label">@lang('allocateservicedata.qty')</label>
                                                                    <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty">
                                                                   
                            
                                                                </th>
                                                                <th colspan="2" width="20%">
                                                                    <button id="addservice" name="addservice" class="btn btn-success"
                                                                        value="+">@lang('allocateservicedata.add')</button>
                            
                                                                </th>
                                                                
                            
                                                            </tr>
                            
                                                        </thead>
                                                        <tbody id="servicetbtbody"></tbody>
                                                    </table>
                                                   

                                           
                                        
                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
                                            <button class="btn btn-primary" id="btn_submit" type="submit">@lang('allocateservicedata.savedata')</button>

                                            <button type="button" class="btn btn-info " id="reset">@lang('allocateservicedata.reset')</button>
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
	<script language="JavaScript" type="text/javascript">

var inserturl="{{ route('visiter.store') }}";
var uploadfile="{{url('uploadingdoc')}}";
var allocateservices="{{route('allocationservice.store') }}";
var csrf_token="{{csrf_token()}}";
 var displayurl="{{ url('getvisiterdata') }}";
 var getallocateroom="{{ url('getallocateroom') }}";
var updateurl="{{ route('visiter.update') }}";
var getallservice="{{ url('getservice') }}";
var getrateofservice="{{ url('servicerate') }}";
var getvistoerinfo="{{ url('getvistiterinformation') }}";
var allocateservicesdetalis="{{route('allocateservicedetalisdata.store') }}";
var getallocateroomservices="{{ url('getserviceintb') }}";
var updateurl="{{ route('allocationservice.update') }}";
        </script>
        <script>
          
                $(document).ready(function(){
                $('#file').change(function () {
                     
                     if ($(this).val() != '') {
                         upload(this);
                
                     }
                 });
                 function upload(img) {
                   
                     var form_data = new FormData();
                     form_data.append('file', img.files[0]);
                     form_data.append('_token', '{{csrf_token()}}');
                    
                     $.ajax({
                         url: "{{url('uploadingfile')}}",
                         data: form_data,
                         type: 'POST',
                         contentType: false,
                         processData: false,
                         success: function (data) {
                           
                             $('#file').val('');
                           $('#msgid').html(data);
                            $('#filehidden1').val(data);
                            
                         }
                     });
                 }
                });
                </script>
                  <script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/allocationservice.js') }}"></script>
</body>

</html>
