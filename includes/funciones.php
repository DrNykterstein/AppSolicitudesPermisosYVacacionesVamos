<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Funcion que revisa si el usuario esta autenticado o no
function isAuth(): void{
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

function isAdmin():void{
    if(!isset($_SESSION['codigo_perfil'])){
        header('Location: /');
    }
}