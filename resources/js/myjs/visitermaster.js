$(document).ready(function() {


    $('#purposedata').hide();
    $('.btnhideshow').click(function() {
        $('.tablehideshow').hide();
        $(".formhideshow").show();
        $('#saveid').val('');
        form_clear();
        $('#docupload_tbody').html('');
        addproof();

    });
    $('.closehideshow').click(function() {
        $('.tablehideshow').show();
        $(".formhideshow").hide();
        $('#saveid').val('');
    });

    $('input[type="checkbox"]').click(function() {
        if ($('#comapanydata').prop("checked") == true) {

            $('#purposedata').show();
        } else {
            $('#purposedata').hide();
        }
    });

    $('#master_form').on('submit', function(event) {
        event.preventDefault();
        var docid = '';
        var id = $('#saveid').val();

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
                    successTost("Operation Successfull");

                    var r1 = $('table#docupload').find('tbody').find('tr');
                    var r = r1.length;
                    var tr = "";

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
                            form_data.append('_token', doc_token);

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
                    datashow();
                }
            });
        } else {

            docid = $('#saveid').val();
            $.ajax({
                url: "docuploaddata/destroy/" + docid,
                beforeSend: function() {

                },
                success: function(data) {

                }
            })
            $.ajax({
                url: updateurl,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {

                    // toastr.success("Record Update Success Fully");

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
                    form_data.append('_token', doc_token);

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
            datashow();
            toastr.success("Record Update Success Fully");
        }





        $('.tablehideshow').show();
        $(".formhideshow").hide();
        datashow();
        $('#saveid').val('');

    });

    //code for validate mobile number
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
    //End of validation of mobile number
    datashow();

    function datashow() {

        $.ajax({
            url: displayurl,
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
                var table1 = $('#visitertb').DataTable();
                table1.destroy();
                var sr = 0;

                var html = '';
                $('#tablebody').html('');

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="visitername_' + data[i].id + '"> <a  class="tbvisitername" id="tbvisitername_' + data[i].id + '" name="tbvisitername_' + data[i].id + '"  >' + data[i].visitername + " " + data[i].lastname + '</a></td>' +
                        '<td style="display:none;" id="lastname_' + data[i].id + '">' + data[i].lastname + '</td>' +
                        '<td id="address_' + data[i].id + '">' + data[i].address + '</td>' +
                        '<td id="mobileno_' + data[i].id + '">' + data[i].mobileno + '</td>' +
                        '<td style="display:none;" id="emailid_' + data[i].id + '">' + data[i].emailid + '</td>' +
                        '<td style="display:none;" id="c_detalis_' + data[i].id + '">' + data[i].c_detalis + '</td>' +
                        '<td style="display:none;" id="c_name_' + data[i].id + '">' + data[i].c_name + '</td>' +
                        '<td style="display:none;" id="desighnation_' + data[i].id + '">' + data[i].desighnation + '</td>' +
                        '<td style="display:none;" id="c_url_' + data[i].id + '">' + data[i].c_url + '</td>' +
                        '<td style="display:none;" id="c_contactno_' + data[i].id + '">' + data[i].c_contactno + '</td>' +
                        '<td style="display:none;" id="c_emailid_' + data[i].id + '">' + data[i].c_emailid + '</td>' +

                        '<td style="display:none;" id="address2_' + data[i].id + '">' + data[i].address2 + '</td>' +
                        '<td style="display:none;" id="street_' + data[i].id + '">' + data[i].street + '</td>' +
                        '<td style="display:none;" id="city_' + data[i].id + '">' + data[i].city + '</td>' +
                        '<td style="display:none;" id="postalcode_' + data[i].id + '">' + data[i].postalcode + '</td>' +
                        '<td style="display:none;" id="state_' + data[i].id + '">' + data[i].state + '</td>' +
                        '<td style="display:none;" id="profilepicture_' + data[i].id + '">' + data[i].profilepicture + '</td>' +

                        '<td ><button name="edit"  class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + '><i class="fa fa-edit"></i> </button>&nbsp;&nbsp;<button name="delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                }
                html += '</tbody></table>';
                $('#tablebody').append(html);
                $('#visitertb').DataTable({

                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false,

                    }],
                });
            }
        });
    }
    $(document).on('click', '.edit_data', function() {
        $('.tablehideshow').hide();
        $(".formhideshow").show();
        var id = $(this).attr('id');
        var visitername = $('#visitername_' + id).text();
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
        var address2 = $('#address2_' + id).html();
        var street = $('#street_' + id).html();
        var city = $('#city_' + id).html();
        var postalcode = $('#postalcode_' + id).html();
        var state = $('#state_' + id).html();
        var profilepicture = $('#profilepicture_' + id).html();
        $('#pfilehidden1').val(profilepicture);

        $('#profileimg').attr('src', imgurl + '/profileuploads/' + profilepicture);

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

        visitername = visitername.split(" ");

        $('#saveid').val(id);
        $('#name').val(visitername[1]);
        $('#address1').val(address);
        $('#mobileno').val(mobileno);
        $('#email').val(emailid);
        $('#c_name').val(c_name);
        $('#desgination').val(desighnation);
        $('#url').val(c_url);
        $('#contactno').val(c_contactno);
        $('#c_email').val(c_emailid);

        $('#lastname').val(lastname);
        $('#address2').val(address2);
        $('#street').val(street);
        $('#city').val(city);
        $('#state').val(state);
        $('#postalcode').val(postalcode);
        $('#btn_submit').text('Update');


        if (c_detalis == 1) {

            $('#comapanydata').prop('checked', true);
            $('#purposedata').show();
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
                        '<option value="0" disabled selected>Select Proof</option>' +
                        '<option value="AdharCard">AdharCard</option>' +
                        '<option value="Pancard">Pancard</option>' +
                        '<option value="Drivinglicense">Driving license</option>' +
                        '<option value="VoterID">VoterID </option>' +
                        '</select>' +

                        '</td>' +

                        '<td>' +
                        '<input type="number" id="proffno_' + row_id + '" name="proffno_' + row_id + '" class="form-control" placeholder="Proof No" value="' + data[i].docproff_no + '">' +
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



                    } else {
                        swal("Cancelled", "Your record is safe :)", "error");
                    }
                });
        } else {
            return false;
        }
    });


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
        //alert(id);
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
                //alert(data);
                id = id.split("_");
                $('#file_' + id[1]).val('');
                $('#msgid_' + id[1]).html(data);
                $('#filehidden_' + id[1]).val(data);

            }
        });
    }

    function form_clear() {
        $('#name').val('');
        $('#lastname').val('');
        $('#address1').val('');
        $('#address2').val('');
        $('#street').val('');
        $('#city').val('');
        $('#postalcode').val('');
        $('#state').val('');
        $('#mobileno').val('');
        $('#email').val('');
        $('#comapanydata').prop('checked', false);
        $('#c_name').val('');
        $('#desgination').val('');
        $('#url').val('');
        $('#contactno').val('');
        $('#c_email').val('');
        $('#btn_submit').text('Save');
        $('#profileimg').attr('src', imgurl + '/resources/img/usersicon.jpg');

    }
    $(document).on('click', '#reset', function(e) {
        e.preventDefault();
        form_clear();
    });

    //for Clcik Event of Role link start
    $(document).on('click', '.tbvisitername', function(e) {
        e.preventDefault();
        $('.formhideshow').hide();
        $('.tablehideshow').hide();
        $('#visiterview').show();
        $('#tab1').trigger('click');
        var id = $(this).attr('id');
        id = id.split("_");

        $('#edit').val(id[1]);
        $('#delete').val(id[1]);

        var visitername = $('#visitername_' + id[1]).text();
        var address = $('#address_' + id[1]).html();
        var mobileno = $('#mobileno_' + id[1]).html();
        var emailid = $('#emailid_' + id[1]).html();

        var c_detalis = $('#c_detalis_' + id[1]).html();
        var c_name = $('#c_name_' + id[1]).html();
        var desighnation = $('#desighnation_' + id[1]).html();
        var c_url = $('#c_url_' + id[1]).html();
        var c_contactno = $('#c_contactno_' + id[1]).html();
        var c_emailid = $('#c_emailid_' + id[1]).html();


        var lastname = $('#lastname_' + id[1]).html();
        var address2 = $('#address2_' + id[1]).html();
        var street = $('#street_' + id[1]).html();
        var city = $('#city_' + id[1]).html();
        var postalcode = $('#postalcode_' + id[1]).html();
        var state = $('#state_' + id[1]).html();
        var profilepicture = $('#profilepicture_' + id[1]).html();

        $('#infovisitername').text("Visitor Name:" + visitername);

        if (profilepicture == "") {
            $('#infoimages').attr('src', imgurl + '/resources/img/usersicon.jpg');
        } else {
            $('#infoimages').attr('src', imgurl + '/profileuploads/' + profilepicture);
        }



        $('#viewaddress1').val(address);
        $('#viewaddress2').val(address2);
        $('#viewstreet').val(street);
        $('#viewcity').val(city);
        $('#viewpostalcode').val(postalcode);
        $('#viewstate').val(state);
        $('#viewmobileno').val(mobileno);

        $('#viewemail').val(emailid);


        getvisiterinfo(id[1]);
    });

    function getvisiterinfo(visiter) {
        $.ajax({
            url: getvisitoralldata + "/" + visiter,
            dataType: "json",
            success: function(data) {
                var totalamt = "";
                var html = '';
                html += '<table id="myTable" class="table table-striped">' +
                    '<thead>' +
                    '<tr>' +
                    '<th  style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In Information</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check In Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Check Out Date </th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Allocate Room </th>' +
                    //'<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Invoice Date</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Invoice No</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;">Total Amount</th>' +
                    //  '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;">Creation Date</th>'+

                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                for (i = 0; i < data.length; i++) {
                    var checkintime = '';
                    var checkouttime = '';
                    var totalguest = '';

                    totalguest = parseInt(data[i].men) + parseInt(data[i].woman) + parseInt(data[i].child);


                    if (data[i].checkintime != "") {
                        var date = data[i].checkintime;
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];


                    } else {
                        checkintime = '-';
                    }
                    if (data[i].checkouttime != "") {
                        var date = data[i].checkouttime;
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];
                    } else {
                        checkouttime = '-';
                    }





                    html += '<tr>' +
                        '<td id="men_' + data[i].id + '">Men:' + totalguest + '</td>' +
                        // '<td id="woman_' + data[i].id + '">Woman:' + data[i].woman + '</td>' +
                        // '<td id="child_' + data[i].id + '">Child:' + data[i].child + '</td>' +
                        '<td id="checkintime_' + data[i].id + '">' + checkintime + '</td>' +
                        '<td id="checkouttime_' + data[i].id + '">' + checkouttime + '</td>' +
                        '<td id="allocateroom" >';
                    for (j = 0; j < data[i].roomdata.length; j++) {
                        html += '<span>Room No:' + data[i].roomdata[j].roomno + '</span><br>';
                    }
                    html += '</td>' +
                        '<td id="invoiceno_' + data[i].id + '">' + data[i].invoiceno + '</td>' +
                        '<td id="invoiceamt_' + data[i].id + '">' + data[i].invoicetotal + '</td>' +
                        '</tr>';
                }
                html += '</tbody></table>';
                $('#getallinfo').html(html);


            }
        });
    }

    $(document).on('click', '#next', function(e) {
        e.preventDefault();
        $("#tab2").trigger('click');
    });
    $(document).on('click', '#cancle', function(e) {
        e.preventDefault();
        $('.formhideshow').hide();
        $('.tablehideshow').show();
        $('#visiterview').hide();
    });
    $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        var id = $(this).val();

        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('#visiterview').hide();
        $('#saveid').val(id);

        $('.tablehideshow').hide();
        $(".formhideshow").show();

        var visitername = $('#visitername_' + id).text();
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
        var address2 = $('#address2_' + id).html();
        var street = $('#street_' + id).html();
        var city = $('#city_' + id).html();
        var postalcode = $('#postalcode_' + id).html();
        var state = $('#state_' + id).html();
        var profilepicture = $('#profilepicture_' + id).html();
        $('#pfilehidden1').val(profilepicture);

        $('#profileimg').attr('src', imgurl + '/profileuploads/' + profilepicture);

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

        visitername = visitername.split(" ");

        $('#saveid').val(id);
        $('#name').val(visitername[1]);
        $('#address1').val(address);
        $('#mobileno').val(mobileno);
        $('#email').val(emailid);
        $('#c_name').val(c_name);
        $('#desgination').val(desighnation);
        $('#url').val(c_url);
        $('#contactno').val(c_contactno);
        $('#c_email').val(c_emailid);

        $('#lastname').val(lastname);
        $('#address2').val(address2);
        $('#street').val(street);
        $('#city').val(city);
        $('#state').val(state);
        $('#postalcode').val(postalcode);
        if (c_detalis == 1) {

            $('#comapanydata').prop('checked', true);
            $('#purposedata').show();
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
                        '<option value="0" disabled selected>Select Proof</option>' +
                        '<option value="AdharCard">AdharCard</option>' +
                        '<option value="Pancard">Pancard</option>' +
                        '<option value="Drivinglicense">Driving license</option>' +
                        '<option value="VoterID">VoterID </option>' +
                        '</select>' +

                        '</td>' +

                        '<td>' +
                        '<input type="number" id="proffno_' + row_id + '" name="proffno_' + row_id + '" class="form-control" placeholder="Proof No" value="' + data[i].docproff_no + '">' +
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

    });
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var id1 = $(this).val();
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
                            url: "docuploaddata/destroy/" + id1,
                            beforeSend: function() {

                            },
                            success: function(data) {

                            }
                        })
                        $.ajax({
                            type: "GET",
                            url: "visiter/destroy/" + id1,
                            contentType: false,
                            cache: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                //alert(data);
                                swal("Deleted!", "Your Record has been deleted.", "success");
                                datashow();
                                $('.tablehideshow').show();
                                $(".formhideshow").hide();
                                $('#visiterview').hide();
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




});