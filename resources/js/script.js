// ----------------------
// ESCUCHAR EVENTO ACTUALIZAR FORMULARIO DEL FILTRO
// ----------------------

// Escuchamos permanentemente al evento keyup, que se activa cuando el usuario suelta 
// una tecla después de presionarla en un elemento HTML.
// Esto almacena el valor del value del input text "buscar" del formulario HTML de filtrado de resultado 
// en la constante valor y posteriormente ejecutamos la función ListarProductos pasandole ese valor como
// parámetro. En caso de que el formulario esté vacío, se envía NULL para que muestre todos los datos.


// buscar.addEventListener("keyup", () => {
//     const valor = buscar.value;
//     if (valor == "") {

//     } else {

//     }
// });


// incidencia.addEventListener("keyup", actualizarFiltro);







// document.getElementById("status_id").addEventListener('change', RecogerEstados);


// let estadosFiltro = '';
// let fechaFiltro = '';

// function actualizarFiltro(estadosFiltro = 'Prueba', fechaFiltro = 'null') {
//     const valor = incidencia.value;

//     // console.log('asdasd' + estadosFiltroLugareListarLugares(valor, estadosFiltro, fechaFiltro);
// }

// function RecogerEstados() {
//     var select_estados = document.getElementById('status_id').value;
//     // var estadosFiltro = select_estados.options[select_estados.selectedIndex].value;
//     actualizarFiltro('', select_estados, '');
// }

// function Fecha() {
//     var select_fecha = document.getElementById('fecha_inc');
//     // var fechaFiltro = select_fecha.options[select_fecha.selectedIndex].value;
//     actualizarFiltro(estadosFiltro, fechaFiltro);
// }

// ----------------------
// LISTAR PRODUCTOS
// ----------------------

// En primer luegar ejecutamos la función ListarProductos sin enviar ningún parámetro de búsqueda.
// De esta forma, se listarán todos los objetos de la base de datos al cargar la página por primera vez
ListarLugares('', '', '');

function ListarLugares() {
    // Especificamos en qué elemento HTML de la página vamos a "insertar" el resultado de la consulta AJAX
    // El ID "resultado" corresponde con el tbody de "index.html"
    var resultado = document.getElementById('resultado');
    // var resultado= document.getElementById('resultado');
    //var frmbusqueda=document.getElementById('frmbusqueda');

    // Creamos un nuevo objeto Formulario VACÍO "FormData" que almacenamos en la variable formdata.
    var formdata = new FormData();



    // Creamos un campo nuevo al objeto formulario recién creado y le pasamos como valor el contenido de la variable 
    // busqueda recibida al ejecutarse el evento "keyup" asociado al elemento "buscar" (input del formulario HTML)
    // formdata.append('busqueda', buscar);
    // formdata.append('estado', status_id);
    // formdata.append('fecha', fecha_inc);
    // formdata.append('resolta', resolta);
    // console.log(buscar);
    // console.log(status_id);
    // console.log(fecha_inc);

    // Inicializamos un método que provee el navegador (XMLHttpRequest)
    // que permite enviar y recibir datos. Este método devuelve un objeto
    // que almacenamos en una variable (ajax)
    var ajax = new XMLHttpRequest();


    // Usando el método open ese objeto, indicamos a qué página vamos a realizar
    // la petición y a través de qué método HTP lo vamos a pedir (En este caso
    // POST dado que vamos a SOLICITAR algo al 'backend').
    ajax.open('POST', '/cliente');


    // "ajax.onload" define una función que se ejecutará cuando la solicitud AJAX se complete
    // con éxito y los datos del servidor estén listos para ser procesados.
    // El evento onload se activa cuando la solicitud ha sido exitosa y se ha
    // recibido una respuesta del servidor.
    // La función anónima asignada a ajax.onload se ejecutará cuando la solicitud
    // se complete correctamente, y dentro de ella, se manejarán los datos recibidos
    // del servidor.
    ajax.onload = function () {


        // Inicializamos una variable string vacía que iremos rellenando con el código
        // HTML a mostrar a partir de los datos recibidos de listar.php
        var str = "";


        // El status 200 indica que se ha ejecutado correctamente la petición AJAX
        if (ajax.status == 200) {
            // La variable ajax.responseText contiene la respuesta del servidor a la solicitud AJAX
            // que se encuentra en formato JSON. Con el método en Javascript 'JSON.parse()' se analiza
            // la cadena de texto en formato JSON y se convierte en un objeto Javascript almacenado
            // en la variable 'json'.

            // Se convierte la respuesta obtenida del servidor en la variable
            // ajax.responseText, que está en formato JSON en un objeto JavaScript
            // que puede manipularse y acceder a sus propiedades de manera más fácil.
            // console.log(ajax.responseText)
            var json = JSON.parse(ajax.responseText);
            var incidencias = json.incidencias;

            console.log(incidencias)
            var estados = json.estados;
            console.log(estados);
            var tabla = '';
            var select = '';

            console.log(json)
            // Se recorre el objeto json mediante un bucle forEach() y construye una
            // tabla HTML con los datos del objeto.
            // Cada elemento del objeto json representa un registro de una tabla
            incidencias.forEach(function (item) {
                var str = "<tr>";
                str += "<td>" + item.nombre_lug + "</td>";
                str += "<td>" + item.tipo_lug + "</td>";
                str += "<td>" + item.barrio_lug + "</td>";
                str += "<td>" + item.foto_inc + "</td>";
                str += "<td>" + item.coordenadas_lug + "</td>";
                str += "<td>" + item.desc_lug + "</td>";
                str += "</td>";
                str += "</tr>";
                tabla += str;
            });

            resultado.innerHTML = tabla;
        

        } else {
            // Si no se recibe un status 200, indica que ha habido un error en la petición AJAX
            resultado.innerText = 'Error';
          
        }
    }


    // Se ejecuta la consulta AJAX (se envían los datos recibidos del formulario
    // a la página indicada en el método OPEN ('listar.php'))
    ajax.send(formdata);
}


