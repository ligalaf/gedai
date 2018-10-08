<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

$usuario = new Usuario();
$aux_usuario = new Usuario();

$usuario->setId_usuario($_POST['idAlterar']);

$aux_usuario = ListaUnicoUsuario($usuario->getId_usuario());

$foto = $aux_usuario->getAvatar();



$array = array("nome" => $aux_usuario->getNome(),
			   "email" => $aux_usuario->getEmail(),
			   "tipo" => $aux_usuario->getTipo(),
			   "senha" => $aux_usuario->getSenha(),
			   "foto" => $foto,
			   "bloqueado" => $aux_usuario->getBloqueado(),
			   "unidade" => $aux_usuario->getFk_unidade()
);

echo json_encode($array);

?>