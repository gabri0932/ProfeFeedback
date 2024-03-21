<?php
    session_start();
    include("resource/controller.php");
    include("resource/pdo.php");
    set();

    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
            $_SESSION["msg"] = "<span class='msg' style=' position:absolute; top:0; right:0;color:red ;'>Todos los campos son necesarios.</span>";
            header("Location: login_register.php");
            exit;
        } elseif (is_numeric($_POST["name"])) {
            $_SESSION["msg"] = "<span class='msg' style=' position:absolute; top:0; right:0;color:red ;'>Ingrese un nombre válido.</span>";
            header("Location: login_register.php");
            exit;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["msg"] = "<span class='msg' style=' position:absolute; top:0; right:0;color:red ;'>Ingrese un correo válido.</span>";
            header("Location: login_register.php");
            exit;
        } else {
            $query = $pdo -> prepare("INSERT INTO users (name, email, password) VALUES (:nm, :em, :pw);");
            $query -> execute(array(
                ':nm' => $_POST["name"],
                ':em' => $_POST["email"],
                ':pw' => $_POST["password"]
            ));

            $_SESSION["msg"] = "<span class='msg' style=' position:absolute; top:0; right:0;color:green ;'>Registro éxitoso. Inicie sesión.</span>";
            header("Location: login.php");
            exit;
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
    <title>Registrarse</title>
</head>
<body>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>¡Bienvenido!</h2>
                <p>Para unirte a Profe Feedback por favor inicia sesi&oacute;n</p>
                <a href="login.php">Iniciar Sesi&oacute;n</a></input>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una cuenta</h2>
                <div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github' ></i>
                    <i class='bx bxl-linkedin-square' ></i>
                </div>
                <p>Usa tu Email para registrarte</p>
<<<<<<< HEAD
                <form action="" class="form" method="POST">
                    <?php
                        if (isset($_SESSION["msg"])) {
                            echo ($_SESSION["msg"]);
                            unset($_SESSION["msg"]);
                        }
                    ?>
=======
                <?php 
                        if(isset($_SESSION["error"])){
                            echo $_SESSION["error"];
                            unset($_SESSION["error"]);
                        }
                    ?>
                <form action="" class="form" method="POST">
>>>>>>> 64d5dee3ee85db08997e828f20f5da1537681e3d
                    <label for="">
                        <i class='bx bx-user' ></i>
                        <input type="text" name="name" placeholder="Nombre completo">
                    </label>
                    <label for="">
                        <i class='bx bx-envelope' ></i>
                        <input type="email" name="email" id="" placeholder="Correo Electr&oacute;nico">
                    </label>
                    <label for="">
                        <i class='bx bx-lock-alt' ></i>
                        <input type="password" name="password" id="" placeholder="Contraseña">
                    </label>
                    <input type="submit" value="Reg&iacute;strate">
                </form>
            </div>
        </div>
    </div>
</body>
</html>