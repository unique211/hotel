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
        var visitorname = $('#visitorname').val();


        // $.ajax({
        //     url: inserturl,
        //     method: "POST",
        //     data: new FormData(this),
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     dataType: "json",
        //     success: function(data) {

        //     }
        var tdateAr = fromdate.split('/');
        var fromdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];

        var tdateAr = todate.split('/');
        var todate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
        $.ajax({
            url: inserturl + "/" + fromdate + "/" + todate + "/" + visitorname,
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
                var download = '';
                if (data.length > 0) {
                    var table1 = $('#checkintable').DataTable();
                    table1.destroy();
                    $('#tablebody').html('');
                    for (var i = 0; i < data.length; i++) {
                        sr = sr + 1;
                        var from_time = data[i].date.split('-');
                        var from_date = from_time[2] + '/' + from_time[1] + '/' + from_time[0];


                        download =
                            html += '<tr><td  style="width:10%" id="srno_' + data[i].id + '">' + sr + '</td>' +

                            '<td  style="width:40%" id="date_' + data[i].id + '">' + from_date + '</td>' +
                            '<td  style="width:30%"id="servicename_' + data[i].id + '">' + data[i].visitername + '</td>' +
                            '<td  style="width:10%"id="qty' + data[i].id + '">' + data[i].amt + '</td>' +
                            //'<td  style="width:10%"id="qty' + data[i].id + '">'++'</td>' +
                            '<td  style="display:none;" id="serviceid_' + data[i].id + '">' + data[i].visiterid + '</td>' +
                            '</tr>';
                    }
                    $('#tablebody').append(html);
                    $('#checkintable').DataTable({});
                    $("div").removeClass("form-inline");
                }

            }
        });


    });
    getMasterSelect("#visitorname");

    function getMasterSelect(selecter) {

        $.ajax({
            type: "GET",
            url: getallvisiter,
            data: {
                "_token": doc_token,
            },
            dataType: "JSON",
            async: false,
            success: function(data) {

                html = '';
                var name = '';
                //					if(table_name=="victim_age"){
                //					html += '<option selected  value="" >Select Victim Age</option>';
                //						}else{
                html += '<option selected disabled value="" >Select</option>';
                html += '<option   value="All" >All</option>';
                //						}
                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].visitername;
                    id = data[i].id;


                    //alert(name);	
                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $(selecter).html(html);
            }
        });
    }

});