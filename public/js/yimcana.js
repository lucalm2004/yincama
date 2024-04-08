document.getElementById('submit-button').addEventListener('click', function() {
    validarFormulario();
});

function validarFormulario() {
    var nombre = document.getElementById('nombre').value.trim();
    var pistaInicial = document.getElementById('pista-inicial').value.trim();
    var pistaInicial = document.getElementById('pista2').value.trim();
    var pistaInicial = document.getElementById('pista3').value.trim();
    var pistaInicial = document.getElementById('pista4').value.trim();
    var pistaInicial = document.getElementById('pista5').value.trim();
    var pistaInicial = document.getElementById('lugar1').value.trim();
    var pistaInicial = document.getElementById('lugar2').value.trim();
    var pistaInicial = document.getElementById('lugar3').value.trim();
    var pistaInicial = document.getElementById('lugar4').value.trim();
    var pistaInicial = document.getElementById('lugar5').value.trim();
    document.getElementById('nombre').classList.remove('is-invalid');
    document.getElementById('pista-inicial').classList.remove('is-invalid');
    document.getElementById('pista2').classList.remove('is-invalid');
    document.getElementById('pista3').classList.remove('is-invalid');
    document.getElementById('pista4').classList.remove('is-invalid');
    document.getElementById('pista5').classList.remove('is-invalid');
    document.getElementById('lugar1').classList.remove('is-invalid');
    document.getElementById('lugar2').classList.remove('is-invalid');
    document.getElementById('lugar3').classList.remove('is-invalid');
    document.getElementById('lugar4').classList.remove('is-invalid');
    document.getElementById('lugar5').classList.remove('is-invalid');



    if (nombre === '') {
        document.getElementById('nombre').classList.add('is-invalid');
        valido = false;
    }

    // Validar pista inicial
    if (pistaInicial === '') {
        document.getElementById('pista-inicial').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('lugar1').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('pista2').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('lugar2').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('pista3').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('lugar3').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('pista4').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('lugar4').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('pista5').classList.add('is-invalid');
        valido = false;
    }

    if (pistaInicial === '') {
        document.getElementById('lugar5').classList.add('is-invalid');
        valido = false;
    }

    if (valido == true) {
        inicio(nombre, pistaInicial, lugar1, lugar2, lugar3, lugar4, lugar5, pista2, pista3, pista4, pista5);
    }
}

function inicio(nombre, pistaInicial, lugar1, lugar2, lugar3, lugar4, lugar5, pista2, pista3, pista4, pista5) {
    var csrfToken = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    var formData = new FormData();

    formData.append('nombre', nombre);
    formData.append('pistaInicial', pistaInicial);
    formData.append('lugar1', lugar1);
    formData.append('lugar2', lugar2);
    formData.append('lugar3', lugar3);
    formData.append('lugar4', lugar4);
    formData.append('lugar5', lugar5);
    formData.append('pista2', pista2);
    formData.append('pista3', pista3);
    formData.append('pista4', pista4);
    formData.append('pista5', pista5);

    formData.append('_token', csrfToken);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/yim');
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

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

    xhr.send(formData);
}