document.addEventListener('DOMContentLoaded', function() {
    let editButton = document.getElementById('editButton');
    let actionField = document.getElementById('actionField');
    if (editButton) {
        editButton.addEventListener('click', function(e) {            
            if (this.textContent.trim() === 'Modifica') {
                e.preventDefault();
                // Abilita i campi input
                document.getElementById('nome').disabled = false;
                ocument.getElementById('taglia').disabled = false;
                document.getElementById('maschio').disabled = false;
                document.getElementById('femmina').disabled = false;
                 document.getElementById('eta').disabled = false;

                // Cambia il testo del bottone in "Salva"
                this.textContent = 'Salva';

                // Cambia il tipo del bottone in "submit" per salvare i dati
                this.type = 'submit';

                actionField.value = 'salva';

                console.log('Campi abilitati e bottone cambiato in Salva');
            }
        });
    } 
});



