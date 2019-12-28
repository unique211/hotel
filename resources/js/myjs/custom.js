$(document).ready(function() {
    $(".formhideshow").hide();
    $(".tablehideshow").show();
    $(document).on('click', '.closehideshow', function() {
        // $('#master_form')[0].reset();
        $('#save_update').val('');
        $(".tablehideshow").show();
        $(".formhideshow").hide();
        $(".btnhideshow").show();
    });
    $(".btnhideshow").click(function() {
        // alert("hide");
        $(".tablehideshow").hide();
        $(".formhideshow").show();
    });
});