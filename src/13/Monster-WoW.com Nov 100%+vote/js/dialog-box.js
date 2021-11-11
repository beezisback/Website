jQuery(document).ready(function() {    
    $('#blackbg').show();
    $('#warningbox').show();
    $('#buttons a').click(function() {
    $('#blackbg').remove();
    $('#warningbox').remove();
    });
});