function togglePasswordVisibility() {
    let password = document.getElementById('password');
    let togglePassword =  document.getElementById('togglePassword').firstElementChild;
    
    // Toggle the type attribute
    let type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the icon
    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
}

document.getElementById('togglePassword').onclick = togglePasswordVisibility;


