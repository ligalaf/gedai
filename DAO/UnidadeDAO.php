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

function ListaUnidadeInter(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "
  select Pulseira, Delegacao, Quantidade from (
select count(Pulseira) as Quantidade,Pulseira,u.Nome as Delegacao from tb_interfatec i
inner join tb_atleta a on a.ID_Atleta =  i.FK_Atleta
inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
group by Pulseira ,Delegacao
UNION ALL
select count(Pulseira) as Quantidade,Pulseira,u.Nome as Delegacao from tb_interfatec i
inner join tb_agregado a on a.ID_Agregado =  i.FK_Agregado
inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
group by Pulseira,Delegacao) subselect
group by Pulseira, Delegacao";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '20%'>".$cadastro['Delegacao']."</td>
        <td align = 'center' width = '10%'>".$cadastro['Pulseira']."</td>
         <td align = 'center' width = '10%'>".$cadastro['Quantidade']."</td>

      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}







?>