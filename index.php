<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/foro.css">
    <link rel="icon" href="icons/icon.jpg">
    <title>Home</title>
</head>
<body>
    <div class="padre">
        <div class="home">
            <div class="redes">
                <a href=""><i class='bx bxl-facebook-circle'></i></a>
                <a href=""><i class='bx bxl-instagram' ></i></a>
                <a href=""><i class='bx bxl-twitter' ></i></a>
            </div>
            <div class="title">
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
                <li class="principal_menu"><i class='bx bx-menu'></i>
                    <ul class="cositas">
                        <li><a href="login.php"><i class='bx bxs-user-account'></i></a><i class="p_menu1">Unete</i></li>
                        <li><a href="login_register.php"><i class='bx bx-user-plus'></i></a><i class="p_menu">Registrate</i></li>
                    </ul>
            </li>
            </ul>
        </nav>
        </div>
        <div class="linea"></div>
    </div>

    <?php
        /*  Menu lateral del foro */
            include("data/menu_lateral_sin_registro.php")
    ?>
    <div class="info">
        <di class="h2">
            <h2>Saber de tus profesores nunca habia sido tan fácil</h2>
        </di>
        <div class="p">
            <p>"La ventaja de utilizar herramientas como Profe Feedback es que te evita el
                tedioso(conocer por experiencia) Se hace mucho mas facil conocer las
                adversidades que trendras con tus profesores y instituciones ya que han sido puntuadas por otros 
                estudiantes"</p>
        </div>
        <div class="boton">
            <button for="search" id="search"><a href="login_register.php">✔ Evalua maestros</a></button>
        </div>
    </div>
    <div class="comentarios">
            <div class="recientes">
                <h3>Comentarios recientes</h3>
            </div>
            <div class="destacados">
                <h3>Comentarios destacados</h3>   
            </div>
        </form>
    </div>
    <div class="popular">
        <h3>Comentarios populares</h3>
    </div>
</body>
</html>