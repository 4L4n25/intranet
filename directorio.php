<?php

require 'includes/funciones.php';

$auth = autenticado();

if(!$auth){
    header('location:login.php');
}else{
    if((time()-$_SESSION['time'])>900){
        header('Location:logout.php');
    }
}
require "/intranet/assets/shared/header.php";

require 'includes/config/database.php';
$db = conectarDb();

$sql = 'SELECT * FROM usuarios';

$resultado = mysqli_query($db,$sql);

?>
<div class="text-center mt-3">
    <h1>Directorio</h1>
</div>
<main class="container mt-5">
    <section class="row">
        <?php while($directorio = mysqli_fetch_assoc($resultado)){ ?>
        <div class="col-lg-4">
            <div class="card border border-primary shadow p-3 mb-5 bg-body rounded" style="width: 24rem;">
            <img src="assets/images/<?php echo $directorio['imagen'] ?>" class="card-img-top img-directorio" alt="Foto Empleado">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $directorio['nombre'].' '.$directorio['apellido']?></h5>
                    <p class="card-text"><?php echo $directorio['departamento']?></p>
                    <p class="card-text"><?php echo $directorio['cargo']?></p>
                    <p class="card-text"><i class="fa-solid fa-envelope"></i> <?php echo $directorio['correo']?></p>
                    <p class="card-text"><i class="fa-solid fa-mobile-screen-button"></i> <?php echo $directorio['celular']?></p>
                    <p class="card-text">Extensión: <?php echo $directorio['extension']?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
</main>


<?php
require "/intranet/assets/shared/footer.php";
?>
