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
            //aqui va un error
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
            
            header("Location: " . $_SERVER['REQUEST_URI'] . " ");
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
    <title>Comentar</title>
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
                <h2 >Evalua a tu profesor</h2>
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
        <div class="title_recientes">
        <h2>Comentarios recientes</h2>
        </div>
        <div class="recientes">
            <div class="comentarios">
                <?php
                    $query = $pdo -> prepare("SELECT * FROM comments WHERE `from` = :id");
                    $query -> execute(array(
                        ':id' => $_GET["escuela"]
                    ));

                    while ($comentario = $query -> fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="comentario">
                            <?php
                                //Datos necesarios para darle forma al comentarios.
                                $query_teacher = $pdo -> prepare("SELECT name FROM teachers WHERE id_teacher = :id");
                                $query_teacher -> execute(array(
                                    ':id' => $comentario["para"]
                                ));
                                $para = $query_teacher -> fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="espacio">
                            <div class="info">
                                <span class="comment">Alguien comentó sobre <?= $para["name"]; ?>.</span>
                                <span class="date"><?= $comentario["fecha"]; ?></span>
                                <div class="linea"></div>
                                <p>Dijo: <span><?= $comentario["comment"] ?></span></p>
                            </div>
                            <div class="espacios">
                                <br>
                            </div>
                        </div>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
        <div class="title_populares">
            <h2>Profesores populares</h2>
        </div>
        <div class="populares">
            <div class="profesores-list">
                <?php
                    $query = $pdo -> prepare("SELECT id_teacher FROM teachers WHERE school_id = :id ORDER BY RAND();");
                    $query -> execute(array(
                        ':id' => $_GET["escuela"]
                    ));
                    
                    $arr = [];
                    while ($c_prof = $query -> fetch(PDO::FETCH_ASSOC)) {
                        array_push($arr, $c_prof["id_teacher"]);
                    }

                    $arr_in = [];
                    for ($i = 0; $i < count($arr); $i++) {
                        $query = $pdo -> prepare("SELECT COUNT(*) para FROM comments WHERE para = :id;");
                        $query -> execute(array(
                            ':id' => $arr[$i]
                        ));

                        $p_comments = $query -> fetch(PDO::FETCH_ASSOC);
                        if ($p_comments["para"] >= 1) {
                            array_push($arr_in, $arr[$i] . "-" . $p_comments["para"]);
                        }
                    }

                    $arr_out = [];
                    for ($i = 0; $i < count($arr_in); $i++) {
                        $data = explode("-", $arr_in[$i]);
                        $query = $pdo -> prepare("SELECT name FROM teachers WHERE id_teacher = :id;");
                        $query -> execute(array(
                            ':id' => $data[0]
                        ));
                        $nombre = $query -> fetch(PDO::FETCH_ASSOC);

                        array_push($arr_out, $nombre["name"]);
                    }

                    if (!empty($arr_out) && count($arr_out) > 5) {
                        for ($i = 1; $i < 6; $i++) { ?>
                            <span class="profesor"><?=$i . ". " .  $arr_out[$i] ?></span>
                        <?php }
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>
</html> 