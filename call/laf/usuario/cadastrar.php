<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

$usuario = new Usuario();


$usuario->setNome($_POST['nome']);
$usuario->setSenha($_POST['senha']);
$usuario->setEmail($_POST['email']);
$usuario->setTipo($_POST['tipo']);
$usuario->setBloqueado($_POST['bloqueado']);
$usuario->setAvatar($_FILES['foto']);
$usuario->setFK_unidade($_POST['unidade']);


echo CadastraUsuario($usuario);

?>