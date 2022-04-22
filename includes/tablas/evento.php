<?php

$sql = 'SELECT * FROM calendario';

$resultado = mysqli_query($db, $sql);

?>

<section id="tabla" class="mt-5">
        <table id="calendario-table" class="display">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Color de fondo</th>
                    <th>Color de texto</th>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($calendario = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $calendario['title'] ?></td>
                        <td><?php echo $calendario['description'] ?></td>
                        <td style="background-color:<?php echo $calendario['color'] ?>; color:<?php echo $calendario['textColor'] ?>;"><?php echo $calendario['color'] ?></td>
                        <td style="background-color:<?php echo $calendario['color'] ?>; color:<?php echo $calendario['textColor'] ?>;"><?php echo $calendario['textColor'] ?></td>
                        <td><?php echo $calendario['start'] ?></td>
                        <td><?php echo $calendario['end'] ?></td>
                        <td><a href="/includes/calendario/actualizar.php?id=<?php echo $calendario['id']; ?>" class="btn btn-success"><i class="fa-solid fa-pencil"></i></a></td>
                        <td><button data-href="/includes/calendario/eliminar.php?id=<?php echo $calendario['id']; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>