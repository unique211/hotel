$(document).ready(function() {
    get_brand();

    function get_brand() {
        //  alert();
        $.get('get_all_members', function(data) {
            console.log(data);
            html = '';
            //alert(html);
            var name = '';
            html += '<option selected disabled value="">Select </option>';
            //  html += '<option  value="0">Parent</option>';
            for (i = 0; i < data.length; i++) {
                var id = '';
                // alert(data.length);
                name = data[i].name;
                id = data[i].id;
                html += '<option value="' + id + '" >' + name + '</option>';
            }

            $("#member").html(html);
        })
    }

    function form_clear() {
        $('#save_update').val('');
        $('#date').val('');
        $('#member').val('');
        $('#type').val('');
        $('#mode').val('');
        $('#bank').val('');
        $('#cheque').val('');
        $('#amt').val('');
        $('#narration').val('');
        $('#pay_for').val('');
        $("#btn_submit").attr("disabled", false);
        $("#if_cheque").hide();
        get_brand();
    }

    $(document).on('change', "#mode", function(e) {
        e.preventDefault();
        var mode = $("#mode").val();
        $("#if_cheque").hide();
        if (mode == "Cheque") {
            $("#if_cheque").show();
        } else {
            $("#if_cheque").hide();
            $('#bank').val('');
            $('#cheque').val('');
            $('#amt').val('');
            $('#narration').val('');
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
        $.get('get_all_transactions', function(data) {

            var data = eval(data);
            var html = '';
            html += '<table id="laravel_crud" style="width:100%;" class=" table table-striped">' +
                '<thead>' +
                '<tr>' +
                '<th><font style="font-weight:bold">Sr. No.</font></th>' +
                '<th><font style="font-weight:bold">Member Name</font></th>' +
                '<th><font style="font-weight:bold">Date</font></th>' +
                '<th><font style="font-weight:bold">Transaction Type</font></th>' +
                '<th><font style="font-weight:bold">Payment Mode</font></th>' +
                '<th class="not-export-column"><font style="font-weight:bold">Action</font>   </th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            for (var i = 0; i < data.length; i++) {
                var sr = i + 1;

                var date = data[i].date;
                var fdateslt = date.split('-');
                var date1 = fdateslt[2] + '/' + fdateslt[1] + '/' + fdateslt[0];
                html += '<tr>' +
                    '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].member_name + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + date1 + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].type + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].mode + '</td>' +
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
        $.get('transaction/' + id + '/edit', function(data) {
            $('#save_update').val(id);
            //   get_brand();
            var date = data.date;
            var fdateslt = date.split('-');
            var date1 = fdateslt[2] + '/' + fdateslt[1] + '/' + fdateslt[0];
            $('#date').val(date1);
            $('#member').val(data.member);
            $('#type').val(data.type);
            $('#pay_for').val(data.payment_for);
            $('#mode').val(data.mode).trigger('change');
            $('#bank').val(data.bank);
            $('#cheque').val(data.cheque);
            $('#amt').val(data.amount);
            $('#narration').val(data.narration);

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