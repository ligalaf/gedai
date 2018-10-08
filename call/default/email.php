<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include ($raiz.'/models/model_usuario.php');
include ($raiz.'/DAO/UsuarioDAO.php');
$usuario = new usuario();
session_start();
$usuario->setEmail($_POST['email']);


EnviaLoginSenha($usuario);

?>