$(document).ready(function() {
    get_brand();

    function get_brand() {
        //  alert();
        $.get('get_all_members', function(data) {
            console.log(data);
            html = '';
            //alert(html);
            var name = '';
            html += '<option selected disabled value="">Select Parent</option>';
            html += '<option  value="0">Parent</option>';
            for (i = 0; i < data.length; i++) {
                var id = '';
                // alert(data.length);
                name = data[i].name;
                id = data[i].id;
                html += '<option value="' + id + '" >' + name + '</option>';
            }

            $("#parent").html(html);
        })
    }

    $(document).on('blur', "#c_password", function(e) {
        e.preventDefault();
        var password = $("#password").val();
        var cpassword = $('#c_password').val();
        $("#btn_submit").attr("disabled", false);
        if (password != "" && cpassword != "") {
            if (password != cpassword) {
                // swal("Password not match", "Hey, please enter password and confirm password same !!", "error");
                $("#btn_submit").attr("disabled", true);
                $('#conformpass').show();
                $("#c_password").val('');
            } else {
                $("#btn_submit").attr("disabled", false);
                $('#conformpass').hide();

            }
        }
    });
    $(document).on('blur', "#userid", function(e) {
        e.preventDefault();
        var user_id = $("#userid").val();
        $("#btn_submit").attr("disabled", false);
        $('#chk_userid').hide();
        if (user_id != "") {
            $.get('get_userid/' + user_id, function(data) {
                //    alert(data);
                if (data == 0 || data == "0") {
                    $('#chk_userid').hide();
                    $("#btn_submit").attr("disabled", false);
                } else {
                    $('#chk_userid').show();
                    $("#btn_submit").attr("disabled", true);
                    $("#userid").val('');
                }
            });

        }

    });

    $(document).on('change', "#side", function() {

        var side = $("#side").val();
        var parent = $("#parent").val();
        //  alert(parent);
        if (parent == '' || parent == null || parent == "null") {
            swal("Parent Not Selected", "Hey, please Select Parent!!", "error");

        } else if (parent == "0" || parent == 0) {
            $("#side").val(side);
        } else {
            $.get('get_child/' + parent, function(data) {
                var a = data[0].a_child;
                var b = data[0].b_child;
                if (side == "A") {
                    if (a == "null" || a == null) {
                        $("#side").val(side);
                    } else {
                        swal("Side Exists", "Hey, please Select Another Side!!", "error");
                        $("#side").val('');
                    }
                } else {
                    if (b == "null" || b == null) {
                        $("#side").val(side);
                    } else {
                        swal("Side Exists", "Hey, please Select Another Side!!", "error");
                        $("#side").val('');
                    }
                }

            });


        }
        //  $("#btn_submit").attr("disabled", false);
        //   $('#chkemail').hide();
        // if (email != "") {
        //     $.get('get_email/' + email, function(data) {
        //         //    alert(data);
        //         if (data == 0 || data == "0") {
        //             $('#chkemail').hide();
        //             $("#btn_submit").attr("disabled", false);
        //         } else {
        //             $('#chkemail').show();
        //             $("#btn_submit").attr("disabled", true);
        //             $("#email").val('');
        //         }
        //     });

        // }

    });

    function form_clear() {
        $('#save_update').val('');
        $('#m_name').val('');
        $('#mobile').val('');
        $('#email').val('');
        $('#address').val('');
        $('#pan').val('');
        $('#aadhar').val('');
        $('#bank').val('');
        $('#branch').val('');
        $('#holder').val('');
        $('#ac_no').val('');
        $('#ac_type').val('');
        $('#ifsc').val('');
        $('#parent').val('');
        $('#side').val('');
        $('#userid').val('');
        $("#password").val('');
        $('#c_password').val('');

        $("#btn_submit").attr("disabled", false);
        get_brand();
    }

    $(document).on('blur', "#product", function(e) {
        e.preventDefault();

        var product = $("#product").val();
        var brand = $("#brand").val();
        $("#btn_submit").attr("disabled", false);
        $('#chkbrand').hide();
        if (brand != "") {
            $.get('get_product/' + product + '/' + brand, function(data) {
                //    alert(data);
                if (data == 0 || data == "0") {
                    $('#chkbrand').hide();
                    $("#btn_submit").attr("disabled", false);
                } else {
                    $('#chkbrand').show();
                    $("#btn_submit").attr("disabled", true);
                    $("#product").val('');
                }
            });

        }

    });
    $(document).on('submit', '#master_form', function(e) {
        e.preventDefault();
        //  alert("in submit");

        $.ajax({
            data: $('#master_form').serialize(),
            url: add_data,
            type: "POST",
            dataType: 'json',
            success: function(data) {
                // $("#master_form").trigger('reset');

                $(".closehideshow").trigger('click');
                form_clear();
                successTost("Saved Successfully");
                $('#save_update').val('');

                datashow();


            },
            error: function(data) {
                console.log('Error:', data);
                //  $('#btn-save').html('Save Changes');
            }
        });


    });
    datashow();

    function datashow() {
        $.get('get_all_members_data', function(data) {

            var data = eval(data);
            var html = '';
            html += '<table id="laravel_crud" style="width:100%;" class=" table table-striped">' +
                '<thead>' +
                '<tr>' +
                '<th><font style="font-weight:bold">Sr. No.</font></th>' +
                '<th><font style="font-weight:bold">Member Name</font></th>' +
                '<th><font style="font-weight:bold">Mobile Number</font></th>' +
                '<th><font style="font-weight:bold">Email</font></th>' +
                '<th><font style="font-weight:bold">Status</font></th>' +
                '<th class="not-export-column"><font style="font-weight:bold">Action</font>   </th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            for (var i = 0; i < data.length; i++) {
                var sr = i + 1;
                var status1 = "";
                var status = data[i].status;
                if (status == 0 || status == "0") {
                    status1 = '<label class="btn-danger btn-xs">Deactivate</label>';
                } else {
                    status1 = '<label class="btn-success btn-xs">Activate</label>';

                }
                html += '<tr>' +
                    '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].name + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].mobile + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].email + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + status1 + '</td>' +
                    '<td class="not-export-column" ><button name="edit" value="edit" class="edit_data btn btn-xs btn-success" id=' +
                    data[i].id +
                    '><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                    data[i].id + '><i class="fa fa-trash"></i></button></td>' + '</tr>';
            }
            html += '</tbody></table>';
            $('#show_master').html(html);
            $('#laravel_crud').DataTable({});
        })

    }
    $(document).on('click', ".edit_data", function(e) {
        e.preventDefault();
        $(".tablehideshow").hide();
        $(".formhideshow").show();
        var id = $(this).attr("id");
        // alert(id);
        $.get('member_reg/' + id + '/edit', function(data) {
            $('#save_update').val(id);
            $('#m_name').val(data.name);
            $('#mobile').val(data.mobile);
            $('#email').val(data.email);
            $('#address').val(data.address);
            $('#pan').val(data.pan);
            $('#aadhar').val(data.aadhar);
            $('#bank').val(data.bank);
            $('#branch').val(data.branch);
            $('#holder').val(data.ac_name);
            $('#ac_no').val(data.ac_no);
            $('#ac_type').val(data.ac_type);
            $('#ifsc').val(data.ifsc);
            $('#parent').val(data.parent);
            //  $('#side').val('');
            $('#userid').val(data.user_id);
            $("#password").val(data.password);
            $('#c_password').val(data.password);

        });
    });
    $(document).on('click', '.delete_data', function() {
        var id1 = $(this).attr('id');
        var user_id = $("#user_id_").html();
        if (id1 != "") {
            swal({
                    title: "Are you sure to delete ?",
                    text: "You will not be able to recover this Data !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !!",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        type: "DELETE",
                        url: delete_data + '/' + id1,
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


                    return false;
                });
        }
    });
    $(document).on('click', "#reset", function(e) {
        e.preventDefault();
        form_clear();
    });
    $(document).on('click', ".closehideshow", function(e) {
        e.preventDefault();
        form_clear();

    });

});