<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_usuario.php');
require_once($raiz.'/models/model_unidade.php');
require_once($raiz.'/models/model_validacao.php');
//require_once($raiz.'/models/PHPMailer/class.phpmailer.php');

function LogarUsuario($usuario){
 
  $validate = new validacao;

  echo $validate->ValidarLoginUsuario($usuario->getEmail(),$usuario->getSenha());
  
  if($validate->verifica()){

    $conexao = new Conexao();

    $cmdsql = "SELECT   ID_Usuario,Nome,Tipo,Avatar
        FROM tb_usuario
        WHERE Email = '{$usuario->getEmail()}' AND Senha = '{$usuario->getSenha()}'";
    
    $exec = mysqli_query($conexao->getConexao(),$cmdsql);
  
    $resultado = mysqli_fetch_assoc($exec);

    $usuariologado = new Usuario;

    $usuariologado->setId_Usuario($resultado['ID_Usuario']);
    $usuariologado->setNome($resultado['Nome']);
    $usuariologado->setTipo($resultado['Tipo']);
    $usuariologado->setAvatar($resultado['Avatar']);


    session_start();

    $_SESSION['usuarioid'] = $usuariologado->getId_Usuario();
    $_SESSION['usuarionome'] = $usuariologado->getNome();
    $_SESSION['tipo'] = $usuariologado->getTipo();
    $_SESSION['avatar'] = $usuariologado->getAvatar();

    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
  }
}
  function ListaUsuario(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "SELECT u.ID_Usuario, u.Nome,d.Nome as Unidade,u.Email,u.Tipo FROM tb_usuario u
  inner join TB_unidade d on u.FK_unidade = d.ID_Unidade";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($usuario = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center'>".$usuario['ID_Usuario']."</td>
        <td align = 'center'>".$usuario['Nome']."</td>
        <td align = 'center'>".$usuario['Unidade']."</td>
        <td align = 'center'>".$usuario['Email']."</td>
        <td align = 'center'>".$usuario['Tipo']."</td>
        <td align = 'center'>
          <button class='btn btn-warning' title='Editar' value='".$usuario['ID_Usuario']."' onclick='preencheridAlterar(this)'>
            <i class='fas fa-pencil-alt icon-sm'></i>
          </button>
           <td align = 'center'>
           <button class='btn btn-primary' title='Permissao' value='".$usuario['ID_Usuario']."' onclick='permissao(this)'>
            <i class='fas fa-pencil-alt icon-sm'></i>
          </button>
          </td>
        </td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function CadastraUsuario($usuario){

  $validacao = new validacao;

        
  echo $validacao->validarCampo("Nome",$usuario->getNome(),100,4);
    echo $validacao->validarCampo("Tipo",$usuario->getTipo(),100,3);
  echo $validacao->ValidarEmailExistenteUsuario($usuario->getEmail());
  echo $validacao->validarCampo("Senha",$usuario->getSenha(),25,8);
  echo $validacao->ValidaImagem($usuario->getAvatar());
  echo $validacao->validarNumero("Bloqueado",$usuario->getBloqueado());
  echo $validacao->validarNumero("Unidade",$usuario->getFk_unidade());

  if($validacao->verifica()){
   
    // instanciando conexão
    $conexao = new Conexao();

    $foto = $usuario->getAvatar();

    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp){1}$/i", $foto["name"], $ext);

    // Gera um nome único para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto["tmp_name"], $caminho_imagem);
 


  $cmdsql = "call PR_CadastraUsuario ('{$usuario->getNome()}','{$usuario->getSenha()}','{$usuario->getEmail()}',{$usuario->getBloqueado()},'{$nome_imagem}','{$usuario->getTipo()}',{$usuario->getFk_unidade()})";           

           

             
    
    mysqli_query($conexao->getConexao(),$cmdsql);


    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
  } 
}

function ListaUnicoUsuario($idUsuario){

  $conexao = new Conexao();

  $cmdsql = "SELECT * FROM tb_usuario WHERE ID_Usuario = $idUsuario";
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

  $array = mysqli_fetch_assoc($resultado);

  $conexao->FechaConexao($conexao->getConexao());

  $usuario = new Usuario();

  $usuario->setNome($array['Nome']);
  $usuario->setEmail($array['Email']);
  $usuario->setTipo($array['Tipo']);
  $usuario->setSenha($array['Senha']);
  $usuario->setAvatar($array['Avatar']);
  $usuario->setBloqueado($array['Bloqueado']);
  $usuario->setFk_Unidade($array['FK_Unidade']);

  return $usuario;

}
function AlteraUsuario($usuario){



  $validacao = new validacao;

 echo $validacao->validarCampo("Nome",$usuario->getNome(),100,4);
    echo $validacao->validarCampo("Tipo",$usuario->getTipo(),100,3);
  echo $validacao->ValidarEmailExistenteUsuarioEditar($usuario->getEmail(),$usuario->getId_usuario());
  echo $validacao->validarCampo("Senha",$usuario->getSenha(),25,8);
  echo $validacao->validarNumero("Bloqueado",$usuario->getBloqueado());
  echo $validacao->validarNumero("Unidade",$usuario->getFk_unidade());


  if($usuario->getAvatar() == ''){
    $foto = '';
  } else{
     echo $validacao->ValidaImagem($usuario->getAvatar());
      $foto = $usuario->getAvatar();

  }
  echo $validacao->validarNumero("Bloqueado",$usuario->getBloqueado());

  if($validacao->verifica()){
   
    // instanciando conexão
    $conexao = new Conexao();

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    if($foto == ''){
      $whereFoto = '';
    }else{

      // Pega extensão da imagem
      preg_match("/\.(jpeg|jpg|png|gif|bmp){1}$/i", $foto["name"], $ext);

      // Gera um nome único para a imagem
      $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

      // Caminho de onde ficará a imagem
      $caminho_imagem = $raiz."/images/avatar/" . $nome_imagem;

      // Faz o upload da imagem para seu respectivo caminho
      move_uploaded_file($foto["tmp_name"], $caminho_imagem);

      $whereFoto = ", Avatar = '{$nome_imagem}'";

      $sql_imagem = "SELECT Avatar from tb_usuario where ID_Usuario = {$usuario->getId_usuario()}";
      $resultado = mysqli_query($conexao->getConexao(),$sql_imagem);
      $array = mysqli_fetch_assoc($resultado);

      $imagem = $array['Avatar'];

      if (file_exists($raiz."/images/avatar/".$imagem)) {
        unlink($raiz."/images/avatar/".$imagem);
      }
    }


    // Se for validado faz o insert
    $cmdsql = "UPDATE tb_usuario SET Nome = '{$usuario->getNome()}', Senha = '{$usuario->getSenha()}', Email = '{$usuario->getEmail()}', Bloqueado = {$usuario->getBloqueado()}, Tipo = '{$usuario->getTipo()}',FK_Unidade = '{$usuario->getFk_unidade()}' $whereFoto WHERE ID_Usuario = {$usuario->getId_usuario()} ";
    
    mysqli_query($conexao->getConexao(),$cmdsql);
    
    $conexao->FechaConexao($conexao->getConexao());

   echo 1;
    
  }
}




?>