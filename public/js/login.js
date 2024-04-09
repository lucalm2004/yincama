function validarFormulario() {
    var usuario = document.getElementById('email').value.trim();
    var contraseña = document.getElementById('password').value.trim();
    document.getElementById('email').classList.remove('is-invalid');
    document.getElementById('password').classList.remove('is-invalid');
    var valido=true
    if (usuario === '') {
        document.getElementById('email').classList.add('is-invalid');
        valido=false;
    }
    if (contraseña === ''){
        document.getElementById('password').classList.add('is-invalid');
        valido=false;
    }
    if (valido === true){
        inicio();
    }
}
function inicio(){
    var user = document.getElementById('email').value;
    var contra = document.getElementById('password').value;
    var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    var formData = new FormData();

    formData.append('user', user);
    formData.append('contra', contra);
    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/logear');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    console.log('ejecutando');
    xhr.send(formData);
    xhr.onload = function() {
        if (xhr.status == 200) {
            console.log('Solicitud completada con éxito', xhr.responseText);
            if (xhr.responseText=='noAdmin'){
                window.location.href = "/cliente";
            }
            if (xhr.responseText=='admin'){
                window.location.href = "/cliente";
            }
        } else {
            console.error('Error en la solicitud:', xhr.responseText);
        }
    };  
    xhr.onerror = function() {
        console.error('Error en la solicitud AJAX:', xhr.statusText);
    };    
}
document.getElementById('login-button').addEventListener('click', function() {
    validarFormulario();
});