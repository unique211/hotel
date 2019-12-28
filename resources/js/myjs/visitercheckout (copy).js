$(document).ready(function() {

    if (checkinid != "") {
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        var finaltotal = 0;
        $('#cheinidvisiterid').val(checkinid);
        $.ajax({
            url: getcheckincustomerinfo + "/" + checkinid,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {


                var html = '';
                html += '<table id="roomtable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    // '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"></th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"><input type="checkbox" id="checkall" name="checkall"  >Room Detalis</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Day</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Total RoomRate</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Ratedata</th>' +

                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    var totalamt = 0;
                    html += '<tr>';
                    var sr = 0;

                    var date = data[0].checkintime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                    var date = data[0].checkouttime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                    $('#checktime').val(checkintime);
                    $('#checkouttime').val(checkouttime);
                    // alert(data[i].vistername);
                    $('#visiterid').val(data[i].visiter);
                    $('#visitorname').val(data[i].vistername);
                    var day = getdiffrentdate(checkintime, checkouttime);
                    var totalroomrate = 0;

                    if (data[i].roomdata.length > 0) {
                        sr = sr + 1;

                        for (var j = 0; j < data[i].roomdata.length; j++) {
                            totalroomrate = parseFloat(day) * parseFloat(data[i].roomdata[j].roomrate);

                            finaltotal = parseFloat(finaltotal) + parseFloat(totalroomrate);
                            html += '<td><input type="checkbox"  class="visiterallocateroom" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].roomdata[j].roomrate + '" visterid="' + data[i].visiter + '">' + data[i].roomdata[j].roomno + ' </td>' +
                                '<td class="tbcountday" id="tbday_' + data[i].roomdata[j].roomid + '">' + day + '</td>' +
                                '<td id="tbamount_' + data[i].roomdata[j].roomid + '">' + data[i].roomdata[j].roomrate + '</td>' +
                                '<td id="tbtotal_' + data[i].roomdata[j].roomid + '">' + totalroomrate + '</td>' +
                                '<td  style="display:none;" id="rate_' + sr + '">' + data[i].roomdata[j].roomrate + '</td></tr>';
                        }

                    }
                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
                $('#amount').val(finaltotal);
            }
        });


    }

    $('.date').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',

    });

    $('#tbl').show();

    $('#mainform1').hide();
    $('.datetimepicker').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',

    })

    $(document).on('click', '#btnadd', function() {
        //alert("HII");	
        $('#tbl').hide();
        $('#btnadd').hide();
        $('#mainform1').show();
        $("#roomtable1 tbody").html('');
        $("#roomtable tbody").html('');



    });

    $('#searchvisitor').keyup(function() {

        var content = $('#searchvisitor').val();
        if (content != "") {
            $('#searchtb').show();
            $.ajax({
                url: searchurl + "/" + content,
                type: "GET",
                //   data: new FormData(this),
                data: {
                    "_token": token,
                },
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    $('#show_master').show();
                    $("#searchtbody").html('');
                    if (data.length > 0) {
                        $("#searchtbody").html('');
                        var html = '';
                        for (i = 0; i < data.length; i++) {
                            html = '<tr class="tbrows" id=' + data[i].id + '>' +
                                '<td id="searchvisitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                                '<td id="searchlastname_' + data[i].id + '">' + data[i].lastname + '</td>' +
                                '<td id="mobileno_' + data[i].id + '">' + data[i].mobileno + '</td>' +
                                '<td style="display:none;" id="address_' + data[i].id + '">' + data[i].address + '</td>' +
                                '<td style="display:none;" id="emailid_' + data[i].id + '">' + data[i].emailid + '</td>' +
                                '<td style="display:none;" id="c_detalis_' + data[i].id + '">' + data[i].c_detalis + '</td>' +
                                '<td style="display:none;" id="c_name_' + data[i].id + '">' + data[i].c_name + '</td>' +
                                '<td style="display:none;" id="desighnation_' + data[i].id + '">' + data[i].desighnation + '</td>' +
                                '<td style="display:none;" id="c_url_' + data[i].id + '">' + data[i].c_url + '</td>' +
                                '<td style="display:none;" id="c_contactno_' + data[i].id + '">' + data[i].c_contactno + '</td>' +
                                '<td style="display:none;" id="c_emailid_' + data[i].id + '">' + data[i].c_emailid + '</td>' +
                                '</tr>';
                            $("#searchtbody").append(html);
                        }

                    } else {
                        $("#searchtbody").html('');
                    }
                }
            });


        }

    });

    $(document).on('click', '.tbrows', function(e) {
        e.preventDefault();
        var vid = $(this).attr('id');
        $('#visiterid').val(vid);

        var visitername = $('#searchvisitername_' + vid).html();

        $('#visitorname').val(visitername);
        $('#show_master').hide();

        $.ajax({
            url: getcheckvistertime + "/" + vid,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                if (data.length > 0) {
                    var date = data[0].checkintime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                    var date = data[0].checkouttime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                    $('#checktime').val(checkintime);
                    $('#checkouttime').val(checkouttime);
                    getdatediff();
                } else {
                    $('#visitorname').val('');
                    $('#checktime').val('');
                    $('#checkouttime').val('');

                }

            }
        });

        $.ajax({
            url: getvisiterinfo + "/" + vid,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var finaltotal = 0;
                $('#show_master1').html('');
                var noofday = $('#noofdays').val();
                var html = '';
                html += '<table id="roomtable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    // '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"></th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"><input type="checkbox" id="checkall" name="checkall"  >Room Detalis</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Rate</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Ratedata</th>' +

                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    var totalamt = 0;
                    html += '<tr>';
                    var sr = 0;
                    if (data[i].roomdata.length > 0) {
                        sr = sr + 1;
                        for (var j = 0; j < data[i].roomdata.length; j++) {
                            totalamt = parseFloat(data[i].rate) * parseFloat(1);

                            html += '<td><input type="checkbox"  class="visiterallocateroom" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].rate + '" visterid="' + data[i].roomdata[j].visterid + '">' + data[i].roomdata[j].roomno + ' </td>' +
                                '<td id="amount_' + data[i].id + '">' + totalamt + '</td>' +
                                '<td  style="display:none;" id="rate_' + sr + '">' + data[i].rate + '</td></tr>';
                        }
                        finaltotal = parseFloat(finaltotal) + parseFloat(totalamt);
                    }
                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
                $('#amount').val(finaltotal);
                var r1 = $('table#roomtable1').find('tbody').find('tr');
                var r = r1.length;
                var tr = "";

                if (r == 0) {

                    var html = '<tr><td  colspan="3"> Visitor Not  Allocate Room </td></tr>';
                    $("#roomtable1 tbody").append(html);

                }

                $('.visiterallocateroom').change(function() {

                    getbuttonid();
                });



            }

        });

        $('#searchtb').hide();


    });
    $(document).on('blur', '#searchroom', function(e) {
        e.preventDefault();
        var roomno = $(this).val();

        $.ajax({
            url: roomwisearch + "/" + roomno,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                $('#show_master1').html('');



                var html = '';
                html += '<table id="roomtable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Datalis</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Rate</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                if (data.length > 0) {
                    $('#visitorname').val(data[0].vistername);

                    var date = data[0].checkintime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                    var date = data[0].cheouttime;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                    $('#checktime').val(checkintime);
                    $('#checkouttime').val(checkouttime);
                    $('#visiterid').val(data[0].visterid);

                    getdatediff();
                    var noofday = $('#noofdays').val();
                    html += '<tr>' +
                        '<td><input type="checkbox" class="visiterallocateroom btn btn-sm  btn-xs  btn-info" id="' + data[0].roomid + '" name="' + data[0].rate + '" visterid="' + data[0].visterid + '" >' + data[0].roomno + '</button> &nbsp;</td>' +
                        '<td id="amount_' + data[0].id + '">' + (parseFloat(data[0].rate) * parseFloat(noofday)); + '</td></tr>';


                } else {

                    $('#visitorname').val('');
                    $('#checktime').val('');
                    $('#checkouttime').val('');
                    html += '<tr><td  colspan="3"> Visitor Not  Allocate Room </td></tr>';
                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
                $('.visiterallocateroom').change(function() {

                    getbuttonid();
                });
            }

        });

    });

    function getbuttonid() {
        var totalamout = 0;

        $('#roomtable input[type="checkbox"]:checked').each(function() {

            var total = 0;
            var totalamt = 0;
            total = $(this).attr('name');
            var noofday = $('#noofdays').val();


            if (noofday == 0) {
                noofday = 1;
            }
            totalamt = parseFloat(noofday) * parseFloat(total);
            totalamout = parseFloat(totalamout) + parseFloat(totalamt);

        });
        $('#roomtable1 input[type="checkbox"]:checked').each(function() {

            var total = 0;
            var totalamt = 0;
            var noofday = $('#noofdays').val();

            total = $(this).attr('name');
            if (noofday == 0) {
                noofday = 1;
            }

            totalamt = parseFloat(noofday) * parseFloat(total);
            totalamout = parseFloat(totalamt) + parseFloat(totalamout);

        });
        $('#amount').val(totalamout);

    }



    $('#master_form').on('submit', function(event) {
        event.preventDefault();

        var checkoutid = 0;

        var updateid = $('#saveid').val();

        if (updateid == "") {
            //alert("updateid" + updateid);
            $.ajax({
                url: inserturl,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    var checkflag = 0;
                    checkoutid = data;

                    //   if (data > 0) {

                    var allChecked = true;
                    $(".visiterallocateroom").each(function(index, element) {
                        if (!element.checked) {
                            allChecked = false;
                            return false;
                        }
                    });
                    if (allChecked == true) {
                        var checkinid = $('#cheinidvisiterid').val();
                        $.ajax({
                            url: updatestatus + "/" + checkinid,
                            type: "GET",
                            //   data: new FormData(this),
                            data: {
                                "_token": token,
                            },
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {


                            }
                        });
                    }

                    $('#roomtable input[type="checkbox"]:checked').each(function() {
                        var roomid = $(this).attr('id');
                        var visterid = $('#visiterid').val();

                        if (roomid != "checkall") {



                            $.ajax({
                                url: checkouturl + "/" + roomid + "/" + visterid + "/" + checkoutid,
                                type: "GET",
                                //   data: new FormData(this),
                                data: {
                                    "_token": token,
                                },
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType: "json",
                                success: function(data) {


                                }
                            });
                        }

                    });

                    $('#roomtable1 input[type="checkbox"]:checked').each(function() {

                        var roomid = $(this).attr('id');
                        var visterid = $('#visiterid').val();


                        $.ajax({
                            url: checkouturl + "/" + roomid + "/" + visterid + "/" + checkoutid,
                            type: "GET",
                            //   data: new FormData(this),
                            data: {
                                "_token": token,
                            },
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {



                            }
                        });

                    });
                    // }
                    successTost("Record Save Success Fully");
                    datashow();
                    $('#saveid').val('');


                }

            });
        }
        $('.formhideshow').hide();
        $('.tablehideshow').show();


    });
    datashow();

    function datashow() {

        $.ajax({
            url: showcheckoutuser,
            type: "GET",

            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var table1 = $('#visitercheckouttb').DataTable();
                table1.destroy();
                $('#tablebody').html('');
                var sr = 0;

                var html = '';
                //  alert('hi');
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td id="visitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                        '<td id="checkintime_' + data[i].id + '">' + data[i].checkintime + '</td>' +
                        '<td id="checkouttime_' + data[i].id + '">' + data[i].checkouttime + '</td>' +
                        '<td style="display:none;" id="visiterid_' + data[i].id + '">' + data[i].visterid + '</td>' +
                        '<td style="display:none;" id="totalamout_' + data[i].id + '">' + data[i].totalamout + '</td>' +
                        '<td style="display:none;" id="mode_' + data[i].id + '">' + data[i].mode + '</td>' +
                        '<td style="display:none;" id="transactiondetal_' + data[i].id + '">' + data[i].transactiondetal + '</td>' +
                        //'<td ><input type="button" name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + ' checkvistreid=' + data[i].visterid + '> &nbsp;&nbsp;<input type="button" name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '></td>' +
                        '</tr>';
                }

                $('#tablebody').html(html);
                $('#visitercheckouttb').DataTable({});

            }
        });
    }

    $(document).on('click', '.edit_data', function() {




        var id = $(this).attr('id');
        var visiterid = $('#visiterid_' + id).html();
        var visitername = $('#visitername_' + id).html();
        var checkintime = $('#checkintime_' + id).html();
        var checkouttime = $('#checkouttime_' + id).html();
        var totalamout = $('#totalamout_' + id).html();
        var mode = $('#mode_' + id).html();
        var transactiondetal = $('#transactiondetal_' + id).html();

        $('#visitorname').val(visitername);
        $('#visiterid').val(visiterid);
        $('#checktime').val(checkintime);
        $('#checkouttime').val(checkouttime);
        $('#amount').val(totalamout);
        $('#amtmode').val(mode);
        $('#transactiondetalis').val(transactiondetal);


        $.ajax({
            url: geteditvisitor + "/" + visiterid + "/" + id,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                $('#show_master1').html('');
                var html = '';
                html += '<table id="roomtable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Room Detalis</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Rate</th>' +

                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    var totalamt = 0;
                    html += '<tr>';
                    if (data[i].roomdata.length > 0) {

                        for (var j = 0; j < data[i].roomdata.length; j++) {
                            totalamt = parseFloat(data[i].rate) * parseFloat(data[i].roomdata.length);
                            html += '<td><input type="checkbox" checked class="visiterallocateroom btn btn-sm  btn-xs  btn-info" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].rate + '" visterid="' + data[i].roomdata[j].visterid + '">' + data[i].roomdata[j].roomno + ' </td>' +
                                '<td id="amount_' + data[i].id + '">' + totalamt + '</td></tr>';
                        }

                    }
                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
                //  $('#amount').val(finaltotal);
                var r1 = $('table#roomtable').find('tbody').find('tr');
                var r = r1.length;
                var tr = "";

                if (r == 0) {

                    var html = '<tr><td  colspan="3"> Visitor Not  Allocate Room </td></tr>';
                    $("#roomtable tbody").append(html);

                }

                $('.visiterallocateroom').change(function() {

                    getbuttonid();
                });
            }
        });
    });

    function getdatediff() {
        var checktime = $('#checktime').val();
        var cheout = $('#checkouttime').val();
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


        if (changet > checkintime) {

            diffDays = diffDays + 1;
        }
        if (changet < checkouttime) {

            diffDays = diffDays + 1;
        }
        alert("changet" + changet + "diffDays" + diffDays);

        $('#noofdays').val(diffDays);


    }

    $(document).on('click', '#btncancel', function() {

        $('#tbl').show();
        $('#btnadd').show();
        $('#mainform1').hide();
        $("#roomtable1 tbody").html('');
        $("#roomtable tbody").html('');
    });

    /*--------get two date diffrent --------*/
    $(document).on('blur', '#checkouttime', function(e) {
        e.preventDefault();
        getdatediff();
    });

    //for last ten visitor
    getchechink_customer();

    function getchechink_customer() {
        $.ajax({
            url: getcheckinvisitor,
            type: "GET",
            //   data: new FormData(this),
            data: {
                "_token": token,
            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                $("#searchtbody").html('');

                if (data.length > 0) {

                    $("#searchtbody").html('');
                    var html = '';
                    for (i = 0; i < 10; i++) {
                        html = '<tr class="tbrows" id=' + data[i].id + '>' +
                            '<td id="searchvisitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                            '<td id="searchlastname_' + data[i].id + '">' + data[i].lastname + '</td>' +
                            '<td id="mobileno_' + data[i].id + '">' + data[i].mobileno + '</td>' +
                            '<td style="display:none;" id="address_' + data[i].id + '">' + data[i].address + '</td>' +
                            '<td style="display:none;" id="emailid_' + data[i].id + '">' + data[i].emailid + '</td>' +
                            '<td style="display:none;" id="c_detalis_' + data[i].id + '">' + data[i].c_detalis + '</td>' +
                            '<td style="display:none;" id="c_name_' + data[i].id + '">' + data[i].c_name + '</td>' +
                            '<td style="display:none;" id="desighnation_' + data[i].id + '">' + data[i].desighnation + '</td>' +
                            '<td style="display:none;" id="c_url_' + data[i].id + '">' + data[i].c_url + '</td>' +
                            '<td style="display:none;" id="c_contactno_' + data[i].id + '">' + data[i].c_contactno + '</td>' +
                            '<td style="display:none;" id="c_emailid_' + data[i].id + '">' + data[i].c_emailid + '</td>' +
                            '</tr>';
                        $("#searchtbody").append(html);
                    }

                } else {
                    $("#searchtbody").html('');
                }
            }
        });
    }

    $(document).on('click', '.btnhideshow', function(e) {
        e.preventDefault();
        $("#searchtbody").html('');
        $("#searchvisitor").val('');
        $("#searchroom").val('');
        $("#visitorname").val('');
        $("#checktime").val('');
        $("#checkouttime").val('');
        getchechink_customer();
    });

    function form_clear() {
        $('#searchvisitor').val('');
        $('#searchroom').val('');
        $('#visitorname').val('');
        $('#Amount').val('');
        $('#amtmode').val('').trigger('change');
        $('#transactiondetalis').val('');

    }
    $(document).on('click', '#reset', function(e) {
        e.preventDefault();
        form_clear();
    });

    //for blue Event of Checkout Time
    $(document).on('blur', '#checkouttime', function(e) {
        e.preventDefault();
        var checkout = $('#checkouttime').val();
        var checkin = $('#checktime').val();

        var day = getdiffrentdate(checkin, checkout);
        var totalamt = 0;
        $('.tbcountday').html(day);
        $('.tbcountday').each(function() {

            var id = $(this).attr('id');
            id = id.split("_");
            var rate = $('#tbamount_' + id[1]).html();
            var total = $('#tbtotal_' + id[1]).html();
            var finaltotal = parseFloat(rate) * parseFloat(day);
            totalamt = parseFloat(finaltotal) + parseFloat(totalamt);
            $('#tbtotal_' + id[1]).html(finaltotal);




        });

        // $('#amount').val(totalamt);
        getamount();
        $('.tbcountday').html(day);

    });

    function getdiffrentdate(checktime, cheout) {
        if (checktime <= cheout) {

            var checktime1 = checktime.split(' ');
            var cheout1 = cheout.split(' ');
            checktime = checktime1[0];
            var checkintime = checktime1[1];

            cheout = cheout1[0];
            var checkouttime = cheout1[1];

            var firstdate1 = checktime.split("/");
            var enddate1 = cheout.split("/");


            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date(firstdate1[2], firstdate1[1], firstdate1[0]);
            var secondDate = new Date(enddate1[2], enddate1[1], enddate1[0]);


            var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
            diffDays = parseInt(diffDays);
            if (changet > checkintime) {

                diffDays = diffDays + 1;
            }
            if (changet < checkouttime) {

                diffDays = diffDays + 1;
            }
            $('#noofdays').val(diffDays);


            return diffDays;
        } else {
            swal("please Select Check Out Date Grather than Check in Date ")
        }
    }

    //for blue Event of Check Box Change Event 
    $(document).on('change', '#checkall', function(e) {
        e.preventDefault();

        if ($(this).is(':checked')) {

            $('.visiterallocateroom').prop("checked", true);
        } else {
            $('.visiterallocateroom').prop("checked", false);
        }
        getamount();
    });
    // $('#checkall').click(function() {

    // });
    $(document).on('change', '.visiterallocateroom', function(e) {
        e.preventDefault();

        getamount();
    });

    function getamount() {

        var total = 0;
        $(".visiterallocateroom").each(function(index, element) {
            if (element.checked) {
                var rate = $(this).attr('name');
                var day = $('#noofdays').val();
                total = parseFloat(total) + (parseFloat(rate) * parseFloat(day));
            }
        });
        $('#amount').val(total);
    }

});