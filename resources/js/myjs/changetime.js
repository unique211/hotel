$(document).ready(function() {
    var url = '';
    if (changet != "") {
        $('#changetimeing').val(changet);
    }
    if (Currency != "") {
        $('#changecurrencyinfo').val(Currency).trigger('change');
    }



    $(document).on('submit', '#master_form', function(e) {
        e.preventDefault();

        url = add_data;


        $.ajax({
            data: $('#master_form').serialize(),
            url: add_data,
            type: "POST",
            dataType: 'json',
            success: function(data) {

                toastr.success("Time Change & Currency Success Fully");


                console.log('Data:', data);


                $('#changetimeing').val(data[0].changetimeing);


                $('#changecurrencyinfo').val(data[0].changecurrencyinfo).trigger('change');
                Currency = data[0].changecurrencyinfo;
            },
            error: function(data) {
                console.log('Error:', data);


            }
        });


    });



});