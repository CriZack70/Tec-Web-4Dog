let scriptLoaded = false;
let contentLoaded = false;
let contentloadreg = false
let scriptLoadedreg = false;

$(document).ready(function() { 
    // Carica il contenuto del tab attivo all'avvio
    if (!contentLoaded) {       
        $('#accediContent').load('template/accedi.php', function() {
            if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
                $('#accediContent').prepend('<p style="color: red; text-align:center">' + errorMessage + '</p>');
            }
            if (!scriptLoaded) {                
                $.getScript('js/accedi-utils.js', function() {
                    scriptLoaded = true;
                });
            } 
            contentLoaded = true;
            
        });
    }

   


    $('#registrati-tab').on('shown.bs.tab', function () {
        if (!contentloadreg) {        
            $('#registratiContent').load('template/registrati.php', function() {
                if (!scriptLoadedreg) {            
                    $.getScript('js/registrati-utils.js', function() {
                        scriptLoadedreg = true;
                    });
                }
                contentloadreg = true;           
             });
        }
    });
    
    
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href"); // ottieni il tab attivo
        if (target === '#accedi') {
            $('#accedi input').val(''); // svuota i campi del form
        } else if (target === '#registrati') {
            $('#registrati input').val(''); // svuota i campi del form
        }
    });
});











    

