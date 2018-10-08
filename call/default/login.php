<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include ($raiz.'/DAO/UsuarioDAO.php');

$usuario = new usuario();
$usuario->SetEmail($_POST['user']);
$usuario->SetSenha($_POST['senha']);

echo LogarUsuario($usuario);

?>