<?php
//autenticar usuario

require 'includes/config/database.php';

$db = conectarDb();

$email = '';
$contraseña = '';
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);

    if (!$email) {
        $errores[] = 'Correo no válido';
    }

    if (!$contraseña) {
        $errores[] = 'Contraseña no valida';
    }

    if (empty($errores)) {

        //revisar si el usuario existe 
        $query = "SELECT * FROM usuarios WHERE correo = '$email'";
        $result = mysqli_query($db, $query);

        if ($result->num_rows) {
            //revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($result);

            //revisar la conincidencia del password
            $auth = password_verify($contraseña, $usuario['contraseña']);

            if ($auth) {
                //usuario autenticado

                session_start();

                //llenar el arreglo de la session
                $_SESSION['usuario'] = $usuario['correo'];
                $_SESSION['rol'] = $usuario['role_id'];
                $_SESSION['login'] = true;
                $_SESSION['time'] = time();

                header('Location:index.php');
            } else {
                $errores[] = 'Contraseña incorrecta';
            }
        } else {
            $errores[] = 'El usuario no existe';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet Art Law & Tax</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/assets/img//apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon-180x180.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,400;0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <main class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card pocision">

                <div class="card-header text-center">
                    <h3>Ingreso</h3>
                </div>
                <div class="card-body mt-4">
                    <form action="login.php" method="POST">
                        <?php foreach ($errores as $error) : ?>
                            <div class="error">
                                <?php echo $error; ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <label for="email"><span class="input-group-text"><i class="fas fa-user"></i></span></label>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Correo">

                        </div>
                        <div class="input-group form-group mt-3">
                            <div class="input-group-prepend">
                                <label for="contraseña"><span class="input-group-text"><i class="fas fa-key"></i></span></label>
                            </div>
                            <input type="password" id="contraseña" name="contraseña" class="form-control input-wrapper" placeholder="Contraseña">
                            <span class="input-icon ocultar" onclick="mostrarContraseña()"><i class="fa-solid fa-eye"></i></span>
                            <span class="input-icon mostrar visually-hidden" onclick="mostrarContraseña()"><i class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <div class="form-group mt-5">
                            <input type="submit" value="Login" class="btn float-center login_btn">
                        </div>
                    </form>
                </div>
            </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
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
    </script>
</body>

</html>