<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_unidade.php');
require_once($raiz.'/models/model_validacao.php');
//require_once($raiz.'/models/PHPMailer/class.phpmailer.php');


  function ListaUnidade(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "SELECT ID_Unidade as cod,Nome as Nome from tb_unidade";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($unidade = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."

        <option value = ".$unidade['cod'].">".$unidade['Nome']."</option>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}







?>