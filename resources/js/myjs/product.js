$(document).ready(function() {
    get_brand();

    function get_brand() {
        //  alert();
        $.get('get_all_brands', function(data) {
            console.log(data);
            html = '';
            //alert(html);
            var cus_name = '';
            html += '<option selected disabled value="">Select Brand</option>';
            for (i = 0; i < data.length; i++) {
                var id = '';
                // alert(data.length);
                cus_name = data[i].name;
                id = data[i].id;
                html += '<option value="' + id + '" >' + cus_name + '</option>';
            }

            $("#brand").html(html);
        })
    }

    function form_clear() {
        $('#save_update').val('');
        $('#brand').val('');
        $('#product').val('');
        $('#desc').val('');
        $('#price').val('');
        $('#chkbrand').hide();
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
        $.get('get_all_products', function(data) {

            var data = eval(data);
            var html = '';
            html += '<table id="laravel_crud" style="width:100%;" class=" table table-striped">' +
                '<thead>' +
                '<tr>' +
                '<th><font style="font-weight:bold">Sr. No.</font></th>' +
                '<th><font style="font-weight:bold">Brand Name</font></th>' +
                '<th><font style="font-weight:bold">Product Name</font></th>' +
                '<th><font style="font-weight:bold">Product Price</font></th>' +
                '<th><font style="font-weight:bold">Product Description</font></th>' +

                '<th class="not-export-column"><font style="font-weight:bold">Action</font>   </th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
            for (var i = 0; i < data.length; i++) {
                var sr = i + 1;
                html += '<tr>' +
                    '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].brand_name + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].product + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].price + '</td>' +
                    '<td id="cus_name_' + data[i].id + '">' + data[i].desc + '</td>' +

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
        $.get('product/' + id + '/edit', function(data) {
            $('#save_update').val(id);
            $('#brand').val(data.brand_id);
            $('#product').val(data.product);
            $('#price').val(data.price);
            $('#desc').val(data.desc);

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