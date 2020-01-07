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
                <li class="active">@lang('user.userdetails')</li>
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
                                <h3 class="panel-title">@lang('user.userdetails')</h3>
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
                                                            <th >@lang('user.srno')</th>
                                                            <th >@lang('user.username')</th>
                                                            <th >@lang('user.mobileno')</th>
                                                            <th >@lang('user.emailid')</th>
                                                            <th >@lang('user.role') </th>
                                                            <th style="display:none;">uname </th>
                                                            <th style="display:none;">password</th>
                                                            <th >@lang('user.action')</th>
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
                                <h3 class="panel-title">@lang('user.usermanage')</h3>
                                <div class="pull-right">
                                    <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" id="master_form" name="master_form">
                                        <div class="row">
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <h4><b>@lang('user.userdetails')</b></h4>
                                            </div><br>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('user.username')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="username" name="username" placeholder="@lang('user.username')" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('user.mobileno')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <input type="number" maxlength="10" pattern="[1-9]{1}[0-9]{9}" class="form-control" id="mobileno" name="mobileno" style="text-align:right;" placeholder="@lang('user.mobileno')" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('user.emailid')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="@lang('user.emailid')" required>
                                                    <label class="control-label" id="chkemail" style="display:none;">
                                                        <font color="red">Email is Already Exists!!
                                                        </font>
                                                    </label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('user.role')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <select class="form-control input-sm  placeholdesize roleselect" id="user_type" name="user_type"  required   >
                                                                <option selected disabled >Select</option>
                                                                <option  value="Admin" >Admin</option>
                                                                <option  value="User" >User</option>
                                                                <option  value="Manager" >Manager</option>
                                                        </select>

                                                </div>
                                            </div>
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <h4><b> @lang('user.logindetalis')*</b></h4>
                                            </div><br>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label>@lang('user.userid')* </label>
                                                </div>
                                                <div class="col-sm-2">
                                                        <input type="text" class="form-control input-sm placeholdesize" placeholder="@lang('user.userid')" id="user_id" name="user_id"  required  >
                                                    <label class="control-label" id="chk_userid" style="display:none;">
                                                        <font color="red">UserId is Already Exists!!
                                                        </font>
                                                    </label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('user.password')*</label>
                                                </div>
                                                <div class="col-sm-2">
                                                        <input type="password" class="form-control input-sm placeholdesize cpassword" id="password" name="password" placeholder="@lang('user.password')"   required  maxlength="36"  >
                                                    <input type="hidden" id="hide_password" name="hide_password"
                                                        value="">
                                                </div>
                                                <div class="col-sm-2">
                                                    <label>@lang('user.confirmpassword')*</label>
                                                </div>
                                                <div class="col-sm-2">
                                                        <input type="password" class="form-control input-sm placeholdesize cpassword" id="cpassword" name="cpassword" placeholder="@lang('user.confirmpassword')"  required   maxlength="36"  >
                                                        <label class="text-danger" id="cpass_error"></label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
                                            <button class="btn btn-primary" id="btn_submit" type="submit">@lang('user.savedata')</button>

                                            <button type="button" class="btn btn-info " id="reset">@lang('vcheckin.reset')</button>
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
        var inserturl="{{route('usermanagement.store') }}";
        var displayurl="{{url('getalluser')}}"
        var doc_token="{{csrf_token()}}";
        var checkuser="{{url ('checkuserid')}}";
        var checkmobileno="{{url ('checkusermobileno') }}";
        varuser="<?php echo$val=Session::get('userid');?>";
        var checkemailaddress="{{url ('checkexistemail')}}";

        </script>

    <script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/usermanagement.js') }}">
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
