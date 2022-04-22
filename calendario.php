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
?>
<div class="text-center mt-3">
    <h1>Calendario</h1>
</div>
<div id="calendar"></div>

<?php
require "/intranet/assets/shared/footer.php";
?>