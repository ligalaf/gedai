<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_agregado.php');
require_once($raiz.'/models/model_usuario.php');
require_once($raiz.'/models/model_unidade.php');
require_once($raiz.'/models/model_validacao.php');

function CadastrarAgregado($agregado){

  $validacao = new validacao;


  


  echo $validacao->validarCampo("Nome",$agregado->getNome(), 150, 10);
  echo $validacao->validarCampo("RG",$agregado->getRG(),100,12);
  echo $validacao->validarEmail($agregado->getEmail());
  echo $validacao->validarCampo("Celular",$agregado->getCelular(),100,10);
  echo $validacao->validarCampo("Tipo",$agregado->getTipo(),100,4);
  echo $validacao->validarNumero("Unidade",$agregado->getFk_Unidade());
  //echo $validacao->ValidaImagem($atleta->getDeclaracao());
  

   

  if($validacao->verifica()){
     
    $foto2 = $agregado->getFoto();
    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp|pdf){1}$/i", $foto2["name"], $ext1);

    // Gera um nome único para a imagem
    $nome_imagem2 = md5(uniqid(time())) . "." . $ext1[1];


    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem2 = $raiz."/images/foto/" . $nome_imagem2;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto2["tmp_name"], $caminho_imagem2);


   
    $conexao = new Conexao();
 
    $sql = "INSERT INTO tb_agregado (Nome,RG,Email,Celular,Tipo,FK_Unidade,Foto) 
            VALUES ('{$agregado->getNome()}','{$agregado->getRG()}','{$agregado->getEmail()}','{$agregado->getCelular()}','{$agregado->getTipo()}',{$agregado->getFk_Unidade()},'{$nome_imagem2}')";


        
    
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
    
  }
}
 function ListaPendente(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "
select a.ID_Atleta,a.Nome,u.Nome as Unidade,a.Email,a.RA from
tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
where a.situacao = 0";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '10%'>".$cadastro['ID_Atleta']."</td>
        <td align = 'center'>".$cadastro['Nome']."</td>
        <td align = 'center'>".$cadastro['Unidade']."</td>
        <td align = 'center'>".$cadastro['Email']."</td>
        <td align = 'center'>".$cadastro['RA']."</td>
            <td align = 'center'>
          <button class='btn btn-info' title='Editar' value='".$cadastro['ID_Atleta']."' onclick='visualizar(this)'>
            <i class='fas fa-edit'></i></td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

 function ListaAtleta(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "
select a.ID_Atleta,a.Nome,u.Nome as Unidade,a.Email,a.RA,
CASE
 WHEN a.situacao =0 THEN 'Pendente LAF'
 WHEN a.situacao =1 THEN 'Aprovado'
 WHEN a.situacao =2 THEN 'Rejeitado'
   END as situacao
 from
tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '10%'>".$cadastro['ID_Atleta']."</td>
        <td align = 'center'>".$cadastro['Nome']."</td>
        <td align = 'center'>".$cadastro['Unidade']."</td>
        <td align = 'center'>".$cadastro['Email']."</td>
        <td align = 'center'>".$cadastro['RA']."</td>
        <td align = 'center'>".$cadastro['situacao']."</td>
            <td align = 'center'>
          <button class='btn btn-info' title='Editar' value='".$cadastro['ID_Atleta']."' onclick='visualizar(this)'>
            <i class='fas fa-edit'></i></td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

 function ListaAgregadoInter(){

  $conexao = new Conexao();
    
  $retorno = null;

  session_start();
   $id = $_SESSION['usuarioid']; 
  $retorno = null;

  $cmdsql = "
select a.ID_Agregado,a.Nome,u.Nome as Unidade,a.Email
from tb_agregado a 
inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
left join tb_interfatec i on a.ID_Agregado = i.FK_Agregado
where i.FK_Agregado is null and u.ID_Unidade = (select FK_Unidade from tb_usuario where ID_Usuario =$id)
";


    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."

      <tr>
        <td align = 'center' width = '10%'>".$cadastro['ID_Agregado']."</td>
        <td align = 'center'>".$cadastro['Nome']."</td>
        <td align = 'center'>".$cadastro['Unidade']."</td>
        <td align = 'center'>".$cadastro['Email']."</td>
        <td align = 'center'>
         <select class='form-control' id='pacote[".$cadastro['ID_Agregado']."]' name='pacote[".$cadastro['ID_Agregado']."]'>

                                      <option> Agregado </option>
                                      <option> Completo </option>

        </select>  

        </td>
        <td align = 'center'>
        <input type = 'checkbox' class='form-control' name ='check[".$cadastro['ID_Agregado']."] id = check[".$cadastro['ID_Agregado']."]'>                               
        </td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function ListarUnicoAtletaPendente($id){

  $conexao = new Conexao();

 $cmdsql = "SELECT a.Nome,a.RG,a.RA,a.Curso,Email,a.Ano,a.Semestre,a.Turno,a.Declaracao,u.Nome as Unidade,a.Celular,a.Foto FROM tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
  WHERE a.ID_Atleta = $id";
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

  $array = mysqli_fetch_assoc($resultado);

  $conexao->FechaConexao($conexao->getConexao());

   $atleta = new Atleta();
   $unidade = new Unidade();

     $atleta->setNome($array['Nome']);
     $atleta->setRg($array['RG']);
     $atleta->setRa($array['RA']);
     $unidade->setNome($array['Unidade']);
     $atleta->setCurso($array['Curso']);
    $atleta->setEmail($array['Email']);
    $atleta->setAno($array['Ano']);
    $atleta->setSemestre($array['Semestre']);
    $atleta->setTurno($array['Turno']);
    $atleta->setCelular($array['Celular']);
    $atleta->setDeclaracao($array['Declaracao']);
    $atleta->setFoto($array['Foto']);
     return array($atleta,$unidade);
}

function ValidaAtleta($atleta,$usuario,$aprova) {

    $conexao = new Conexao();

 $sql = "call PR_AprovaRejeitaAtleta($atleta,$usuario,$aprova);";

mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;



}
function CadastraAgregadoInter($agregado,$pulseira,$numero){

    $conexao = new Conexao();

    $id = $agregado->getId_Agregado();

 $sql = "insert into tb_interfatec (FK_Agregado,pulseira,numero)
 values ($id,'$pulseira',$numero)";


mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());




}
function RetornaNumeroPulseira($pulseira){

  $conexao = new Conexao();

if($pulseira == 'Agregado'){
$sql = "
SELECT IFNULL(max(Numero),2099) as valor from tb_interfatec
where Pulseira = '$pulseira'";
}
if($pulseira == 'Completo'){
$sql = "
SELECT IFNULL(max(Numero),999) as valor from tb_interfatec
where Pulseira = '$pulseira'";
}

$exec = mysqli_query($conexao->getConexao(),$sql);
 $result = mysqli_fetch_assoc($exec);


 $valor = $result['valor'] +1;

    $conexao->FechaConexao($conexao->getConexao());

    return $valor;
}
function ListaAgregadoInterConsolidado(){

  $conexao = new Conexao();
    
  $retorno = null;

  session_start();
   $id = $_SESSION['usuarioid']; 
  $retorno = null;

  $cmdsql = "
select a.Nome,u.Nome as Unidade,a.RG,i.Numero,i.Pulseira as Pacote
from tb_agregado a 
inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
inner join tb_interfatec i on a.ID_Agregado = i.FK_Agregado
";


    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."

      <tr>
        <td align = 'center'>".$cadastro['Nome']."</td>
        <td align = 'center'>".$cadastro['Unidade']."</td>
        <td align = 'center'>".$cadastro['RG']."</td>
        <td align = 'center'>".$cadastro['Pacote']."</td>
         <td align = 'center'>".$cadastro['Numero']."</td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function ListaAgregadoConsolidado(){

  $conexao = new Conexao();
    
  $retorno = null;
  session_start();
   $id = $_SESSION['usuarioid']; 

  $cmdsql = "
select a.ID_Agregado,a.Nome,u.Nome as Unidade,a.Email,
i.Pulseira as situacao
 from
tb_agregado a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
inner join tb_usuario us on us.FK_Unidade = A.FK_Unidade
inner join tb_interfatec i on a.ID_Agregado = i.FK_Agregado
where us.ID_Usuario = $id
";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '10%'>".$cadastro['ID_Agregado']."</td>
        <td align = 'center'>".$cadastro['Nome']."</td>
        <td align = 'center'>".$cadastro['Unidade']."</td>
        <td align = 'center'>".$cadastro['Email']."</td>
        <td align = 'center'>".$cadastro['situacao']."</td>
            <td align = 'center'>
          <button class='btn btn-danger' id = 'btnexcluir' name = 'btnexcluir' title='Editar' value='".$cadastro['ID_Agregado']."' onclick='apagar(this)'>
            <i class='fas fa-trash'></i>
            </td>
           
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function ExcluiAgregadoInter($id){

    $conexao = new Conexao();




 $sql = "delete from tb_interfatec where FK_Agregado = $id";


mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());


echo 1;

}


?>