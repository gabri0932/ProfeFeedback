<?php
    session_start();
    include("../resource/controller.php");
    include("../resource/pdo.php");
    noset();

    $query = $pdo -> query("SELECT * FROM school;");
    if ($query -> rowCount() == 0) {
        $escuelas = [
            "Politecnico Francisco Jose Peynado", "Politecnico Loyola", "Colegio San Rafael", "Politécnico Altagracias Lucas de Garcia", "Liceo Diogenes Valdez"
        ];

        for ($i = 0; $i < count($escuelas); $i++) {
            $insert = $pdo -> prepare("INSERT INTO school (name) VALUES (:nm)");
            $insert -> execute(array(
                ':nm' => $escuelas[$i]
            ));
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../icons/icon.jpg">
    <link rel="stylesheet" href="appcss/style.css">
    <title>Foro-Maestro</title>
</head>
<body>
    <?php 
        include("../data/header.php");
        include("../data/menu_lateral.php");
    ?>
    <div class="informacion">
        <div class="bienvenido">
            <p>¡Bienvenidos a nuestra plataforma de puntuación de profesores y 
                escuelas! En nuestra comunidad, podrás evaluar y compartir tus 
                experiencias sobre diferentes instituciones educativas. Entre las 
                escuelas disponibles para puntuar se encuentran:</p>
        </div>
                    <ul class="lista">
                        <li><a href="school/comentar.php?escuela=1">Politecnico Francisco Jose Peynado</a></li>
                        <li><a href="school/comentar.php?escuela=2">Politecnico Loyola</a></li>
                        <li><a href="school/comentar.php?escuela=3">Colegio San Rafael</a></li>
                        <li><a href="school/comentar.php?escuela=4">Politécnico Altagracias Lucas de Garcia</a></li>
                        <li><a href="school/comentar.php?escuela=5">Liceo Diogenes Valdez</a></li>
                    </ul>
                    <img src="../icons/icon.jpg" alt="" class="logo">
                    </div>
                    <div class="linea5"></div>
                </body>
</html>