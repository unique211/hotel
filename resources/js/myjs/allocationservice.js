$(document).ready(function() {

    $('#tbl').show();
    $('#mainform').hide();

    $('.datetimepicker').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',

    });
    var date = new Date();
    $(document).on('click', '#btnadd', function(e) {
        e.preventDefault();
        $('#tbl').hide();
        $('#mainform').show();
        $('#mainform')[0].reset();
        date = date.toString('dd/MM/yyyy hh:mm');
        $("#datetime").val(date);
        $('#servicetbtbody').html('');
        $('#show_master1').html('');
    });
    $('#btncancel').click(function() {
        $('#mainform').hide();
        $("#tbl").show();
        $('#saveid').val('');
    });

    // date = date.toString('dd/MM/yyyy hh:mm:ss');





    $('.datetimepicker').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',

    });

    console.log(date);
    date = date.toString('dd/MM/yyyy hh:mm:ss');
    $("#datetime").val(date);

    get_allocateroom();

    function get_allocateroom() {


        $.ajax({
            url: getallocateroom,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": csrf_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {

                html = '';
                var name = '';

                html += '<option selected disabled value="" >Select</option>';

                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].roomno;
                    id = data[i].roomid;


                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#allocaterom').html(html);
            }
        });
    }
    getallservices();

    function getallservices() {
        $.ajax({
            url: getallservice,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": csrf_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                html = '';
                var name = '';
                //					if(table_name=="victim_age"){
                //					html += '<option selected  value="" >Select Victim Age</option>';
                //						}else{
                html += '<option selected disabled value="" >Select</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].servicename;
                    id = data[i].id;


                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#servicename').html(html);

            }
        });
    }

    $(document).on("change", "#servicename", function(e) {
        e.preventDefault();
        var id = $(this).val();
        $.ajax({
            url: getrateofservice + "/" + id,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": csrf_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                if (data.length > 0) {
                    $('#rate').val(data[0].rate);
                }
            }
        });



    });

    /*--------for Service Detalis  save in Html Table---------------*/
    $(document).on('click', "#addservice", function(e) {
        e.preventDefault();


        var datetime = $("#datetime").val();
        var serviceid = $("#servicename").val();
        var servicename = $("#servicename option:selected").text();
        var rate = $("#rate").val();
        var qty = $("#qty").val();
        var total = 0;
        if (qty > 0) {
            total = parseFloat(rate) * parseFloat(qty);
        } else {
            total = 0;
        }


        var row_id = $('#doc_row_id').val();
        row_id = parseInt(row_id) + parseInt(1);
        var save_update = $('#doc_save_update').val();
        var dlt = 0;

        var r1 = $('table#servicetb').find('tbody').find('tr');
        var r = r1.length;
        for (var i = 0; i < r; i++) {

            var tblservice = $(r1[i]).find('td:eq(2)').html();
            var tblqty = $(r1[i]).find('td:eq(5)').html();
            var tbltotal = $(r1[i]).find('td:eq(6)').html();

            if (save_update == "") {
                if (serviceid == tblservice) {
                    save_update = i + 1;


                    qty = parseInt(qty) + parseInt(tblqty);
                    total = parseInt(total) + parseInt(tbltotal);

                }
            }
        }

        // if (dlt > 0) {
        //     if (dlt == 1) {
        //         swal("Selected Document Already Exists !!!");
        //     }
        //     var dlt = 0;

        // } else 
        if (serviceid != null && qty > 0) {
            if (save_update != "") {


                $('#datetime_' + save_update).html(datetime);
                $('#serviceid_' + save_update).html(serviceid);
                $('#servicename_' + save_update).html(servicename);
                $('#rate_' + save_update).html(rate);
                $('#qty_' + save_update).html(qty);
                $('#total_' + save_update).html(total);
                $('#doc_save_update').val('');


            } else {


                var html = '<tr class="project_tab_add_row" id="del_' + row_id + '" >' +
                    '<td style="display:none;" >' + row_id + '</td>' +
                    '<td  id="datetime_' + row_id + '">' + datetime + '</td>' +
                    '<td  style="display:none;" id="serviceid_' + row_id + '">' + serviceid + '</td>' +
                    '<td  id="servicename_' + row_id + '">' + servicename + '</td>' +
                    '<td  id="rate_' + row_id + '">' + rate + '</td>' +
                    '<td  id="qty_' + row_id + '">' + qty + '</td>' +
                    '<td  id="total_' + row_id + '">' + total + '</td>' +
                    '<th><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  >Edit</button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  >delete</button>' +
                    '</tr>';

                $("#servicetbtbody").append(html);
                $('#doc_row_id').val(row_id);
                $('#doc_save_update').val('');


            }
        } else {
            swal("Please Select Any Service !!!");
        }

        // $("#datetime").val('');
        $("#servicename").val('');
        $("#rate").val('');
        $("#qty").val('');

    });
    $(document).on('click', '.regional_delete_data1', function(e) {
        e.preventDefault();
        var save_update = $(this).attr('id');
        save_update = save_update.split("_");
        if (save_update[1] != "") {
            $("#del_" + save_update[1]).remove();
            $('#doc_save_update').val('');

        }

    });
    $(document).on('click', '.doc_edit_data1', function(e) {
        e.preventDefault();

        var row = $(this).attr('id');

        var datetime = $("#datetime_" + row).html();
        var serviceid = $("#serviceid_" + row).html();
        // var servicename = $("#servicename_" + row).html();
        var rate = $("#rate_" + row).html();
        var qty = $("#qty_" + row).html();

        $("#datetime").val(datetime);
        $("#servicename").val(serviceid);
        $("#rate").val(rate);
        $("#qty").val(qty);
        $('#doc_save_update').val(row);


    });
    $('#master_form').on('submit', function(event) {
        event.preventDefault();
        var id = $('#saveid').val();

        if (id == "") {
            var r1 = $('table#servicetb').find('tbody').find('tr');
            var r = r1.length;
            if (r > 0) {
                $.ajax({
                    url: allocateservices,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if (data > 0) {

                            var r1 = $('table#servicetb').find('tbody').find('tr');
                            var r = r1.length;
                            var tr = "";
                            var allocate_sid = data;

                            for (var i = 0; i < r; i++) {

                                var t = document.getElementById('docupload');
                                var datetime = $(r1[i]).find('td:eq(1)').html();
                                var serviceid = $(r1[i]).find('td:eq(2)').html();
                                var rate = $(r1[i]).find('td:eq(4)').html();
                                var qty = $(r1[i]).find('td:eq(5)').html();
                                var form_data = new FormData();
                                form_data.append('allocatesid', allocate_sid);
                                form_data.append('datetime', datetime);
                                form_data.append('serviceid', serviceid);
                                form_data.append('rate', rate);
                                form_data.append('qty', qty);
                                form_data.append('_token', csrf_token);
                                $.ajax({
                                    url: allocateservicesdetalis,
                                    method: "POST",
                                    data: form_data,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function(data) {

                                    }
                                });
                            }

                            toastr.success("Record Saved Success Fully");
                            $(".tablehideshow").show();
                            $(".formhideshow").hide();
                            getservicedetalis();
                            $("#servicetbtbody").html('')
                        }


                    }
                });
            } else {
                swal("Please Select Any Service");
            }
        } else {

            $.ajax({
                url: "allocateservicedetalisdata/destroy/" + id,
                beforeSend: function() {

                },
                success: function(data) {

                }
            });

            $.ajax({
                url: updateurl,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {


                    var r1 = $('table#servicetb').find('tbody').find('tr');
                    var r = r1.length;
                    var tr = "";
                    var allocate_sid = id;

                    for (var i = 0; i < r; i++) {

                        var t = document.getElementById('docupload');
                        var datetime = $(r1[i]).find('td:eq(1)').html();
                        var serviceid = $(r1[i]).find('td:eq(2)').html();
                        var rate = $(r1[i]).find('td:eq(4)').html();
                        var qty = $(r1[i]).find('td:eq(5)').html();
                        var form_data = new FormData();
                        form_data.append('allocatesid', allocate_sid);
                        form_data.append('datetime', datetime);
                        form_data.append('serviceid', serviceid);
                        form_data.append('rate', rate);
                        form_data.append('qty', qty);
                        form_data.append('_token', csrf_token);
                        $.ajax({
                            url: allocateservicesdetalis,
                            method: "POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {

                            }
                        });
                    }
                    toastr.success("Record Updated Success Fully");
                    $(".tablehideshow").show();
                    $(".formhideshow").hide();
                    getservicedetalis();
                    $("#servicetbtbody").html('')
                }
            });


        }


    });
    $(document).on('change', '#allocaterom', function(e) {
        e.preventDefault();
        var roomno = $(this).val();

        $.ajax({
            url: getvistoerinfo + "/" + roomno,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": csrf_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';

                html = '<table  id="mytable"  class="table table-striped table-bordered">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="display:none;">Visiter id  </th>' +
                    '<th>Visiter Name  </th>' +
                    '<th>Address  </th>' +
                    '<th>Mobileno  </th>' +
                    '</tr>' +
                    '</thead><tbody>';

                for (var i = 0; i < data.length; i++) {
                    $('#visiterid').val(data[i].id);
                    html += '<tr>' +
                        '<td style="display:none;">' + data[i].id + ' </td>' +
                        '<td>' + data[i].visitername + ' </td>' +
                        '<td>' + data[i].address + '  </td>' +
                        '<td>' + data[i].mobileno + '</td>' +

                        '</tr>';
                }


                html += '</tbody></table>';
                $('#show_master1').html(html);
            }
        });

    });

    getservicedetalis();

    function getservicedetalis() {

        $.ajax({
            url: getallocateroomservices,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": csrf_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var sr = 0;
                var table1 = $('#allocatesevicetb').DataTable();
                table1.destroy();
                $('#tablebody').html('');
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        sr = sr + 1;
                        html += '<tr>' +
                            '<td style="width:40%;" id="id_' + data[i].id + '">' + sr + '</td>' +
                            '<td style="display:none;" id="roomid_' + data[i].id + '">' + data[i].roomid + '</td>' +
                            '<td style="width:40%;" id="roomno_' + data[i].id + '">' + data[i].roomno + '</td>' +
                            '<td ><input type="button" name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + '> &nbsp;&nbsp;<input type="button" name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '></td>' +
                            '</tr>';
                    }

                }
                $('#tablebody').append(html);
                $('#allocatesevicetb').DataTable({});
                $("div").removeClass("form-inline");

            }
        });

    }

    $(document).on('click', '.edit_data', function(e) {
        e.preventDefault();
        $(".tablehideshow").hide();
        $(".formhideshow").show();
        var id = $(this).attr('id');
        var roomid = $('#roomid_' + id).html();

        $('#allocaterom').val(roomid).trigger('change');
        $('#saveid').val(id);
        $.ajax({
            url: "allocateservicedetalisdata/" + id + "/edit",
            dataType: "json",
            success: function(data) {

                var row_id = 0;
                var total = 0;
                $("#servicetbtbody").html('');
                for (var i = 0; i < data.length; i++) {
                    row_id = row_id + 1;
                    if (data[i].rate > 0 && data[i].qty > 0) {
                        total = parseFloat(data[i].rate) * parseFloat(data[i].qty);
                    } else {
                        total = 0;
                    }
                    var date = data[i].datetime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var datetime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                    var html = '<tr class="project_tab_add_row" id="del_' + row_id + '" >' +
                        '<td style="display:none;" >' + row_id + '</td>' +
                        '<td  id="datetime_' + row_id + '">' + datetime + '</td>' +
                        '<td  style="display:none;" id="serviceid_' + row_id + '">' + data[i].serviceid + '</td>' +
                        '<td  id="servicename_' + row_id + '">' + data[i].servicename + '</td>' +
                        '<td  id="rate_' + row_id + '">' + data[i].rate + '</td>' +
                        '<td  id="qty_' + row_id + '">' + data[i].qty + '</td>' +
                        '<td  id="total_' + row_id + '">' + total + '</td>' +
                        '<th><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  >Edit</button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  >delete</button>' +
                        '</tr>';

                    $("#servicetbtbody").append(html);
                    $('#doc_row_id').val(row_id);
                }
            }
        });


    });

    $(document).on('click', '.delete_data', function() {
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
                            type: "GET",
                            url: "allocationservice/destroy/" + id1,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                //alert(data);
                                swal("Deleted!", "Your Record has been deleted.", "success");
                                getservicedetalis();
                            }
                        });

                    } else {
                        swal("Cancelled", "Your record is safe :)", "error");
                    }
                });
        } else {
            return false;
        }
    });

    function form_clear() {
        $('#allocaterom').val('').trigger('change');
        $('#servicename').val('').trigger('change');
        $('#rate').val('');
        $('#qty').val('');
        $('#servicetbtbody').html('');
    }

    $(document).on('click', '#reset', function() {
        form_clear();
    });
});