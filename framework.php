<?php
include 'librerias/cargador.php';

session_start();

if(isset($_GET['option'])){
    $componente = $_GET['option'];
} else {
    $componente = 'home';
}