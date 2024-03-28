<?php
    session_start();
    include("../resource/controller.php");
    include("../resource/pdo.php");
    noset();

    $query = $pdo -> query("SELECT * FROM school;");
    $query_t = $pdo -> query("SELECT * FROM teachers;");
    if ($query -> rowCount() < 1) {
        $escuelas = [
            "Politecnico Francisco Jose Peynado", "Politecnico Loyola", "Colegio San Rafael", "Politécnico Altagracias Lucas de Garcia", "Liceo Diogenes Valdez"
        ];

        for ($i = 0; $i < count($escuelas); $i++) {
            $insert = $pdo -> prepare("INSERT INTO school (name) VALUES (:nm)");
            $insert -> execute(array(
                ':nm' => $escuelas[$i]
            ));
        }
    } elseif ($query_t -> rowCount() < 1) {
        $profesores = [
            [
                "Julio Luna",
                "Juan Isidro Márquez",
                "Rafael De La Cruz",
                "Wilianyi",
                "Mairobi Soriano",
                "Claribel De La Rosa",
                "Agustina Lorenzo",
                "David Familia",
                "Carlos Martínez",
                "Domingo Aquino",
                "Jose Lucia",
                "Pablo Rosa",
                "Luis Lara",
                "Elsa Rivera",
                "Evaristo Doñe",
                "Feliciti",
                "Felicia Aquino",
                "Pascual Garcés",
                "Gustina Brito",
                "Ruberky Alcántara",
                "Clara Brito",
                "Yeranny Brito"
            ], 
            [
                "Enrique Guevara",
                "Karina Encarnación",
                "Karina Glayrisa Sanchez",
                "Santalisa Nina",
                "Geografía e Historia Universal",
                "Yahaira Feliz",
                "Mabel Maria de La Cruz",
                "Gloria Matilde Casilla",
                "Roberto lorenzo",
                "Fiola Sarante",
                "Victor José mateo"

            ],
            [
                "Domingo Garcia Brito",
                "Nereyda Pinales",
                "Modesto Tejeda",
                "Pedro Martines",
                "Sarah Lorenzo"
            ],
            [
                "Néstor",
                "Armando",
                "Arisenia",
                "Jose Fina",
                "Veras",
                "Andria"
            ],
            [
                "María del Carmen",
                "María fría",
                "Ruth contanso",
                "Elizabeth",
                "Valentín",
                "Quisquella"
            ]
        ];
        /*echo ("<pre>");
        var_dump($profesores);*/

        $query = $pdo -> prepare("INSERT INTO teachers (name, school_id) VALUES (:nm, :id);");
        for ($i = 0; $i < count($profesores); $i++) {
            for ($j = 0; $j < count($profesores[$i]); $j++) {
                //echo "Grupo " . $i . ": ". $profesores[$i][$j] . "<br>";
                $query -> execute(array(
                    ':nm' => $profesores[$i][$j],
                    ':id' => $i + 1
                ));
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