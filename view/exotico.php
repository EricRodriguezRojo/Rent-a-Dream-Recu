<?php
require '../controller/UserController.php';
$ctrl = new UserController;
$workers = null;
$workers = $ctrl->listWorkersExotic();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Dream - Exotico</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div>
        <nav>
            <div id="nav1">
                <a href="index.php"><img src="img/Rent-a-dream-logo-only.png" width="110rem" alt=""></a>
            </div>
            <div id="nav2">
                <a href="index.php">HOME</a>
                <span>|</span>
                <a href="chicas.php">CHICAS</a>
                <span>|</span>
                <a href="chicos.php">CHICOS</a>
                <span>|</span>
                <a href="exotico.php">EXOTICO</a>
            </div>
            <div>
                <a href="login.html">
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
        <header>
            <div class="mainp">
                <div class="mainp-slogan">
                    <h2 class="mainp-slogan-h2">Exotico</h2>
                    <p class="mainp-slogan-txt">Compañeros de confianza y de calidad</p>
                    <a href="trabajadores/insert/insertWorkerExotic.php"><p class="mainp-slogan-txt" style="font-weight: bold;">INSERT NEW WORKER</p></a>
                </div>
            </div>
        </header>

        <div id="filters-mobile">
            <div class="filters">
                <div class="filter-section">
                    <h3>Edad</h3>
                    <div class="filter-option">
                        <input type="checkbox" id="age-18-25" checked>

                        <label for="age-18-25">18-25 años</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="age-26-30" checked>
                        <label for="age-26-30">26-30 años</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="age-31-40" checked>
                        <label for="age-31-40">31-40 años</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Altura</h3>
                    <div class="filter-option">
                        <input type="checkbox" id="height-160-175" checked>
                        <label for="height-160-175">160-175 cm</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="height-176-185" checked>
                        <label for="height-176-185">176-185 cm</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="height-186" checked>
                        <label for="height-186">+186 cm</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Valoración</h3>
                    <div class="filter-option">
                        <input type="checkbox" id="rating-4" checked>
                        <label for="rating-4">4 estrellas o más</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="rating-3" checked>
                        <label for="rating-3">3 estrellas o más</label>
                    </div>
                </div>
                <button class="filter-button">Apply</button>


            </div>

        </div>

        <!-- Catálogo de chicos -->
        <div class="catalog-container">
            <!-- Filtros -->
            <div id="filters-display" class="filters">
                <div class="filter-section">
                    <h3>Edad</h3>
                    <div class="filter-option">
                        <input type="checkbox" id="age-18-25" checked>
                        <label for="age-18-25">18-25 años</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="age-26-30" checked>
                        <label for="age-26-30">26-30 años</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="age-31-40" checked>
                        <label for="age-31-40">31-40 años</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Altura</h3>
                    <div class="filter-option">
                        <input type="checkbox" id="height-160-175" checked>
                        <label for="height-160-175">160-175 cm</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="height-176-185" checked>
                        <label for="height-176-185">176-185 cm</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="height-186" checked>
                        <label for="height-186">+186 cm</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Valoración</h3>
                    <div class="filter-option">
                        <input type="checkbox" id="rating-4" checked>
                        <label for="rating-4">4 estrellas o más</label>
                    </div>
                    <div class="filter-option">
                        <input type="checkbox" id="rating-3" checked>
                        <label for="rating-3">3 estrellas o más</label>
                    </div>
                </div>

                <button class="filter-button">Apply</button>
            </div>

            <!-- Perfiles -->
            <div class="catalog">
                <!-- Perfiles php -->
                <?php foreach ($workers as $w): ?>
                    <div class="profile-card">
                        <div class="profile-image"
                            style="background-image: url('img/workers/exotic/<?= htmlspecialchars($w['idWorker']) ?>.png');">
                        </div>
                        <div class="profile-info">
                            <a href="trabajadores/perfil-exotic.php?id=<?= $w['idWorker'] ?>">
                                <h3 class="profile-name"><?= htmlspecialchars($w['name']) ?></h3>
                            </a>
                            <div class="profile-rating">
                                <div class="stars">
                                    <?php
                                    // Muestra cinco estrellas rellenas y vacías según el rating
                                    $int = floor($w['rating']);
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo $i <= $int ? '★' : '☆';
                                    }
                                    ?>
                                </div>
                                <span class="rating-value"><?= number_format($w['rating'], 1) ?></span>
                            </div>
                            <p class="profile-description">
                                <?= nl2br(htmlspecialchars($w['description'])) ?>
                            </p>
                            <p class="profile-price">
                                Desde <?= number_format($w['price'], 0, ',', '.') ?>€/hora
                            </p>
                            <div style="display: flex;">
                            <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin"): ?>
                                <a href="trabajadores/update/updateWorkerExotico.php?id=<?= $w['idWorker'] ?>">
                                    <p>Actualizar</p>
                                </a>
                                <form action="../controller/usercontroller.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este trabajador? Esta acción no se puede deshacer.');">
                                    <input type="hidden" name="deleteWorkerExotic" value="<?= $w['idWorker'] ?>">
                                    <button type="submit" style="margin-top: 1.4rem; background:none; border:none; color:red; cursor:pointer; padding:0; font-size:1em;">
                                        Eliminar
                                    </button>
                                </form>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>