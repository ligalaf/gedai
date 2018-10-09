<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AtletaDAO.php');

$atleta = new Atleta();
$usuario = new Usuario();
session_start();
$user = $_SESSION['usuarioid'];

$atleta->setId_Atleta($_POST['idAlterar']);
$usuario->setId_usuario($user); 

echo ValidaAtleta($atleta->getId_Atleta(),$usuario->getId_usuario(),2);

?>