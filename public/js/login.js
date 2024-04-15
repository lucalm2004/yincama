function validarFormulario() {
    var usuario = document.getElementById('email').value.trim();
    var contrasena = document.getElementById('password').value.trim();
    document.getElementById('email').classList.remove('is-invalid');
    document.getElementById('password').classList.remove('is-invalid');
    var valido = true
    if (usuario === '') {
        document.getElementById('email').classList.add('is-invalid');
        valido = false;
    }
    if (contrasena === '') {
        document.getElementById('password').classList.add('is-invalid');
        valido = false;
    }
    if (valido === true) {
        inicio();
    }
}
function inicio() {
    var user = document.getElementById('email').value;
    var contra = document.getElementById('password').value;
    var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    var formData = new FormData();

    formData.append('user', user);
    formData.append('contra', contra);
    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'logear');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    console.log('ejecutando');
    xhr.send(formData);
    xhr.onload = function () {
        if (xhr.status == 200) {
            console.log('Solicitud completada con �xito', xhr.responseText);
            if (xhr.responseText == 'noAdmin') {
                window.location.href = "cliente";
            } else if (xhr.responseText == 'admin') {
                window.location.href = "admin";
            }
            if (xhr.responseText == 'mal') {
                document.getElementById('email').classList.add('is-invalid');
                document.getElementById('password').classList.add('is-invalid');
            }
        } else {
            console.error('Error en la solicitud:', xhr.responseText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud AJAX:', xhr.statusText);
    };
}


function validarFormulario2() {
    var nombre = document.getElementById('name2').value.trim();
    var usuario = document.getElementById('email2').value.trim();
    var contrasena = document.getElementById('password2').value.trim();
    document.getElementById('name2').classList.remove('is-invalid');
    document.getElementById('email2').classList.remove('is-invalid');
    document.getElementById('password2').classList.remove('is-invalid');
    var valido = true;
    if (nombre === '') {
        document.getElementById('name2').classList.add('is-invalid');
        valido = false;
    }
    if (usuario === '') {
        document.getElementById('email2').classList.add('is-invalid');
        valido = false;
    }
    if (contrasena === '') {
        document.getElementById('password2').classList.add('is-invalid');
        valido = false;
    }
    if (valido === true) {
        inicio2();
    }
}

function inicio2() {
    var nombre = document.getElementById('name2').value;
    var usuario = document.getElementById('email2').value;
    var contra = document.getElementById('password2').value;
    var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('user', usuario);
    formData.append('contra', contra);
    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'resgistrar');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    console.log('ejecutando');
    xhr.send(formData);
    xhr.onload = function () {
        if (xhr.status == 200) {
            console.error(xhr.statusText);
            window.location.href = "cliente";
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud AJAX:', xhr.statusText);
    };
}

function change() {
    document.getElementById('logi').style.display = "none";
    document.getElementById('regi').style.display = "block";
}

function change2() {
    document.getElementById('logi').style.display = "block";
    document.getElementById('regi').style.display = "none";
}

document.getElementById('login-button').addEventListener('click', function () {
    validarFormulario();
});
document.getElementById('reg-button').addEventListener('click', function () {
    validarFormulario2();
});
document.getElementById('change').addEventListener('click', function () {
    change();
});
document.getElementById('change2').addEventListener('click', function () {
    change2();
});