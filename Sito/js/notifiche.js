$(document).ready(function() {
    $('.notifica-oggetto').on('click', function() {
        const numero = $(this).data('numero');
        const descrizione = $(this).data('descrizione');
        const data = $(this).data('data');        

        // Aggiorna il contenuto del modal
        $('#notificaDescrizione').text(descrizione);
        $('#notificaData').text(data);
        $('#notificaDescrizione').prepend("Stato dell'Ordine: ");
        $('#notificaData').prepend("Data aggiornamento  ");

        // Rimuove l'attributo inert e mostra il modal
        $('#notificaModal').removeAttr('inert').modal('show');

        const orderDetailsHtml = $(this).closest('.alert').find('.order-details').html();
        $('#orderDetailsContainer').html(orderDetailsHtml);



        // Segna la notifica come letta
        $.post('update_notifica.php', { Numero: numero, Descrizione: descrizione, azione: 'letta' }, function() {
            // Aggiorna l'icona della bustina
            $(`.notifica-oggetto[data-numero="${numero}"]`).siblings('.icon').find('em').removeClass('fa-envelope').addClass('fa-envelope-open');
            
            $(`.notifica-oggetto[data-numero="${numero}"]`).closest('.alert').addClass('alert-letta');
        });
    });

    $('#notificaModal').on('hidden.bs.modal', function () {
        // Aggiunge l'attributo inert quando il modal è nascosto
        $(this).attr('inert', '');
    });

    $('.delete').on('click', function() {
        const numero = $(this).data('numero');
        const descrizione = $(this).data('descrizione');
        $.post('update_notifica.php', { Numero: numero, Descrizione: descrizione, azione: 'elimina' }, function() {
            location.reload();
        });
    });
});