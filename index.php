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

require "assets/shared/header.php";
?>
<div class="hero"></div>
<main class="container construccion">
    <!-- <section id="noticias" class="d-flex">
        <div class="row mt-5">
            <div class="col-lg-6 mt-3">
                <div class="card">
                    <img src="assets/img/noticias.webp" class="card-img-top" width="200" height="300" alt="noticias-art">
                    <h5 class="card-title ms-2">
                        Reforma sat
                    </h5>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis nobis ea aliquid iure maxime? Architecto, praesentium alias! Ut repellat, beatae provident amet nesciunt optio maxime inventore consequatur, temporibus pariatur iure!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-3">
                <div class="card">
                    <img src="assets/img/noticias.webp" class="card-img-top" width="200" height="300" alt="noticias-art">
                    <h5 class="card-title ms-2">
                        Reforma sat
                    </h5>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis nobis ea aliquid iure maxime? Architecto, praesentium alias! Ut repellat, beatae provident amet nesciunt optio maxime inventore consequatur, temporibus pariatur iure!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-3">
                <div class="card">
                    <img src="assets/img/noticias.webp" class="card-img-top" width="200" height="300" alt="noticias-art">
                    <h5 class="card-title ms-2">
                        Reforma sat
                    </h5>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis nobis ea aliquid iure maxime? Architecto, praesentium alias! Ut repellat, beatae provident amet nesciunt optio maxime inventore consequatur, temporibus pariatur iure!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-3">
                <div class="card">
                    <img src="assets/img/noticias.webp" class="card-img-top" width="200" height="300" alt="noticias-art">
                    <h5 class="card-title ms-2">
                        Reforma sat
                    </h5>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis nobis ea aliquid iure maxime? Architecto, praesentium alias! Ut repellat, beatae provident amet nesciunt optio maxime inventore consequatur, temporibus pariatur iure!</p>
                    </div>
                </div>
            </div>
        </div>

        </div> -->
    </section>
</main>
<?php
require "assets/shared/footer.php";
?>