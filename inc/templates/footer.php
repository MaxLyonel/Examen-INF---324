<script src="js/sweetalert2.all.min.js"></script>
<?php
    $actual = obtenerPaginaActual();
    echo $actual;
    if($actual === 'crear-cuenta' || $actual === 'login') {
        echo '<script src="js/formulario.js"></script>';
    }
?>
</body>
</html>