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
                <li class="active">@lang('roomdata.roommaster')</li>
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
                                <h3 class="panel-title">@lang('roomdata.roommaster')</h3>
                                <div class="pull-right">
                                    {{-- <button class="btn btn-success closehideshow" style="background-color:#00B050;">View
                                        Detail</button> --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" id="master_form" name="master_form">
                                        <div class="row">
                                            
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('roomdata.roomno')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <input type="text"  class="form-control" id="roomno" name="roomno" placeholder="@lang('roomdata.roomno')" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('roomdata.roomname')</label>
                                                </div>
                                                <div class="col-sm-3">
                                                        <input type="text"  class="form-control" id="name" name="name" placeholder="@lang('roomdata.roomname')">
                                                        
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label>@lang('roomdata.category')*</label>
                                                </div>
                                                <div class="col-sm-3">
                                                      
                                                        <select id="category" name="category" class="form-control"  required>
                                                                    

                                                        </select>
                                                    
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>@lang('categorydata.description')</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <textarea   id="description" name="description" class="form-control" placeholder="@lang('categorydata.description')"></textarea>

                                                </div>
                                            </div>
                                           
                                        
                                        </div>
                                        <div class="btn-group pull-right">
                                            <input type="hidden" id="saveid" name="saveid" value="" />
                                            <button class="btn btn-primary" id="btn_submit" type="submit">@lang('roomdata.savedata')</button>

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
                  {{--NEWS SECTION--}}
                  <div class="row" >
                    <div class="col-md-12 col-sm-12 col-xs-12 right_side">
                        {{-- START SIMPLE DATATABLE --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">@lang('roomdata.roommaster')</h3>
                                <ul class="panel-controls">
                                    {{-- <li> <!--<button class="btn btn-success btnhideshow" style="background-color:#00B050;">
                                            Add Detail</button></li> --}}
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-12 ">
                                    <div class="table-responsive" id="show_master">
											<table id="roommastertb" class="table table-striped table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th >@lang('roomdata.srno').</th>
                                                            <th >@lang('roomdata.roomno')</th>
                                                            <th >@lang('roomdata.roomname')</th>
                                                            <th >@lang('roomdata.category') </th>
                                                            <th style="display:none;">Category Id </th>
                                                            <th >@lang('categorydata.description')</th>
                                                            <th >@lang('roomdata.action')</th>
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
            var flag=0;
            var flag1=0;
         
            $('.btnhideshow').click(function(){
			$('.tablehideshow').hide();
			  $(".formhideshow").show();
              $('#saveid').val('');
              form_clear();
             
		 });
		 $('#reset').click(function(){
			
			  $('#saveid').val('');
              form_clear();
		 });
         $('#btncancel').click(function(){
            $('#mainform').hide();
              $("#tbl").show();
         });
    
         getMasterSelect("#category");
        function getMasterSelect(selecter) {
            
            $.ajax({
                type:"GET",
                url  : "{{url('showall')}}",
                data:{
                 "_token": "{{ csrf_token() }}",
                },
                dataType : "JSON",
                async : false,
                success: function(data){
                        
                    html = '';
                    var name = '';
         //					if(table_name=="victim_age"){
         //					html += '<option selected  value="" >Select Victim Age</option>';
         //						}else{
                    html += '<option selected disabled value="" >Select</option>';
         //						}
                    for(i=0; i<data.length; i++){
                            var id = '';
                         
                             name = data[i].name;								
                             id = data[i].id;
                       
                          
                    //alert(name);	
                    html += '<option value="'+id+'">'+name+'</option>';
                    }
                    $(selecter).html(html);
                }
            });
        }
         $('#master_form').on('submit', function(event){
                  event.preventDefault();
               var id= $('#saveid').val();
              // alert(flag+""+flag1);
             //  if(flag==0 && flag1==0){
               if(id==""){
                $.ajax({
                    url:"{{ route('room.store') }}",
                    method:"POST",
                    data: new FormData(this),
                    contentType: false,
                    cache:false,
                    processData: false,
                    dataType:"json",
                    success:function(data)
                    {
                        if(data=='100'){
                                    swal("RoomNo  Alredy Exists Please Enter Another Room No !!!");	
                                }else{
                                    form_clear(); 
                        successTost("Record Save Success Fully");
                        datashow();  
                                }
                    }
                });
               }else{
                docid=$('#saveid').val(); 
                        $.ajax({
                            url:"{{ route('room.update') }}",
                            method:"POST",
                            data:new FormData(this),
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType:"json",
                            success:function(data)
                            {
                                if(data=='100'){
                                    swal("RoomNo  Alredy Exists Please Enter Another Room No !!!");	
                                }else{
                                    datashow(); 
                                    form_clear(); 
                                    toastr.success("Record Update Success Fully");
                          
                                }
                           
                            }
                        });
               }
              
              
               datashow();  
             
			 // $('#saveid').val('');
              
            // }else{
            //     swal("RoomNo OR RoomName Alredy Exists Please Enter Another Room No RoomName !!!");	
            // }
             
         });
        datashow();
            function datashow(){
                
                $.ajax({
                    url:"{{ url('getroomdata') }}",
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
                        var tb=$('#roommastertb').DataTable();
                        tb.destroy();
                           $('#tablebody').html('');
                    var table="";
                    var sr=0;
                    for(var i=0;i<data.length;i++)
                    {
                        var description='';
                        var roomname='';
                        if(data[i].description==null){
                            description='';
                        }else{
                            description= data[i].description;
                        }
                        if(data[i].roomname==null){
                            roomname='';
                        }else{
                            roomname= data[i].roomname;
                        }

                        sr=sr+1;
                        table+='<tr>'+
                        '<td style="width:5%" id="id_'+data[i].id+'">'+sr+'</td>'+
                        '<td style="width:10%" id="roomno_'+data[i].id+'">'+data[i].roomno+'</td>'+
                        '<td style="width:15%" id="roomname_'+data[i].id+'">'+roomname+'</td>'+
                        '<td style="width:20%" id="categoryname_'+data[i].id+'">'+data[i].categoryname+'</td>'+
                        '<td style="display:none;" id="categoryid_'+data[i].id+'">'+data[i].categoryid+'</td>'+
                        '<td style="width:20%" id="description_'+data[i].id+'">'+description+'</td>'+
                        '<td style="width:10%" ><button name="edit"  class="edit_data btn btn-xs  btn-primary" id='+data[i].id+'><i class="fa fa-edit"></i></button> &nbsp;&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id='+data[i].id+'><i class="fa fa-trash"></i></button></td>'+
                        '</tr>' ;
                    }
                    $('#tablebody').append(table);
                    $('#roommastertb').DataTable({});
                    }
                });
            }
            $(document).on('click', '.edit_data', function(){
                $(".tablehideshow").hide();
        		$(".formhideshow").show();
                var id = $(this).attr('id');
                var roomno = $('#roomno_'+id).html();
                var roomname=$('#roomname_'+id).html();
                var categoryid=$('#categoryid_'+id).html();
                var description=$('#description_'+id).html();
    
                $('#saveid').val(id);
                $('#roomno').val(roomno);
                $('#name').val(roomname);
                $('#category').val(categoryid).trigger('change');
                $('#description').val(description);
                $('#btn_submit').text("Update");
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
                                url:"room/destroy/"+id1,
                                contentType: false,
                                cache:false,
                                processData: false,
                                dataType:"json",
                                success: function(data){
                                    if(data=='100'){
                                        swal("Room Allocate To Visiter Not Deleted !!!");
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
        $(document).on('blur','#roomno',function(){
           var roomno=$(this).val();
           var id=$('#saveid').val();
           var geturl="";
           if(id==""){
            geturl= "checkroomno/"+roomno;
           }else{
            geturl= "checkroomnoexist/"+roomno+"/"+id;
           }
           
            $.ajax({
            type:"GET",
            url:geturl,
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function(data){
                
                if(data=='100'){
                   // flag1=1;
                    swal("Roomno Alredy Exists Please Enter Another Roomno !!!");
                }else{
                    //flag1=0;
                }
            }
        });
        });

        $(document).on('blur','#name',function(){
           var roomname=$(this).val();
           var id=$('#saveid').val();
          // alert('hiii');
           var geturl="";
           if(id==""){
            geturl= "checkroomname/"+roomname;
           }else{
            geturl= "checkroomnameexist/"+roomname+"/"+id;
           }
           
            $.ajax({
            type:"GET",
            url:geturl,
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function(data){
              
                if(data=='100'){

                   // flag=1;
                    swal("Roomname Alredy Exists Please Enter Another Roomname !!!");
                }else{
                  //  flag=0;
                }
            }
        });
        });
        function form_clear(){
            $('#roomno').val('');
            $('#name').val('');
            $('#category').val('').trigger('change');
            $('#description').val('');
            $('#btn_submit').text("Save");
        }





        });

       

    
        
    
    </script>
</body>

</html>
