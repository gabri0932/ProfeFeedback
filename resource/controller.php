<?php 
    function validacion() {
        if (!isset($_SESSION["USER_VAL"])){
            header('Location: https://profefeedback.com/');
            return;
        }else if(isset($_SESSION["USER_VAL"])){
            header('Location: https://profefeedback.com/app/foro.php');
        }
    }
?>