<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}else{
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
}
?>