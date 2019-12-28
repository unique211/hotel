@include('layouts.header')
<style>
    /* tab css */
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    p:not(:last-child) {
        margin: 0 0 20px;
    }

    section {
        display: none;
        padding: 20px 0 0;
        border-top: 1px solid #abc;
    }

    #tab1,
    #tab2,
    #tab3,
    #tab4,
    #tab5,
    #tab6,
    #tab7 {
        display: none;
    }

    label {
        display: inline-block;
        margin: 0 0 -1px;
        padding: 15px 25px;
        font-weight: 600;
        text-align: center;
        color: #abc;
        border: 1px solid transparent;
    }

    label:before {
        font-family: fontawesome;
        font-weight: normal;
        margin-right: 10px;
    }

    label[for*='1']:before {
        content: '\f007';
    }

    label[for*='2']:before {
        content: '\f02d';
    }

    label[for*='3']:before {
        content: '\f21b';
    }

    label[for*='4']:before {
        content: '\f19c';
    }

    label[for*='5']:before {
        content: '\f15c';
    }

    label[for*='6']:before {
        content: '\f023';
    }

    label[for*='7']:before {
        content: '\f21b';
    }



    label:hover {
        color: #789;
        cursor: pointer;
    }

    input:checked+label {
        color: #1caf9a;
        border: 1px solid #abc;
        border-top: 2px solid #1caf9a;
        border-bottom: 1px solid #fff;
    }

    #tab1:checked~#content1,
    #tab2:checked~#content2,
    #tab3:checked~#content3,
    #tab4:checked~#content4,
    #tab5:checked~#content5,
    #tab6:checked~#content6,
    #tab7:checked~#content7 {
        display: block;
    }

    @media screen and (max-width: 800px) {
        label {
            font-size: 0;
        }

        label:before {
            margin: 0;
            font-size: 18px;
        }
    }

    @media screen and (max-width: 500px) {
        label {
            padding: 15px;
        }
    }
</style>

