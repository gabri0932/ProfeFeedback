<?php
    session_start();
    include("../resource/controller.php");
    include("../resource/pdo.php");
    noset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="appcss/perfil.css">
    <link rel="icon" href="../icons/icon.jpg">
    <link rel="stylesheet" href="../responsive/responsive.css">
    <title>Perfil</title>
</head>
<body>
    <?php 
        require_once("../responsive/no_responsive.php");
    ?>
    <div class="container">
    <div class="padre">
        <div class="home">
            <div class="redes">
                <a href=""><i class='bx bxl-facebook-circle'></i></a>
                <a href=""><i class='bx bxl-instagram' ></i></a>
                <a href=""><i class='bx bxl-twitter' ></i></a>
            </div>
            <div class="title">
                <img src="../icons/icon.jpg" alt="">
                <h1>Profe Feedback</h1>
            </div>
        </div>
        <div class="search">
            <form action="">
                <label for="">
                <i class='bx bx-search'></i>
                <input type="search" name="" id="" placeholder="Busca a tu maestro">
                </label>
            </form>
        </div>
        <div class="menu">
            <nav>
            <ul id="menu">
                <li class="principal_menu"><i class='bx bxs-cog' ></i>
                    <ul class="cositas">
                        <li><a href="perfil.php"><i class='bx bx-user'></i></a> <i class="p_menu1">Perfil</i></li>
                        <li><a href="../resource/logout.php"><i class='bx bx-log-out'></i></a> <i class="p_menu">Salir</i></li>
                    </ul>
            </li>
            </ul>
        </nav>
        </div>
        <div class="linea"></div>
        </div>
        <div class="men_lateral">
            <nav>
            <ul>
                <li><a href="foro.php"><i class='bx bx-home'></i> Inicio</a></li>
                <li><a href="foro.php"><i class='bx bxs-right-top-arrow-circle'></i> Popular</a></li>
                <li><a href="foro.php"><i class='bx bx-bar-chart'></i></i>  Todo</a></li>
            </ul>
            </nav>
        </div> 
        <div class="mi_perfil">
            <div class="saludo">
                <h2>Bienvenido <?= $_SESSION["USER_VAL"]["name_parts"][0]; ?></h2>
            </div>
            <div class="linea"></div>
            <p class="i"><i class='bx bx-comment'></i> Mis comentarios</p>
            <div class="mis_come">
                <div class="comentarios">
                    <?php
                        $query = $pdo -> prepare("SELECT * FROM comments WHERE por = :id;");
                        $query -> execute(array(
                            ':id' => $_SESSION["USER_VAL"]["user_id"]
                        ));

                        while ($mcomment = $query -> fetch(PDO::FETCH_ASSOC)) { 
                            if (!empty($mcomment)) {
                                $query_t = $pdo -> prepare("SELECT name FROM teachers WHERE id_teacher = :id;");
                                $query_t -> execute(array(
                                    ':id' => $mcomment['para']
                                ));
                                $teac = $query_t -> fetch(PDO::FETCH_ASSOC); ?>

                                <div class="comentario">
                                    <span class="info">Comentaste sobre <?= $teac["name"] . " en el " . $mcomment["fecha"] ?></span>
                                    <div class="co">
                                        <span class="text">Dijiste: <?= $mcomment["comment"] ?></span>
                                    </div>
                                    
                                </div>
                                <div class="espacio"><br></div>
                            <?php }
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="menu_lateral_izquierdo">
            <a href="" class="eliminar"><i class='bx bx-exit'></i> Eliminar mi cuenta</a>
        </div>
        </div>
</body>
</html>