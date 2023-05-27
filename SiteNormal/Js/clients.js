$(function(){
    $("#associationOnly").click(function(){
        $(".association").toggle();
    });

    $("#particulierOnly").click(function(){
        $(".particulier").toggle();
    });

    $("#professionnelOnly").click(function(){
        $(".professionnel").toggle();
    });
});
/*
$(function(){
    $(".btn").click(function(){
        if($(this).hasClass('active'))
            $(this).removeClass('active');
        else
            $(this).addClass('active');
    });
});*/