<body>
    <style>
        div.picture1 {
            width: 100px;
            /*width of your image*/
            height: 100px;
            /*height of your image*/

            margin: 0;
            /* If you want no margin */
            padding: 0;
            /*if your want to padding */
        }
    </style>


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
                <li class="active">@lang('visiter.visitormaster')</li>
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
                                <h3 class="panel-title">@lang('visiter.visitormaster')</h3>
                                <ul class="panel-controls">
                                    <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_master">
                                        <table id="visitertb" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>@lang('visiter.srno')</th>
                                                    <th>@lang('visiter.visitername')</th>
                                                    <th style="display:none;">@lang('visiter.vlastname')</th>
                                                    <th>@lang('visiter.vaddress1')</th>
                                                    <th>@lang('visiter.vmobileno')</th>
                                                    <th style="display:none;">Email ID </th>
                                                    <th style="display:none;">Company Detalis</th>
                                                    <th style="display:none;">Company Name</th>
                                                    <th style="display:none;">Designation</th>
                                                    <th style="display:none;">Web Site</th>
                                                    <th style="display:none;">Company Contact</th>
                                                    <th style="display:none;">Email ID</th>
                                                    <th style="display:none;">Addres2</th>
                                                    <th style="display:none;">amount</th>
                                                    <th style="display:none;">advancepayment</th>
                                                    <th style="display:none;">mode</th>
                                                    <th style="display:none;">remark</th>
                                                    <th style="display:none;">profilepic</th>
                                                    <th>@lang('visiter.action')</th>
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
                                <h3 class="panel-title">@lang('visiter.visitormaster')</h3>
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
                                                    <label>@lang('visiter.visitername')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        placeholder="@lang('visiter.visitername')" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vlastname')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="lastname"
                                                        name="lastname" placeholder="@lang('visiter.vlastname')"
                                                        required>


                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vaddress1')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <textarea class="form-control" id="address1" name="address1"
                                                        placeholder="@lang('visiter.vaddress1')" required></textarea>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vaddress2')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <textarea class="form-control" id="address2" name="address2"
                                                        placeholder="@lang('visiter.vaddress2')" required></textarea>


                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vstreet')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="street" name="street"
                                                        placeholder="@lang('visiter.vstreet')" required>


                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vcity')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="city" name="city"
                                                        placeholder="@lang('visiter.vcity')" required>
                                                </div>

                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vpostalcode')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="postalcode"
                                                        name="postalcode" placeholder="@lang('visiter.vpostalcode')"
                                                        required>


                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vstate')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" id="state" name="state"
                                                        placeholder="@lang('visiter.vstate')" required>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vmobileno')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" class="form-control" id="mobileno"
                                                        name="mobileno" style="text-align:rihgt;"
                                                        placeholder="@lang('visiter.vmobileno')" required>

                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.vemailid')</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="@lang('visiter.vemailid')">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('visiter.profilepicture')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="file" id="profile" name="profile" class="form-control"
                                                        accept="image/*" >
                                                    <div id="pmsgid"></div>
                                                    <input type="hidden" id="pfilehidden1" name="pfilehidden1" value="">
                                                    <div class="form-group picture1">
                                                        <img id="profileimg"
                                                            src="<?php  echo url('/'); ?>/resources/img/usersicon.jpg"
                                                            alt="Smiley face" height="100px" width="100px">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">

                                                </div>
                                                <div class="col-sm-3">


                                                </div>
                                            </div>
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <button type="button" id="addproff" name="addproff"
                                                    style="margin-bottom:-5px;" class="btn btn-success pull-right">Add
                                                    Proff</button>
                                                <h4><b>@lang('visiter.vproofdetalis') </b></h4>
                                                <input type="hidden" id="doc_row_id" value="0">
                                                <input type="hidden" id="doc_save_update">
                                            </div><br>
                                            <table class="table table-bordered table-striped" id="docupload">
                                                <thead>
                                                    <tr>
                                                        @csrf
                                                        <th width="30%">
                                                            <label
                                                                class="control-label">@lang('visiter.vprooftype')</label>

                                                            <!--<select id="profdoc" name="profdoc"
                                                                        class="form-control" style="width:100%">
                                                                        <option value="AdharCard">AdharCard</option>
                                                                        <option value="Pancard">Pancard</option>
                                                                        <option value="Drivinglicense">Driving license
                                                                        </option>
                                                                        <option value="VoterID">VoterID </option>
                                                                    </select>-->

                                                        </th>
                                                        <th width="20%">
                                                            <label class="control-label">@lang('visiter.vproofno')
                                                            </label>

                                                            <!--<input type="number" id="proffno" name="proffno"
                                                                        class="form-control">-->

                                                        </th>
                                                        <th width="35%">
                                                            <br>
                                                            <label class="control-label">@lang('visiter.vimage')
                                                            </label>


                                                            <!--<input type="file" id="file" name="file"
                                                                        class="form-control">
                                                                    <div id="msgid"></div>
                                                                    <input type="hidden" id="filehidden1"
                                                                        value=>-->

                                                        </th>
                                                        <th width="10%">
                                                            <label class="control-label">@lang('visiter.action')
                                                            </label>
                                                            <!--<button id="saveproff" name="saveproff"
                                                                        class="btn btn-success" value="+">+</button>-->

                                                        </th>

                                                    </tr>

                                                </thead>
                                                <tbody id="docupload_tbody"></tbody>
                                            </table>

                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <h4><b>@lang('visiter.vpurpose')</b></h4>
                                                <input type="checkbox" name="comapanydata" id="comapanydata"
                                                    value="1"><b> &nbsp;@lang('visiter.vcompanyorganation')</b>
                                                <hr><br>
                                            </div><br>
                                            <div class="form-group" id="purposedata">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label>@lang('visiter.vcompanyname')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="c_name"
                                                            name="c_name" placeholder="@lang('visiter.vcompanyname')">

                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>@lang('visiter.vdesignation')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="desgination"
                                                            name="desgination"
                                                            placeholder="@lang('visiter.vdesignation')">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label>@lang('visiter.vcompanywebsiteurl')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="url" name="url"
                                                            placeholder="@lang('visiter.vcompanywebsiteurl')">

                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>@lang('visiter.vcompanycontactno')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control"
                                                            style="text-align:right" id="contactno" name="contactno"
                                                            placeholder="@lang('visiter.vcompanycontactno')">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label>@lang('visiter.vcompanyemailaddress')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="c_email"
                                                            name="c_email"
                                                            placeholder="@lang('visiter.vcompanyemailaddress')">

                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" />
                                            <button class="btn btn-primary" id="btn_submit"
                                                type="submit">@lang('visiter.savedata')</button>

                                            <button type="button" class="btn btn-info "
                                                id="reset">@lang('visiter.reset')</button>
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

                {{-- Start Information Tab --}}

                <div id="visiterview" class="row" style="display:none">
                        
                    <div class="col-sm-12">
                            <div class="row pull-right">
                                    <button type="button" class="btn btn-info "
                                    id="cancle">@lang('visiter.cancle')</button>
                              </div>
                        <div class="col-sm-3">
                            <div class="form-group picture1">
                                    
                                <img id="infoimages" src="<?php  echo url('/'); ?>/resources/img/usersicon.jpg"
                                    alt="Smiley face" height="100px" width="100px">
                            </div><!-- /form-group -->
                        </div>
                        <div class="col-sm-6">
                            <label><i class="fa fa-info-circle"></i> Information</label>
                            <hr>
                            <h5> <label id="infovisitername"><b>Contact Bruce</b></label></h5>
                        </div>
                        <div class="col-sm-3">
                                <label></label>
                                <hr>
                                <h5><label><b>Total Amount</b></label>  0408365892</h5>
                            </div>

                    </div>
                    <div class="col-lg-12">
                        <input id="tab1" class="stages" type="radio" name="tabs" checked>
                        <label for="tab1">Info</label>
                        <input id="tab2" class="stages" type="radio" name="tabs" checked>
                        <label for="tab2">Visitor Check in Detalis</label>

                        <section id="content1">

                            <div class="row">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vaddress1')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <textarea class="form-control" id="viewaddress1" name="viewaddress1"
                                            placeholder="@lang('visiter.vaddress1')" disabled ></textarea>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vaddress2')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <textarea class="form-control" id="viewaddress2" name="viewaddress2"
                                            placeholder="@lang('visiter.vaddress2')" disabled></textarea>


                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vstreet')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="viewstreet" name="viewstreet"
                                            placeholder="@lang('visiter.vstreet')" disabled >


                                    </div>
                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vcity')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="viewcity" name="viewcity"
                                            placeholder="@lang('visiter.vcity')" disabled >
                                    </div>

                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vpostalcode')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="viewpostalcode" name="viewpostalcode"
                                            placeholder="@lang('visiter.vpostalcode')" disabled >


                                    </div>
                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vstate')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="viewstate" name="viewstate"
                                            placeholder="@lang('visiter.vstate')" disabled>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vmobileno')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="viewmobileno" name="viewmobileno"
                                            style="text-align:rihgt;" placeholder="@lang('visiter.vmobileno')" disabled >

                                    </div>
                                    <div class="col-sm-3">
                                        <label>@lang('visiter.vemailid')</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="email" class="form-control" id="viewemail" name="viewemail"
                                            placeholder="@lang('visiter.vemailid')" disabled>

                                    </div>
                                </div>
                            </div>
                            <div class="btn-group pull-right">
                                    
                                    <button class="btn btn-primary" id="edit" name="edit"
                                        ><i class="fa fa-edit"></i></button>
                                       <button class="btn btn-danger" id="delete" name="delete"
                                       ><i class="fa fa-trash"></i></button>

                                    <button type="button" class="btn btn-info "
                                        id="cancle">@lang('visiter.cancle')</button>
                                </div>


                        </section>
                        <section id="content2">
                                <div class="col-lg-12 ">
                                        <div class="table-responsive" id="getallinfo">
                                        </div>
                                </div>

                        </section>


                    </div>
                </div>
                {{-- End Information Tab --}}
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
        var docuploadurl="{{route('docuploaddata.store') }}";
        var doc_token="{{csrf_token()}}";
        var displayurl="{{ url('getvisiterdata') }}";
        var updateurl="{{ route('visiter.update') }}";
        var uploadfileurl="{{url('uploadingfile')}}";
        var checkmobileno="{{ url('checkmobilenoexist') }}";
        var getvisitoralldata="{{ url('getvisitorallinfo') }}";
        var imgurl="<?php  echo url('/') ?>";

    </script>
    <script>
        $(document).ready(function(){
                $('#profile').change(function () {
                     
                     if ($(this).val() != '') {
                         profileupload(this);
                
                     }
                 });
                 function profileupload(img) {
                   
                     var form_data = new FormData();
                     form_data.append('profile', img.files[0]);
                     form_data.append('_token', '{{csrf_token()}}');
                    
                     $.ajax({
                         url: "{{url('profileuploadingfile')}}",
                         data: form_data,
                         type: 'POST',
                         contentType: false,
                         processData: false,
                         success: function (data) {
                          
                            $('#profileimg').attr('src', imgurl+'/profileuploads/'+data);
                           $('#pmsgid').html(data);
                            $('#pfilehidden1').val(data);
                            
                         }
                     });
                 }
                });
    </script>
    <script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/visitermaster.js') }}"></script>
</body>

</html>