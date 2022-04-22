<?php

$query = "SELECT * FROM documentos";

$consulta = mysqli_query($db, $query);
?>

<section id="listar-documentos" class="mt-5">
    <table class="display" id="documentos">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Descripcion</th>
          <th>Documentos</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($filas = mysqli_fetch_assoc($consulta)) {
        ?>
        
          <tr>
            <td><?php echo $filas['titulo'] ?></td>
            <td><?php echo $filas['descripcion'] ?></td>
            <td><a href="assets/docs/<?php echo $filas['archivo'];?>" target="blank" class="btn btn-outline-info">Ver</a></td>
            <td><a href="/includes/documentos/actualizar.php?id=<?php echo $filas['id']; ?>" class="btn btn-success"><i class="fa-solid fa-pencil"></i></a></td>
            <td><button data-href="/includes/documentos/eliminar.php?id=<?php echo $filas['id']; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
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
        ¿Deseas eliminar este documento?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn-ok">Borrar</a>
      </div>
    </div>
  </div>
</div>
