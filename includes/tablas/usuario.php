<?php

$query = 'SELECT * FROM usuarios';

$consulta = mysqli_query($db, $query);

?>

<section id="tabla-directorio" class="mt-5 mb-5 container">

<table id="directorio" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Extensión</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($consulta)) {
            ?>
                <tr>
                    <td><?php echo $row['nombre'] ?></td>
                    <td><?php echo $row['apellido'] ?></td>
                    <td><?php echo $row['departamento'] ?></td>
                    <td><?php echo $row['cargo'] ?></td>
                    <td><?php echo $row['correo'] ?></td>
                    <td><?php echo $row['celular'] ?></td>
                    <td><?php echo $row['extension'] ?></td>
                    <td><a href="/includes/directorio/update.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa-solid fa-pencil"></i></a></td>
                    <td><button data-href="/includes/directorio/eliminar.php?id=<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="text-center">
        <span class="text-danger fs-6">las extensiones es 0 no aplican</span>
    </div>
</section>

<!--Modal-->

<div class="modal" id="confirm-delete" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar Registro </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Deseas eliminar este empleado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Borrar</a>
            </div>
        </div>
    </div>
</div>


<script>
    function mostrarContraseña() {
        const pass = document.querySelector('#contraseña');
        const mostar = document.querySelector('.mostrar');
        const ocultar = document.querySelector('.ocultar');

        if (pass.type == 'password') {
            pass.type = 'text';
            ocultar.classList.add('visually-hidden');
            mostar.classList.remove('visually-hidden')
        } else {
            pass.type = 'password';
            mostar.classList.add('visually-hidden');
            ocultar.classList.remove('visually-hidden')

        }

    }

    function mostrarContraseñaConfirmar() {
        const pass = document.querySelector('#contraseña-con');
        const mostar = document.querySelector('.mostrar-con');
        const ocultar = document.querySelector('.ocultar-con');

        if (pass.type == 'password') {
            pass.type = 'text';
            ocultar.classList.add('visually-hidden');
            mostar.classList.remove('visually-hidden')
        } else {
            pass.type = 'password';
            mostar.classList.add('visually-hidden');
            ocultar.classList.remove('visually-hidden')

        }

    }
</script>
