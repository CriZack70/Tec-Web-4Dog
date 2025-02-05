$(document).ready(function() {
    $('.notifica-ordine').on('click', function() {
        const numero = $(this).data('numero');
        const id = $(this).data('id');
        const data = $(this).data('data');
        
         // Svuota il contenuto del modal
         $('#notificaDescrizione').empty();
         $('#notificaData').empty();
         $('#orderDetailsContainer').empty();
        

        // Aggiorna il contenuto del modal
        $('#notificaDescrizione').text(`Nuovo Ordine # ${numero}`);
        $('#notificaData').text(data);        
        $('#notificaData').prepend("effettuato il ");

        // Rimuove l'attributo inert e mostra il modal
        $('#notificaModal').removeAttr('inert').modal('show');

        const orderDetailsHtml = $(this).closest('.alert').find('.order-details').html();
        $('#orderDetailsContainer').html(orderDetailsHtml);



      // Segna la notifica come letta
      $.post('update_notifica_vend.php', { Id: id, azione: 'letta' }, function() {
        // Aggiorna l'icona della bustina
        $(`.notifica-ordine[data-id="${id}"]`).siblings('.icon').find('em').removeClass('fa-envelope').addClass('fa-envelope-open');
        
        $(`.notifica-ordine[data-id="${id}"]`).closest('.alert').addClass('alert-letta');
    });
});

// Gestore per le notifiche di prodotti
$('.notifica-prodotto').on('click', function() {
    const codice = $(this).data('codice');
    const id = $(this).data('id');
    const data = $(this).data('data');
    const taglia = $(this).data('taglia');
    const eta = $(this).data('eta');
    const composizione = $(this).data('composizione');
    const prezzo = $(this).data('prezzo');

    // Svuota il contenuto del modal
    $('#notificaDescrizione').empty();
    $('#notificaData').empty();
    $('#orderDetailsContainer').empty();

    // Aggiorna il contenuto del modal
    $('#notificaDescrizione').text(`Prodotto Codice: ${codice}`);
        $('#notificaData').text(`il ${data}`);
        $('#notificaDescrizione').prepend("Esaurito ");
        $('#notificaDescrizione').append(`<br>Taglia: ${taglia}`);
        $('#notificaDescrizione').append(`<br>Età: ${eta}`);
        $('#notificaDescrizione').append(`<br>Composizione: ${composizione}`);
        $('#notificaDescrizione').append(`<br>Prezzo: €${prezzo}`);

     // Rimuove l'attributo inert e mostra il modal
     $('#notificaModal').removeAttr('inert').modal('show');


    // Segna la notifica come letta
    $.post('update_notifica_vend.php', { Id: id, azione: 'letta' }, function() {
        // Aggiorna l'icona della bustina
        $('.notifica-prodotto[data-id="${id}"]').siblings('.icon').find('em').removeClass('fa-envelope').addClass('fa-envelope-open');
        
        $('.notifica-prodotto[data-id="${id}"]').closest('.alert').addClass('alert-letta');
    });
});

$('#notificaModal').on('hidden.bs.modal', function () {
    // Aggiunge l'attributo inert quando il modal è nascosto
    $(this).attr('inert', '');
});

$('.delete').on('click', function() {
    const id = $(this).data('id');    
    $.post('update_notifica_vend.php', { Id: id, azione: 'elimina' }, function(response) {        
        location.reload();
    });
});
});