<?php 
    function noset() {
        if (!isset($_SESSION["USER_VAL"])){
            header('Location: https://profefeedback.com/');
            return;
        }
    }

    function set() {
        if(isset($_SESSION["USER_VAL"])){
            header('Location: https://profefeedback.com/app/foro.php');
            return;
        }
    }
?>