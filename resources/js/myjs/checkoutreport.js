$(document).ready(function() {

    $('#fromdate').datepicker({
        'todayHighlight': true,
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
    $('#todate').datepicker({
        'todayHighlight': true,
        format: 'dd/mm/yyyy',
        autoclose: true,
    });
    var date = new Date();
    date = date.toString('dd/MM/yyyy');
    $("#fromdate").val(date);
    $("#todate").val(date);

    $('#mainform').on('submit', function(event) {
        event.preventDefault();
        var fromdate = $('#fromdate').val();
        var todate = $('#todate').val();
        $('#f_date').html('From Date : ' + fromdate);
        $('#t_date').html('To Date : ' + todate);

        var tdateAr = fromdate.split('/');
        var fromdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];

        var tdateAr = todate.split('/');
        var todate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
        $.ajax({
            url: inserturl + "/" + fromdate + "/" + todate,
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
                var sr = 0;
                var html = "";
                if (data.length > 0) {
                    var table1 = $('#checkintable').DataTable();
                    table1.destroy();
                    $('#tablebody').html('');
                    for (var i = 0; i < data.length; i++) {
                        sr = sr + 1;
                        var date = data[i].date;
                        var fdateslt = date.split('-');
                        var time = fdateslt[2].split(' ');
                        var checkintime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0] + ' ' + time[1];

                        html += '<tr ><td  style="width:10%" id="srno_' + data[i].id + '">' + sr + '</td>' +

                            '<td  style="width:40%" id="visitername_' + data[i].id + '">' + data[i].visitername + '</td>' +
                            '<td  style="width:30%"id="checkintime_' + data[i].id + '">' + checkintime + '</td>' +
                            '<td  style="display:none;" id="visiterid_' + data[i].id + '">' + data[i].visiterid + '</td>' +
                            '</tr>';
                    }
                    $('#tablebody').append(html);
                    $('#checkintable').DataTable({

                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdfHtml5',
                                title: 'Checkout Report',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                },
                            },
                            {
                                title: 'Checkout Report',
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2]
                                }
                            }
                        ]

                    });
                    $("div").removeClass("form-inline");
                }

            }
        });


    });





});