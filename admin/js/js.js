
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
    $.ajax({
        method: "POST",
        url : "ajax_paiement.php",
        data: {id:this.id, cotisation:this.value}
    });

    var cas = $(this).parent().parent()[0].id;
    $('#'+cas).html($(this).data('cotis'));
    console.log($(this).data('cotis'));
});
