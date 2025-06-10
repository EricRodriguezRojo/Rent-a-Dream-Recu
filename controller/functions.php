<?php
    function createUserIfnotExists(){
        if (!isset($_SESSION["users"])){
            $_SESSION["users"] = [
                [
                    "email" => "admin@admin.net",
                    "name" => "admin",
                    "dni" => null,
                    "password" => password_hash("admin", PASSWORD_DEFAULT),
                    "rol" => "admin"
                ],
                [
                    "email" => "user@user.net",
                    "name" => "user",
                    "dni" => null,
                    "password" => password_hash("user", PASSWORD_DEFAULT),
                    "rol" => "user"
                ]
            ];
        }
    }

    function printUserControllerError(): void{
        echo($_SESSION['Error']);
    }

    function printUserName(): void{
        $resultPrintUsername = (isset($_SESSION['logged']))?$_SESSION['username']:null;
        echo $resultPrintUsername;
    }
    function printRol(): void{
        $resultPrintRol = (isset($_SESSION['logged']))?$_SESSION['rol']:null;
        echo $resultPrintRol;
    }
?>