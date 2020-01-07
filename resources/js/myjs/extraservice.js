$(document).ready(function() {
    var flag = 0;
    $('#mainform').hide();
    $('#tbl').show();
    $('#purposedata').hide();
    $('.closehideshow').click(function() {
        $(".tablehideshow").show();
        $(".formhideshow").hide();
        $(".btnhideshow").show();
        $('#saveid').val('');
    });
    $('.btnhideshow').click(function() {
        $(".tablehideshow").hide();
        $(".formhideshow").show();
        $('#saveid').val('');
        from_clear();
    });





    $('#master_form').on('submit', function(event) {
        event.preventDefault();
        var uid = '';

        var id = $('#saveid').val();
        var rate = $('#rate').val();
        var unit = $('#unit').val();

        if (rate > 0 && unit > 0) {

            $.ajax({
                url: inserturl,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data == '100') {
                        swal({
                            title: "Service Already Exists",
                            // text: "Please Enter 10 digits!",
                            type: "warning",
                        });
                    } else {
                        datashow();
                        toastr.success("Record save Success Fully");
                        // ;
                        $(".tablehideshow").show();
                        $(".formhideshow").hide();
                        $(".btnhideshow").show();
                        $('#saveid').val('');
                    }


                }

            });
        } else {
            swal({
                title: "Rate And Unit Sholud Greater Than Zero",
                // text: "Please Enter 10 digits!",
                type: "warning",
            });
        }




    });

    //code for validate mobile number
    $(document).on("blur", "#mobileno", function(e) {
        e.preventDefault();
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        var m = $('#mobileno').val();
        if (filter.test(m)) {
            if (m.length == 10) {
                validate = 1;
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
    $("div").removeClass("form-inline");

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
                var table1 = $('#usertb').DataTable();
                table1.destroy();
                var sr = 0;
                var html = '';
                $('#tablebody').html('');

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td style="width:10%" id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td style="width:40%" id="servicename_' + data[i].id + '">' + data[i].servicename + '</td>' +
                        '<td style="width:15%" id="unit_' + data[i].id + '">' + data[i].unit + '</td>' +
                        '<td style="width:15%" id="rate_' + data[i].id + '">' + data[i].rate + '</td>' +
                        '<td style="width:20%"><button type="button" name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + '><i class="fa fa-edit"></i></button> &nbsp;&nbsp;<button type="button" name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';
                }

                $('#tablebody').append(html);
                $('#usertb').DataTable({});
                $("div").removeClass("form-inline");
            }
        });
    }
    $(document).on('click', '.edit_data', function() {
        $(".tablehideshow").hide();
        $(".formhideshow").show();
        var id = $(this).attr('id');
        var servicename = $('#servicename_' + id).html();
        var unit = $('#unit_' + id).html();
        var rate = $('#rate_' + id).html();



        $('#saveid').val(id);
        $('#servicename').val(servicename);
        $('#unit').val(unit);
        $('#rate').val(rate);
        $('#btn_submit').text('Update');



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
                            url: "service/destroy/" + id1,
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



    $(document).on("blur", "#user_id", function(e) {
        e.preventDefault();
        var userid = $(this).val();
        var saveid = $('#saveid').val();

        if (saveid == "") {
            $.ajax({
                type: "GET",
                url: checkuser + "/" + userid,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {

                    if (data > 0) {
                        flag = 1;
                        swal("Userid Alredy Exists Please Enter Another Userid !!!");
                    } else {
                        flag = 0;
                    }
                }
            });
        }


    });

    function from_clear() {
        $('#servicename').val('');
        $('#unit').val('');
        $('#rate').val(0);
        $('#btn_submit').text('Save');
    }




});
