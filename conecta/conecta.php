<?php 
$servidor = 'localhost';
$usuario  = 'root';
$senha    = '';
$banco    = 'login';

$conn = mysqli_connect($servidor,$usuario,$senha,$banco);

if(!$conn){
    echo 'erro ao conectar';
    die();
}