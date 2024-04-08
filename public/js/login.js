function validarFormulario() {
    var usuario = document.getElementById('user').value.trim();
    var contraseña = document.getElementById('contra').value.trim();
    document.getElementById('user').classList.remove('is-invalid');
    document.getElementById('contra').classList.remove('is-invalid');
    var valido=true
    if (usuario === '') {
        document.getElementById('user').classList.add('is-invalid');
        valido=false;
    }
    if (contraseña === ''){
        document.getElementById('contra').classList.add('is-invalid');
        valido=false;
    }
    if (valido === true){
        inicio();
    }
}
function inicio(){
    var user = document.getElementById('user').value.trim();
    var contra = document.getElementById('contra').value.trim();
    var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    var formData = new FormData();

    formData.append('user', user);
    formData.append('contra', contra);
    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/vamos');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    console.log('ejecutando');
    xhr.onload = function() {
        if (xhr.status == 200) {
            console.log('Solicitud completada con éxito');
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