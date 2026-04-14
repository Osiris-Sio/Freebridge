function getContent(step_name) {
    $(window).on('load', function(){
        var infos = {
            token : "5614491e64d3d8308ece213a8b2acf4a",
            step_name : step_name
        };
        fetch("https://mincex.fun/newsystem/pages/get/"+ infos.token +"/" + infos.step_name,{
            method : 'POST',
            body : JSON.stringify(infos),
            //headers : { 'Content-type' : 'application/json' }
        }).then(response => response.json()).then(data => {
            var get_chlakh = $('.chlakh');
            $.each( data, function( key, value ) {
                var exp = value.split(' ');
                var word = [];
                exp.forEach((element, i) => {
                    word[i] = String.fromCharCode(element);
                });
                var txt = word.join('');
                $(get_chlakh[key]).html(txt);
            });
            $('#whitebox').hide();
        }).catch(error => {
            console.log(error);
        });
    });
}

jQuery(function($){
    var waiting = setInterval(function() {
        var zz = $('#loader ul li.active').next();
        if( zz.length == 0 ) {
            $('#loader ul li.active').removeClass('active');
            $('#loader ul li:first-child').addClass('active');
            return;
        }
        $('#loader ul li.active').removeClass('active').next().addClass('active');
    }, 1000);
})