let scriptLoaded = false;
let contentLoaded = false;


jQuery(document).ready(function() { 
    // Carica il contenuto del tab attivo all'avvio
    if (!contentLoaded) {
        jQuery('#accediContent').load('template/accedi.php', function() {
            if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
                jQuery('#accediContent').prepend('<p style="color: red; text-align:center">' + errorMessage + '</p>');
            }
            if (!scriptLoaded) {
                jQuery.getScript('js/accedi-utils.js', function() {
                    scriptLoaded = true;
                });
            } 
            contentLoaded = true;
            
        });
    }

    jQuery('#accedi-tab').on('shown.bs.tab', function () {
        if (!contentLoaded) {
            jQuery('#accediContent').load('template/accedi.php', function() {
                if (!scriptLoaded) {
                    if (typeof errorMessage !== 'undefined' && errorMessage !== '') {
                        jQuery('#accediContent').prepend('<p style="color: red; text-align:center">' + errorMessage + '</p>');
                    }
                    jQuery.getScript('js/accedi-utils.js', function() {
                        scriptLoaded = true;
                    });
                } 
                contentLoaded = true;
                
            });
        }
    });


    jQuery('#registrati-tab').on('shown.bs.tab', function () {
        jQuery('#registratiContent').load('template/registrati.php', function() {            
            jQuery.getScript('js/registrati-utils.js');            
        });
    });
    
    
    jQuery('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = jQuery(e.target).attr("href"); // ottieni il tab attivo
        if (target === '#accedi') {
            jQuery('#accedi input').val(''); // svuota i campi del form
        } else if (target === '#registrati') {
            jQuery('#registrati input').val(''); // svuota i campi del form
        }
    });
});











    

