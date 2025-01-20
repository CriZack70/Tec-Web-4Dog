    
$(document).ready(function() {
    let cognome = $('#cognome').val();
    let nome = $('#nome').val();
    let phone = $('#phone').val();
    $('#modBtn').click(function() {
        // Abilita i campi di input
        $('#cognome').prop('disabled', false);
        $('#nome').prop('disabled', false);
        $('#phone').prop('disabled', false);
        
        // Mostra i bottoni "Salva" e "Annulla"
        $('#salvaBtn').show();
        $('#annullaBtn').show();
        $('#modBtn').hide();
    });

    $('#annullaBtn').click(function() {        
        // Disabilita i campi di input e ripristina i valori originali
        $('#cognome').prop('disabled', true).val(cognome);
        $('#nome').prop('disabled', true).val(nome);
        $('#phone').prop('disabled', true).val(phone);

        // Nasconde i bottoni "Salva" e "Annulla"
        $('#salvaBtn').hide();
        $('#annullaBtn').hide();
        $('#modBtn').show();
    });    
       

});

