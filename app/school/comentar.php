<?php
    session_start();
    include("../../resource/controller.php");
    include("../../resource/pdo.php");
    noset();

    if (isset($_GET["escuela"]) && !empty($_GET["escuela"])) {
        $query_p = $pdo -> prepare("SELECT * FROM teachers WHERE school_id = :id");
        $query_p -> execute(array(
            ':id' => htmlentities($_GET["escuela"])
        ));
    } else {
        header("Location: https://profefeedback.com/app/foro.php");
        exit;
    }

    if (isset($_POST["teacher"]) && isset($_POST["comment"])) {
        if (empty($_POST["teacher"]) || empty($_POST["comment"])) {
            header("Location: comentar.php");
            exit;
        } elseif (strlen($_POST["comment"]) > 512) {
            //Aqui va un error mmpene.
        } else {
            date_default_timezone_set("America/Santo_Domingo");
            $date = getdate();
            $query_c = $pdo -> prepare("INSERT INTO comments (comment, por, para, `from`, fecha) VALUES (:cm, :pr, :pra, :fr, :fch);");
            $query_c -> execute(array(
                ':cm' => htmlentities($_POST["comment"]),
                ':pr' => $_SESSION["USER_VAL"]["user_id"],
                ':pra' => htmlentities($_POST["teacher"]),
                ':fr' => $_GET["escuela"],
                ':fch' => $date["year"] . "-" . $date["mon"] . "-" . $date["mday"] . " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]
            ));
            
            header("Location: ../foro.php");
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
    <link rel="icon" href="../../icons/icon.jpg">
    <link rel="stylesheet" href="../../responsive/responsive.css">
    <link rel="stylesheet" href="../appcss/form_escuelas.css">
    <title>Bautista</title>
</head>
<body>
    <?php 
        require_once("../../responsive/no_responsive.php")
    ?>
    <div class="container">
    <?php 
        include("../../data/header_comentarios.php");
        include("../../data/menu_escuelas.php");     
    ?>
    <h1 class="bienvenida">Bienvenido <?= $_SESSION["USER_VAL"]["name_parts"][0]; ?> a Profe Feedback</h1>
    <div class="form_comen">
        <div class="form">
            <form action="" method="POST">
                <h2>Evalua a tu profesor</h2>
                <select name="teacher" class="select">
                    <?php
                        while ($profesor = $query_p -> fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?= $profesor["id_teacher"]; ?>"><?= $profesor["name"]; ?></option>
                        <?php }
                    ?>
                </select>
                <textarea name="comment" id="" cols="30" rows="10" class="center"></textarea>
                <button type="submit" class="center">Comentar</button>
            </form>
        </div>
        <div class="recientes">
            <h2>Comentarios recientes</h2>
            <div class="comentarios">
                <?php
                    $query = "SELECT * FROM comments WHERE"
                ?>
            </div>
        </div>
        <div class="populares">
            <h2>Comentarios populares</h2>
        </div>
        <div class="antiguos">
            <h2>Comentarios antiguos</h2>
        </div>
    </div>
    </div>
</body>
</html>