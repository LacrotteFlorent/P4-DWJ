

                            /* BILLET => PROGRESS BAR */
                            /* BILLET => PROGRESS BAR */
                            /* BILLET => PROGRESS BAR */

$(window).scroll(function(){
    position = (($(window).scrollTop())*100)/(($(document).height())-$(window).height());
    position = position + "%";
    $(".progress-bar").css("width", position);
});


                            /* ADMINPOST => INPUT FILE */
                            /* ADMINPOST => INPUT FILE */
                            /* ADMINPOST => INPUT FILE */

$(document).ready(function() {
    $('input[type="file"]').change(function(e) {
        var file = e.target.files[0].name;
        $('#inputLabel').text(file);
    });
});