<?php 
    include 'inc/funciones/sesiones.php';
    include 'inc/funciones/funciones.php';    
    include 'inc/templates/header.php';
    include 'inc/templates/barra.php';
?>
<body>
<div class="contenedor">
    <?php
        include 'inc/templates/sidebar.php';  
    ?>

    <main class="contenido-principal">
        <?php
            $tipo = $_SESSION['tipo'];
            if($tipo == "estudiante") { 
        ?>
        <h1>
            <span>Tabla de Notas del Estudiante <?php echo $_SESSION['nombre']; ?></span>
        </h1>
        <table class="tabla-prestamo">
            <tr>
                <th><strong>NRO CI</strong></th>
                <th><strong>NOTA 1</strong></th>
                <th><strong>NOTA 2</strong></th>
                <th><strong>NOTA 3</strong></th>
                <th><strong>NOTA FINAL</strong></th>
            </tr>
            <?php
                include 'inc/funciones/conexion.php';
                $id = $_SESSION['ci'];                
                $notas = obtenerNotas($id);                 
            ?>
            <tr>
                <td> <?php echo  $id;?></td>
                <td> <?php echo  $notas['nota1'];?></td>
                <td> <?php echo  $notas['nota2'];?></td>
                <td> <?php echo  $notas['nota3'];?></td>
                <td> <?php echo  $notas['notafinal'];?></td>
            </tr>                       
        </table>
        <?php 
            include 'inc/funciones/conexion.php';
            } elseif($tipo == "docente") { ?>
            <h1>
            <span>Tabla de Notas Promedio por Departamento</span>
            </h1>
            <?php
                $res = obtenerNotasXDepartamento(); ?>    
                <table class="tabla-prestamo">
                    <tr>
                    <?php foreach($res as $i) { ?>
                        <?php if($i['dep'] == '01') { ?>
                            <th> <?php echo 'CHUQUISACA'; ?></th>                        
                        <?php }  ?>
                        <?php if($i['dep'] == '02') { ?>
                            <th> <?php echo 'LA PAZ'; ?></th>
                        <?php } ?>
                        <?php if($i['dep'] == '03') { ?>
                            <th> <?php echo 'COCHABAMBA'; ?></th>
                        <?php } ?>
                        <?php if($i['dep'] == '04') { ?>
                            <th> <?php echo 'ORURO'; ?></th>
                        <?php } ?>
                        <?php if($i['dep'] == '05') { ?>
                            <th> <?php echo 'POTOSI'; ?></th>
                        <?php } ?>
                        <?php if($i['dep'] == '06') { ?>
                            <th> <?php echo 'TARIJA'; ?></th>
                        <?php }  ?>
                        <?php if($i['dep'] == '07') { ?>
                            <th> <?php echo 'SANTA CRUZ'; ?></th>
                        <?php } ?>
                        <?php if($i['dep'] == '08') { ?>
                            <th> <?php echo 'BENI'; ?></th>
                        <?php } ?>
                        <?php if($i['dep'] == '09') { ?>
                            <th> <?php echo 'PANDO'; ?></th>
                        <?php } ?>                        
                    <?php
                    }
                    ?>  
                    </tr>
            <?php
                $res = obtenerNotasXDepartamento(); ?>                                
                    <tr>
                   <?php 
                    foreach($res as $i) { ?>
                        <?php if($i['dep'] == '01') { ?>
                            <td> <?php echo $i['promedio']; ?></td>                        
                        <?php }  ?>
                        <?php if($i['dep'] == '02') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php } ?>
                        <?php if($i['dep'] == '03') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php } ?>
                        <?php if($i['dep'] == '04') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php
                            }
                        ?>
                        <?php if($i['dep'] == '05') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php
                            }
                        ?>
                        <?php if($i['dep'] == '06') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php
                            }
                        ?>
                        <?php if($i['dep'] == '07') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php
                            }
                        ?>
                        <?php if($i['dep'] == '08') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php
                            }
                        ?>
                        <?php if($i['dep'] == '09') { ?>
                            <td> <?php echo $i['promedio']; ?></td>
                        <?php
                            }
                        ?>
                        
                    <?php
                    }
                    ?>  
                    </tr>
                
                </table>
                
        <?php
            }
        ?>
    </main>
</div><!--.contenedor-->

<?php
    include 'inc/templates/footer.php';
?>