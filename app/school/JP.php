<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../../icons/icon.jpg">
    <link rel="stylesheet" href="../appcss/form_escuelas.css">
    <title>Politecnico Francisco Jose Peynado</title>
</head>
<body>
    <?php 
        include("../../data/header.php");
        include("../../data/menu_escuelas.php");    
    ?>
    <h1 class="bienvenida">Bienvenido [Name] al Politecnico Francisco Jose Peynado</h1>
    <div class="form_comen">
        <div class="form">
            <form action="">
            <h2>Evalua a tu profesor</h2>
            <select name="select" class="select">
                <option value="value1">Value 1</option>
                <option value="value2" selected>Value 2</option>
                <option value="value3">Value 3</option>
            </select>
            <textarea name="" id="" cols="30" rows="10" class="center"></textarea>
            <button type="submit" class="center">Comentar</button>
            </form>
        </div>
        <div class="recientes">
            <h2>Comentarios recientes</h2>
        </div>
        <div class="populares">
            <h2>Comentarios populares</h2>
        </div>
        <div class="antiguos">
            <h2>Comentarios antiguos</h2>
        </div>
    </div>
</body>
</html>