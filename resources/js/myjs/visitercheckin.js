$(document).ready(function() {
    var totalamount = 0;
    var countcapacity = 0;
    // $('#datetimepicker').datetimepicker({
    //     format: 'dd/MM/yyyy hh:mm:ss',
    //     language: 'pt-BR'
    // });
    $('.btnhideshow').trigger('click');
    $('#visiter_data').hide();

    $(document).on('click', '.btnhideshow', function() {


        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $(".stages").prop('disabled', true);
        $("#tab1").prop('checked', true);
        //  getallocateroom();
        var date = new Date();
        // date = date.toString('dd/MM/yyyy hh:mm:ss');


        var tomorrow = new Date(date.getTime() + 24 * 60 * 60 * 1000);
        date = date.toString('dd/MM/yyyy HH:mm:ss');
        tomorrow = tomorrow.toString('dd/MM/yyyy HH:mm:ss');


    });
    // $("#datetimepicker1").on("dp.change", function() {
    //     alert($(this).datetimepicker('getDate'));

    //     //  $("#datetimepicker2").datepicker('option', 'minDate', );

    // });

    $('#datetimepicker1').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',
        minDate: new Date(), // disable past date




    });


    $('#datetimepicker2').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',
        minDate: new Date(), // disable past date
        // disable past time

    });



    $(document).on('click', '.closehideshow', function() {
        $('.formhideshow').hide();
        $('.tablehideshow').show();

        $(".stages").prop('disabled', true);
        $(".stages").prop('checked', false);
        $("#tab1").trigger('click');

    });

    // $('.date').datepicker({
    //     'todayHighlight': true,
    //     format: 'dd/mm/yyyy',
    //     autoclose: true,
    //     pickDate: true, // disables the date picker
    //     pickTime: true,
    //     pickSeconds: true, // disables seconds in the time picker
    //     startDate: -Infinity, // set a minimum date
    //     endDate: Infinity
    // });


    var date = new Date();
    // date = date.toString('dd/MM/yyyy hh:mm:ss');


    var tomorrow = new Date(date.getTime() + 24 * 60 * 60 * 1000);
    date = date.toString('dd/MM/yyyy HH:mm:ss');
    tomorrow = tomorrow.toString('dd/MM/yyyy HH:mm:ss');
    //  $('.clockpicker').clockpicker();
    $('.datetimepicker').datetimepicker({
        //pickTime: true,
        format: 'DD/MM/YYYY HH:mm:ss',
        minDate: 0, // disable past date


    });

    $("#checktime").val(date);

    $('#nodays').val(1);
    $("#date").val(tomorrow);


    $('#visitordetalis').hide();
    $('#visitordetalis1').hide();
    $('#tbl').show();
    $('#purposedata').hide();
    $("#myForm :input").prop("disabled", true);

    $(document).on('change', '#date', function(e) {
        e.preventDefault();
        var date = $(this).val();
        date = date.toString('dd/MM/yyyy hh:mm');
        $("#date").val(date);

    });
    //$(".mainformcon").attr('disabled', 'disabled');
    $(document).on('click', '#btnadd', function() {
        //alert("HII");
        $('#tbl').hide();
        $('#visitordetalis').show();
        $('#mainform').hide();
        $('#visitordetalis1').hide();


    });


    $('#searchvisitor').keyup(function() {
        $('#serachdiv').show();
        var content = $('#searchvisitor').val();
        if (content != "") {
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
                                '<td id="visitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                                '<td id="lastnname_' + data[i].id + '">' + data[i].lastname + '</td>' +
                                '<td id="mobileno_' + data[i].id + '">' + data[i].mobileno + '</td>' +
                                '<td style="display:none;" id="address_' + data[i].id + '">' + data[i].address + '</td>' +
                                '<td style="display:none;" id="emailid_' + data[i].id + '">' + data[i].emailid + '</td>' +
                                '<td style="display:none;" id="c_detalis_' + data[i].id + '">' + data[i].c_detalis + '</td>' +
                                '<td style="display:none;" id="c_name_' + data[i].id + '">' + data[i].c_name + '</td>' +
                                '<td style="display:none;" id="desighnation_' + data[i].id + '">' + data[i].desighnation + '</td>' +
                                '<td style="display:none;" id="c_url_' + data[i].id + '">' + data[i].c_url + '</td>' +
                                '<td style="display:none;" id="c_contactno_' + data[i].id + '">' + data[i].c_contactno + '</td>' +
                                '<td style="display:none;" id="c_emailid_' + data[i].id + '">' + data[i].c_emailid + '</td>' +

                                '<td style="display:none;" id="taddress2_' + data[i].id + '">' + data[i].address2 + '</td>' +
                                '<td style="display:none;" id="tstreet_' + data[i].id + '">' + data[i].street + '</td>' +
                                '<td style="display:none;" id="tcity_' + data[i].id + '">' + data[i].city + '</td>' +
                                '<td style="display:none;" id="tpostalcode_' + data[i].id + '">' + data[i].postalcode + '</td>' +
                                '<td style="display:none;" id="tstate_' + data[i].id + '">' + data[i].state + '</td>' +
                                '<td style="display:none;" id="tprofilepicture_' + data[i].id + '">' + data[i].profilepicture + '</td>' +

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

    /*---------click Event of visiter search table Start----------------*/
    $(document).on('click', '.tbrows', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var visitername = $('#visitername_' + id).html();
        var address = $('#address_' + id).html();
        var mobileno = $('#mobileno_' + id).html();
        var emailid = $('#emailid_' + id).html();
        var lastnname = $('#lastnname_' + id).html();
        $('#serachdiv').show();
        $('#visiter_data').show();



        var c_detalis = $('#c_detalis_' + id).html();
        var c_name = $('#c_name_' + id).html();
        var desighnation = $('#desighnation_' + id).html();
        var c_url = $('#c_url_' + id).html();
        var c_contactno = $('#c_contactno_' + id).html();
        var c_emailid = $('#c_emailid_' + id).html();

        var taddress2 = $('#taddress2_' + id).html();
        var tstreet = $('#tstreet_' + id).html();
        var tcity = $('#tcity_' + id).html();
        var tpostalcode = $('#tpostalcode_' + id).html();
        var tstate = $('#tstate_' + id).html();

        var profilepicture = $('#tprofilepicture_' + id).html();

        $('#pfilehidden1').val(profilepicture);
        if (profilepicture == "") {

        } else {

            $('#profile').prop('required', false);
        }

        if (c_name == "null") {
            c_name = "";
        }
        if (desighnation == "null") {
            desighnation = "";
        }
        if (c_url == "null") {
            c_url = "";
        }
        if (c_contactno == "null") {
            c_contactno = "";
        }
        if (c_emailid == "null") {
            c_emailid = "";
        }
        if (emailid == "null") {

            emailid = "";
        }
        if (taddress2 == "null") {
            taddress2 = "";
        }

        $('#profileimg').attr('src', imgurl + '/profileuploads/' + profilepicture);

        $('#lastname').val(lastnname);
        $('#address2').val(taddress2);
        $('#street').val(tstreet);
        $('#city').val(tcity);
        $('#state').val(tstate);
        $('#postalcode').val(tpostalcode);

        $('#saveid').val(id);
        $('#saveid1').val(id);
        $('#name').val(visitername);
        $('#searchvisitor').val(visitername);
        $('#address1').val(address);
        $('#mobileno').val(mobileno);
        $('#email').val(emailid);


        if (c_detalis == 1) {

            $('#comapanydata').prop('checked', true);
            $('#purposedata').show();
            $('#c_name').val(c_name);
            $('#desgination').val(desighnation);
            $('#url').val(c_url);
            $('#contactno').val(c_contactno);
            $('#c_email').val(c_emailid);
            // $('#comapanydata').trigger('click');
        } else {
            $('#comapanydata').prop('checked', false);
            $('#purposedata').hide();
        }

        $.ajax({
            url: "docuploaddata/" + id + "/edit",
            dataType: "json",
            success: function(data) {
                var row_id = 0;

                $("#docupload_tbody").html('');
                for (var i = 0; i < data.length; i++) {

                    row_id = row_id + 1;
                    var html = '<tr  class="proffinfodata"  id="proffinfo_' + row_id + '" >' +
                        '<td>' +
                        '<select id="profdoc_' + row_id + '" name="profdoc_' + row_id + '" class="form-control" style="width:100%">' +
                        '<option value="0" disabled selected>Select Proff</option>' +
                        '<option value="AdharCard">AdharCard</option>' +
                        '<option value="Pancard">Pancard</option>' +
                        '<option value="Drivinglicense">Driving license</option>' +
                        '<option value="VoterID">VoterID </option>' +
                        '</select>' +

                        '</td>' +

                        '<td>' +
                        '<input type="number" id="proffno_' + row_id + '" name="proffno_' + row_id + '" class="form-control" placeholder="Proff No" value="' + data[i].docproff_no + '">' +
                        '</td>' +

                        '<td>' +
                        '<input type="file" id="file_' + row_id + '" name="file_' + row_id + '" class="form-control proffupload">' +
                        '<div id="msgid_' + row_id + '"></div>' +
                        '<input type="hidden" id="filehidden_' + row_id + '" name="filehidden_' + row_id + '" value="' + data[i].filename + '">' +
                        '</td>' +

                        '<td>&nbsp;<button  class="proff_delete_data btn btn-xs btn-danger"   id="proffinfo_' + row_id + '" title="Remove Section !!!" ><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';

                    $('#docupload_tbody').prepend(html);
                    $('#doc_row_id').val(row_id);
                    $('#profdoc_' + row_id).val(data[i].doc_name).trigger('change');
                    $('#msgid_' + row_id).html(data[i].filename);
                }
            }
        });
        $('#serachdiv').hide();
    });
    /*---------click Event of visiter search table End----------------*/


    function form_clear() {

        $('#name').val('');
        $('#address').val('');
        $('#mobileno').val('');
        $('#email').val('');
        $('#c_name').val('');
        $('#desgination').val('');
        $('#url').val('');
        $('#contactno').val('');
        $('#c_email').val('');
        $('#c_email').val('');
        // $('#docupload_tbody').html('');
        $('#saveid').val('');


        $('#amount').val('0');
        $('#advanceamount').val('0');
        $('#amtmode').val('').trigger('change');
        $('#remark').val('');

        $('#men').val('1');
        $('#women').val('0');
        $('#child').val('0');
        $('#amount').val('0');

        $('#lastname').val('');
        $('#address1').val('');
        $('#address2').val('');
        $('#street').val('');
        $('#city').val('');
        $('#postalcode').val('');
        $('#state').val('');
        $('#mobileno').val('');
        $('#email').val('');

        $('#profileimg').attr('src', imgurl + '/resources/img/usersicon.jpg');

    }


    /*--------submite of main form crate or update visiter Start---------------*/
    $('#master_form').on('submit', function(event) {
        event.preventDefault();
        var docid = '';
        var id = $('#saveid').val();
        var name = $('#name').val();

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

                    docid = data;

                    if (data == '0') {
                        swal({
                            title: "Mobile NO Already Exist",
                            text: "Please Enter Another Mobile No !!",
                            type: "warning",
                        });
                    } else {
                        if (data > 0) {
                            $('#saveid1').val(docid);


                            // var r1 = $('table#docupload').find('tbody').find('tr');
                            // var r = r1.length;
                            // var tr = "";

                            // for (var i = 0; i < r; i++) {
                            $('.proffinfodata').each(function() {
                                var id1 = $(this).attr('id');
                                id1 = id1.split("_");

                                var doctype = $('#profdoc_' + id1[1]).val();
                                var profdocno = $('#proffno_' + id1[1]).val();
                                var filename = $('#filehidden_' + id1[1]).val();

                                if (doctype != "") {

                                    // var t = document.getElementById('docupload');
                                    // var doctype = $(r1[i]).find('td:eq(1)').html();
                                    // var profdocno = $(r1[i]).find('td:eq(3)').html();
                                    // var filename = $(r1[i]).find('td:eq(4)').html();
                                    var form_data = new FormData();
                                    form_data.append('doctype', doctype);
                                    form_data.append('docid', docid);
                                    form_data.append('filename', filename);
                                    form_data.append('profdocno', profdocno);
                                    form_data.append('_token', token);

                                    $.ajax({


                                        type: "POST",
                                        url: docuploadurl,
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
                            });
                            $("#tab1").prop('disabled', false);
                            $("#tab2").prop('disabled', false);
                            $("#tab2").trigger('click');
                            successTost("Operation Successfull");
                        }
                    }

                }
            });
        } else {

            docid = $('#saveid').val();

            $.ajax({
                url: updateurl,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {



                    if (data == '0') {
                        swal({
                            title: "Mobile NO Already Exist",
                            text: "Please Enter Another Mobile No !!",
                            type: "warning",
                        });
                    } else {

                        $.ajax({
                            url: "docuploaddata/destroy/" + docid,
                            beforeSend: function() {

                            },
                            success: function(data) {

                            }
                        });

                        $('.proffinfodata').each(function() {
                            var id1 = $(this).attr('id');
                            id1 = id1.split("_");


                            var doctype = $('#profdoc_' + id1[1]).val();
                            var profdocno = $('#proffno_' + id1[1]).val();
                            var filename = $('#filehidden_' + id1[1]).val();
                            if (doctype != "") {
                                var form_data = new FormData();
                                form_data.append('doctype', doctype);
                                form_data.append('docid', docid);
                                form_data.append('filename', filename);
                                form_data.append('profdocno', profdocno);
                                form_data.append('_token', token);

                                $.ajax({


                                    type: "POST",
                                    url: docuploadurl,
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
                        });
                        toastr.success("Record Update Success Fully");
                        $("#tab1").prop('disabled', false);
                        $("#tab2").prop('disabled', false);
                        $("#tab2").trigger('click');
                    }

                }
            });

            // var r1 = $('table#docupload').find('tbody').find('tr');
            // var r = r1.length;
            // var tr = "";


        }


        forgetadvanceroom();


        $('#searchvisitor').val('')

    });
    /*--------submite of main form crate or update visiter End---------------*/

    /*--------check mobile number blue event start---------------*/
    $(document).on("blur", "#mobileno", function(e) {
        e.preventDefault();
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        var m = $('#mobileno').val();
        if (filter.test(m)) {
            if (m.length == 10) {
                validate = 1;

                $.ajax({
                    url: checkmobileno + "/" + m,
                    type: "GET",

                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        if (data > 0) {
                            swal({
                                title: "Mobile NO Already Exist",
                                text: "Please Enter Another Mobile No !!",
                                type: "warning",
                            });
                        }
                    }
                });


            } else {
                swal({
                    title: "Opss...",
                    text: "Please Enter 10 digits!",
                    type: "warning",
                });
                //alert('Please put 10  digit mobile number');
                validate = 0;
            }
        } else {
            swal("Not a valid number");
            validate = 0;
        }
    });
    /*--------check mobile number blue event End---------------*/

    /*--------for Document save in Html Table---------------*/
    $(document).on('click', "#saveproff", function(e) {
        e.preventDefault();


        var profdoc = $("#profdoc").val();

        var profdocname = $("#profdoc option:selected").text();
        var profno = $("#proffno").val();
        var file = $("#filehidden1").val();


        var row_id = $('#doc_row_id').val();
        row_id = parseInt(row_id) + parseInt(1);
        var save_update = $('#doc_save_update').val();
        var dlt = 0;

        var r1 = $('table#docupload').find('tbody').find('tr');
        var r = r1.length;
        for (var i = 0; i < r; i++) {

            var profid = $(r1[i]).find('td:eq(1)').html();

            if (save_update == "") {
                if (profid == profdoc) {
                    dlt = parseInt(dlt) + parseInt(1);
                }
            }
        }

        if (dlt > 0) {
            if (dlt == 1) {
                swal("Selected Document Already Exists !!!");
            }
            var dlt = 0;

        } else if (save_update != "") {


            $('#profdoc_' + save_update).html(profdoc);
            $('#profdocname_' + save_update).html(profdocname);
            $('#file_' + save_update).html(file);
            $('#profdocno_' + save_update).html(profno);
            $('#doc_save_update').val('');


        } else {


            var html = '<tr class="project_tab_add_row" id="del_' + row_id + '" >' +
                '<td style="display:none;" >' + row_id + '</td>' +
                '<td  style="display:none;" id="profdoc_' + row_id + '">' + profdoc + '</td>' +
                '<td  id="profdocname_' + row_id + '">' + profdocname + '</td>' +
                '<td  id="profdocno_' + row_id + '">' + profno + '</td>' +
                '<td  id="file_' + row_id + '">' + file + '</td>' +
                '<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  >Edit</button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  >delete</button>' +
                '</tr>';

            $("#docupload_tbody").append(html);
            $('#doc_row_id').val(row_id);
            $('#doc_save_update').val('');


        }
        $("#profdoc").val('').trigger('change');
        $("#file").val('');
        $("#filehidden1").val('');
        $("#msgid").html('');
        $("#proffno").val('');
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

        var profdoc = $("#profdoc_" + row).html();
        var file = $("#file_" + row).html();
        var profno = $("#profdocno_" + row).html();
        $("#profdoc").val(profdoc).trigger('change');
        // $("#file").html('');
        $("#filehidden1").val(file);
        $("#proffno").val(profno);
        $('#doc_save_update').val(row);
        $('#msgid').html(file);

    });
    /*---------click Event of check Box start-------------------*/
    $('input[type="checkbox"]').click(function() {
        if ($('#comapanydata').prop("checked") == true) {

            $('#purposedata').show();
        } else {
            $('#purposedata').hide();
        }
    });
    /*---------click Event of check Box End-------------------*/

    /*---------uploading file Event Start-------------------*/
    $('#file').change(function() {

        if ($(this).val() != '') {
            upload(this);

        }
    });

    function upload(img) {

        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('_token', token);

        $.ajax({
            url: documentuplodingurl,
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {

                $('#file').val('');
                $('#msgid').html(data);
                $('#filehidden1').val(data);

            }
        });
    }
    /*---------uploading file Event End-------------------*/
    $(document).on('click', '#new', function(e) {
        e.preventDefault();
        // $(".mainformcon").removeAttr('disabled', 'disabled');
        $('#visiter_data').show();
        form_clear();
    });

    $(document).on('click', '#btnadd', function(e) {
        e.preventDefault();
        // $(".mainformcon").removeAttr('disabled', 'disabled');
        $('#visitordetalis').show();
        $('.editvister').show();
        $('#mainform').hide();
        form_clear();
    });



    function getallocateroom() {
        $.ajax({
            url: avalibleroomdata,
            type: "GET",

            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                // alert(data);
                // if (data[0].roomdata.length > 0) {

                var html = '';
                // html += '<table id="roomtable" class="table table-striped">' +
                //     '<thead>' +
                //     '<tr>' +
                //     '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Category</th>' +
                //     '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Category</th>' +

                //     '</tr>' +
                //     '</thead>' +
                //     '<tbody>';

                for (var i = 0; i < data.length; i++) {

                    if (data[i].roomdata.length > 0) {

                        html += '<a class="categoryname" caterate="' + data[i].rate + '" capacity="' + data[i].capacity + '"  id="catname_' + data[i].cateid + '"><b>' + data[i].catname + '</b></a><br>';
                        // html += '<br>';
                        // for (var j = 0; j < data[i].roomdata.length; j++) {
                        //     html += '<button  class="roomalocate btn btn-sm  btn-xs  btn-primary" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].rate + '" >' + data[i].roomdata[j].roomno + '</button> &nbsp;';
                        // }
                        // html += '</a></<button>';
                    }
                }
                //html += '</tbody></table>';
                $('#categoryinfo').html(html);
                //} else {
                //     swal({
                //         title: "Currently Not Room Avalible",
                //         text: "Currently Not Room Avalible!!!",
                //         type: "warning",
                //     });
                // }
            }
        });

    }
    $(document).on('click', '.roomalocate', function(e) {
        e.preventDefault();
        var roomid = $(this).attr('id');
        roomid = roomid.split("_");

        var roomrate = $(this).attr('name');
        var roomno = $(this).text();
        var visiterid = $('#saveid1').val();
        var nodays = $('#nodays').val();

        var checkintime = $('#checktime').val();
        var checkouttime = $('#date').val();
        var capacity = $(this).attr('usercapacity');



        $(this).addClass('btn-info');

        if (totalamount > 0) {

            if ($(this).hasClass('btn-primary')) {


                totalamount = parseInt(roomrate) + parseInt(totalamount);
                countcapacity = parseInt(capacity) + parseInt(countcapacity);
                $(this).addClass('btn-info');
                $(this).removeClass("btn-primary");
                var html = '';

                html = '<button type="button"  class="allcateroomalocate btn btn-sm  btn-xs  btn-info" id="' + roomid[1] + '" name="' + roomrate + '" >' + roomno + '</button> &nbsp;';


                $('#allocateroom').append(html);

                // var form_data = new FormData();
                // form_data.append('visiterid', visiterid);
                // form_data.append('roomid', roomid);
                // form_data.append('roomrate', roomrate);
                // form_data.append('checkintime', checkintime);
                // form_data.append('checkouttime', checkouttime);
                // form_data.append('_token', token);

                // $.ajax({
                //     url: allocateroom,
                //     type: "POST",
                //     data: form_data,
                //     contentType: false,
                //     cache: false,
                //     processData: false,
                //     dataType: "json",
                //     success: function(data) {

                //     }
                // });



            } else if ($(this).hasClass('btn-info')) {
                var form_data = new FormData();
                form_data.append('visiterid', visiterid);
                form_data.append('roomid', roomid);
                // $.ajax({
                //     url: "allocateroom/destroy/" + roomid + "/" + visiterid,
                //     beforeSend: function() {

                //     },
                //     success: function(data) {

                //     }
                // })

                $(this).addClass('btn-primary');
                $(this).removeClass("btn-info");
                totalamount = parseInt(totalamount) - parseInt(roomrate);
                countcapacity = parseInt(countcapacity) - parseInt(capacity);
            }
        } else {

            $(this).addClass('btn-info');
            $(this).removeClass("btn-primary");
            totalamount = parseInt(roomrate) + parseInt(totalamount);
            countcapacity = parseInt(capacity) + parseInt(countcapacity);

            html = '<br><button type="button"  class="allcateroomalocate btn btn-sm  btn-xs  btn-info" id="' + roomid[1] + '" name="' + roomrate + '" >' + roomno + '</button> &nbsp;';


            $('#allocateroom').append(html);


            // var form_data = new FormData();
            // form_data.append('visiterid', visiterid);
            // form_data.append('roomid', roomid);
            // form_data.append('roomrate', roomrate);
            // form_data.append('checkintime', checkintime);
            // form_data.append('checkouttime', checkouttime);
            // form_data.append('_token', token);

            // $.ajax({
            //     url: allocateroom,
            //     type: "POST",
            //     data: form_data,
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     dataType: "json",
            //     success: function(data) {

            //     }
            // });
        }
        getallocateinfo();
        // getsameroom();
        // $('#amount').val(totalamount);



    });

    /*---------------Submit of mainform 2-----------------*/
    $('#mainform1').on('submit', function(event) {
        event.preventDefault();
        var updateid = $('#updateid').val();
        var checkinid = '';
        var men = $('#men').val();
        var women = $('#women').val();
        var child = $('#child').val();
        if (men == "") {
            men = 0;
        }
        if (women == "") {
            women = 0;
        }
        if (child == "") {
            child = 0;
        }
        var totalmember = parseInt(men) + parseInt(women) + parseInt(child)
        console.log("countcapacity" + countcapacity);
        if (countcapacity > totalmember) {
            var nodays = $('#nodays').val();
            var advanceamount = $('#advanceamount').val();
            var amtmode = $('#amtmode').val();
            var flag = 0;
            if (advanceamount > 0) {
                if (amtmode == "") {
                    flag = 1;
                } else {
                    flag = 0;
                }
            }
            if (updateid == "") {
                if (flag == 0) {
                    if (men > 0 || women > 0) {
                        if (nodays > 0) {

                            $.ajax({
                                url: visitercheckinsert,
                                method: "POST",
                                data: new FormData(this),
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType: "json",
                                success: function(data) {
                                    if (data > 0) {
                                        checkinid = data;

                                        $('.allcateroomalocate').each(function() {
                                            var roomid = $(this).attr('id');

                                            var roomrate = $(this).attr('name');

                                            if (roomrate > 0) {

                                                var visiterid = $('#saveid1').val();
                                                var nodays = $('#nodays').val();
                                                var checkintime = $('#checktime').val();
                                                var checkouttime = $('#date').val();
                                                var form_data = new FormData();
                                                form_data.append('visitercheckinid', checkinid);
                                                form_data.append('visiterid', visiterid);
                                                form_data.append('roomid', roomid);
                                                form_data.append('roomrate', roomrate);
                                                form_data.append('checkintime', checkintime);
                                                form_data.append('checkouttime', checkouttime);
                                                form_data.append('_token', token);

                                                $.ajax({
                                                    url: allocateroom,
                                                    type: "POST",
                                                    data: form_data,
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    dataType: "json",
                                                    success: function(data) {
                                                        // alert(data);
                                                    }
                                                });
                                            }
                                        });


                                        datashow();
                                        form_clear();
                                        successTost("Record Save Success Fully");
                                        $('#updateid').val('');
                                        $('#saveid').val('');
                                        $('.formhideshow').hide();
                                        $('.tablehideshow').show();
                                    }
                                }
                            });
                        } else {
                            swal({
                                title: "No Of Day Should Be Grather Than Zero",
                                text: "No Of Day Should Be Grather Than Zero !!",
                                type: "warning",
                            });
                        }

                    } else {
                        swal({
                            title: "Men OR Woman Should Be Grather Than Zero",
                            text: "Men OR Woman Should Be Grather Than Zero !!",
                            type: "warning",
                        });
                    }
                } else {
                    swal({
                        title: "Please Select Payment Mode!!",
                        text: "Please Select Payment Mode!!",
                        type: "warning",
                    });
                }
            } else {
                //alert(updateid);

                $.ajax({
                    url: "allocateroomdelte/" + updateid,
                    beforeSend: function() {

                    },
                    success: function(data) {

                    }
                })
                $.ajax({
                    url: visitercheckupdateurl,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        checkinid = updateid;


                        $('.btn-info').each(function() {
                            var roomid = $(this).attr('id');

                            var roomrate = $(this).attr('name');




                            if (roomrate > 0) {

                                var visiterid = $('#saveid1').val();
                                var nodays = $('#nodays').val();
                                var checkintime = $('#checktime').val();
                                var checkouttime = $('#date').val();
                                var form_data = new FormData();
                                form_data.append('visitercheckinid', checkinid);
                                form_data.append('visiterid', visiterid);
                                form_data.append('roomid', roomid);
                                form_data.append('roomrate', roomrate);
                                form_data.append('checkintime', checkintime);
                                form_data.append('checkouttime', checkouttime);
                                form_data.append('_token', token);

                                $.ajax({
                                    url: allocateroom,
                                    type: "POST",
                                    data: form_data,
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function(data) {

                                    }
                                });
                            }
                        });

                        datashow();
                        toastr.success("Record Update Success Fully");
                        $('#updateid').val('');
                        $('#saveid').val('');
                        $('.formhideshow').hide();
                        $('.tablehideshow').show();

                    }

                });





            }
        } else {
            swal("Member Grather Than Capacity of Room")
        }
        // $('#visitordetalis').hide();
        // $('#visitordetalis1').hide();
        // $('#tbl').show();
        // datashow();

        //$('#master_form')[0].reset();
        //$('#mainform')[0].reset();

    });

    /*--------------Blur Event of Number of Days----------------*/
    $('#nodays').on('blur', function(event) {
        event.preventDefault();
        var noofday = $(this).val();
        if (noofday > 0) {
            $('.date').datepicker({
                'todayHighlight': true,
                format: 'dd/mm/yyyy',
                autoclose: true,
                // token:"{{csrf_token()}}",
            });
            var date = new Date();
            var tomorrow = new Date(date.getTime() + noofday * 24 * 60 * 60 * 1000);
            tomorrow = tomorrow.toString('dd/MM/yyyy hh:mm:ss');
            $("#date").val(tomorrow);
        }

    });

    datashow();
    /*----------------funcction data show-----------------*/
    function datashow() {
        $.ajax({
            url: showalldata,
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
                var table1 = $('#visitercheckintb').DataTable();
                table1.destroy();
                $('#tablebody').html('');
                var sr = 0;

                var html = '';
                // alert(data);

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


                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td id="visitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                        '<td id="lastname_' + data[i].id + '">' + data[i].lastname + '</td>' +
                        '<td id="address_' + data[i].id + '">' + data[i].address + '</td>' +
                        '<td id="mobileno_' + data[i].id + '">' + data[i].mobileno + '</td>' +
                        '<td id="checkintimedata_' + data[i].id + '">' + checkintime + '</td>' +
                        '<td style="display:none;" id="emailid_' + data[i].id + '">' + data[i].emailid + '</td>' +
                        '<td style="display:none;" id="c_detalis_' + data[i].id + '">' + data[i].c_detalis + '</td>' +
                        '<td style="display:none;" id="c_name_' + data[i].id + '">' + data[i].c_name + '</td>' +
                        '<td style="display:none;" id="desighnation_' + data[i].id + '">' + data[i].desighnation + '</td>' +
                        '<td style="display:none;" id="c_url_' + data[i].id + '">' + data[i].c_url + '</td>' +
                        '<td style="display:none;" id="c_contactno_' + data[i].id + '">' + data[i].c_contactno + '</td>' +
                        '<td style="display:none;" id="c_emailid_' + data[i].id + '">' + data[i].c_emailid + '</td>' +
                        '<td style="display:none;" id="men_' + data[i].id + '">' + data[i].men + '</td>' +
                        '<td style="display:none;" id="woman_' + data[i].id + '">' + data[i].woman + '</td>' +
                        '<td style="display:none;" id="child_' + data[i].id + '">' + data[i].child + '</td>' +
                        '<td style="display:none;" id="noofday_' + data[i].id + '">' + data[i].noofday + '</td>' +
                        '<td style="display:none;" id="checkintime_' + data[i].id + '">' + checkintime + '</td>' +
                        '<td style="display:none;" id="checkouttime_' + data[i].id + '">' + checkouttime + '</td>' +
                        '<td style="display:none;" id="amount_' + data[i].id + '">' + data[i].amount + '</td>' +
                        '<td style="display:none;" id="advancepayment_' + data[i].id + '">' + data[i].advancepayment + '</td>' +
                        '<td style="display:none;" id="mode_' + data[i].id + '">' + data[i].mode + '</td>' +
                        '<td style="display:none;" id="remark_' + data[i].id + '">' + data[i].remark + '</td>' +

                        '<td style="display:none;" id="address2_' + data[i].id + '">' + data[i].address2 + '</td>' +
                        '<td style="display:none;" id="street_' + data[i].id + '">' + data[i].street + '</td>' +
                        '<td style="display:none;" id="city_' + data[i].id + '">' + data[i].city + '</td>' +
                        '<td style="display:none;" id="postalcode_' + data[i].id + '">' + data[i].postalcode + '</td>' +
                        '<td style="display:none;" id="state_' + data[i].id + '">' + data[i].state + '</td>' +
                        '<td style="display:none;" id="profilepicture_' + data[i].id + '">' + data[i].profilepicture + '</td>' +


                        '<td ><button name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + ' checkvistreid=' + data[i].visiterid + '><i class="fa fa-edit"></i></button>&nbsp;<a href="' + getcheckout + "/" + data[i].id + '" ><button name="chechoutuser" class="chechoutuser btn btn-xs  btn-info" id=' + data[i].id + '>checkout</button></a> &nbsp;&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                }

                $('#tablebody').append(html);
                $('#visitercheckintb').DataTable({});
                $("div").removeClass("form-inline");
            }
        });
    }
    $(document).on('click', '.edit_data', function() {


        $('#visiter_data').show();
        $('.btnhideshow').trigger('click');



        var id = $(this).attr('id');
        // alert(id);
        var visterid = $(this).attr('checkvistreid');
        var visitername = $('#visitername_' + id).html();

        var address = $('#address_' + id).html();
        var mobileno = $('#mobileno_' + id).html();
        var emailid = $('#emailid_' + id).html();
        var c_detalis = $('#c_detalis_' + id).html();
        var c_name = $('#c_name_' + id).html();
        var desighnation = $('#desighnation_' + id).html();
        var c_url = $('#c_url_' + id).html();
        var c_contactno = $('#c_contactno_' + id).html();
        var c_emailid = $('#c_emailid_' + id).html();
        var lastname = $('#lastname_' + id).html();



        if (c_name == null) {
            c_name = "";
        }
        if (desighnation == null) {
            desighnation = "";
        }
        if (c_url == null) {
            c_url = "";
        }
        if (c_contactno == null) {
            c_contactno = "";
        }
        if (c_emailid == null) {
            c_emailid = "";
        }
        if (emailid == null) {
            emailid = "";
        }


        var men = $('#men_' + id).html();
        var woman = $('#woman_' + id).html();
        var child = $('#child_' + id).html();
        var noofday = $('#noofday_' + id).html();
        var checkintime = $('#checkintime_' + id).html();
        var checkouttime = $('#checkouttime_' + id).html();
        var amount = $('#amount_' + id).html();
        var advancepayment = $('#advancepayment_' + id).html();
        var mode = $('#mode_' + id).html();
        var remark = $('#remark_' + id).html();

        var address2 = $('#address2_' + id).html();
        var street = $('#street_' + id).html();
        var city = $('#city_' + id).html();
        var postalcode = $('#postalcode_' + id).html();
        var state = $('#state_' + id).html();

        var profilepicture = $('#profilepicture_' + id).html();
        if (address2 == null) {
            address2 = "";
        }


        $('#profileimg').attr('src', imgurl + '/profileuploads/' + profilepicture);

        $('#lastname').val(lastname);
        $('#address2').val(address2);
        $('#street').val(street);
        $('#city').val(city);
        $('#state').val(state);
        $('#postalcode').val(postalcode);



        $('#saveid').val(visterid);
        $('#saveid1').val(visterid);
        $('#name').val(visitername);
        $('#address1').val(address);
        $('#mobileno').val(mobileno);
        $('#email').val(emailid);
        $('#c_name').val(c_name);
        $('#desgination').val(desighnation);
        $('#url').val(c_url);
        $('#contactno').val(c_contactno);
        $('#c_email').val(c_emailid);

        $('#men').val(men);
        $('#women').val(woman);
        $('#child').val(child);
        $('#checktime').val(checkintime);
        $('#date').val(checkouttime);
        $('#nodays').val(noofday);
        $('#amount').val(amount);
        totalamount = amount;
        $('#advanceamount').val(advancepayment);
        $('#amtmode').val(mode);
        $('#remark').val(remark);

        $('#updateid').val(id);


        if (c_detalis == 1) {

            $('#comapanydata').prop('checked', true);
            $('#purposedata').show();
            // $('#comapanydata').trigger('click');
        } else {
            $('#comapanydata').prop('checked', false);
            $('#purposedata').hide();
        }
        $.ajax({
            url: "docuploaddata/" + visterid + "/edit",
            dataType: "json",
            success: function(data) {
                var row_id = 0;

                $("#docupload_tbody").html('');
                for (var i = 0; i < data.length; i++) {

                    row_id = row_id + 1;
                    var html = '<tr  class="proffinfodata"  id="proffinfo_' + row_id + '" >' +
                        '<td>' +
                        '<select id="profdoc_' + row_id + '" name="profdoc_' + row_id + '" class="form-control" style="width:100%">' +
                        '<option value="0" disabled selected>Select Proff</option>' +
                        '<option value="AdharCard">AdharCard</option>' +
                        '<option value="Pancard">Pancard</option>' +
                        '<option value="Drivinglicense">Driving license</option>' +
                        '<option value="VoterID">VoterID </option>' +
                        '</select>' +

                        '</td>' +

                        '<td>' +
                        '<input type="number" id="proffno_' + row_id + '" name="proffno_' + row_id + '" class="form-control" placeholder="Proff No" value="' + data[i].docproff_no + '">' +
                        '</td>' +

                        '<td>' +
                        '<input type="file" id="file_' + row_id + '" name="file_' + row_id + '" class="form-control proffupload">' +
                        '<div id="msgid_' + row_id + '"></div>' +
                        '<input type="hidden" id="filehidden_' + row_id + '" name="filehidden_' + row_id + '" value="' + data[i].filename + '">' +
                        '</td>' +

                        '<td>&nbsp;<button  class="proff_delete_data btn btn-xs btn-danger"   id="proffinfo_' + row_id + '" title="Remove Section !!!" ><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';

                    $('#docupload_tbody').prepend(html);
                    $('#doc_row_id').val(row_id);
                    $('#profdoc_' + row_id).val(data[i].doc_name).trigger('change');
                    $('#msgid_' + row_id).html(data[i].filename);
                }
            }
        });

        var date = checkintime;
        var fdateslt = date.split('/');
        var time = fdateslt[2].split(' ');
        var checkintime = time[0] + '-' + fdateslt[1] + '-' + fdateslt[0] + ' ' + time[1];
        //alert(visterid + "" + id);

        $.ajax({
            type: "POST",
            url: "visterallocateroom/" + visterid + "/" + id,
            data: {
                "_token": token,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                $('#show_master1').html('');
                // alert(data);
                var html = '';
                html += '<table id="roomtable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Category</th>' +

                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    if (data[i].roomdata.length > 0) {
                        html += '<tr><td id="catname_' + data[i].id + '"><b>' + data[i].catname + '</b>';
                        html += '<br>';
                        for (var j = 0; j < data[i].roomdata.length; j++) {
                            html += '<button  class="roomalocate btn btn-sm  btn-xs  btn-info" categoryid="' + data[i].cateid + '" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].rate + '" visterid="' + data[i].roomdata[j].visterid + '" >' + data[i].roomdata[j].roomno + '</button> &nbsp;';

                        }
                        html += '</td></tr>';
                    }
                }
                html += '</tbody></table>';
                $('#show_master1').html(html);
            }
        });



    });

    getallocateroom();
    $(document).on('click', '.visiterallocateroom', function(e) {
        e.preventDefault();
        var roomid = $(this).attr('id');
        var visiterid = $(this).attr('visterid');
        $.ajax({
            url: "getvistercheckout/" + roomid + "/" + visiterid,
            beforeSend: function() {

            },
            success: function(data) {
                if (data.length > 0) {
                    $(this).addClass('btn-primary');
                    $(this).removeClass("btn-info");
                }
            }
        })

    });

    /*--------get two date diffrent --------*/
    $(document).on('blur', '#date', function(e) {
        e.preventDefault();




        var checktime = $('#checktime').val();
        var cheout = $('#date').val();

        if (Date.parse(checktime) <= Date.parse(cheout)) {

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

            $('#nodays').val(diffDays);
        } else {
            swal("please Select Check Out Date Grather than Check in Date ")
        }
        // var diff = new Date(Date.parse(cheout) - Date.parse(checktime));
        // alert(diff);
        // var years = Math.floor(diff_date / 31536000000);
        // var months = Math.floor((diff_date % 31536000000) / 2628000000);
        // var days = Math.floor(((diff_date % 31536000000) % 2628000000) / 86400000);



        // alert(checktime + "cheout" + cheout);
        // var oneDay = 24 * 60 * 60 * 1000;
        // var days = '';


        // //  var diff = new Date(cheout - checktime),
        // diff = Math.round(Math.abs((cheout.getTime() - checktime.getTime()) / (oneDay)));

        // days = diff / 1000 / 60 / 60 / 24;
        // days = Math.round(days);


        // alert('hii' + days);
        // $('#nodays').val(days);
        getallocateinfo();
    });




    //---function for get all same class room
    function getsameroom() {
        var totalamount = 0;
        $('.btn-info').each(function() {
            var roomid = $(this).attr('id');
            var roomrate = $(this).attr('name');
            var nodays = $('#nodays').val();
            var sum = 0;

            if (roomrate > 0) {
                sum = parseInt(roomrate) * parseInt(nodays);
                totalamount = parseInt(totalamount) + parseInt(sum);
            }


        });
        $('#amount').val(totalamount);
    }

    addproof();

    //function for add proff dynamically
    function addproof() {
        var row_id = $('#doc_row_id').val();
        row_id = parseInt(row_id) + 1;
        var html = '<tr  class="proffinfodata"  id="proffinfo_' + row_id + '" >' +
            '<td>' +
            '<select id="profdoc_' + row_id + '" name="profdoc_' + row_id + '" class="form-control" style="width:100%">' +
            '<option value="0" disabled selected>Select Proff</option>' +
            '<option value="AdharCard">AdharCard</option>' +
            '<option value="Pancard">Pancard</option>' +
            '<option value="Drivinglicense">Driving license</option>' +
            '<option value="VoterID">VoterID </option>' +
            '</select>' +

            '</td>' +

            '<td>' +
            '<input type="number" id="proffno_' + row_id + '" name="proffno_' + row_id + '" class="form-control" placeholder="Proff No">' +
            '</td>' +

            '<td>' +
            '<input type="file" id="file_' + row_id + '" name="file_' + row_id + '" class="form-control proffupload">' +
            '<div id="msgid_' + row_id + '"></div>' +
            '<input type="hidden" id="filehidden_' + row_id + '" name="filehidden_' + row_id + '">' +
            '</td>' +

            '<td>&nbsp;<button  class="proff_delete_data btn btn-xs btn-danger"   id="proffinfo_' + row_id + '" title="Remove Section !!!" ><i class="fa fa-trash"></i></button></td>' +
            '</tr>';

        $('#docupload_tbody').prepend(html);
        $('#doc_row_id').val(row_id);

        $('.proffupload').change(function() {
            var id = $(this).attr('id');

            if ($(this).val() != '') {
                upload(this, id);

            }
        });

    }
    //click event of add proff button
    $(document).on('click', '#addproff', function(e) {
        e.preventDefault();
        addproof();
    });

    //for deleting prooff data


    $(document).on('click', '.proff_delete_data', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        id = id.split("_");
        if (id != "") {
            $('#proffinfo_' + id[1]).remove();
        }

    });

    $('.proffupload').change(function() {
        var id = $(this).attr('id');
        //  alert(id);
        if ($(this).val() != '') {
            upload(this, id);

        }
    });

    function upload(img, id) {

        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        //form_data.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: uploadfileurl,
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                // alert(data);
                id = id.split("_");
                $('#file_' + id[1]).val('');
                $('#msgid_' + id[1]).html(data);
                $('#filehidden_' + id[1]).val(data);

            }
        });
    }
    $(document).on('blur', '#txt_searchall', function(e) {
        e.preventDefault();

        var search = $(this).val();

        // Hide all table tbody rows
        $('#roomtable tbody tr').hide();

        // Count total search result
        // var len = $('#roomtable tbody tr:not(.notfound) td:contains("' + search + '")').length;
        var len = $('table tbody tr:not(.notfound) td:nth-child(1):contains("' + search + '")').length;
        if (len > 0) {
            // Searching text in columns and show match row
            $('#roomtable tbody tr:not(.notfound) td:contains("' + search + '")').each(function() {
                $(this).closest('tr').show();
            });
        } else {
            swal({
                title: "Room Not Found",
                // text: "Room Not Found !!",
                type: "warning",
            });
        }

    });


    function forgetadvanceroom() {
        var visiterid = $('#saveid1').val();

        $.ajax({
            url: getadvancecheckin + "/" + visiterid,
            data: {
                "_token": token,
            },
            type: 'GET',
            contentType: false,
            processData: false,
            success: function(data) {

                ///$('#show_master1').html('');
                if (data == '0') {
                    getallocateroom();
                } else {

                    var html = '';
                    html += '<table id="roomtable" class="table table-striped">' +
                        '<thead>' +
                        '<tr>' +
                        '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Category</th>' +

                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    for (var i = 0; i < data.length; i++) {
                        if (data[i].roomdata.length > 0) {

                            html += '<tr><td id="catname_' + data[i].id + '"><b>' + data[i].catname + '</b>';
                            html += '<br>';
                            for (var j = 0; j < data[i].roomdata.length; j++) {

                                html += '<button  class="roomalocate btn btn-sm  btn-xs  btn-primary" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].rate + '" visterid="' + data[i].roomdata[j].visterid + '" >' + data[i].roomdata[j].roomno + '</button> &nbsp;';

                            }
                            html += '</td></tr>';
                        }
                    }
                    html += '</tbody></table>';
                    $('#show_master1').html(html);
                }
            }
        });

    }

    $(document).on('blur', '.guesttotal', function(e) {
        e.preventDefault();
        var men = $('#men').val();
        var women = $('#women').val();
        var child = $('#child').val();

        if (men == "") {
            men = 0;
        }
        if (women == "") {
            women = 0;
        }
        if (child == "") {
            child = 0;
        }
        var totalguest = parseInt(men) + parseInt(women) + parseInt(child);

        $('#totalnoguest').val(totalguest);
    });

    //for blur Event of -------
    $(document).on('blur', '#checktime', function(e) {
        e.preventDefault();
        var checktime = $(this).val();
        var date = new Date();

        $('#datetimepicker1').datetimepicker({
            //pickTime: true,
            format: 'DD/MM/YYYY HH:mm:ss',
            minDate: checktime, // disable past date



        });
    });

    /*----click Event of Category name--*/
    $(document).on('click', '.categoryname', function(e) {
        e.preventDefault();
        var flag = 0;
        var count = 0;
        var category = $(this).attr('id');
        category = category.split("_");
        var rate = $(this).attr('caterate');
        var categoryname = $(this).text();
        var capacity = $(this).attr('capacity');


        $.ajax({
            url: getallroominfo + "/" + category[1],
            type: "GET",

            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var html = '<b >' + categoryname + '</b><br>';
                for (var i = 0; i < data.length; i++) {
                    count = count + 1;

                    flag = getmatchdata(data[i].id);
                    //alert(flag);
                    console.log(flag);


                    if (flag == 1) {
                        // $(this).remove();
                        html += '<button type="button"  class="roomalocate btn btn-sm  btn-xs  btn-info" usercapacity="' + capacity + '" getid="btnroom_' + data[i].id + '"  id="freeroom_' + data[i].id + '" name="' + rate + '" >' + data[i].roomno + '</button> &nbsp;';
                    } else {
                        html += '<button type="button"  class="roomalocate btn btn-sm  btn-xs  btn-primary" usercapacity="' + capacity + '" getid="btnroom_' + data[i].id + '"  id="freeroom_' + data[i].id + '" name="' + rate + '" >' + data[i].roomno + '</button> &nbsp;';
                    }



                    // html += '<br>';
                    // for (var j = 0; j < data[i].roomdata.length; j++) {
                    //     html += '<button  class="roomalocate btn btn-sm  btn-xs  btn-primary" id="' + data[i].roomdata[j].roomid + '" name="' + data[i].rate + '" >' + data[i].roomdata[j].roomno + '</button> &nbsp;';
                    // }
                    // html += '</a></<a>';
                    if (count == 10) {
                        html += "<br><br>";
                        count = 0;
                    }

                }
                //html += '</tbody></table>';
                $('#roominfo').html(html);
            }
        });
    });

    function getmatchdata(id) {
        var flag1 = 0;
        $('.allcateroomalocate').each(function() {
            var alocateid = (this.id);
            //if ($(this).hasClass('btn btn-info')) {
            if (alocateid == id) {
                flag1 = 1;
                return flag1;

            }
            // }
        });
        return flag1;

    }
    $(document).on('click', '.allcateroomalocate', function(e) {
        e.preventDefault();
        var alid = $(this).attr('id');
        // alid = alid.split("_");
        allocateroomdelete(alid);
        $(this).remove();

        getallocateinfo();

    });

    function allocateroomdelete(allocateid) {

        $('.roomalocate').each(function() {
            var id = $(this).attr("id");
            id = id.split("_");

            //if ($(this).hasClass('btn btn-info')) {
            // alert('hii' + allocateid + "==id" + id[1]);
            if (allocateid == id[1]) {

                // $(this).attr("getid").addClass('btn-primary');
                // $(this).attr("getid").removeClass("btn-info");
                $('#freeroom_' + id[1]).addClass('btn-primary');
                $('#freeroom_' + id[1]).removeClass("btn-info");

            }
            // }
        });

    }


    function getallocateinfo() {
        var total = 0;
        $('.allcateroomalocate').each(function() {
            var alocateid = (this.id);
            var rate = (this.name);
            var noofday = $('#nodays').val();
            var amt = 0;

            console.log(noofday)

            if (noofday > 0) {
                amt = parseInt(rate) * parseInt(noofday);
                total = parseInt(amt) + parseInt(total);

            }

        });
        $('#amount').val(total);

    }

    function gettimediff() {
        var checktime = $('#checktime').val();
        var cheout = $('#date').val();

        if (checktime <= cheout) {

            var checktime1 = checktime.split(' ');
            var cheout1 = cheout.split(' ');
            checktime = checktime1[0];
            checkintime = checktime1[1];


            cheout = cheout1[0];
            checkouttime = cheout1[1];








            var firstdate1 = checktime.split("/");
            var enddate1 = cheout.split("/");



            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date(firstdate1[2], firstdate1[1], firstdate1[0]);
            var secondDate = new Date(enddate1[2], enddate1[1], enddate1[0]);



            var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
            diffDays = parseInt(diffDays);





            $('#nodays').val(diffDays);
        } else {
            swal("please Select Check Out Date Grather than Check in Date ")
        }
    }

    // $(document).on('click', '.chechoutuser', function() {

    //     var id = $(this).attr('id');
    //     alert(id);
    //     $.ajax({
    //         url: getcheckout + "/" + id,
    //         type: "GET",

    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         dataType: "json",
    //         success: function(data) {

    //         }
    //     });


    // });

    //function for hide show pf advance payment
    $(document).on('keyup', '#advanceamount', function(e) {
        e.preventDefault();
        var amt = $(this).val();
        if (amt > 0) {
            $('.hideamtdata').show();
        } else {
            $('.hideamtdata').hide();
        }
    });
    $('.hideamtdata').hide();

    $(document).on('click', '.delete_data', function() {
        var id1 = $(this).attr('id');
        //$('#saveid').val(id1);
        if (id1 != "") {
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this Data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plz!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {

                    $.ajax({
                        data: {

                            id: id1,
                        },
                        url: deltevisitercheckin,
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {

                            if (data == true) {
                                swal("Deleted !!", "Hey, your Data has been deleted !!", "success");
                                $('.closehideshow').trigger('click');
                                $('#save_update').val("");
                                datashow(); //call function show all data
                            } else {
                                errorTost("Data Delete Failed");
                            }

                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });


                });
        } else {
            return false;
        }
    });



});
