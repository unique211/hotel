@include('layouts.header')

<body>
        <?php echo $val=Session::get('savecurrency');?>


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
                <li class="active">@lang('user.changetime')</li>
            </ul>
            {{--  END BREADCRUMB  --}}
            {{-- PAGE CONTENT WRAPPER --}}
            <div class="page-content-wrap">
                {{--NEWS SECTION--}}
               
                {{--NEWS SECTION END--}}
                {{-- strat notification --}}
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side" id="form1">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('user.changetime')</h3>
                                
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form   id="master_form" name="master_form" >
                                            @csrf
                                        <div class="row">
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <h4><b>@lang('user.changetime')</b></h4>
                                            </div><br>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('user.changetime')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <div class="input-group timepicker">
                                                                <input type="text" class="form-control" id="changetimeing" name="changetimeing" class="changetimeing" placeholder="hh:mm:ss" required>
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('user.changecurrency')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control" id="changecurrencyinfo" name="changecurrencyinfo" >
                                                        <option value="0" selected disabled>Select Currency*</option>
                                                         <option value="€" >Euro</option>
                                                        <option value="R$">Brazilian real</option>
                                                        <option value="RM" >Malaysian ringgit</option>
                                                        <option value="₽" >Russian ruble</option>
                                                        <option value="₹" >Indian rupee</option>
                                                    </select>
                                                </div>
                                              
                                            </div>
                                            <div class="btn-group pull-right">
                                              
                                                <button class="btn btn-primary" id="btn_submit" type="submit">Save</button>
    
                                                <button type="button" class="btn btn-info " id="reset">Reset</button>
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
     var updateurl="{{ route('settime.update') }}";
    var add_data="{{ route('settime.store')}}";
   var changet= "<?php echo $val=Session::get('savetime');?>";
   var Currency="<?php echo $val=Session::get('savecurrency');?>";
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

                  $('.timepicker').datetimepicker({
            format: 'HH:mm:ss',
            });
    </script>
</body>
<script src="{{ URL::asset('resources/js/myjs/changetime.js') }}">
</script>
</html>
