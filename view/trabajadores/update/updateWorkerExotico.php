<?php
require '../../../controller/UserController.php';
$ctrl = new UserController();

// Validar ID
if (!isset($_GET['id'])) {
    echo "ID de trabajador no especificado.";
    exit;
}

$id = $_GET['id'];
$worker = $ctrl->getWorkerById($id);

if (!$worker) {
    echo "Trabajador no encontrado.";
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedData = [
        'name' => $_POST['name'] ?? '',
        'age' => $_POST['age'] ?? '',
        'height' => $_POST['height'] ?? '',
        'description' => $_POST['description'] ?? '',
        'price' => $_POST['price'] ?? '',
    ];

    $ctrl->updateWorker($id, $updatedData);
    echo "Información actualizada correctamente.";
    // Redireccionar o mostrar confirmación
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Dream</title>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav>
        <div id="nav1">
            <a href="../../index.php"><img src="../../img/Rent-a-dream-logo-only.png" width="110rem" alt=""></a>
        </div>
        <div id="nav2" class="display-nav2">
            <a href="../../index.php">HOME</a>
            <span>|</span>
            <a href="../../chicas.php">CHICAS</a>
            <span>|</span>
            <a href="../../chicos.php">CHICOS</a>
            <span>|</span>
            <a href="../../exotico.php">EXOTICO</a>
        </div>
        <div>
            <a href="../../login.html">
                <button class="Btn">
                    <div class="sign"><svg viewBox="0 0 512 512">
                            <path
                                d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z">
                            </path>
                        </svg></div>

                    <div class="text">Login</div>
                </button>
            </a>
        </div>
    </nav>
    <nav>
        <div>
        </div>
        <div id="nav2" class="display-nav2-mobile">
            <a href="../../index.php">HOME</a>
            <span>|</span>
            <a href="../../chicas.php">CHICAS</a>
            <span>|</span>
            <a href="../../chicos.php">CHICOS</a>
            <span>|</span>
            <a href="../../exotico.php">EXOTICO</a>
        </div>
        <div>
        </div>
    </nav>
    <div class="edit-worker-container">
        <h1>Editar Información del Trabajador</h1>

        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($worker['name']) ?>" required><br>

            <label>Edad:</label>
            <input type="number" name="age" value="<?= htmlspecialchars($worker['age']) ?>" required><br>

            <label>Altura (cm):</label>
            <input type="number" name="height" value="<?= htmlspecialchars($worker['height']) ?>" required><br>

            <label>Descripción:</label>
            <textarea name="description" required><?= htmlspecialchars($worker['description']) ?></textarea><br>

            <label>Precio por hora (€):</label>
            <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($worker['price']) ?>" required><br>

            <button type="submit">Guardar Cambios</button>
        </form>

        <a href="ver_trabajador.php?id=<?= htmlspecialchars($id) ?>">Volver al perfil</a>
    </div>
</body>

</html>