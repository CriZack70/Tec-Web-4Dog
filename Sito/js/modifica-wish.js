$(document).ready(function() {
    const checkboxes = document.querySelectorAll('.card-checkbox');
    const eliminaBtn = $('#elinimaListBtn');

    function toggleEliminaBtn() {
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        eliminaBtn.prop('disabled', !isChecked);
    }    



    $('#modListBtn').click(function() {
        let checkboxes = document.querySelectorAll('.card-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = false;
        });
        $('#elinimaListBtn').show();
        $('#annullaListBtn').show();
        $('#modListBtn').hide();
        toggleEliminaBtn(); // Controlla lo stato dei checkbox quando si abilita la modifica
    });
   

    $('#annullaListBtn').click(function() {
        let checkboxes = document.querySelectorAll('.card-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = true;
            checkbox.checked = false; // Rimuove eventuali flag dai checkbox
        });
        $('#elinimaListBtn').hide();
        $('#annullaListBtn').hide();
        $('#modListBtn').show();
        eliminaBtn.prop('disabled', true); // Disabilita il bottone "Elimina"
    });
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', toggleEliminaBtn);
    });

});