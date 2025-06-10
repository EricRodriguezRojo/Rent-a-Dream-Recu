
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../styles.css">
</head>

<body>
    <nav>
        <div id="nav1">
            
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
    <div class="login">
        <div style="justify-content: center;text-align:center;">
            <a href="../../../view/index.php"><img src="../../../view/img/Rent-a-dream-logo-only.png" width="150rem" alt=""></a>
        </div>
        <div style="display:flex;text-align: center;justify-content:center;align-items: center;">
            <div class="container">
                <div class="heading">INSERT WORKER</div>
                <form action="../../../controller/usercontroller.php" class="form" method="POST" enctype="multipart/form-data">
                    <input required class="input" type="text" name="name" id="name" placeholder="name">
                    <input required class="input" type="number" name="age" id="age" min="18" max="120" placeholder="age">
                    <input required class="input" type="number" name="height" id="height" placeholder="height">
                    <input required class="input" type="text" name="description" id="description" placeholder="description">
                    <input required class="input" type="number" name="rating" id="rating" step="0.01" min="1" max="5" placeholder="rating">
                    <input required class="input" type="email" name="email" id="email" placeholder="E-mail">
                    <input required class="input" type="number" name="price" id="price" step="0.01" placeholder="price">
                    <input class="login-button" type="submit" name="insertWorkerMan" value="insert Worker">
                </form>
            </div>
        </div>
    </div>
</body>

</html>