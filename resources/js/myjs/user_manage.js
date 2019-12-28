$(document).ready(function() {
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
    $(document).on('blur', "#email", function(e) {
        e.preventDefault();

        var email = $("#email").val();
        $("#btn_submit").attr("disabled", false);
        $('#chkemail').hide();
        if (email != "") {
            $.get('get_email/' + email, function(data) {
                //    alert(data);
                if (data == 0 || data == "0") {
                    $('#chkemail').hide();
                    $("#btn_submit").attr("disabled", false);
                } else {
                    $('#chkemail').show();
                    $("#btn_submit").attr("disabled", true);
                    $("#email").val('');
                }
            });

        }

    });

    function form_clear() {
        $('#save_update').val('');
        $('#name').val('');
        $('#mobile').val('');
        $('#email').val('');
        $('#role').val('');
        $('#userid').val('');
        $('#password').val('');
        $('#c_password').val('');
        $('#chkemail').hide();
        $('#chk_userid').hide();
        $('#conformpass').hide();
        $("#btn_submit").attr("disabled", false);
        //    $('#hide_password').val('');
    }
    $(document).on('submit', '#master_form', function(e) {
        e.preventDefault();
        //  alert("in submit");

        $.ajax({
            data: $('#master_form').serialize(),
            url: add_data,
            type: "POST",
            dataType: 'json',
            success: function(data) {
                //  $("#master_form").trigger('reset');
                //   this.reset();
                //  $("#master_form")[0].reset();
                $(".closehideshow").trigger('click');
                form_clear();
                successTost("Saved Successfully");
                $('#save_update').val('');
                // location.href = "{{ route('customer.index')}}";
                datashow();
                // $.ajax({
                //     data: $('#master_form').serialize(),
                //     url: add_data_login,
                //     type: "POST",
                //     dataType: 'json',
                //     success: function(data) {

                //     }
                // });

            },
            error: function(data) {
                console.log('Error:', data);
                //  $('#btn-save').html('Save Changes');
            }
        });


    });
    datashow();

    function datashow() {
        $.get('get_all', function(data) {

            var data = eval(data);
            var html = '';
            html += '<table id="laravel_crud" style="width:100%;" class=" table table-striped">' +
                '<thead>' +
                '<tr>' +
                '<th><font style="font-weight:bold">Sr. No.</font></th>' +
                '<th><font style="font-weight:bold">Name</font></th>' +
                '<th><font style="font-weight:bold">Mobile</font></th>' +
                '<th><font style="font-weight:bold">Email</font></th>' +
                '<th><font style="font-weight:bold">User Id</font></th>' +
                '<th class="not-export-column"><font style="font-weight:bold">Action</font>   </th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            for (var i = 0; i < data.length; i++) {
                var sr = i + 1;
                html += '<tr>' +
                    '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].name + '</td>' +
                    '<td id="address_' + data[i].id + '">' + data[i].mobile + '</td>' +
                    '<td id="address_' + data[i].id + '">' + data[i].email + '</td>' +
                    '<td id="user_id_' + data[i].id + '">' + data[i].user_id + '</td>' +
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
        $.get('user_manage/' + id + '/edit', function(data) {
            $('#save_update').val(id);
            $('#name').val(data.name);
            $('#mobile').val(data.mobile);
            $('#email').val(data.email);
            $('#userid').val(data.user_id);
            $('#role').val(data.role);
            $('#password').val(data.password);
            $('#c_password').val(data.password);
            // $('#hide_password').val(data.password);
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