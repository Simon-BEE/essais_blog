/*$(document).ready(function(){
    $('#btn').click(function(){
        var text = $("#search").val().toLowerCase();
        var sizeText = text.length;
        console.log(sizeText);
        //var body = $( "p:contains("+text+")" ).css( "text-decoration", "underline" );
        var indexText = $( "p:contains("+text+")" ).text().toLowerCase().indexOf(text);
        var whereText = $("p:contains("+text+")");
        var span = text.replace()
        for (let i = 0; i <= sizeText; i++) {
            const element = array[i];
            
        }
        console.log(hihi);
        
    })
})*/
/*
$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("article").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
*/
/*
$(document).ready(function(){
    $('#btn').click(function(){
        $('span').removeAttr("class");
        var word = $('#search').val();
        var field = $('article').html();
        var pos = field.indexOf(word);
        var reg = new RegExp('('+word+'(?![^<]*>)',"g");
        if(pos  > -1) {
            content = field.replace(reg, '<span style="background-color: red;">'+word+'</span>');

            $('article').html(content);
        }
    })
})*/
$(document).ready(function() {
    var searchInput;
    var textDiv;
    $('#btn').click(function(event) {
        event.preventDefault();
        $('span').removeAttr("class");
        $('span').contents().unwrap();
        searchInput = $('#search').val();
        textDiv = $('article').html();
        var pattern = '('+searchInput+')(?![^<]*>)';
        var reg = new RegExp(pattern, 'gi');
        var txt = textDiv.replace(reg, function(str) {
            return "<span class='highlight'>" + str + "</span>"
        });
    
    $('article').html(txt);
    });
});