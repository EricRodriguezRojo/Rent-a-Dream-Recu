<?php
include 'functions.php';
session_start();
createUserIfnotExists();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger y limpiar los datos
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);

    $isValidUser = false;

    // Verificar credenciales recorriendo los usuarios
    foreach ($_SESSION["users"] as $user) {
        if ($user["email"] === $email && password_verify($password, $user["password"])) {
            $isValidUser = true;
            $_SESSION["activeUser"] = [
                "email" => $user["email"],
                "name" => $user["name"],
                "dni" => $user["dni"],
                "password" => $user["password"],
                "rol" => $user["rol"]
            ];
            break; // No es necesario seguir buscando
        }
    }

    // Redirigir si las credenciales son correctas
    if ($isValidUser) {
        header("Location: ../../view/index.php");
        exit(); // Detener ejecución
    } else {
        echo "<p style='color:red; text-align:center;'>Incorrect user</p>";
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
        <div style="display:flex;text-align: center;justify-content:center;align-items: center;">
            <div class="container">
                <div class="heading">Log in</div>
                <form action="login.php" class="form" method="POST">
                    <input required class="input" type="email" name="email" id="email" placeholder="E-mail">
                    <input required class="input" type="password" name="password" id="password" placeholder="Password">
                    <span class="forgot-password"><a href="sign_up.php" style="text-shadow: none">Forgot Password ?</a></span>
                    <span class="forgot-password"><a href="sign_up.php" style="text-shadow: none">Register</a></span>
                    <input class="login-button" type="submit" value="Log In">
                </form>
            </div>
        </div>

    </div>

</body>

</html>