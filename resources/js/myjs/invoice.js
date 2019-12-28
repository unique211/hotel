$(document).ready(function() {
    var totalroomamount = 0;
    var totalserviceamount = 0;
    var grandtotal = 0;
    var flag = 0;
    $('#mainform').hide();
    $("#tbl").show();

    $('#date').datepicker({
        'todayHighlight': true,
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
    var date = new Date();
    date = date.toString('dd/MM/yyyy');
    $("#date").val(date);


    $(document).on('blur', '#checkroomno', function(e) {
        e.preventDefault();
        getallocateroom();
    });
    $(document).on('change', '#vistername', function(e) {
        e.preventDefault();
        // getallocateroom();
    });
    $('#btnadd').click(function() {
        $('#mainform').show();
        $("#tbl").hide();
        $('#saveid').val('');
        $('#roomdata').html('');
        $('#mainform')[0].reset();
    });
    $('#btncancel').click(function() {
        $('#mainform').hide();
        $("#tbl").show();
        $('#saveid').val('');
        $('#roomdata').html('');
        $('#mainform')[0].reset();
    });


    function getallocateroom() {
        var roomno = $('#checkroomno').val();
        var vistername = $('#vistername').val();
        var saveid = $('#saveid').val();

        if (saveid != "") {
            if (roomno > 0 && vistername > 0) {


                $.ajax({
                    url: invoicegeteditdata + "/" + roomno + "/" + vistername,
                    type: "GET",
                    //   data: new FormData(this),
                    data: {
                        "_token": doc_token,
                    },
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {

                        var html = '';
                        var sr = 0;
                        html += '<table id="roomdata" class="table table-striped">' +
                            '<thead>' +
                            '<tr>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Roomno</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">roomid</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">RoomCategory</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">categoryid</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In time</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check out Time</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Days</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Checkout Id</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                        for (var i = 0; i < data.length; i++) {
                            sr = sr + 1;
                            // alert('from here');

                            var days = getdatediff(data[i].checkintime, data[0].checkouttime);
                            days = parseInt(days) + parseInt(1);
                            var amount = parseFloat(data[0].roomrate) * parseFloat(days);

                            html += '<tr><td id="roomno_' + sr + '">' + data[0].roomno + '</td>' +
                                '<td style="display:none;" id="roomid_' + sr + '">' + data[0].roomid + '</td>' +
                                '<td id="categoryname_' + sr + '">' + data[0].categoryname + '</td>' +
                                '<td  style="display:none;" id="categoryid_' + sr + '">' + data[0].categoryid + '</td>' +
                                '<td id="roomrate_' + sr + '">' + data[0].roomrate + '</td>' +
                                '<td id="checkintime_' + sr + '">' + data[0].checkintime + '</td>' +
                                '<td id="checkouttime_' + sr + '">' + data[0].checkouttime + '</td>' +
                                '<td id="days_' + sr + '">' + days + '</td>' +
                                '<td  style="display:none;" id="checkoutid_' + sr + '">' + data[0].checkoutid + '</td>' +
                                '<td   id="amount_' + sr + '">' + amount + '</td>' +
                                '</tr>';

                        }
                        html += '</tbody><tfoot>' +
                            ''
                        '</tfoot></table>';
                        $('#show_master1').html(html);
                    }
                });

            }
        } else {
            if (roomno > 0 && vistername > 0) {

                $.ajax({
                    url: searchroom + "/" + roomno + "/" + vistername,
                    type: "GET",
                    //   data: new FormData(this),
                    data: {
                        "_token": doc_token,
                    },
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        $('#show_master1').html('');
                        var html = '';
                        var sr = 0;
                        var amout = 0;
                        html += '<table id="roomdata" class="table table-striped">' +
                            '<thead>' +
                            '<tr>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Roomno</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">roomid</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">RoomCategory</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">categoryid</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In time</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check out Time</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Days</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Checkout Id</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                        for (var i = 0; i < data.length; i++) {
                            sr = sr + 1;

                            var days = getdatediff(data[i].checkintime, data[0].checkouttime);
                            amout = parseFloat(data[i].roomrate) * parseFloat(days);
                            html += '<tr><td id="roomno_' + sr + '">' + data[0].roomno + '</td>' +
                                '<td style="display:none;" id="roomid_' + sr + '">' + data[0].roomid + '</td>' +
                                '<td id="categoryname_' + sr + '">' + data[0].categoryname + '</td>' +
                                '<td  style="display:none;" id="categoryid_' + sr + '">' + data[0].categoryid + '</td>' +
                                '<td id="roomrate_' + sr + '">' + data[0].roomrate + '</td>' +
                                '<td id="checkintime_' + sr + '">' + data[0].checkintime + '</td>' +
                                '<td id="checkouttime_' + sr + '">' + data[0].checkouttime + '</td>' +
                                '<td   id="days_' + sr + '">' + days + '</td>' +
                                '<td  style="display:none;" id="checkoutid_' + sr + '">' + data[0].checkoutid + '</td>' +
                                '<td   id="amt_' + sr + '">' + amout + '</td>' +
                                '</tr>';

                        }
                        html += '</tbody></table>';
                        $('#show_master1').html(html);
                    }
                });
            }
        }



    }


    getMasterSelect("#vistername");

    function getMasterSelect(selecter) {

        $.ajax({
            type: "GET",
            url: getdropdown,
            data: {
                "_token": doc_token,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                html = '';
                var name = '';

                html += '<option selected disabled value="" >Select</option>';

                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].visitername;
                    id = data[i].id;


                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            }
        });
    }
    $('#master_form').on('submit', function(event) {
        event.preventDefault();
        var id = $('#saveid').val();

        var invioceid = '';
        if (id == "") {
          
                $.ajax({
                    url: inserturl,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {

                        if(data=='0'){
                            swal({
                                title: "Invoice No Already Exists!!!",
                            });
                        }else{

                        invioceid = data;
                        var r1 = $('table#roomdata').find('tbody').find('tr');
                        var r = r1.length;
                        var tr = "";

                        for (var i = 0; i < r; i++) {

                            var t = document.getElementById('roomdata');
                            var roomid = $(r1[i]).find('td:eq(1)').html();
                            var categoryid = $(r1[i]).find('td:eq(3)').html();
                            var checkintime = $(r1[i]).find('td:eq(5)').html();
                            var checkoutime = $(r1[i]).find('td:eq(6)').html();
                            var checkoutid = $(r1[i]).find('td:eq(10)').html();
                            var visterid = $('#vistername').val();
                            var form_data = new FormData();
                            form_data.append('roomid', roomid);
                            form_data.append('invioceid', invioceid);
                            form_data.append('categoryid', categoryid);
                            form_data.append('checkintime', checkintime);
                            form_data.append('checkouttime', checkoutime);
                            form_data.append('checkoutid', checkoutid);
                            form_data.append('visterid', visterid);
                            form_data.append('_token', doc_token);

                            $.ajax({


                                type: "POST",
                                url: invoice_detalis,
                                dataType: "JSON",
                                async: false,
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType: "json",
                                success: function(data) {



                                }



                            });
                        }

                        datashow();
                        toastr.success("Record save Success Fully");

                        $('#saveid').val('');
                        $('.formhideshow').hide();
                        $('.tablehideshow').show();
                    }

                    }

                });
            
        } else {
            invioceid = $('#saveid').val();
            $.ajax({
                url: updateurl,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    var r1 = $('table#roomdata').find('tbody').find('tr');
                    var r = r1.length;
                    var tr = "";

                    for (var i = 0; i < r; i++) {

                        var t = document.getElementById('roomdata');
                        var roomid = $(r1[i]).find('td:eq(1)').html();
                        var categoryid = $(r1[i]).find('td:eq(3)').html();
                        var checkintime = $(r1[i]).find('td:eq(5)').html();
                        var checkoutime = $(r1[i]).find('td:eq(6)').html();
                        var checkoutid = $(r1[i]).find('td:eq(8)').html();
                        var visterid = $('#vistername').val();
                        var form_data = new FormData();
                        form_data.append('roomid', roomid);
                        form_data.append('invioceid', invioceid);
                        form_data.append('categoryid', categoryid);
                        form_data.append('checkintime', checkintime);
                        form_data.append('checkouttime', checkoutime);
                        form_data.append('checkoutid', checkoutid);
                        form_data.append('visterid', visterid);
                        form_data.append('_token', doc_token);

                        $.ajax({


                            type: "POST",
                            url: invoice_detalis,
                            dataType: "JSON",
                            async: false,
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {



                            }



                        });
                    }
                    datashow();
                    toastr.success("Record Update Success Fully");


                    $('#saveid').val('');
                    $('.formhideshow').hide();
                    $('.tablehideshow').show();

                }
            });

        }

    });
    datashow();

    function datashow() {
        $.ajax({
            url: getallinvoice,
            type: "GET",
            data: {
                "_token": doc_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var sr = 0;
                var table1 = $('#invoicetb').DataTable();
                table1.destroy();
                $('#tablebody').html('');

                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        sr = sr + 1;
                        var from_time = data[i].invoicedate.split('-');
                        var from_date = from_time[2] + '/' + from_time[1] + '/' + from_time[0];

                        html += '<tr><td id="srno_' + data[i].id + '">' + sr + '</td>' +
                            '<td id="invoiceno_' + data[i].id + '">' + data[i].invoiceno + '</td>' +
                            '<td id="invoicedate_' + data[i].id + '">' + from_date + '</td>' +
                            //'<td id="checkout_roomno_' + sr + '">' + data[i].checkout_roomno + '</td>' +
                            '<td id="visitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                            '<td  style="display:none;" id="visiterid_' + data[i].id + '">' + data[i].visiterid + '</td>' +
                            '<td  style="display:none;" id="checkout_roomno_' + data[i].id + '">' + data[i].checkout_roomno + '</td>' +
                            '<td  style="display:none;" id="paidamt_' + data[i].id + '">' + data[i].paidamt + '</td>' +
                            '<td  style="display:none;" id="paymentmode_' + data[i].id + '">' + data[i].paymentmode + '</td>' +
                            '<td  style="display:none;" id="remark_' + data[i].id + '">' + data[i].remark + '</td>' +
                            '<td ><button type="button" name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + ' checkvistreid=' + data[i].visiterid + '><i class="fa fa-edit"></i></button> &nbsp;&nbsp;<button type="button" name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                            '</tr>';
                    }
                    $('#tablebody').append(html);
                    $('#invoicetb').DataTable({});
                    $("div").removeClass("form-inline");
                }
            }
        });
    }
    $(document).on('click', '.edit_data', function() {

        $('.formhideshow').show();
        $('.tablehideshow').hide();
        var id = $(this).attr('id');
        //   alert(id);

        var invoiceno = $('#invoiceno_' + id).html();
        var invoicedate = $('#invoicedate_' + id).html();
        var checkout_roomno = $('#checkout_roomno_' + id).html();
        var visitername = $('#visitername_' + id).html();
        var visiterid = $('#visiterid_' + id).html();
        var paidamt = $('#paidamt_' + id).html();
        var paymentmode = $('#paymentmode_' + id).html();
        var remark = $('#remark_' + id).html();



        $('#saveid').val(id);
        $('#invoiceno').val(invoiceno);
        $('#date').val(invoicedate);
        $('#vistername').val(visiterid).trigger('change');
        $('#paidamt').val(paidamt);
        $('#amtmode').val(paymentmode).trigger('change');
        if(remark=="null"){
            remark="";
        }
        $('#remark').val(remark);

       
        if (checkout_roomno > 0) {
            $('#checkdata').prop('checked', true);

            $.ajax({
                url: geteditroomnno + "/" + id,
                type: "GET",
                data: {
                    "_token": doc_token,
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
                    $('#roomno').html(html);
                    $('#roomno').val(checkout_roomno).trigger('change');

                }

            });

            $('.roominfo').show();
        } else {
            $('#checkdata').prop('checked', false);
            $('.roominfo').hide();
        }

        // getallocateroom();



        $.ajax({
            url: geteditvisitor + "/" + id,
            type: "GET",
            data: {
                "_token": doc_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
               
                var html = '';
                var sr = 0;
                var amount = 0;
                totalroomamount = 0;
                totalserviceamount = 0;
                grandtotal = 0;
                $('#show_master1').html('');
                html += '<table id="roomdata" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">ID</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Roomno</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">roomid</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">RoomCategory</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">categoryid</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In time</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check out Time</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Days</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Checkout Id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Extra service</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    var date = data[i].checkintime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                    var date = data[i].checkouttime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                    //alert("checkintime" + checkintime + "checkouttime" + checkouttime);
                    var days = getdatediff(checkintime, checkouttime);
                    //alert(days);
                    amount = parseFloat(data[i].roomrate) * parseFloat(days);
                    totalroomamount = parseFloat(totalroomamount) + parseFloat(amount);
                    totalserviceamount = parseFloat(totalserviceamount) + parseFloat(data[i].extraserviceamt);
                    grandtotal = parseFloat(totalroomamount) + parseFloat(totalserviceamount);


                    html += '<tr>' +
                        '<td id="roomno_' + sr + '">' + data[i].roomno + '</td>' +
                        '<td style="display:none;" id="roomid_' + sr + '">' + data[i].roomid + '</td>' +
                        '<td id="categoryname_' + sr + '">' + data[i].categoryname + '</td>' +
                        '<td  style="display:none;" id="categoryid_' + sr + '">' + data[i].categoryid + '</td>' +
                        '<td id="roomrate_' + sr + '">' + data[i].roomrate + '</td>' +
                        '<td id="checkintime_' + sr + '">' + checkintime + '</td>' +
                        '<td id="checkouttime_' + sr + '">' + checkouttime + '</td>' +
                        '<td   id="days_' + sr + '">' + days + '</td>' +
                        '<td   id="amt_' + sr + '">' + amount + '</td>' +
                        '<td   id="extraserviceamt_' + sr + '">' + data[i].extraserviceamt + '</td>' +
                        '<td  style="display:none;" id="checkoutid_' + sr + '">' + data[i].checkoutid + '</td>' +
                        '</tr>';

                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
                $('#totalamt').val(grandtotal);
            }
        });
       
        $.ajax({
            url: geteditserviceinfo + "/" + id,
            type: "GET",
            data: {
                "_token": doc_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var sr = 0;
                var html = '';
            
                $('#show_master2').html('');

                if (data.length > 0) {
                    $('#extraservicedata').show();
                  
                    html += '<table id="servicedata" class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room No</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Date</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Service Name </th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Rate</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">qty</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    for (var j = 0; j < data.length; j++) {
                        sr = sr + 1;
                        html += '<tr><td id="roomno_' + sr + '">' + data[j].roomno + '</td>'+
                        '<td id="datetime_' + sr + '">' + data[j].datetimedata + '</td>' +
                            '<td id="servicename_' + sr + '">' + data[j].servicename + '</td>' +
                            '<td   id="servicerate_' + sr + '">' + data[j].rate + '</td>' +
                            '<td   id="serviceqty_' + sr + '">' + data[j].qty + '</td>' +
                            '<td   id="totalsum_' + sr + '">' + data[j].sum + '</td>' +
                            '</tr>';
                    }
                    html += '</tbody></table>';
                    $('#show_master2').html(html);
                } else {
                    $('#extraservicedata').hide();
                }
            }
        });


    });

    // function getdatediff(checktime, cheout) {



    //     var checktime1 = checktime.split(' ');
    //     var cheout1 = cheout.split(' ');
    //     checktime = checktime1[0];
    //     cheout = cheout1[0];


    //     var firstdate1 = checktime.split("/");
    //     var enddate1 = cheout.split("/");

    //     var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
    //     var firstDate = new Date(firstdate1[2], firstdate1[1], firstdate1[0]);
    //     var secondDate = new Date(enddate1[2], enddate1[1], enddate1[0]);


    //     var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));


    //     return diffDays;
    // }
    function getdatediff(checktime, cheout) {
      //  var checktime = $('#checktime').val();
        //var cheout = $('#checkouttime').val();
        // alert("checktime" + checktime + "cheout" + cheout);

        var checktime1 = checktime.split(' ');
        var cheout1 = cheout.split(' ');
        var checktime = checktime1[0];

        cheout = cheout1[0];
        var checkouttime = cheout1[1];



        var firstdate1 = checktime.split("/");
        var enddate1 = cheout.split("/");

        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var firstDate = new Date(firstdate1[2], firstdate1[1], firstdate1[0]);
        var secondDate = new Date(enddate1[2], enddate1[1], enddate1[0]);


        var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));


        if (changet > checktime) {

            diffDays = diffDays + 1;
        }
        if (changet < checkouttime) {

            diffDays = diffDays + 1;
        }
        return diffDays;

       // $('#noofdays').val(diffDays);


    }

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
                            url: "invoice/destroy/" + id1,
                            beforeSend: function() {

                            },
                            success: function(data) {
                                swal("Deleted!", "Your Record has been deleted.", "success");
                                datashow();
                            }
                        })


                    } else {
                        swal("Cancelled", "Your record is safe :)", "error");
                    }
                });
        } else {
            return false;
        }
    });


    /*-----change event of visitor ---------*/
    $(document).on('change', '#vistername', function(e) {
        e.preventDefault();
        var id1 = $(this).val();
        $.ajax({
            url: getvisitorbookedroom + "/" + id1,
            type: "GET",
            data: {
                "_token": doc_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {

                $('#show_master1').html('');
                var html = '';
                var sr = 0;
                var amount = 0;
                totalroomamount = 0;
                totalserviceamount = 0;
                grandtotal = 0;
                html += '<table id="roomdata" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">ID</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Roomno</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">roomid</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">RoomCategory</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">categoryid</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In time</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check out Time</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Days</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Checkout Id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Extra service</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    var date = data[i].checkintime;
                    if (date != "") {
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                    }
                    var date = data[i].checkouttime;
                    if (date != "") {
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                        // alert(checkintime + "" + checkouttime);
                    }
                    var days = getdatediff(checkintime, checkouttime);


                    amount = parseFloat(data[i].roomrate) * parseFloat(days);
                    totalroomamount = parseFloat(totalroomamount) + parseFloat(amount);
                    totalserviceamount = parseFloat(totalserviceamount) + parseFloat(data[i].extraserviceamt);
                    grandtotal = parseFloat(totalroomamount) + parseFloat(totalserviceamount);
                    html += '<tr>' +
                        '<td id="roomno_' + sr + '">' + data[i].roomno + '</td>' +
                        '<td style="display:none;" id="roomid_' + sr + '">' + data[i].roomid + '</td>' +
                        '<td id="categoryname_' + sr + '">' + data[i].categoryname + '</td>' +
                        '<td  style="display:none;" id="categoryid_' + sr + '">' + data[i].categoryid + '</td>' +
                        '<td id="roomrate_' + sr + '">' + data[i].roomrate + '</td>' +
                        '<td id="checkintime_' + sr + '">' + checkintime + '</td>' +
                        '<td id="checkouttime_' + sr + '">' + checkouttime + '</td>' +
                        '<td   id="days_' + sr + '">' + days + '</td>' +
                        '<td   id="amt_' + sr + '">' + amount + '</td>' +
                        '<td   id="extraserviceamt_' + sr + '">' + data[i].extraserviceamt + '</td>' +
                        '<td  style="display:none;" id="checkoutid_' + sr + '">' + data[i].checkoutid + '</td>' +
                        '</tr>';

                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
                $('#totalamt').val(grandtotal);
            }
        });
        $.ajax({
            url: getroomwiseserviceinfo + "/" + id1,
            type: "GET",
            data: {
                "_token": doc_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var sr = 0;
                var html = '';
                $('#show_master2').html('');

                if (data.length > 0) {
                    $('#extraservicedata').show();
                    html += '<table id="servicedata" class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room No</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Date</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Service Name </th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Rate</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">qty</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    for (var j = 0; j < data.length; j++) {
                        sr = sr + 1;

                        html += '<tr><td id="roomno_' + sr + '">' + data[j].roomno + '</td>' +
                        '<td id="datetime_' + sr + '">' + data[j].datetimedata + '</td>' +
                            '<td id="servicename_' + sr + '">' + data[j].servicename + '</td>' +
                            '<td   id="servicerate_' + sr + '">' + data[j].rate + '</td>' +
                            '<td   id="serviceqty_' + sr + '">' + data[j].qty + '</td>' +
                            '<td   id="totalsum_' + sr + '">' + data[j].sum + '</td>' +
                            '</tr>';
                    }
                    html += '</tbody></table>';
                    $('#show_master2').html(html);
                } else {
                    $('#extraservicedata').hide();
                }
            }
        });
        $.ajax({
            url: getallocateroominfo + "/" + id1,
            type: "GET",
            data: {
                "_token": doc_token,
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
                $('#roomno').html(html);
            }
        });



    });

    $('#checkdata').click(function() {
        var thisCheck = $(this);

        if (thisCheck.is(':checked')) {

            $('.roominfo').show();
        } else {
            $('.roominfo').hide();
        }
    });
    $('.roominfo').hide();
    $('#extraservicedata').hide();

    /*-----change event of visitor ---------*/
    $(document).on('change', '#roomno', function(e) {
        e.preventDefault();
        var id1 = $(this).val();
        var visitorid = $('#vistername').val();
        var saveid = $('#saveid').val();
        if (saveid == "") {

            $.ajax({
                url: getroomwiseinvoice + "/" + visitorid + "/" + id1,
                type: "GET",
                data: {
                    "_token": doc_token,
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {

                    $('#show_master1').html('');
                    var html = '';
                    var sr = 0;
                    var amount = 0;
                    totalroomamount = 0;
                    totalserviceamount = 0;
                    grandtotal = 0;
                    html += '<table id="roomdata" class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">ID</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Roomno</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">roomid</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">RoomCategory</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none">categoryid</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In time</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check out Time</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Days</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Checkout Id</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Extra service</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    for (var i = 0; i < data.length; i++) {
                        sr = sr + 1;
                        var date = data[i].checkintime;
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                        var date = data[i].checkouttime;
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                        var days = getdatediff(checkintime, checkouttime);
                        amount = parseFloat(data[i].roomrate) * parseFloat(days);
                        totalroomamount = parseFloat(totalroomamount) + parseFloat(amount);
                        totalserviceamount = parseFloat(totalserviceamount) + parseFloat(data[i].extraserviceamt);
                        grandtotal = parseFloat(totalroomamount) + parseFloat(totalserviceamount);
                        html += '<tr>' +
                            '<td id="roomno_' + sr + '">' + data[i].roomno + '</td>' +
                            '<td style="display:none;" id="roomid_' + sr + '">' + data[i].roomid + '</td>' +
                            '<td id="categoryname_' + sr + '">' + data[i].categoryname + '</td>' +
                            '<td  style="display:none;" id="categoryid_' + sr + '">' + data[i].categoryid + '</td>' +
                            '<td id="roomrate_' + sr + '">' + data[i].roomrate + '</td>' +
                            '<td id="checkintime_' + sr + '">' + checkintime + '</td>' +
                            '<td id="checkouttime_' + sr + '">' + checkouttime + '</td>' +
                            '<td   id="days_' + sr + '">' + days + '</td>' +
                            '<td   id="amt_' + sr + '">' + amount + '</td>' +
                            '<td   id="extraserviceamt_' + sr + '">' + data[i].extraserviceamt + '</td>' +
                            '<td  style="display:none;" id="checkoutid_' + sr + '">' + data[i].checkoutid + '</td>' +
                            '</tr>';

                    }
                    html += '</tbody></table>';
                    $('#show_master1').html(html);
                    $('#totalamt').val(grandtotal);
                }
            });
            $.ajax({
                url: getroomservice + "/" + visitorid + "/" + id1,
                type: "GET",
                data: {
                    "_token": doc_token,
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    var sr = 0;
                    var html = '';
                    $('#show_master2').html('');

                    if (data.length > 0) {
                        $('#extraservicedata').show();
                        html += '<table id="servicedata" class="table table-striped">' +
                            '<thead>' +
                            '<tr>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Date</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Service Name </th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Rate</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">qty</th>' +
                            '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Amount</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';
                        for (var j = 0; j < data.length; j++) {
                            sr = sr + 1;

                            html += '<tr><td id="datetime_' + sr + '">' + data[j].datetimedata + '</td>' +
                                '<td id="servicename_' + sr + '">' + data[j].servicename + '</td>' +
                                '<td   id="servicerate_' + sr + '">' + data[j].rate + '</td>' +
                                '<td   id="serviceqty_' + sr + '">' + data[j].qty + '</td>' +
                                '<td   id="totalsum_' + sr + '">' + data[j].sum + '</td>' +
                                '</tr>';
                        }
                        html += '</tbody></table>';
                        $('#show_master2').html(html);
                    } else {
                        $('#extraservicedata').hide();
                    }
                }
            });
        }
    });


    $('.btnhideshow').click(function() {
        $('.tablehideshow').hide();
        $(".formhideshow").show();
        $('#saveid').val('');
        from_clear();
        $('#roomdata').html('');
        $('#servicedata').html('');


    });
    $('.closehideshow').click(function() {
        $('.tablehideshow').show();
        $(".formhideshow").hide();
        $('#saveid').val('');
    });

    /*-----blur  event of invoice no ---------*/
    $(document).on('blur', '#invoiceno', function(e) {
        e.preventDefault();
        var invoiceno = $('#invoiceno').val();
        var saveid = $('#saveid').val();
        var checkurl = '';

        if (saveid == "") {
            checkurl = checkinvoiceno + "/" + invoiceno;
        } else {
            checkurl = checkeditinvoiceno + "/" + invoiceno + "/" + saveid;
        }

        $.ajax({
            url: checkurl,
            type: "GET",
            data: {
                "_token": doc_token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                if (data == '100') {
                    flag = 1;
                    swal("Invoice No Already Exists");
                } else {
                    flag = 0;
                }
            }
        });


    });

    function from_clear() {
        $('#invoiceno').val('');
        $('#vistername').val('').trigger('change');
        $('#checkbox').val('').trigger('change');
        $('#checkdata').prop('checked', false);
        $('#roomno').val('');
        $('#totalamt').val('');
        $('#totalamt').val('');
        $('#paidamt').val('');
        $('#amtmode').val('').trigger('change');
        $('#remark').val('');


    }

    $(document).on('click', '#reset', function(e) {
        e.preventDefault();
        from_clear();
    });



});