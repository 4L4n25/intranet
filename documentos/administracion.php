<?php
require '../includes/funciones.php';

$auth = autenticado();

if(!$auth){
    header('location:login.php');
}else{
    if((time()-$_SESSION['time'])>900){
        header('Location:logout.php');
    }
}
require '../includes/config/database.php';

$db = conectarDb();

$query = "SELECT * FROM documentos WHERE departamento = 'administracion'";

$resultado = mysqli_query($db, $query);
require '/intranet/assets/shared/header.php';
?>
<div class="text-center mt-3">
    <h1>Documentos</h1>
</div>
<main class="container mt-5">
    <section class="row">
        <?php
        while($documento = mysqli_fetch_assoc($resultado)){  ?>
        <div class="col-md-3">
            <div class="card border border-secondary shadow p-3 mb-5 bg-body rounded width">
                <div class="card-body">
                <h5 class="card-title"><?php echo $documento['titulo'] ?></div>
                <p class="card-text text-center"><?php echo $documento['descripcion'] ?></p>
                <a href="assets/docs/<?php echo $documento['archivo'] ?>" target="blank" class="btn btn-primary"><i class="fa-solid fa-cloud-arrow-down"></i> Descargar</a>
            </div>
            </div>
        </div>

        <?php }
        ?>
        
        </div>
    </section>
</main>

<?php
require '/intranet/assets/shared/footer.php';
?>