<?php
session_start();
require_once "../controller/functions.php";
if (!isset($_SESSION["activeUser"])) {
  $_SESSION["activeUser"] = [
    "email" => null,
    "name" => null,
    "dni" => null,
    "password" => null,
    "rol" => null
  ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perfil de Usuario</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
</head>
<style>
  body {
    margin: 0;
    padding: 2rem;
    background-color: #fff0f5;
    font-family: 'Montserrat', sans-serif;
    display: flex;
    justify-content: center;
  }

  .profile-container {
    position: relative;
    width: 90%;
    max-width: 750px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    padding: 3rem 2rem 2rem;
    display: flex;
    flex-direction: column;
    gap: 2rem;
    overflow-y: auto;
    max-height: 90vh;
  }

  .back-button {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
  }
  .btn-back {
    background-color: #f6a4cd;
    color: #fff;
    text-decoration: none;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    font-weight: bold;
    font-size: 0.9rem;
  }

  .btn-back:hover {
    opacity: 0.9;
  }

  .profile-photo-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
  }

  .profile-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #f6a4cd;
  }

  .profile-header h1 {
    font-size: 1.8rem;
    margin: 0;
    text-align: center;
  }

  .profile-header p {
    margin: 0.5rem 0 0;
    text-align: center;
  }

  .profile-info p {
    margin: 0.5rem 0;
  }

  .btn-logout {
    display: inline-block;
    background-color: #f6a4cd;
    color: #fff;
    border: none;
    padding: 0.5rem 1rem;
    margin-top: 1rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1rem;
  }

  .password-form-section h2 {
    font-size: 1.4rem;
    margin-bottom: 1rem;
  }

  .password-form label {
    display: block;
    margin-top: 1rem;
    font-weight: bold;
  }

  .password-form input {
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.25rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }

  .password-form button {
    width: 100%;
    padding: 0.75rem;
    margin-top: 1.5rem;
    background-color: #f6a4cd;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    font-size: 1rem;
  }

  @media (max-width: 480px) {
    .profile-container {
      width: 95%;
      padding: 2rem 1rem;
    }
    .profile-photo {
      width: 100px;
      height: 100px;
    }
    .profile-header h1 {
      font-size: 1.6rem;
    }
    .password-form-section h2 {
      font-size: 1.2rem;
    }
  }
</style>
<body>
  <main class="profile-container">
    <div class="back-button">
      <a href="index.php" class="btn-back">← Volver</a>
    </div>

    <div class="profile-photo-section">
      <img src="default-profile.png" alt="Foto de perfil" class="profile-photo" />
    </div>

    <header class="profile-header">
      <h1>Mi Perfil</h1>
      <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Usuario') ?></strong></p>
    </header>

    <section class="profile-info">
      <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION['username'] ?? 'Usuario') ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email'] ?? 'usuario@ejemplo.com') ?></p>

      <form action="../controller/usercontroller.php" method="POST">
        <button class="btn-logout" name="logout" type="submit">Cerrar Sesión</button>
      </form>


      <form action="../controller/usercontroller.php" method="POST"
            onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
        <input type="hidden" name="deleteAccount" value="1" />
        <button class="btn-logout" type="submit" style="background-color: #dc3545;">Eliminar Cuenta</button>
      </form>
    </section>

<section class="password-form-section">
  <h2>Cambiar contraseña</h2>
  
  <?php if (isset($_GET['msg'])): ?>
    <div style="padding: 1rem; border-radius: 6px; font-weight: bold;
                background-color: <?= $_GET['msg'] === 'success' ? '#d4edda' : '#f8d7da' ?>;
                color: <?= $_GET['msg'] === 'success' ? '#155724' : '#721c24' ?>;
                border: 1px solid <?= $_GET['msg'] === 'success' ? '#c3e6cb' : '#f5c6cb' ?>;
                margin-bottom: 1rem;">
      <?php
        switch ($_GET['msg']) {
          case 'success':
            echo "Contraseña actualizada con éxito.";
            break;
          case 'wrongcurrent':
            echo "La contraseña actual es incorrecta.";
            break;
          case 'nomatch':
            echo "Las nuevas contraseñas no coinciden.";
            break;
          case 'notfound':
            echo "Usuario no encontrado.";
            break;
          case 'emptyfields':
            echo "Todos los campos son obligatorios.";
            break;
          default:
            echo "Ocurrió un error.";
        }
      ?>
    </div>
  <?php endif; ?>

  <form class="password-form" action="../controller/usercontroller.php" method="POST">
    <label for="actual">Contraseña actual</label>
    <input type="password" id="actual" name="actual" required />

    <label for="nueva">Nueva contraseña</label>
    <input type="password" id="nueva" name="nueva" required />

    <label for="confirmar">Confirmar nueva contraseña</label>
    <input type="password" id="confirmar" name="confirmar" required />

    <button type="submit" name="updatePassword">Cambiar contraseña</button>
  </form>
</section>