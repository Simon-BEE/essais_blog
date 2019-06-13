
$(document).ready(function() {
    var searchInput;
    var textDiv;
    $('#btn').click(function(event) {
        event.preventDefault();
        $('.highlight').contents().unwrap();
        searchInput = $('#search').val();
        textDiv = $('.articles').html();
        var pattern = '('+searchInput+')(?![^<]*>)';
        var reg = new RegExp(pattern, 'gi');
        var txt = textDiv.replace(reg, function(str) {
            return "<span class='highlight'>" + str + "</span>"
        });
    $('.articles').html(txt);
    });
});