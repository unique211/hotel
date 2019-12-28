$(document).ready(function() {



    $('#fromdate').datepicker({
        'todayHighlight': true,
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
    $('#todate').datepicker({
        'todayHighlight': true,
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
    var date = new Date();
    date = date.toString('dd/MM/yyyy');
    $("#fromdate").val(date);
    $("#todate").val(date);
    $('#mainform').on('submit', function(event) {
        event.preventDefault();
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();


        $('#f_date').html('From Date' + fromdate);
        $('#t_date').html('To Date' + todate);
        // $.ajax({
        //     url: inserturl,
        //     method: "POST",
        //     data: new FormData(this),
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     dataType: "json",
        //     success: function(data) {

        //     }
        var tdateAr = fromdate.split('/');
        var fromdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];

        var tdateAr = todate.split('/');
        var todate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
        $.ajax({
            url: inserturl + "/" + fromdate + "/" + todate,
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
                var sr = 0;
                var html = "";
                if (data.length > 0) {
                    var table1 = $('#checkintable').DataTable();
                    table1.destroy();


                    $('#tablebody').html('');


                    for (var i = 0; i < data.length; i++) {
                        sr = sr + 1;
                        var date = data[i].date;
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                        html += '<tr class="getallinformation" id="getinfo_' + sr + '"><td  style="width:10%" id="srno_' + data[i].id + '">' + sr + '</td>' +

                            '<td  style="width:40%" id="visitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                            '<td  style="width:30%"id="checkintime_' + data[i].id + '">' + checkintime + '</td>' +
                            '<td  style="display:none;" id="visiterid_' + data[i].id + '">' + data[i].visiterid + '</td>' +
                            '<td  ><button class="btn btn-primary getfullinfo"  type="button" id="checkinrep_' + sr + '" name="' + data[i].visiterid + '" checkintime="' + data[i].date + '">Full Info</button></td>' +
                            '</tr>';
                    }
                    $('#tablebody').append(html);
                    $('#checkintable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdfHtml5',
                                title: 'checkinreport',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                },
                            },
                            {
                                title: 'checkinreport',
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            }
                        ]
                    });

                    $("div").removeClass("form-inline");
                }

            }
        });


    });

    $(document).on('click', '.getfullinfo', function() {
        var id1 = $(this).attr('id');
        var visiterid = $(this).attr('name');
        var visitorcheckindate = $(this).attr('checkintime');

        //alert("visiterid"+visiterid+""+visitorcheckindate);
        // $.ajax({
        //     url: inserturl + "/" + fromdate + "/" + todate,
        //     type: "GET",
        //     //   data: new FormData(this),
        //     data: {
        //         "_token": doc_token,
        //     },
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     dataType: "json",
        //     success: function(data) {

        //     }
        // });
        $.ajax({
            url: getfullinformation,
            data: {
                visiterid: visiterid,
                visitorcheckindate: visitorcheckindate
            },
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                var html = '';
                if (data.length > 0) {
                    html += '<table id="laravel_crud" style="width:100%;" class=" table table-striped">' +
                        '<thead>' +
                        '<tr>' +

                        '<th><font style="font-weight:bold">Visitor Name</font></th>' +
                        '<th><font style="font-weight:bold">Last Name</font></th>' +
                        '<th><font style="font-weight:bold"> Mobile No</font></th>' +
                        '<th><font style="font-weight:bold">Address</font></th>' +
                        '<th><font style="font-weight:bold">Visitor Email</font></th>' +

                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    for (var i = 0; i < data.length; i++) {
                        var sr = i + 1;


                        html += '<tr>' +
                            '<td id="visitername_' + sr + '">' + data[i].visitername + '</td>' +
                            '<td id="lastname_' + sr + '">' + data[i].lastname + '</td>' +
                            '<td id="mobileno_' + sr + '">' + data[i].mobileno + '</td>' +
                            '<td id="address_' + sr + '">' + data[i].address + '</td>' +
                            '<td id="email_' + sr + '">' + data[i].email + '</td>' +

                            '</tr>';

                        html += '<tr><td colspan="5"><b>Check In Information</b></td></tr>';

                        html += '<tr>' +
                            '<td id="visitername_' + sr + '"><b>Men</b></td>' +
                            '<td id="lastname_' + sr + '"><b>Woman</b></td>' +
                            '<td id="mobileno_' + sr + '"><b>Child</b></td>' +
                            '<td id="address_' + sr + '"><b>CheckinTime</b></td>' +
                            '<td id="email_' + sr + '"></td>' +

                            '</tr>';


                        html += '<tr>' +
                            '<td id="visitername_' + sr + '">' + data[i].men + '</td>' +
                            '<td id="lastname_' + sr + '">' + data[i].woman + '</td>' +
                            '<td id="mobileno_' + sr + '">' + data[i].chid + '</td>' +
                            '<td id="address_' + sr + '">' + data[i].chektime + '</td>' +
                            '<td id="email_' + sr + '"></td>' +

                            '</tr>';

                        html += '<tr><td colspan="5"><b>Room Inforamation</b></td></tr>';

                        if (data[i].roomdata.length > 0) {
                            html += '<tr>' +
                                '<td ><b>Room No</b></td>' +
                                '<td ><b>Room Rate</b></td>' +
                                '<td colspan="3"><b>Room Name</b></td>' +
                                '</tr>';

                            for (var j = 0; j < data[i].roomdata.length; j++) {
                                var broomname="";
                                if( data[i].roomdata[j].roomname ==null){
                                    broomname="-"; 
                                }else{
                                    broomname=data[i].roomdata[j].roomname;
                                }

                                html += '<tr>' +
                                    '<td id="roomno_' + sr + '">' + data[i].roomdata[j].roomno + '</td>' +
                                    '<td id="lastname_' + sr + '">' + data[i].roomdata[j].roomrate + '</td>' +
                                    '<td  colspan="3" id="mobileno_' + sr + '">' + broomname+ '</td>' +


                                    '</tr>';
                            }

                        }
                        html += '<tr><td colspan="5"><b>Checkout Inforamation</b></td></tr>';
                        if (data[i].checkoutinfo.length > 0) {

                            html += '<tr>' +
                                '<td ><b>Room No</b></td>' +
                                '<td ><b>Check Out Time</b></td>' +
                                '<td colspan="3"><b>Room Name</b></td>' +
                                '</tr>';

                            for (var j = 0; j < data[i].checkoutinfo.length; j++) {
                                if (data[i].checkoutinfo[j].checkouttime != "") {
                                    var vroomname="";
                                    if(data[i].checkoutinfo[j].roomname==null){
                                        vroomname="-"; 
                                    }else{
                                        vroomname=data[i].checkoutinfo[j].roomname;
                                    }
                                    html += '<tr>' +
                                        '<td id="roomno_' + sr + '">' + data[i].checkoutinfo[j].roomno + '</td>' +
                                        '<td id="lastname_' + sr + '">' + data[i].checkoutinfo[j].checkouttime + '</td>' +
                                        '<td  colspan="3" id="mobileno_' + sr + '">' + vroomname+ '</td>' +
                                        '</tr>';
                                }
                            }
                            html += '<tr><td colspan="5"><b>Invioce Inforamation</b></td></tr>';
                            html += '<tr>' +
                                '<td ><b>Invoice No</b></td>' +
                                '<td ><b>Invoice Date</b></td>' +
                                '<td colspan="3"><b>Invoicetotal</b></td>' +
                                '</tr>';
                            for (var j = 0; j < data[i].invoice.length; j++) {
                                if (data[i].invoice[j].invoicedate != "") {
                                    html += '<tr>' +
                                        '<td id="roomno_' + sr + '">' + data[i].invoice[j].invoiceno + '</td>' +
                                        '<td id="lastname_' + sr + '">' + data[i].invoice[j].invoicedate + '</td>' +
                                        '<td  colspan="3" id="mobileno_' + sr + '">' + data[i].invoice[j].totalamt + '</td>' +
                                        '</tr>';
                                }
                            }

                        }




                    }
                    html += '</tbody></table>';
                    $('#show_master1').html(html);
                }

            }
        });

    });

});