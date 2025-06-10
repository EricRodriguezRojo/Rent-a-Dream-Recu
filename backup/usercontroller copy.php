<?php
session_start();

// check if form is submitted
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
}

class UserController {
    private $conn;

    public function __construct() {
        // database conexión
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rentadream";

        // crear la conexión
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        // echo "Connected successfully"; // Puedes comentar esto si no quieres mostrarlo
    }

    public function login(): void {
    
        // Obtener datos del formulario
        $email = $_POST['email'];
        $password = $_POST['password'];
        
    
        // Preparar y ejecutar consulta
        $stmt = $this->conn->prepare("SELECT name, password FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Verificar si existe el usuario
        if ($row = $result->fetch_assoc()) {
            // Verificar contraseña
            if ($password == $row['password']) {
                // Autenticación exitosa
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['rol'] = $row['rol'];
                $_SESSION['dni'] = $row['dni'];
    
                // Redirigir
                header("Location: ../view/index.php");
                exit();
            }
        }
    
        // Si falla
        $_SESSION['logged'] = false;
        $_SESSION['error'] = "Nombre de usuario o contraseña inválidos.";
        echo $_SESSION['error'];
        echo $password;
        // header("Location: ../view/login.html");
        exit();
    }

    public function register(): void {
        // Obtener datos del formulario
        $email = $_POST['email'];
        $username = $_POST['name'];
        $password = $_POST['password'];
        $rol = $_POST["rol"];
        $dni = $_POST["dni"];

        // Validar que los campos no esten vacíos
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = "Por favor, complete todos los campos.";
            header("Location: ../view/sign_up.html");
            exit();
        }
    
        // Validar formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Formato de correo inválido.";
            header("Location: ../view/sign_up.html");
            exit();
        }
    
        // Prepararamos la consulta para insertar un nuevo registro
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, rol, dni) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $password, $rol, $dni);
    
        try {
            if ($stmt->execute()) {
                // Registro se inserto
                $_SESSION['logged'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['rol'] = $rol;
                $_SESSION['dni'] = $dni;
    
                $this->conn->close();
                header("Location: ../view/index.php");
                exit();
            } else {
                // Error al registrar
                $_SESSION['error'] = "No se pudo completar el registro.";
                $this->conn->close();
                header("Location: ../view/sign_up.html");
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            $this->conn->close();
            header("Location: ../view/sign_up.html");
            exit();
        } finally {
            //Cerramos conexion
            $this->conn->close();
        }
    }

    public function logout(): void {
        session_start();
        session_unset();
        session_destroy();

        header("Location: ../view/login.html");
        exit();
    }
}