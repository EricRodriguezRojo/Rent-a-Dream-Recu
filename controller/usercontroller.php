<?php
session_start();
require_once "functions.php";
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


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new UserController();

    if (isset($_POST["login"])) {
        $user->login();
    }

    if (isset($_POST["register"])) {
        $user->register();
    }

    if (isset($_POST["logout"])) {
        $user->logout();
    }

    if (isset($_POST["updatePassword"])) {
            $user->updatePassword();
    }

    if (isset($_POST["deleteAccount"])) {
        $user->deleteAccount();
    }
    if (isset($_POST["deleteWorker"])) {
        $user->deleteWorker();
    }

    if (isset($_POST["insertWorker"])) {
        $user->insertWorker();
    }
}

class usercontroller
{
    private $pdo;
    private $usersTable = "users";

    public function __construct()
    {
        try {
            $host = 'localhost';
            $dbname = 'rentadream';
            $username = 'root';
            $password = '';

            $this->pdo = new PDO(
                "mysql:host=$host;charset=utf8",
                $username,
                $password
            );
            if ($this->createDatabase($dbname) == false){
                    die("Error de conexión: ");
            }
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $username,
                $password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->createUsersTable($this -> usersTable);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function createDatabase($name){
        try{
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $name");
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    public function createUsersTable($tableName) {
    try {
        $sql = "
            CREATE TABLE IF NOT EXISTS $tableName (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(45) NOT NULL,
                email VARCHAR(45) NOT NULL,
                password VARCHAR(400) NOT NULL,
                rol VARCHAR(50) NOT NULL,
                dni VARCHAR(50) NOT NULL,
                phonenumber VARCHAR(11) NOT NULL
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        ";
        $this->pdo->exec($sql);
    } catch (PDOException $e) {
        echo "Error al crear la tabla 'usuarios': " . $e->getMessage();
    }
}

    public function listWorkersGirls()
    {
        // 2) Saca todos los registros de workergirl
        $stmt = $this->pdo->query("SELECT idWorker, name, age, height, description, rating, price FROM workers WHERE tipo = 'girl';");
        return $stmt->fetchAll();
    }
    public function listWorkersMan()
    {
        // 2) Saca todos los registros de workerman
        $stmt = $this->pdo->query("SELECT idWorker, name, age, height, description, rating, price FROM workers WHERE tipo = 'man';");
        return $stmt->fetchAll();
    }
    public function listWorkersExotic()
    {
        // 2) Saca todos los registros de workerexotic
        $stmt = $this->pdo->query("SELECT idWorker, name, age, height, description, rating, price FROM workers WHERE tipo = 'exotic';");
        return $stmt->fetchAll();
    }

    public function getWorkerById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM workers WHERE idWorker = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   

    public function insertWorker()
    {
        if (isset($_POST['insertWorker'])) {
            // Recoger datos del formulario
            $name = $_POST['name'];
            $age = $_POST['age'];
            $height = $_POST['height'];
            $description = $_POST['description'];
            $rating = $_POST['rating'];
            $price = $_POST['price'];
            $tipo = $_POST['tipo'];
            // Llamar a la función de inserción
            try {
                 $stmt = $this->pdo->prepare("
                INSERT INTO workers 
                (name, age, height, description, rating, price, tipo) 
                VALUES (:name, :age, :height, :description, :rating, :price, 'man')
            ");

            $stmt->execute([
                ':name' => $name,
                ':age' => $age,
                ':height' => $height,
                ':description' => $description,
                ':rating' => $rating,
                ':price' => $price
            ]);

            header("Location: ../view/index.php");
            exit();
                
            } catch (PDOException $e) {
                echo "Error al insertar trabajador: " . $e->getMessage();
            }
        }
    }

    public function updateWorker($id, $data): bool
    {
        try {
            $stmt = $this->pdo->prepare("
            UPDATE workers
            SET name = :name,
                age = :age,
                height = :height,
                description = :description,
                price = :price
                WHERE idWorker = :id
        ");

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':age', $data['age'], PDO::PARAM_INT);
            $stmt->bindParam(':height', $data['height'], PDO::PARAM_INT);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar trabajador: " . $e->getMessage());
            return false;
        }
    }
 

    
    public function deleteWorker(): void
    {
        // Verificar que el ID venga en POST
        if (!isset($_POST['deleteWorker']) || empty($_POST['deleteWorker'])) {
            // Puedes redirigir o lanzar error
            die("ID de trabajador no especificado.");
        }

        $id = $_POST['deleteWorker'];

        try {
            // Preparar la consulta DELETE
            $stmt = $this->pdo->prepare("DELETE FROM workers WHERE idWorker = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se eliminó algún registro
            if ($stmt->rowCount() > 0) {
                // Eliminado correctamente
                // Puedes redirigir a una página con mensaje o mostrar confirmación
                header("Location: ../view/chicos.php?msg=El trabajador ha sido eliminado correctamente");
                exit();
            } else {
                // No se encontró el trabajador con ese ID
                die("No se encontró el trabajador para eliminar.");
            }
        } catch (PDOException $e) {
            // Manejar errores
            error_log("Error al eliminar trabajador: " . $e->getMessage());
            die("Error al eliminar el trabajador.");
        }
    }


    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $usersTable = $this->usersTable;
        try {
            $stmt = $this->pdo->prepare("
                SELECT name, email, password, rol, dni 
                FROM $usersTable 
                WHERE email = :email
            ");

            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['dni'] = $user['dni'];

                header("Location: ../view/index.php");
                exit();
            }

            $_SESSION['logged'] = false;
            $_SESSION['error'] = "Credenciales inválidas";
            header("Location: ../view/login.html");
            exit();
        } catch (PDOException $e) {
            error_log("Error de login: " . $e->getMessage());
            $_SESSION['error'] = "Error en el sistema";
            header("Location: ../view/login.html");
            exit();
        }
    }

    public function register(): void
    {
        $email = $_POST['email'] ?? '';
        $username = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';
        $rol = $_POST["rol"] ?? 'user';
        $dni = $_POST["dni"] ?? '';
        $phonenumber = $_POST["phonenumber"];
        $usersTable = $this->usersTable;

        // Validaciones
        if (empty($username) || empty($email) || empty($password) || empty($phonenumber)) {
            $_SESSION['error'] = "Todos los campos son requeridos";
            header("Location: ../view/sign_up.html");
            exit();
        }

        if (!preg_match('/^\\+?[1-9][0-9]{10}$/', $phonenumber))
        {
            $_SESSION['error'] = "El numero de telefono tiene que ser de 11 numeros";
            echo "numero";
            //header("Location: ../view/sign_up.html");
            exit();
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email inválido";
            header("Location: ../view/sign_up.html");
            exit();
        }

        try {
            // Verificar si el email ya existe
            $stmt = $this->pdo->prepare("SELECT id FROM $usersTable WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->fetch()) {
                $_SESSION['error'] = "El email ya está registrado";
                header("Location: ../view/sign_up.html");
                exit();
            }

            // Hash de contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("
                INSERT INTO $usersTable 
                (name, email, password, rol, dni, phonenumber) 
                VALUES (:name, :email, :password, :rol, :dni, :phonenumber)
            ");

            $stmt->execute([
                ':name' => $username,
                ':email' => $email,
                ':password' => $passwordHash,
                ':rol' => $rol,
                ':dni' => $dni,
                ':phonenumber' => $phonenumber
            ]);

            $_SESSION['logged'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['rol'] = $rol;
            $_SESSION['dni'] = $dni;
            $_SESSION['phonenumber'] = $phonenumber ;

            header("Location: ../view/index.php");
            exit();
        } catch (PDOException $e) {
            error_log("Error de registro: " . $e->getMessage());
            $_SESSION['error'] = "Error en el registro";
            header("Location: ../view/sign_up.html");
            exit();
        }
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header("Location: ../view/login.html");
        exit();
    }


    public function updatePassword(): void
{
    // Verifica si el usuario está logueado
    if (!isset($_SESSION['email'])) {
        header("Location: ../view/userconfig.php?msg=notfound");
        exit();
    }

    $email = $_SESSION['email'];
    $currentPassword = $_POST['actual'] ?? '';
    $newPassword = $_POST['nueva'] ?? '';
    $confirmPassword = $_POST['confirmar'] ?? '';
    $usersTable = $this->usersTable;

    // Validaciones
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        header("Location: ../view/userconfig.php?msg=emptyfields");
        exit();
    }

    // Verificar que las nuevas contraseñas coinciden
    if ($newPassword !== $confirmPassword) {
        header("Location: ../view/userconfig.php?msg=nomatch");
        exit();
    }

    try {
        // Obtener usuario desde la base de datos
        $stmt = $this->pdo->prepare("SELECT password FROM $usersTable WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: ../view/userconfig.php?msg=notfound");
            exit();
        }

        // Verificar contraseña actual
        if (!password_verify($currentPassword, $user['password'])) {
            header("Location: ../view/userconfig.php?msg=wrongcurrent");
            exit();
        }

        // Encriptar nueva contraseña
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Actualizar contraseña
        $stmt = $this->pdo->prepare("UPDATE $usersTable SET password = :password WHERE email = :email");
        $stmt->execute([
            ':password' => $hashedNewPassword,
            ':email' => $email
        ]);

        header("Location: ../view/userconfig.php?msg=success");
        exit();
    } catch (PDOException $e) {
        error_log("Error al actualizar contraseña: " . $e->getMessage());
        header("Location: ../view/userconfig.php?msg=error");
        exit();
    }
    }


    public function deleteAccount(): void
{
    // Verifica si el usuario está logueado
    if (!isset($_SESSION['email'])) {
        $_SESSION['error'] = "Debes iniciar sesión para eliminar tu cuenta.";
        header("Location: ../view/login.html");
        exit();
    }

    $email = $_SESSION['email'];
    $usersTable = $this->usersTable;

    try {
        // Eliminar la cuenta del usuario
        $stmt = $this->pdo->prepare("DELETE FROM $usersTable WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Cerrar sesión y limpiar datos
        $_SESSION = [];
        session_destroy();

        // Redirigir a la página principal
        header("Location: ../view/index.php");
        exit();
    } catch (PDOException $e) {
        error_log("Error al eliminar la cuenta: " . $e->getMessage());
        $_SESSION['error'] = "Ocurrió un error al eliminar tu cuenta.";
        header("Location: ../view/userconfig.php");
        exit();
    }
    }   
}
