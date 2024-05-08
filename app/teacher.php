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
    <link rel="icon" href="../icons/icon.jpg">
    <link rel="stylesheet" href="appcss/teacher.css">
    <link rel="stylesheet" href="../responsive/responsive.css">
    <title>Foro-Maestro</title>
</head>
<body>
    <?php 
        require_once("../responsive/no_responsive.php");
    ?>
    <div class="container">
    <?php 
        include("../data/header.php");
        include("../data/menu_lateral.php");
    ?>
     </div>
     <div class="todas">
        <h2>Todos los comentarios</h2>
        <div class="every">
            <?php 
                $query = $pdo -> query("SELECT * FROM comments ORDER BY RAND();");
                while($coment = $query -> fetch(PDO::FETCH_ASSOC)){ ?>
                    <div class="comentario">
                        <?php
                            $query_t = $pdo -> prepare("SELECT name FROM teachers WHERE id_teacher = :id;");
                            $query_t -> execute(array(
                                ':id' => $coment['para']
                            ));
                            $teac = $query_t -> fetch(PDO::FETCH_ASSOC);
                            
                            $query_s = $pdo -> prepare("SELECT name FROM school WHERE school_id = :id;");
                            $query_s -> execute(array(
                                ':id' => $coment['from']
                            ));
                            $scho = $query_s -> fetch(PDO::FETCH_ASSOC);
                        ?>
                        
                        <div class="comento">
                            <span>Alguien comento sobre <?= $teac['name'] . " en el " . $coment["fecha"] ?></span>
                            <div class="linea"></div>
                            <div class="es">
                            <span class="text">Dijo: <?= $coment["comment"] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="espacio">
                            <br>
                        </div>
                <?php }
            ?>
        </div>
     </div>
</body>

</html>