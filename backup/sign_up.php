<?php
session_start();
include 'functions.php';
createUserIfnotExists();
if ($_SESSION["users"])


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Register"])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $dni = htmlspecialchars(trim($_POST['dni']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña
        if ($_POST["rol"] == "1"){
            $rol = "user";
        } else {
            $rol = "admin";
        }
        // Verificar si ya existe el usuario
        $exists = false;
        foreach ($_SESSION["users"] as $user) {
            if ($user["email"] === $email) {
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            // Agregar nuevo usuario a la sesión
            $_SESSION["users"][] = [
                "email" => $email,
                "name" => $nombre,
                "dni" => $dni,
                "password" => $password,
                "rol" => $rol
            ];

            // Mandar al login
            header("Location: login.php");
        } else {
            echo "El email ya está registrado.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../view/styles.css">
</head>

<body>

    <div class="login">
        <div style="justify-content: center;text-align:center;">
            <a href="../../view/index.php"><img src="../../view/img/Rent-a-dream-logo-only.png" width="150rem" alt=""></a>
        </div>
        <div style="display:flex;text-align: center;justify-content:center;">
            <!-- From Uiverse.io by Smit-Prajapati -->
            <div class="container">
                <div class="heading">Register</div>
                <form method="POST" class="form">
                    <input required class="input" type="email" name="email" id="email" placeholder="E-mail">
                    <input required class="input" type="dni" name="nombre" id="nombre" placeholder="Nombre">
                    <input required class="input" type="dni" name="dni" id="dni" placeholder="DNI">
                    <input required class="input" type="password" name="password" id="password" placeholder="Password">
                    <div class="radio-inputs">
                        <label class="radio">
                            <input required type="radio" name="radio" value="1" checked="">
                            <span class="name">User</span>
                        </label>
                        <label class="radio">
                            <input required type="radio" name="radio" value="2">
                            <span class="name">Admin</span>
                        </label>
                    </div>
                    <span class="forgot-password"><a href="login.php" style="text-shadow: none">You alredy have an account?</a></span>
                    <input class="login-button" type="submit" name="Register" value="Register">
                </form>
            </div>
        </div>

    </div>
    <br><br>
    <br>

</body>

</html>