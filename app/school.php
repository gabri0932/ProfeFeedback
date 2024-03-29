<?php
    session_start();
    include("../resource/controller.php");
    noset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../icons/icon.jpg">
    <link rel="stylesheet" href="appcss/school.css">
    <link rel="stylesheet" href="../responsive/responsive.css">
    <title>Foro</title>
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
    <div class="recientes">
    </div>
    <div class="destacados">        
    </div>
    <div class="populares"></div>
    </div>
</body>
</html>