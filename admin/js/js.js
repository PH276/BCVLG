$( document ).ready(function() {
    console.log('ready');
    $('button[name="liste"]').on('click', function(){
        $('.reduit').toggle();
        // $('th').css("text-align", "left");
    });

    $('input[name=adherent]').on('change', function(){
        console.log('ad');
        var parent = $(this).parent()[0];
        $(parent).html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
        console.log($(parent).attr("id"));
        var id_joueur = $(parent).attr("id");

        $.ajax({
            method: "POST",
            url : "ajax_adherent.php",
            data: {id_joueur:id_joueur}
        });
    });

    $('button[name=imprimer]').on('click', function(){
        $('nav').hide();
        $('.imprimer').hide();

    })

    $('input[name=cotis]').on('click', function(){
        var id = $(this).data('id');
        var val = this.value;
        $.ajax({
            type: "POST",
            url : "ajax_paiement.php",
            dataType: 'json',
            data: {id:id, cotisation:val},
            success:function () {
                console.log('ok');
            },
            error:function(e){
                console.log(e);
            }
        });

        var cas = $(this).parent().parent()[0].id;
        $('#'+cas).html($(this).data('cotis'));
        console.log($(this).data('id'));
    });
});
