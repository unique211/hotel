$(document).ready(function() {
    var flag = 0;
    var validate = 1;
    $('#mainform').hide();
    $('#tbl').show();
    $('#purposedata').hide();
    $('.btnhideshow').click(function() {
        $('.tablehideshow').hide();
        $(".formhideshow").show();
        $('#saveid').val('');
        form_clear();
    });
    $('.closehideshow').click(function() {
        $('.tablehideshow').show();
        $(".formhideshow").hide();
        $('#saveid').val('');
    });

    $('#btncancel').click(function() {
        $('#mainform').hide();
        $("#tbl").show();
    });


    $(document).on("blur", ".cpassword", function(e) {
        e.preventDefault();
        var msg = '';
        var p = $('#password').val();
        var cp = $('#cpassword').val();
        if (p != cp) {
            msg = 'confirm does not match';
            $('#btn_submit').attr('disabled', 'disabled');
        } else {
            msg = '';
            $('#btn_submit').removeAttr('disabled');
        }
        $('#cpass_error').html(msg);
    });

    $('#master_form').on('submit', function(event) {
        event.preventDefault();
        var uid = '';

        var id = $('#saveid').val();
        var checkpassword = 0;
        var p = $('#password').val();
        var cp = $('#cpassword').val();
        var m = $('#mobileno').val();
        if (p != cp) {
            msg = 'confirm does not match';

        } else {
            msg = '';

        }

        if (m.length == 10) {

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
                            title: "Mobile NO  OR Email Already Exist  !",
                            text: "Please Enter Another Mobile No OR Email !!",
                            type: "warning",
                        });
                    } else if (data == '101') {
                        swal({
                            title: "Userid Already Exist  !",
                            text: "Please Enter Another Userid !!",
                            type: "warning",
                        });
                    } else {
                        datashow();
                        toastr.success("Record save Success Fully");
                        $('.tablehideshow').show();
                        $(".formhideshow").hide();
                        $('#saveid').val('');
                        form_clear();
                    }


                }

            });
        } else {
            swal({
                title: "Opss...",
                text: "Please Enter 10 digits!",
                type: "warning",
            });
        }



        // } else {
        //     swal({
        //         title: "Mobile NO  OR Email Already Exist  !",
        //         text: "Please Enter Another Mobile No OR Email !!",
        //         type: "warning",
        //     });
        // }

    });

    //code for validate mobile number
    $(document).on("blur", "#mobileno", function(e) {
        e.preventDefault();
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        var m = $('#mobileno').val();
        if (filter.test(m)) {
            if (m.length == 10) {
                var id = $('#saveid').val();
                var url = "";
                if (id = "") {
                    url = checkmobileno + "/" + m;
                } else {
                    url = checkmobileno + "/" + m + "/" + id;
                }


                $.ajax({
                    url: url,
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
                        } else {
                            validate = 1;
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

    //check for Email Address---*/
    $(document).on("blur", "#email", function(e) {
        e.preventDefault();
        var url = "";
        var email = $('#email').val();
        if (id = "") {
            url = checkemailaddress + "/" + email;
        } else {
            url = checkemailaddress + "/" + email + "/" + id;
        }
        $.ajax({
            url: url,
            type: "GET",

            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                if (data > 0) {
                    swal({
                        title: "Email Already Exist !!",
                        text: "Please Enter Another Email !!",
                        type: "warning",
                    });
                } else {
                    validate = 1;
                }
            }
        });

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
                var table1 = $('#usertb').DataTable();
                table1.destroy();
                var sr = 0;
                var html = '';
                $('#tablebody').html('');

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td id="username_' + data[i].id + '">' + data[i].username + '</td>' +
                        '<td id="mobileno_' + data[i].id + '">' + data[i].mobileno + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].email + '</td>' +
                        '<td id="role_' + data[i].id + '">' + data[i].role + '</td>' +
                        '<td style="display:none;" id="userid_' + data[i].id + '">' + data[i].userid + '</td>' +
                        '<td style="display:none;" id="password_' + data[i].id + '">' + data[i].password + '</td>' +
                        // '<td ><input type="button" name="edit" value="Edit" class="edit_data btn btn-xs  btn-primary" id=' + data[i].id + '> &nbsp;&nbsp;<input type="button" name="delete" value="Delete" class="delete_data btn btn-xs  btn-danger" id=' + data[i].id + '></td>' +
                        '<td class="not-export-column" ><button name="edit" value="edit" class="edit_data btn btn-xs btn-success" id=' +
                        data[i].id +
                        '><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                        data[i].id + '><i class="fa fa-trash"></i></button></td>';

                    '</tr>';
                }

                $('#tablebody').append(html);
                $('#usertb').DataTable({});
            }
        });
    }
    $(document).on('click', '.edit_data', function() {
        $('.tablehideshow').hide();
        $(".formhideshow").show();
        var id = $(this).attr('id');
        var username = $('#username_' + id).html();
        var mobileno = $('#mobileno_' + id).html();
        var email = $('#email_' + id).html();
        var role = $('#role_' + id).html();

        var userid_ = $('#userid_' + id).html();
        var password_ = $('#password_' + id).html();


        $('#saveid').val(id);
        $('#username').val(username);
        $('#email').val(email);
        $('#mobileno').val(mobileno);

        $('#user_type').val(role).trigger('change');
        $('#user_id').val(userid_);
        $('#password').val(password_);
        $('#cpassword').val(password_);

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
                            url: "usermanagement/destroy/" + id1,
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

    function form_clear() {
        $('#username').val('');
        $('#mobileno').val('');
        $('#email').val('');
        $('#user_type').val('').trigger('change');
        $('#user_id').val('');
        $('#password').val('');
        $('#cpassword').val('');


    }
    $(document).on("click", "#reset", function(e) {
        e.preventDefault();
        form_clear();
    });



});
