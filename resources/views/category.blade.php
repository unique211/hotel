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
                <li class="active">@lang('categorydata.categorymaster')</li>
            </ul>
            {{--  END BREADCRUMB  --}}
            {{-- PAGE CONTENT WRAPPER --}}
            <div class="page-content-wrap">

                {{-- strat notification --}}
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side" id="form1">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('categorydata.categorymaster')</h3>
                                <div class="pull-right">
                                   {{-- <!-- <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button>---> --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" id="master_form" name="master_form">
                                        <div class="row">

                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('categorydata.categoryname')*</label>
                                                </div>
                                                <div class="col-sm-3">
													<input type="text"  class="form-control" id="name" name="name" placeholder="@lang('categorydata.categoryname')" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('categorydata.rate')<?php echo "(".$val=Session::get('savecurrency').")";?>*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="number" min="0" class="form-control" id="rate" name="rate" style="text-align:right;" placeholder="@lang('categorydata.rate')" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('categorydata.capacity')*</label>
                                                </div>
                                                <div class="col-sm-3">
													<input type="number"  min="0" class="form-control" id="capacity" style="text-align:right;" name="capacity" placeholder="@lang('categorydata.capacity')" required>
                                                    <label id="errmsg" style="color:red"></label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('categorydata.description')</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <textarea   id="descriptiondata" name="descriptiondata" class="form-control" placeholder="@lang('categorydata.description')"></textarea>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
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
				 {{--NEWS SECTION--}}
				 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('categorydata.categorymaster')</h3>
                                <ul class="panel-controls">
                                    {{-- <li> <button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li> --}}
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_master">
											<table id="categorytb" class="table table-striped table-bordered" style="width:100%">
													<thead>
														<tr>
															<th width="5%">@lang('categorydata.srno')</th>
															<th width="30%">@lang('categorydata.categoryname')</th>
															<th width="10%">@lang('categorydata.rate')</th>
															<th width="10%">@lang('categorydata.capacity')</th>
															<th width="30%">@lang('categorydata.description')</th>
															<th width="10%">@lang('categorydata.action')</th>
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
		$(document).ready(function(){
		//	$('#dataTable').DataTable({});
			var flag=0;
		 $('.btnhideshow').click(function(){

			$('.tablehideshow').hide();
			  $(".formhideshow").show();
			  $('#saveid').val('');
			  from_clear();
		 });
		 $('#reset').click(function(){
			from_clear();
			  $('#saveid').val('');
		 });
		 $('#master_form').on('submit', function(event){
				  event.preventDefault();
			 var id= $('#saveid').val();
			var rate=$('#rate').val();
			var capacity=$('#capacity').val();

			if(rate > 0 && capacity >0){
			   if(id==""){
				$.ajax({
					url:"{{ route('category.store') }}",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
					{
						if(data =='100'){
							swal("Category Name Alredy Exists Please Enter Another Category Name !!!");
						}else{
							datashow();
							from_clear();
						successTost("Operation Successfull");
						}

					}
				});
			   }else{
				docid=$('#saveid').val();
						$.ajax({
							url:"{{ route('category.update') }}",
							method:"POST",
							data:new FormData(this),
							contentType: false,
							cache: false,
							processData: false,
							dataType:"json",
							success:function(data)
							{
								datashow();
								if(data =='100'){
							swal("Category Name Alredy Exists Please Enter Another Category Name !!!");
								}else{
									from_clear();
							toastr.success("Record Update Success Fully");
						}

							}
						});
			   }

			   datashow();
			   //from_clear();
			}else{
				swal("Category Rate  OR Capacity sholud be Grather Than Zero !!!");
			}

		 });
		 datashow();
			function datashow(){

				$.ajax({
					url:"{{ url('showall') }}",
					type:"GET",
				 //   data: new FormData(this),
				   data:{
							"_token": "{{ csrf_token() }}",
						},
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
					{
						var tb=$('#categorytb').DataTable();
						tb.destroy();

						   $('#tablebody').html('');
					var table="";
					var sr=0;
					for(var i=0;i<data.length;i++)
					{
						sr=sr+1;
						var descroption='';
						if(data[i].descroption==null){
							descroption='';
						}else{
							descroption=data[i].descroption;
						}
						table+='<tr>'+
						'<td style="width:5%"  id="id_'+data[i].id+'">'+sr+'</td>'+
						'<td style="width:30%" id="name_'+data[i].id+'">'+data[i].name+'</td>'+
						'<td style="width:10%"  id="rate_'+data[i].id+'">'+data[i].rate+'</td>'+
						'<td style="width:10%"  id="capacity_'+data[i].id+'">'+data[i].capacity+'</td>'+
						'<td style="width:30%" id="descroption_'+data[i].id+'">'+descroption+'</td>'+
						'<td style="width:10%" ><button name="edit"  class="edit_data btn btn-xs  btn-primary" id='+data[i].id+'><i class="fa fa-edit"></i></button> &nbsp;&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id='+data[i].id+'><i class="fa fa-trash"></i></button></td>'+
						'</tr>' ;
					}
					$('#categorytb').append(table);
					$('#categorytb').DataTable({
						// dom: 'Bfrtip',
						// //"dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
						// buttons: [
						// 		{
						// 		    extend: 'pdfHtml5',
						// 		    title: 'category',
						// 		    orientation: 'landscape',
						// 		    pageSize: 'A4',
						// 		    exportOptions: {
						// 		        columns: [0, 1, 2, 3, 4, 5, 6]
						// 		    },
						// 		},
						// 		{
						// 				title: 'category',
						// 				extend: 'excelHtml5',
						// 				exportOptions: {
						// 						columns: [0, 1, 2, 3, 4, 5, 6]
						// 				}
						// 		}
						// ]
				});
				$("div").removeClass("form-inline");
					}
				});
			}
			$(document).on('click', '.edit_data', function(){
				//$('#master_form').show();
				$(".tablehideshow").hide();
        		$(".formhideshow").show();
				var id = $(this).attr('id');
				var name = $('#name_'+id).html();
				var rate=$('#rate_'+id).html();
				var capacity=$('#capacity_'+id).html();
				var descroption=$('#descroption_'+id).html();




				$('#btn_submit').text('Update');
				$('#saveid').val(id);
				$('#name').val(name);
				$('#rate').val(rate);
				$('#capacity').val(capacity);
				$('#descriptiondata').val(descroption);
			});
			$(document).on('click','.delete_data',function(){
			var id1 = $(this).attr('id');
			//$('#saveid').val(id1);
			if (id1 != "") {
				swal({
					title: "Are you sure?",
					text: "You will not be able to recover this imaginary file!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, delete it!",
					cancelButtonText: "No, cancel plz!",
					closeOnConfirm: false,
					closeOnCancel: false
					},
					function(isConfirm) {
						if (isConfirm) {
							$.ajax({
								type:"GET",
								url:"category/destroy/"+id1,
								contentType: false,
								cache:false,
								processData: false,
								dataType:"json",
								success: function(data){
									if(data==100){
										swal("Category Allocate To Room Not Delete At !!!");

									}else{
										swal("Deleted!", "Your Record has been deleted.", "success");
										datashow();
									}

								}
							});
						}else {
							swal("Cancelled", "Your record is safe :)", "error");
						}
					});
			}
			else{
				return false;
			}
		});


		$("#capacity").keypress(function (e) {

     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && e.which !=='-' && (e.which < 48 || e.which > 57)) {

        $("#errmsg").html("Digits Only");
               return false;
    }else{
		$("#errmsg").hide();
	}
   });
   $("#rate").keypress(function (e) {
			console.log('hiii');
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && e.which !=='-' && (e.which < 48 || e.which > 57)) {

        //$("#errmsg").html("Digits Only");
               return false;
    }else{
		$("#errmsg").hide();
	}
   });


   function from_clear(){
	   $('#capacity').val('1');
	   $('#rate').val('0');
	   $('#name').val('');
	   $('#descriptiondata').val('');
	   $('#saveid').val('');
	   $('#btn_submit').text('Save');
   }

   $('#capacity').val('1');
	   $('#rate').val('0');
   $(document).on('blur','#name',function(e){
	   e.preventDefault();

           var category=$(this).val();
           var id=$('#saveid').val();
           var geturl="";
           if(id==""){
            geturl= "checkcategoryname/"+category;
           }else{
            geturl= "checkcategortnameexist/"+category+"/"+id;
           }

            $.ajax({
            type:"GET",
            url:geturl,
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function(data){

                if(data>0){
                   // flag=1;
                    swal("Category Name Alredy Exists Please Enter Another Category Name !!!");
                }else{
                    //flag=0;
                }
            }
        });
		});

});



	</script>
</body>

</html>
