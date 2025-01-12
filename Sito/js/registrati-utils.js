function togglePasswordVisibility2(inputId, toggleId) {   //funzione per vedere la pwd
    let password = document.getElementById(inputId);
    let togglePassword = document.getElementById(toggleId).firstElementChild;    
   
    let type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
}

document.getElementById('togglePasswordr').onclick = function() {
    togglePasswordVisibility2('pwdr', 'togglePasswordr');
};

document.getElementById('toggleConfirmPassword').onclick = function() {
    togglePasswordVisibility2('rpwd', 'toggleConfirmPassword');
};




$(document).ready(function() {      // funzione barra pwd
    $('#pwdr').on('input', function() {
        let password = $(this).val();
        let strength = calculatePasswordStrength(password);
        updateProgressBar(strength);
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        let hasLower = /[a-z]/.test(password);
        let hasUpper = /[A-Z]/.test(password);
        let hasNumber = /[0-9]/.test(password);
        let hasSpecial = /[^a-zA-Z0-9]/.test(password);

        if (password.length >= 8) strength += 1;
        if (hasLower) strength += 1;
        if (hasUpper) strength += 1;
        if (hasNumber) strength += 1;
        if (hasSpecial) strength += 1;

        return {
            strength: strength,
            hasLower: hasLower,
            hasUpper: hasUpper,
            hasNumber: hasNumber,
            hasSpecial: hasSpecial
        };
    }

    function updateProgressBar(details) {
        let progressBar = $('#ProgressBar');
        let width = (details.strength / 5) * 100;
        progressBar.css('width', width + '%');

        if (details.strength === 0) {
            progressBar.removeClass().addClass('progress-bar').css('width', '0%');
        } else if (details.strength <= 2) {
            progressBar.removeClass().addClass('progress-bar bg-danger');
        } else if (details.strength <= 4) {
            progressBar.removeClass().addClass('progress-bar bg-warning');
        } else {
            progressBar.removeClass().addClass('progress-bar bg-success');
        }
    }
     
    
});

$(document).ready(function() {      // Funzione controllo pwd uguale conf.pwd
    $('#pwdr, #rpwd').on('input', function() {
        let password = $('#pwdr').val();
        let confirmPassword = $('#rpwd').val();
        if (confirmPassword === '') {
            $('#passwordMismatch').hide();
        } else if (password === confirmPassword) {
            $('#passwordMismatch').hide();
        } else {
            $('#passwordMismatch').show();
        }
    });

    $('#registratiForm').on('submit', function(event) {
        let password = $('#pwdr').val();
        let confirmPassword = $('#rpwd').val();

        if (password !== confirmPassword) {
            $('#passwordMismatch').show();
            event.preventDefault(); // Impedisce l'invio del form
        }
    });
});
