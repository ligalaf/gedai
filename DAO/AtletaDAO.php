<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_atleta.php');
require_once($raiz.'/models/model_usuario.php');
require_once($raiz.'/models/model_unidade.php');
require_once($raiz.'/models/model_validacao.php');

function CadastrarAtleta($atleta){

  $validacao = new validacao;


  


  echo $validacao->validarCampo("Nome",$atleta->getNome(), 150, 10);
  echo $validacao->validarCampo("RA",$atleta->getRa(),100,6);
  echo $validacao->validarCampo("RG",$atleta->getRG(),100,12);
  echo $validacao->validarCampo("Curso",$atleta->getCurso(),100,12);
  echo $validacao->validarEmail($atleta->getEmail());
  echo $validacao->validarCampo("Curso",$atleta->getCurso(),100,12);
  echo $validacao->validarCampo("Celular",$atleta->getCelular(),100,10);
  echo $validacao->validarNumero("Ano",$atleta->getAno());
  echo $validacao->validarCampo("Semestre",$atleta->getSemestre(),100,10);
  echo $validacao->validarCampo("Turno",$atleta->getTurno(),100,4);
  echo $validacao->validarNumero("Unidade",$atleta->getFk_Unidade());
  //echo $validacao->ValidaImagem($atleta->getDeclaracao());
  

   

  if($validacao->verifica()){
     
    $foto = $atleta->getDeclaracao();
    $foto2 = $atleta->getFoto();
    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp|pdf){1}$/i", $foto["name"], $ext);
    preg_match("/\.(jpeg|jpg|png|gif|bmp|pdf){1}$/i", $foto2["name"], $ext1);

    // Gera um nome único para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    $nome_imagem2 = md5(uniqid(time())) . "." . $ext1[1];


    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem = $raiz."/images/declaracao/" . $nome_imagem;
    $caminho_imagem2 = $raiz."/images/foto/" . $nome_imagem2;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto["tmp_name"], $caminho_imagem);
    move_uploaded_file($foto2["tmp_name"], $caminho_imagem2);


   
    $conexao = new Conexao();
 
    $sql = "INSERT INTO tb_atleta (Nome, RA, RG,Curso,Email, Celular,Ano,Semestre,Turno,Declaracao,FK_Unidade,Situacao,Foto) 
            VALUES ('{$atleta->getNome()}','{$atleta->getRa()}','{$atleta->getRG()}','{$atleta->getCurso()}','{$atleta->getEmail()}','{$atleta->getCelular()}',{$atleta->getAno()},'{$atleta->getSemestre()}','{$atleta->getTurno()}','{$nome_imagem}',{$atleta->getFk_Unidade()},'0','{$nome_imagem2}')";


        
    
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
    
  }
}
function AlterarAtleta($atleta){

  $validacao = new validacao;


  

  //echo $validacao->ValidaImagem($atleta->getDeclaracao());
  

   

  if($validacao->verifica()){
     

    $foto2 = $atleta->getFoto();
    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp|pdf){1}$/i", $foto2["name"], $ext1);

    // Gera um nome único para a imagem

    $nome_imagem2 = md5(uniqid(time())) . "." . $ext1[1];


    $raiz = $_SERVER['DOCUMENT_ROOT'];

    $caminho_imagem2 = $raiz."/images/foto/" . $nome_imagem2;

    move_uploaded_file($foto2["tmp_name"], $caminho_imagem2);


   
    $conexao = new Conexao();
 
    $sql = "UPDATE tb_atleta set Foto =  '{$nome_imagem2}'
            WHERE ID_Atleta = {$atleta->getId_Atleta()}; ";


        
    
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
function ListaAtletaEditar(){

  $conexao = new Conexao();

  session_start();
   $id = $_SESSION['usuarioid']; 
    
  $retorno = null;

  $cmdsql = "
select a.ID_Atleta,a.Nome,u.Nome as Unidade,a.Email,a.RA,
CASE
 WHEN a.situacao =0 THEN 'Pendente LAF'
 WHEN a.situacao =1 THEN 'Aprovado'
 WHEN a.situacao =2 THEN 'Rejeitado'
   END as situacao
 from
tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
where u.ID_Unidade = (select FK_Unidade from tb_usuario where ID_Usuario = $id)";

    
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
          <button class='btn btn-warning' title='Editar' value='".$cadastro['ID_Atleta']."' onclick='alterar(this)'>
            <i class='fas fa-edit'></i></td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}
 function ListaAtletaInter(){

  $conexao = new Conexao();
    
  $retorno = null;

  session_start();
   $id = $_SESSION['usuarioid']; 
  $retorno = null;

  $cmdsql = "
select a.ID_Atleta,a.Nome,u.Nome as Unidade,a.Email,a.RA
from tb_atleta a 
inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
left join tb_interfatec i on a.ID_Atleta = i.FK_Atleta
where i.FK_Atleta is null and u.ID_Unidade = (select FK_Unidade from tb_usuario where ID_Usuario =$id)
and a.situacao = 1
";


    
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
         <select class='form-control' id='pacote[".$cadastro['ID_Atleta']."]' name='pacote[".$cadastro['ID_Atleta']."]'>

                                      <option> Atleta </option>
                                      <option> Completo </option>

        </select>  

        </td>
        <td align = 'center'>
        <input type = 'checkbox' class='form-control' name ='check[".$cadastro['ID_Atleta']."] id = check[".$cadastro['ID_Atleta']."]'>                               
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

function CadastraAtletaInter($atleta,$pulseira,$numero){

    $conexao = new Conexao();

    $id = $atleta->getId_Atleta();

 $sql = "insert into tb_interfatec (FK_Atleta,pulseira,numero)
 values ($id,'$pulseira',$numero)";


mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());




}
function ExcluiAtletaInter($id){

    $conexao = new Conexao();




 $sql = "delete from tb_interfatec where FK_Atleta = $id";


mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());


echo 1;

}


function RetornaNumeroPulseira($pulseira){

  $conexao = new Conexao();

if($pulseira == 'Atleta'){
$sql = "
SELECT IFNULL(max(Numero),1449) as valor from tb_interfatec
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


function ListaAtletaConsolidado(){

  $conexao = new Conexao();
    
  $retorno = null;
  session_start();
   $id = $_SESSION['usuarioid']; 

  $cmdsql = "
select a.ID_Atleta,a.Nome,u.Nome as Unidade,a.Email,a.RA,
i.Pulseira as situacao
 from
tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
inner join tb_usuario us on us.FK_Unidade = A.FK_Unidade
inner join tb_interfatec i on a.ID_Atleta = i.FK_Atleta
where us.ID_Usuario = $id
";

    
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
          <button class='btn btn-danger' id = 'btnexcluir' name = 'btnexcluir' title='Editar' value='".$cadastro['ID_Atleta']."' onclick='apagar(this)'>
            <i class='fas fa-trash'></i>
            </td>
           
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function ListaAtletaInterConsolidado(){
  $conexao = new Conexao();
    
  $retorno = null;
  session_start();
   $id = $_SESSION['usuarioid']; 
  $retorno = null;
  $cmdsql = "
select a.Nome,u.Nome as Unidade,a.RG,i.Numero,i.Pulseira as Pacote
from tb_atleta a 
inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
inner join tb_interfatec i on a.ID_Atleta = i.FK_Atleta
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

?>