// for (let i = 0; i < datos.consulta.length; i++) {

//     var direccion = datos.consulta[i].calle + ', ' + datos.consulta[i].num_calle + ', ' + datos.consulta[i].codigo_postal + ' ' + datos.consulta[i].ciudad;
//     // console.log(direccion);

//     var popup = datos.consulta[i].nombre;
//     var latitud = datos.consulta[i].latitud;
//     var longitud = datos.consulta[i].longitud;
//     var id_tipo = datos.consulta[i].tipo_recurso;
//     var nombre_tipo = datos.consulta[i].nombre_tipo
//         // console.log(popup);

//     var icono = L.icon({
//         iconUrl: `storage/uploads/categorias/${id_tipo}.png?x=${Math.random()}`,
//         iconSize: [20, 25],
//         popupAnchor: [0, -20],
//         markerColor: 'black'
//     });

//     var marker = L.marker([datos.consulta[i].latitud, datos.consulta[i].longitud], { icon: icono }).addTo(map);
//     miObjeto[nombre_tipo].push(marker);





//     marker.bindPopup("<div class='popup-ubi' style='text-align:center;'> <p>" + popup + "</p><button type='button' class='btn_llegar' id='" + latitud + "' value='" + longitud + "'> Como llegar </button> </div > ").addTo(map);
//     map.setView([datos.consulta[i].latitud, datos.consulta[i].longitud], 11.75);

//     // Guarda una referencia al control de enrutamiento en una variable global
//     var routingControl;
//     var contador = 0;

//     var taxiIcon = L.icon({
//         iconUrl: '../resources/img/xavi.png',
//         iconSize: [70, 70]
//     })

//     marker.on("click", function() {



//         var llegar = document.getElementsByClassName("btn_llegar");
//         for (var i = 0; i < llegar.length; i++) {
//             llegar[i].addEventListener('click', function(evt) {
//                 var latitud = evt.target.id
//                 var longitud = evt.target.value

//                 // Crea un elemento div para el loader
//                 var loader = document.createElement("div");

//                 // Agrega una clase CSS al loader para personalizar su estilo
//                 loader.classList.add("loader");

//                 // Crea un elemento div para el mensaje
//                 var mensaje = document.createElement("div");
//                 mensaje.innerHTML = "<p>Cargando ruta...</p><img class='coche' src='../resources/img/coche.png'><div class='estrada'><div class='shadow'></div></div>";

//                 // Agrega una clase CSS al mensaje para personalizar su estilo
//                 mensaje.classList.add("mensaje");

//                 // Agrega el mensaje al loader
//                 loader.appendChild(mensaje);

//                 // Agrega el loader al documento
//                 document.body.appendChild(loader);

//                 navigator.geolocation.getCurrentPosition(function(position) {
//                     var taxi_marker = L.marker([position.coords.latitude, position.coords.longitude], { icon: taxiIcon }).addTo(map);
//                     var currentLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

//                     // Borra la ruta anterior si existe
//                     if (routingControl) {
//                         routingControl.remove();
//                     }

//                     if (contador == 1) {
//                         routingControl.remove();
//                     }

//                     contador++;

//                     // Crea una nueva ruta y guarda la referencia al control de enrutamiento
//                     routingControl = L.Routing.control({
//                         waypoints: [
//                             currentLatLng,
//                             L.latLng(latitud, longitud)
//                         ],
//                         router: L.Routing.graphHopper('d16202b7-f25f-46dd-86e3-2ba8863c2445'),

//                     }).addTo(map);


//                     routingControl.on("routesfound", function(e) {
//                         loader.style.display = "none";
//                         mensaje.style.display = "none";
//                         var routes = e.routes;
//                         e.routes[0].coordinates.forEach(function(coord, index) {
//                             setTimeout(function() {
//                                 taxi_marker.setLatLng([coord.lat, coord.lng]);
//                             }, 100 * index);
//                         });
//                         var lastCoord = e.routes[0].coordinates.slice(-1)[0];
//                         console.log(lastCoord);
//                         setInterval(function() {
//                             if (taxi_marker.getLatLng().distanceTo(lastCoord) < 10) {
//                                 // If the distance between the marker and lastCoord is less than 10 meters, remove the marker from the map
//                                 map.removeLayer(taxi_marker);
//                             }
//                         }, 10000);
//                     });






//                 });

//                 // Check if the taxi has reached its destination

//             })
//         }
//     });



    // function ver(latitud, longitud) {
    //     navigator.geolocation.getCurrentPosition(function(position) {
    //         var currentLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
    //         L.Routing.control({
    //             waypoints: [
    //                 currentLatLng,
    //                 L.latLng(latitud, longitud)
    //             ]
    //         }).addTo(map('mapa'));
    //     });
    // }


//}