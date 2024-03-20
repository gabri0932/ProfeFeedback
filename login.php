<?php
    include("resource/pdo.php");
    session_start();
    if(isset($_POST["email"]) && isset($_POST["password"]) ){
        if(empty($_POST["email"]) || empty($_POST["password"])){
            $_SESSION["error"] = "<span class='error' style=' position:absolute; top:0; right:0;color:red ;'> Todos los campos son necesarios</span>";
            header("Location: login.php");
            exit;
        }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "<span class='error' style=' position:absolute; top:0; right:0;color:red ;'> Email Invalido</span>";
            header("Location: login.php");
            exit;
        } else {
            $query = $pdo -> prepare("SELECT COUNT(*) conteo  FROM users WHERE email = :em AND password = :pw;");
            $query -> execute(array(
                ':em' => htmlentities($_POST["email"]),
                ':pw' => htmlentities($_POST["password"])
            ));
            $conteo = $query -> fetch(PDO::FETCH_ASSOC);

            if ($conteo["conteo"] == 1) {
                $query = $pdo -> prepare("SELECT * FROM users WHERE email = :em AND password = :pw;");
                $query -> execute(array(
                    ':em' => htmlentities($_POST["email"]),
                    ':pw' => htmlentities($_POST["password"])
                ));
                $user_data = $query -> fetch(PDO::FETCH_ASSOC);

                $_SESSION["USER_VAL"] = [
                    'user_id' => $user_data['user_id'],
                    'name' => $user_data['name'],
                    'email' => $user_data['email']
                ]

                header("Location: https://profefeedback.com/app/foro.php");
                exit;
            } else {
                $_SESSION["error"] = "<span class='error' style=' position:absolute; top:0; right:0;color:red ;'> Correo o contraseña incorrecto</span>";
                header("Location: login.php");
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/login_register.css">
    <link rel="icon" href="icons/icon.jpg">
    <title>Iniciar Sesion</title>
</head>
<body>
<div class="container-form login">
        <div class="information">
            <div class="info-childs">
                <h2>¡Bienvenido nuevamente!</h2>
                <p>Para unirte a Profe Feedback por favor Reg&iacute;strate</p>
                    <a href="login_register.php">Reg&iacute;strate</a>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesi&oacute;n</h2>
                <div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github' ></i>
                    <i class='bx bxl-linkedin-square' ></i>
                </div>
                <p>o Inicia Sesi&oacute;n con una cuenta</p>
                <form action="" class="form" method="POST">
                    <?php 
                        if(isset($_SESSION["error"])){
                            echo $_SESSION["error"];
                            unset($_SESSION["error"]);
                        }
                        
                    ?>
                    <label for="">
                        <i class='bx bx-envelope' ></i>
                        <input type="email" name="email" id="" placeholder="Correo Electr&oacute;nico">
                    </label>
                    <label for="">
                        <i class='bx bx-lock-alt' ></i>
                        <input type="password" name="password" id="" placeholder="Contraseña">
                    </label>
                    <input type="submit" value="Inciar Sesi&oacute;n">
                </form>
            </div>
        </div>
    </div>
</body>
</html>