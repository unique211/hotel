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
    #tab2
        {
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
        content: '\f015';
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
    #tab2:checked~#content2
        {
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

    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-toggled page-container-wide">
        <!-- START PAGE SIDEBAR -->
        @include('layouts.sidebar')
        <!-- END PAGE SIDEBAR -->
        <!-- PAGE CONTENT -->
        <div class="page-content">
            <!-- START X-NAVIGATION VERTICAL -->
            @include('layouts.topbar')
            <!-- END X-NAVIGATION VERTICAL -->
            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li class="active">@lang('vcheckin.visitorcheckin')</li>
            </ul>
            <!-- END BREADCRUMB -->
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <!--NEWS SECTION-->
                <div class="row tablehideshow">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side">
                        <!-- START SIMPLE DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('vcheckin.visitorcheckin')</h3>
                                <ul class="panel-controls">
                                    <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_masterdata">
                                            <table id="visitercheckintb" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th >@lang('visiter.srno')</th>
                                                            <th >@lang('visiter.visitername')</th>
                                                            <th >@lang('visiter.vlastname')</th>
                                                            <th >@lang('visiter.vaddress1')</th>
                                                            <th >@lang('visiter.vmobileno')</th>
                                                            <th >@lang('vcheckin.vcheckintime')</th>
                                                            <th style="display:none;">Email ID </th>
                                                            <th style="display:none;">Company Detalis</th>
                                                            <th style="display:none;">Company Name</th>
                                                            <th style="display:none;">Designation</th>
                                                            <th style="display:none;">Wrb Site</th>
                                                            <th style="display:none;">Company Contact</th>
                                                            <th style="display:none;">Email ID</th>
                                                            <th style="display:none;">Men </th>
                                                            <th style="display:none;">Woman</th>
                                                            <th style="display:none;">child</th>
                                                            <th style="display:none;">noofday</th>
                                                            <th style="display:none;">checkintime</th>
                                                            <th style="display:none;">checkouttime</th>
                                                            <th style="display:none;">amount</th>
                                                            <th style="display:none;">advancepayment</th>
                                                            <th style="display:none;">mode</th>
                                                            <th style="display:none;">remark</th>
                                                            <th style="display:none;">checkouttime</th>
                                                            <th style="display:none;">amount</th>
                                                            <th style="display:none;">advancepayment</th>
                                                            <th style="display:none;">mode</th>
                                                            <th style="display:none;">remark</th>
                                                            <th style="display:none;">Profile Picture</th>

                                                           <th >@lang('visiter.action')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablebody">
                                                    </tbody>
                                                </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END SIMPLE DATATABLE -->
                    </div>
                </div>
                <!--NEWS SECTION END-->
                <!-- strat notification -->
                <div class="row formhideshow" style="display:none;">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side">
                        <!-- START SIMPLE DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <!-- <h3 class="panel-title">Information</h3> -->
                                <div class="pull-right">
                                    <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">

                                    <input id="tab1" class="stages" type="radio" name="tabs" checked>
                                    <label for="tab1">@lang('vcheckin.visiterdetalis')</label>
                                    <input id="tab2" class="stages" type="radio" name="tabs" disabled>
                                    <label for="tab2">@lang('vcheckin.roomdetalis')</label>

                                    <section id="content1">
                                            <form class="form-horizontal" id="master_form" name="master_form">

                                                <div class="row">

                                                    <div class="form-group row editvister">
                                                        <div class="col-sm-3">
                                                            <label>@lang('vcheckin.searchvistor')</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="searchvisitor"
                                                                name="searchvisitor" placeholder="@lang('vcheckin.searchvistor')" >
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <button id="new" class="btn btn-primary"
                                                                name="new">@lang('vcheckin.new')</button>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row " id="serachdiv">
                                                        <div class="table-responsive">

                                                                <table id="searchtb"
                                                                    class="table table-striped table-bordered"
                                                                    style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="20%">@lang('vcheckin.visitername').</th>
                                                                            <th width="20%">@lang('vcheckin.vlastname').</th>
                                                                            <th width="20%">@lang('vcheckin.vmobileno')</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="searchtbody">
                                                                    </tbody>
                                                                </table>


                                                        </div>
                                                    </div>
                                                  <div id="visiter_data">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">
                                                            <label>@lang('vcheckin.vfirstname')*</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" placeholder="@lang('vcheckin.vfirstname')" required>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>@lang('vcheckin.vlastname')*</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                                <input type="text" class="form-control" id="lastname"
                                                                name="lastname" placeholder="@lang('vcheckin.vlastname')" required>


                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vaddress1')*</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                    <textarea class="form-control" id="address1" name="address1" placeholder="@lang('vcheckin.vaddress1')" required></textarea>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vaddress2')</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                    <textarea class="form-control" id="address2" name="address2" placeholder="@lang('vcheckin.vaddress2')" ></textarea>


                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                                <div class="col-sm-3">
                                                                    <label>@lang('vcheckin.vstreet')*</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                        <input type="text" class="form-control" id="street"
                                                                        name="street" placeholder="@lang('vcheckin.vstreet')" required>


                                                                </div>
                                                                <div class="col-sm-3">
                                                                        <label>@lang('vcheckin.vcity')*</label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                            <input type="text" class="form-control" id="city"
                                                                            name="city" placeholder="@lang('vcheckin.vcity')" required>
                                                                    </div>

                                                            </div>
                                                            <div class="form-group row">

                                                                    <div class="col-sm-3">
                                                                        <label>@lang('vcheckin.vpostalcode')*</label>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                            <input type="number" class="form-control" id="postalcode"
                                                                            name="postalcode" placeholder="@lang('vcheckin.vpostalcode')" required>


                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                            <label>@lang('vcheckin.vstate')*</label>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                                <input type="text" class="form-control" id="state"
                                                                            name="state" placeholder="@lang('vcheckin.vstate')" required>
                                                                        </div>

                                                                </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">
                                                            <label>@lang('vcheckin.vmobileno')*</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="number" class="form-control" id="mobileno"
                                                                name="mobileno" placeholder="@lang('vcheckin.vmobileno')" required>

                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label>@lang('vcheckin.vemailid')*</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="@lang('vcheckin.vemailid')" required>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">
                                                            <label>@lang('visiter.profilepicture')*</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="file" id="profile" name="profile" class="form-control" accept="image/*" required>
                                                            <div id="pmsgid" ></div>
                                                            <input type="hidden" id="pfilehidden1" name="pfilehidden1" value="">
                                                            <div class="form-group picture1">
                                                                <img id="profileimg" src="<?php  echo url('/'); ?>/resources/img/usersicon.jpg" alt="Smiley face" height="100px" width="100px">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">

                                                        </div>
                                                        <div class="col-sm-3">


                                                        </div>
                                                    </div>

                                                    <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                        <button type="button" id="addproff" name="addproff" style="margin-bottom:-5px;" class="btn btn-success pull-right">Add Proff</button>
                                                        <h4><b>@lang('vcheckin.vproofdetalis')</b></h4>

                                                        <input type="hidden" id="doc_row_id" value="0">
                                                        <input type="hidden" id="doc_save_update">
                                                    </div><br>
                                                    <table class="table table-bordered table-striped" id="docupload">
                                                        <thead>
                                                            <tr>
                                                                @csrf
                                                                <th width="30%">
                                                                    <label class="control-label">@lang('vcheckin.vprooftype')</label>

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
                                                                    <label class="control-label">@lang('vcheckin.vproofno')</label>

                                                                    <!--<input type="number" id="proffno" name="proffno"
                                                                        class="form-control">-->

                                                                </th>
                                                                <th width="35%">
                                                                    <br>
                                                                    <label class="control-label">@lang('vcheckin.vimage') </label>


                                                                    <!--<input type="file" id="file" name="file"
                                                                        class="form-control">
                                                                    <div id="msgid"></div>
                                                                    <input type="hidden" id="filehidden1"
                                                                        value=>-->

                                                                </th>
                                                                <th width="10%">
                                                                        <label class="control-label">@lang('vcheckin.action')</label>
                                                                    <!--<button id="saveproff" name="saveproff"
                                                                        class="btn btn-success" value="+">+</button>-->

                                                                </th>

                                                            </tr>

                                                        </thead>
                                                        <tbody id="docupload_tbody"></tbody>
                                                    </table>

                                                    <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                        <h4><b>@lang('vcheckin.vpurpose')</b></h4>
                                                        <input type="checkbox" name="comapanydata" id="comapanydata"
                                                            value="1"><b> &nbsp;@lang('vcheckin.vcompanyorganation')</b>
                                                        <hr><br>
                                                    </div><br>
                                                    <div class="form-group" id="purposedata">
                                                        <div class="form-group row">
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vcompanyname')</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" id="c_name"
                                                                    name="c_name" placeholder="@lang('vcheckin.vcompanyname')">

                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vdesignation')</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" id="desgination"
                                                                    name="desgination" placeholder="@lang('vcheckin.vdesignation')">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vcompanywebsiteurl')</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" id="url"
                                                                    name="url" placeholder="@lang('vcheckin.vcompanywebsiteurl')">

                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vcompanycontactno')</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="number" class="form-control" id="contactno"
                                                                    name="contactno" placeholder="@lang('vcheckin.vcompanycontactno')">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-3">
                                                                <label>@lang('vcheckin.vcompanyemailaddress')</label>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" id="c_email"
                                                                    name="c_email" placeholder="@lang('vcheckin.vcompanyemailaddress')">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                </div>
                                                <div class="btn-group pull-right">
                                                    <input type="hidden" id="saveid" name="saveid" value="" />
                                                    <button class="btn btn-primary" id="btn_submit" type="submit">Save &
                                                        Next</button>

                                                    <button type="button" class="btn btn-info "
                                                        id="reset">Reset</button>
                                                </div>
                                            </form>
                                    </section>
                                    <section id="content2">
                                        <form id="mainform1" name="mainform1">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-3">
                                                        <label>@lang('vcheckin.men')*</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" value="1" class="form-control guesttotal" id="men"
                                                            name="men" style="text-align:right;" placeholder="@lang('vcheckin.men')" required>
                                                    </div>
                                                    <div class="col-sm-3">
                                                            <label>@lang('vcheckin.vcheckintime')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                            <div class='input-group' id='datetimepicker1'>
                                                                    <input type='text' class="form-control" style="width:100%"
                                                                        id="checktime" name="checktime" required />
                                                                    <div class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </div>
                                                                </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-3">
                                                            <label>@lang('vcheckin.woman') *</label>

                                                    </div>
                                                    <div class="col-sm-3">
                                                            <input type="number" value="0" class="form-control guesttotal" id="women"
                                                            name="women" style="text-align:right;" placeholder="@lang('vcheckin.woman')" required>

                                                    </div>
                                                    <div class="col-sm-3">
                                                            <label>@lang('vcheckin.vcheckouttime')</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                            <div class='input-group datetimepicker' id='datetimepicker2'>
                                                                    <input type='text' class="form-control" style="width:100%"
                                                                        id="date" name="date" required />
                                                                    <div class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </div>
                                                                </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-sm-3">
                                                            <label>@lang('vcheckin.child')*</label>

                                                    </div>
                                                    <div class="col-sm-3">
                                                            <input type="number" class="form-control guesttotal" id="child"
                                                            name="child" style="text-align:right;"  placeholder="@lang('vcheckin.child')" value="0" required>

                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label>@lang('vcheckin.vnoofdays')*</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" style="text-align:right;" class="form-control" id="nodays"
                                                            name="nodays" placeholder="No Of Day" required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-3">
                                                                <label>@lang('vcheckin.totalguest')*</label>

                                                        </div>
                                                        <div class="col-sm-3">
                                                                <input type="number" class="form-control" id="totalnoguest"
                                                                name="totalnoguest" style="text-align:right;"  placeholder="@lang('vcheckin.totalguest')" value="1" >

                                                        </div>



                                                    </div>
                                                </div>
                                            <div style="margin-top:-5px;border-bottom:2px solid;width:100%;">
                                                <h4 class="pull-left"><b>@lang('vcheckin.vallocateroom')</b></h4>
                                                <hr>
                                            </div><br>
                                            <div class="col-lg-12 ">
                                                    {{-- <div class="row">
                                                            <div class="col-sm-2">
                                                                    <label>@lang('vcheckin.venterroomnosearch')</label>
                                                                </div>
                                                    <div class="col-sm-2">
                                                            <input type="number" style="text-align:right;" class="form-control" id="txt_searchall"
                                                            name="txt_searchall" placeholder="@lang('vcheckin.venterroomnosearch')" >
                                                        </div>
                                                    </div> --}}
                                                <div class="table-responsive" id="show_master1">
                                                        <div style="margin-top:0px;border-bottom:2px solid;width:100%;"></div><br>
                                                        <table id="tballocateroom" class="table table-striped table-bordered" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <td style="width:20%">Category</td>
                                                                        <td style="width:40%">Room</td>
                                                                        <td style="width:40%">AllocateRoom</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                        <td style="width:20%" id="categoryinfo"></td>
                                                                        <td style="width:40%" id="roominfo"></td>
                                                                        <td style="width:40%"  id="allocateroom"></td>
                                                                </tbody>
                                                            </table>
                                                        {{-- <div class="row">

                                                                <div class="col-sm-4">
                                                                        <b>Category</b>
                                                                 </div>
                                                                 <div class="col-sm-4">
                                                                        <b >Room</b>
                                                                 </div>
                                                                 <div class="col-sm-4">
                                                                        <b >AllocateRoom</b>
                                                                 </div>
                                                         </div>
                                                         <div style="margin-top:0px;border-bottom:2px solid;width:100%;"></div><br>
                                                         <div class="row">
                                                                <div class="col-sm-4" id="categoryinfo">

                                                                 </div>
                                                                 <div class="col-sm-4" id="roominfo">

                                                                 </div>
                                                                 <div class="col-sm-4" id="allocateroom">

                                                                 </div>

                                                         </div> --}}
                                                         <div style="margin-top:0px;border-bottom:2px solid;width:100%;"></div><br>


                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="form-group">
                                                    <div class="col-sm-7">

                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="col-sm-2 text-right control-label col-form-label">@lang('vcheckin.vamount')<?php echo "(".$val=Session::get('savecurrency').")";?></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" class="form-control" id="amount"
                                                            name="amount" placeholder="@lang('vcheckin.vamount')" style="text-align:right" value="0" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-7">

                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label
                                                                class="col-sm-2 text-right control-label col-form-label">@lang('vcheckin.vadvancepaymentamount')</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                                <input type="number" style="text-align:right;"  class="form-control" id="advanceamount" name="advanceamount" placeholder="@lang('vcheckin.vadvancepaymentamount')" value="0" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                        <div class="form-group hideamtdata">
                                                            <div class="col-sm-7">

                                                            </div>
                                                            <div class="col-sm-2">
                                                                <label
                                                                    class="col-sm-2 text-right control-label col-form-label">@lang('vcheckin.vpaymentmode')</label>
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
                                                            <div class="form-group hideamtdata">
                                                                <div class="col-sm-7">

                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <label
                                                                        class="col-sm-2 text-right control-label col-form-label">@lang('vcheckin.vremark')</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <textarea   class="form-control" id="remark" name="remark" placeholder="@lang('vcheckin.vremark')"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                            <div class="row">
                                                <br>
                                                <div class="form-group pull-right">
                                                        <input type="hidden" id="saveid1" name="saveid1" value="" />
                                                        <input type="hidden" id="updateid" name="updateid" value="" />
                                                    <input type="submit" id="save1" class="btn btn-info"  value="Save">

                                                </div>
                                            </div>
                                        </form>




                                    </section>

                                </div>
                            </div>
                        </div>
                        <!--panel panel default-->
                        <!-- END SIMPLE DATATABLE -->
                    </div>
                    <!------------------------form1-end------------------------------->
                    <!-------------------------------------------------------------------------------------------------------------------------->
                </div>
                <!-- end notification -->
            </div>
            <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!-- MESSAGE BOX-->
    @include('layouts.message_box')
    {{-- END MESSAGE BOX--}}
    {{-- START SCRIPTS --}}

    @include('layouts.footer_scripts')

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
        var getsearchvistiter="{{ url('getvisitersearch') }}";
        var updateurl="{{ route('visiter.update') }}";
        var docuploadurl="{{route('docuploaddata.store') }}";
        var token="{{csrf_token()}}";
        var documentuplodingurl="{{url('uploadingfile')}}";
        var inserturl="{{ route('visiter.store') }}";
        var avalibleroomdata="{{url('avalibleroomdata')}}";
        var allocateroom="{{route('allocateroom.store')}}";
        var deleteallocateroom="{{url('avalibleroomdata')}}";
        var visitercheckinsert="{{ route('visitercheckin.store') }}";
        var showalldata="{{ url('showallrecord') }}";
        var displayurl="{{ url('getvisiterdata') }}";
        var visitercheckupdateurl="{{route('visitercheckin.update') }}";
        var checkmobileno="{{ url('checkmobilenoexist') }}";
        var uploadfileurl="{{url('uploadingfile')}}";
        var getadvancecheckin="{{ url('getadvancecheckin') }}";
        var getallroominfo="{{ url('getallroominformation') }}";
        var getcheckout="{{ url('getcheckoutscreen') }}";
        var imgurl="<?php  echo url('/') ?>";
        var changet= "<?php echo $val=Session::get('savetime');?>";
        var deltevisitercheckin="{{ url('deletevisitorcheckin') }}";
       
        </script>

    <script type="text/javascript">
        $('.clockpicker').clockpicker();
    </script>
    <script>

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
              <script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/visitercheckin.js') }}"></script>
</body>

</html>
