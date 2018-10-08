<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include ($raiz.'/DAO/PermissaoDAO.php');
include ($raiz.'/models/model_usuario.php');

$usuario = new usuario();
session_start();
$usuario->setId_usuario($_SESSION['usuarioid']);


echo RetornaMenu($usuario);

?>