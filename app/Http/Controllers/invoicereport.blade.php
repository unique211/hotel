@extends('layout.app')
@extends('layout.header')
@extends('layout.headerlink')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div id="column" class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <!--<button type="button" id="btnadd" data-target="#form"
                            class="mdi mdi-plus-circle  btn btn-info btn-xs"> ADD </button>-->
                    </div>
                </div>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard">Home /</a></li>&nbsp;
                            <li class="active"><?php echo "Extra Service Report"; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <div id="form" class="col-md-12">
            @csrf
            <form id="mainform" class="form-horizontal">
                @csrf
                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">@lang('report.invoicereport')</h4>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 text-right control-label col-form-label">@lang('report.fromdate')</label>
                        <div class="col-sm-2">
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control input-sm placeholdesize datepicker" id="fromdate" name="fromdate" required>
                                <div class="input-group-addon">
                                    <span class="fa fa-calender"></span>
                                </div>
                            </div>

                        </div>

                        <label class="col-sm-2 text-right control-label col-form-label">@lang('report.todate')</label>
                        <div class="col-sm-2">
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control input-sm placeholdesize datepicker" id="todate" name="todate" required>
                                <div class="input-group-addon">
                                    <span class="fa fa-calender"></span>
                                </div>
                            </div>
                        </div>

                        <label class="col-sm-1 text-right control-label col-form-label"></label>
                        <div class="col-sm-2">
                            <button type="submit" id="submitbtn"
                            class="btn btn-sm btn-success btn-sm pull-right">@lang('report.search')</button>
                        </div>

                    </div>
        
            </form>

        </div>
        <div id="tbl" class="row panel" style="width:100%">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Records</h5>
                        <div class="table-responsive">
                            <table id="checkintable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:10%" >@lang('report.srno')</th>
                                        <th style="width:15%">@lang('report.checkindate')</th>
                                        <th style="width:40%">@lang('report.visitername')</th>
                                      
                                        <th style="width:15%">@lang('report.amt')</th>
                                       
                                        <th style="display:none;">Visiter id</th>
                                       
                                    </tr>
                                </thead>
                                <tbody id="tablebody">
                                </tbody>        		
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

</div>

@extends('layout.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script language="JavaScript" type="text/javascript">

var inserturl="{{ url('invoicereportdata')}}";
var doc_token="{{csrf_token()}}";

varuser="<?php echo $val=Session::get('userid');?>";

</script>
<script>


</script>

<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</body>

</html>

<script src="{{ URL::asset('resources/js/invoicereport.js') }}">
</script>