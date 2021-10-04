<?php

$accion = $_POST['accion'];
$password = $_POST['password'];
$usuario = $_POST['usuario'];
//$ci = intval($_POST['ci']);


//die(json_encode($_POST));

// if($accion === 'crear') {
    
//     // Código para crear a los administradore
//     // hashear passwords
//     $opciones = array(
//         'cost' => 12
//     );
//     // primer argumento el password a hashear, el algoritmo, opciones
//     $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);

//     // import la conexión
//     include '../funciones/conexion.php';
//     try {
//        // Realizar la consulta a la base de datos
       
//        $stmt = $conn->prepare("INSERT INTO usuario (ci, usuario, password) VALUES (?,?,?) ");
//        $a = array(
//         'accion' => $accion,
//         'password' => $password,
//         'usuario' => $usuario,
//         'ci'=> $ci,
//         'stmt' => $stmt->affected_rows
//         );
//         die(json_encode($a));
//        $stmt->bind_param('iss', $ci, $usuario, $hash_password);
//        $stmt->execute();
//        if($stmt->affected_rows > 0){
//             $respuesta = array(
//                 'respuesta' => 'correcto',
//                 'id_insertado' => $stmt->insert_id,
//                 'tipo' => $accion
//             );
//        } else {
//            $respuesta = array(
//                'respuesta' => 'error'
//            );
//        }
       
//        $stmt->close();
//        $conn->close();
//     } catch (Exception $e) {
//         $respuesta = array(
//             'pass' => $e->getMessage()
//         );
//     }

//     // al parecer no sirve el echo
//     // echo json_encode($respuesta);
//     die(json_encode($respuesta));
// }
if($accion === 'login'){
    
    // Código para loguee a los administradores
    include '../funciones/conexion.php';

    try {
        $stmt = $conn->prepare("SELECT ci, usuario, password, tipo FROM usuario WHERE usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $stmt->bind_result($ci_usuario, $nombre_usuario, $pass_usuario, $tipo);
        $stmt->fetch();
        if($nombre_usuario) {
            // Verificar el password
            // if(password_verify($password, $ci_usuario, $pass_usuario)) {
                // Login correcto
                // Iniciar la sesión
                session_start();
                $_SESSION['nombre'] = $usuario;
                $_SESSION['ci'] = $ci_usuario;
                $_SESSION['tipo'] = $tipo;
                $_SESSION['login'] = true;

                $respuesta = array(
                    'respuesta' => 'correcto',
                    'nombre' => $nombre_usuario,
                    'tipo' => $accion
                );
            // } else {
            //     // Login incorrecto
            //     $respuesta = array(
            //         'resultado' => 'password incorrecto'
            //     );
            // }
            
        } else {
            $respuesta = array(
                'error' => 'Usuario no existe'
            );
        }
        
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $respuesta = array(
            'pass' =>  $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}