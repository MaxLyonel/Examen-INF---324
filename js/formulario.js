addEventListener();

function addEventListener() {
    document.querySelector('#formulario').addEventListener('submit', validarRegistro);
}

function validarRegistro(e) {
    e.preventDefault();
    // Obtenemos los datos del formulario
    var usuario = document.querySelector('#usuario').value,
        password = document.querySelector('#password').value,
        tipo = document.querySelector('#tipo').value;
        // ci = document.querySelector('#ci').value;
    if(usuario === '' || password === ''){
        // la validación falla.
        swal({
            type:'error',
            title:'Opps..!',
            text:'Ambos campos son obligatorios!'
        })
    } else {
        // Ambos campos son correctos, mandar a ejecutar Ajax
        // Crear datos que se envian al servidor
        var datos = new FormData();
        datos.append('usuario', usuario);
        datos.append('password', password);
        datos.append('accion', tipo);
        // datos.append('ci', ci);
        // Llamado a Ajax
        var xhr = new XMLHttpRequest();
        // abrir la conexion
        xhr.open('POST', 'inc/modelos/modelo-admin.php', true);
        // retorno de datos
        xhr.onload = function() {
            if(this.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                console.log(respuesta);
                // Si la respuesta es correcta
                if(respuesta.respuesta === 'correcto') {
                    // Si es un nuevo usuario
                    if(respuesta.tipo === 'crear') {
                        swal({
                            type:'success',
                            title:'Usuario Creado',
                            text:'El usuario se creó correctamente!'
                        })
                    } else if(respuesta.tipo == 'login') {
                        swal({
                            type:'success',
                            title:'Login Correcto',
                            text:'Presione OK para ir a la página'
                        })
                        .then(resultado => {
                            if(resultado.value){
                                window.location.href = 'index.php';
                            }
                        })
                    }
                } else {
                    // Hubo un error
                    swal({
                        type:'error',
                        title:'Error',
                        text:'Hubo un error!'
                    })
                }
            }
        }
        // Enviar la petición
        xhr.send(datos);                
    }
}