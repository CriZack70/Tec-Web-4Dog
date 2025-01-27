document.addEventListener('DOMContentLoaded', function() {
    let editButton = document.getElementById('editButton');
    let actionField = document.getElementById('actionField');
    let action = actionField.value;
    
    function enableFields() {
        document.getElementById('nome').disabled = false;
        document.getElementById('nome').required = true;
        document.getElementById('taglia').disabled = false;
        document.getElementById('taglia').required = true;
        document.getElementById('maschio').disabled = false;
        document.getElementById('maschio').required = true;
        document.getElementById('femmina').disabled = false;
        document.getElementById('femmina').required = true;
        document.getElementById('eta').disabled = false;
        document.getElementById('eta').required = true;
    }
    
    if (action === 'inserisci') {
        enableFields();
    }

    if (editButton) {
        editButton.addEventListener('click', function(e) {            
            if (this.textContent.trim() === 'Modifica') {
                e.preventDefault();
                // Abilita i campi input
                enableFields();
                // Cambia il testo del bottone in "Salva"
                this.textContent = 'Salva';

                // Cambia il tipo del bottone in "submit" per salvare i dati
                this.type = 'submit';

                actionField.value = 'salva';
                
            }
        });
    } 
});



