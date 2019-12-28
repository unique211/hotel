@include('layouts.header')

<body>
        <?php echo $val=Session::get('locale');?>


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
                <li class="active">@lang('user.changelanguages')</li>
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
                                <h3 class="panel-title">@lang('user.changelanguages')</h3>
                                
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form  action="languges" method="post" id="master_form" name="master_form">
                                            @csrf
                                        <div class="row">
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <h4><b>@lang('user.changelanguages')</b></h4>
                                            </div><br>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('user.changelanguages')</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select class="form-control" id="languages" name="languages" onchange="this.form.submit()">
                                                        <option value="0" selected disabled>Select Languages</option>
                                                    <option value="gu" <?php if($val!=null){ if($val=="gu"){?> selected <?php }} ?>>Gujrati</option>
                                                        <option value="en" <?php if($val!=null){ if($val=="en"){?> selected <?php }} ?>>English</option>
                                                    </select>
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
</body>

</html>
