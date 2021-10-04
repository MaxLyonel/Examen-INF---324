<?php
// Obtiene la págia actual que se ejecuta
function obtenerPaginaActual() {
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    return $pagina;
}
/* Consultas */
/* Obtener las notas de un estudiante x */
function obtenerNotas($idEst){
    include 'conexion.php';
    try {
        $stmt = $conn->prepare("SELECT nota1, nota2, nota3, notafinal FROM nota WHERE ci_estudiante = ?");
        $stmt->bind_param('i', $idEst);
        $stmt->execute();
        $stmt->bind_result($nota1, $nota2, $nota3, $notafinal);
        $stmt->fetch();
        $respuesta = array(
            'nota1'=>$nota1,
            'nota2'=>$nota2,
            'nota3'=>$nota3,
            'notafinal'=>$notafinal
        );
        //return $conn->query("SELECT nota1, nota2, nota3, notafinal FROM nota WHERE ci_estudiante = $idEst");
        return $respuesta;
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return NULL;
    }
}
function obtenerNotasXDepartamento(){
    include 'conexion.php';
    try {

        return $conn->query("SELECT p.departamento as dep, AVG(n.notafinal) as promedio
                                FROM estudiante e, persona p, nota n
                                WHERE e.ci = p.ci
                                AND e.ci = n.ci_estudiante
                                GROUP BY p.departamento");
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return NULL;
    }
}