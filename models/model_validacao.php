<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];
require_once($raiz.'/DAO/conexao.php');

date_default_timezone_set('America/Sao_Paulo');
header('Content-type: text/html; charset=utf-8');

class validacao {

	public $campo;
	public $valor;
	public $msg = array();
	
	// Mensagens de erro
	public function mensagens($num, $campo, $max, $min) {
		
		$this->msg[0] = "
		<script>
			Messenger().post({
  				message: 'Campo ".$campo." Inválido',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[1] = "
		<script>
			Messenger().post({
  				message: 'Campo ".$campo." Máximo de Caracteres: ".$max."',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[2] = "
		<script>
			Messenger().post({
  				message: 'Campo ".$campo." Mínimo de Caracteres: ".$min."',
 				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>"; 

		$this->msg[3] = "
		<script>
			Messenger().post({
  				message: 'Campo ".$campo." Já cadastrado.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[4] = "
		<script>Messenger().post({
		  	message: 'Login/Senha Incorreta',
		  	type: 'error',
		  	showCloseButton:'yes',
		  	closeButtonText:'x',
		  	HideAfter:2
		}) 
		</script>";

		$this->msg[5] = "
		<script>
			Messenger().post({
  				message: 'Extensões Permitidas: JPEG, JPG, PNG, GIF ou BMP',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[6] = "
		<script>
			Messenger().post({
  				message: 'O tamanho Máximo da Imagem é 2Mb.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[7] = "
		<script>
			Messenger().post({
  				message: 'Login Já cadastrado.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[8] = "
		<script>
			Messenger().post({
  				message: 'Arquivo Inválido.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[9] = "
		<script>
			Messenger().post({
  				message: 'Preencha o Campo ".$campo." Com Números.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		$this->msg[10] = "
		<script>
			Messenger().post({
  				message: 'Erro ao Gravar, Contate um Administrador.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";
		$this->msg[11] = "
		<script>
			Messenger().post({
  				message: 'Você não pode Excluir esse Registro,".$campo." Registros dependem dele.',
  				type: 'error',
  				showCloseButton:'yes',
  				closeButtonText:'x',
  				HideAfter:2
			}) 
		</script>";

		return $this->msg[$num];
	}
	
	// Validar Email
	public function validarEmail($email) {

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return $this->str_to_utf8($this->mensagens(0, 'email', null, null));
		}
	}
	
    // Validar CEP (xxxxx-xxx)
	public function validarCep($cep) {
		if (!eregi("^[0-9]{5}-[0-9]{3}$", $cep)) { 
			return $this->str_to_utf8($this->mensagens(0, 'cep', null, null));
		}
	}
	
	// Validar Datas (DD/MM/AAAA)
	public function validarData($data) {
		if (!eregi("^[0-9]{2}/[0-9]{2}/[0-9]{4}$", $data)) { 
			return $this->str_to_utf8($this->mensagens(0, 'data', null, null));
		}
	}
	
	// Validar Telefone (01432363810)
	public function validarTelefone($telefone) {
		if (!eregi("^[0-9]{11}$", $telefone)) { 
			return $this->str_to_utf8($this->mensagens(0, 'telefone', null, null));
		}
	}

	public function limpaCPF_CNPJ($cpf){
		$cpf = trim($cpf);
		$cpf = str_replace('.','',$cpf);
		$cpf = str_replace(',','',$cpf);
		$cpf = str_replace('-','',$cpf);
		$cpf = str_replace('/','',$cpf);
		return $cpf;
	}
	
	// Validar CPF (111111111111)
	public function validarCpf($cpf) {
		
 		if(!is_numeric($cpf)) {
  			$status = false;
		} else {
   			# Pega o digito verificador
  			$dv_informado = substr($cpf, 9,2);

   			for($i=0; $i<=8; $i++) {
   				$digito[$i] = substr($cpf, $i,1);
   			}
   			# Calcula o valor do 10� digito de verifica��o
   			$posicao = 10;
   			$soma = 0;

  			for($i=0; $i<=8; $i++) {
    			$soma = $soma + $digito[$i] * $posicao;
    			$posicao = $posicao - 1;
   			}

   			$digito[9] = $soma % 11;

   				if($digito[9] < 2) {
    				$digito[9] = 0;
   				} else {
    				$digito[9] = 11 - $digito[9];
   				} 
   				
   			# Calcula o valor do 11� digito de verifica��o
   			$posicao = 11;
   			$soma = 0;

   			for ($i=0; $i<=9; $i++) {
    			$soma = $soma + $digito[$i] * $posicao;
    			$posicao = $posicao - 1;
   			}

   			$digito[10] = $soma % 11;

   				if ($digito[10] < 2) {
    				$digito[10] = 0;
   				} else {
    				$digito[10] = 11 - $digito[10];
   				}
   				
  			# Verifica de o dv � igual ao informado
 			$dv = $digito[9] * 10 + $digito[10];
  			
			 	if ($dv != $dv_informado) {
   					$status = false;
  				} else
   					$status = true;
  				}
  
  		  # Se houver erro
 				if (!$status) {
					return $this->str_to_utf8($this->mensagens(0, 'CPF', null, null));
				}

	}

	public function validar_cnpj($cnpj){
	
		$cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
		// Valida tamanho
		if (strlen($cnpj) != 14)
		return $this->str_to_utf8($this->mensagens(0, 'CNPJ', null, null));
		
		// Valida primeiro d�gito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++){
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;
		if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
		return $this->str_to_utf8($this->mensagens(0, 'CNPJ', null, null));
		
		// Valida segundo d�gito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++){
			$soma += $cnpj{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}

		$resto = $soma % 11;
		return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
	}
	
	// Validar IP (200.200.200.200)
	public function validarIp($ip) {
		if (!eregi("^([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}.([0-9]){1,3}$", $ip)) {
			return $this->str_to_utf8($this->mensagens(0, 'ip', null, null));
		}
	}
	
	
	// Validar Numero
	public function validarNumero($campo,$numero) {
		if(!is_numeric($numero)) {
			return $this->str_to_utf8($this->mensagens(9, $campo, null, null));
		}
	}
	
	// Validar URL
	public function validarUrl($url) {
		if (!preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) {
			return $this->str_to_utf8($this->mensagens(0, $campo, null, null));
		}
	}

	// Verifica��o simples (Campo vazio, maximo/minimo de caracteres)
	public function validarCampo($campo, $valor, $max, $min) {
		$this->campo = $campo;
			if ($valor == "") {
				return $this->str_to_utf8($this->mensagens(0, $campo, $max, $min));
			} 
			elseif (strlen($valor) > $max) {
				return $this->str_to_utf8($this->mensagens(1, $campo, $max, $min));
			} 
			elseif (strlen($valor) < $min) {
				return $this->str_to_utf8($this->mensagens(2, $campo, $max, $min));	
			}
	}

   	public function ValidarCPFExistente($cpf){
   	
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_usuario WHERE Cpf ='{$cpf}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'CPF',null,null));
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function ValidarCNPJExistente($cnpj){
   	
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_cadastro WHERE cnpj ='{$cnpj}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'CNPJ',null,null));
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}


	public function CPFexistenteEdiferente($cpf,$usuario){
   	
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_usuario WHERE Cpf ='{$cpf}' AND ID_Usuario <> '{$usuario}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'Cpf',null,null));
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function CNPJexistenteEdiferente($cnpj,$fornecedor){
   	
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_fornecedor WHERE CNPJ ='{$cnpj}' AND ID_Fornecedor <> '{$fornecedor}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'CNPJ',null,null));
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}

 	public function ValidarEmailExistente($email){
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_cadastro WHERE Email ='{$email}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'Email',null,null));
		}
   		
   		$conexao->FechaConexao($conexao->getConexao());
	}
	public function ValidarEmailExistenteEditar($email){
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_cadastro WHERE Email ='{$email}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'Email',null,null));
		}
   		
   		$conexao->FechaConexao($conexao->getConexao());
	}
	public function ValidarEmailExistenteUsuario($email){
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_usuario WHERE Email ='{$email}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'Email',null,null));
		}
   		
   		$conexao->FechaConexao($conexao->getConexao());
	}
	public function ValidarEmailExistenteUsuarioEditar($email,$id){
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_usuario WHERE Email ='{$email}' and ID_Usuario <> {$id}";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'Email',null,null));
		}
   		
   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function EmailexistenteEdiferente($email,$usuario){
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_usuario WHERE Email ='{$email}' AND ID_Usuario <> '{$usuario}'";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >0){
   			return $this->str_to_utf8($this->mensagens(3,'Email',null,null));
		}
   		
   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function ValidarLoginExistente($login){
		$conexao = new Conexao();

		$sql = "SELECT * FROM tb_usuario WHERE Login ='{$login}'";

		$result = mysqli_query($conexao->getConexao(),$sql);

		$num = mysqli_num_rows($result);

		if($num >0){
			return $this->str_to_utf8($this->mensagens(7,'Login',null,null));
		}

		$conexao->FechaConexao($conexao->getConexao());
	}

	public function ValidarLoginUsuario($email,$senha){
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_usuario WHERE Email = '{$email}' AND Senha = '{$senha}'";
 
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont == 0){
   			return $this->str_to_utf8($this->mensagens(4,'Login/senha',null,null));
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function VerificaDependencias($id,$table,$column){
		$this->id = $id;
		$this->table = $table;
		$this->column = $column;

   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM $table WHERE $column = $id";
 
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont >= 1){
   			return $this->str_to_utf8($this->mensagens(11,$cont,null,null));
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function ExisteSessao(){
		
		if(!isset($_SESSION['usuarioid'])){
			$_SESSION['usuarioid'] = 0;
 		}
	}

	public function ValidaSessao($sessao){
 		
 		if($sessao == 0){
 			session_destroy();
 			echo "<script>window.location.href = 'views/default/login.php'</script>;";
 		}
		return;
	}
		public function ValidarPermissao($usuario,$permissao){
   	
   		$conexao = new Conexao();
    
  		$cmdsql = "SELECT * FROM tb_permissao_usuario WHERE FK_Usuario ={$usuario} AND
  		FK_Permissao = {$permissao}";
    
  		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
    
   		$cont = mysqli_num_rows($resultado);

   		if($cont == 0){
   			echo "<script>window.location.href = 'views/default/denied.php'</script>;";
   		}

   		$conexao->FechaConexao($conexao->getConexao());
	}

	public function ValidaImagem($imagem){

		// Tamanho m�ximo do arquivo em bytes
		$tamanho = 2000000;

    	// Verifica se o arquivo � uma imagem
    	if(!preg_match("/^image\/(jpeg|jpg|png|gif|bmp|pdf)$/",$imagem['type'])){
     	   	return $this->str_to_utf8($this->mensagens(6,'Img',null,null));
   	 	} 
		
		// Verifica se o tamanho da imagem � maior que o tamanho permitido
		if($imagem["size"] > $tamanho) {
   		 	return $this->str_to_utf8($this->mensagens(8,'tamanho',null,null));
		}
	
	}

	public function ValidaFile($arq){

		$type_valido = array ('doc','docx','xls','xlxs','pdf','ppt','pptx','rar','zip','mp3','mp4','txt','mov','avi','mpg','bmp','gif','jpeg','jpg','png');
		
		$type_arq = explode (".",$arq['name']);

		if (in_array(end($type_arq), $type_valido)) {
			return true;
		} else {
			return $this->str_to_utf8($this->mensagens(6,'Arquivo',null,null));
		}
	}

	//Verifica se a string já esta com Charset UTF-8 caso não estiver Coloca.
	public function str_to_utf8($str) {
    	$decoded = $str;
    	if (mb_detect_encoding($decoded , 'UTF-8', true) === false)
        	return utf8_encode($str);
    	return $decoded;
	}

	public function geraSKU($grupo,$marca,$fornecedor,$produto){
		$this->grupo = $grupo;
		$this->marca = $marca;
		$this->fornecedor = $fornecedor;
		$this->produto = $produto;

		$grupo = strtoupper((substr(trim($grupo), 0, 2)));
		$marca = strtoupper((substr(trim($marca), 0, 2)));
		$fornecedor = strtoupper((substr(trim($fornecedor), 0, 3)));
		$produto = strtoupper((substr(trim($produto), 0, 4)));

		$sku_verifica = $fornecedor."-".$marca."-".$grupo."-".$produto;

		$conexao = new Conexao();

		$cmdsql = "SELECT COUNT(*) AS Qtde FROM tb_produto WHERE Sku LIKE '{$sku_verifica}%'";
		$resultado = mysqli_query($conexao->getConexao(), $cmdsql);
		$array = mysqli_fetch_assoc($resultado);

		$conexao->FechaConexao($conexao->getConexao());
			   
		if($array['Qtde'] >= 1){
			$sku = $sku_verifica."-MDL".($array['Qtde']+1);
		}else{
			$sku = $sku_verifica;
		}

		return $sku;

	}

	//Pega somente números de uma String
	public function soNumero($str) {
		return preg_replace("/[^0-9]/", "", $str);
	}

	//Se campo for 0, não há erros, se for Diferente retorna mensagem de erro.
	public function VerificaErro($campo){
		$this->campo = $campo;
		if($campo != 0){
			return $this->str_to_utf8($this->mensagens(10,'Erro',null,null));
		}
	}

	public function limpaCampoMoney($campo){
		$this->campo = $campo;
		$source = array('.',',','R$');
		$replace = array('','.','');
		$valor = str_replace($source,$replace,$campo);
		return $valor;
	}

	//Verifica Tempo Corrido Formado m/d/Y H:i:s
	public function tempo_corrido($time) {

		$now = strtotime(date('m/d/Y H:i:s'));
 		$time = strtotime($time);
 		$diff = $now - $time;

		$seconds = $diff;
 		$minutes = round($diff / 60);
		$hours = round($diff / 3600);
		$days = round($diff / 86400);
		$weeks = round($diff / 604800);
		$months = round($diff / 2419200);
		$years = round($diff / 29030400);

		if ($seconds <= 60) return $this->str_to_utf8("1 Min Atrás");
		else if ($minutes <= 60) return $minutes==1 ? $this->str_to_utf8('1 Min Atrás') : $this->str_to_utf8($minutes.' Min Atrás');
		else if ($hours <= 24) return $hours==1 ? $this->str_to_utf8('1 Hr Atrás') : $this->str_to_utf8($hours.' Hrs Atrás');
		else if ($days <= 7) return $days==1 ? $this->str_to_utf8('1 Dia Atras') : $this->str_to_utf8($days.' Dias Atrás');
		else if ($weeks <= 4) return $weeks==1 ? $this->str_to_utf8('1 Semana Atrás') : $this->str_to_utf8($weeks.' Semanas Atrás');
		else if ($months <= 12) return $months == 1 ? $this->str_to_utf8('1 Mín Atrás') : $this->str_to_utf8($months.' Meses Atrás');
		else return $years == 1 ? $this->str_to_utf8('1 Ano Atrás') : $this->str_to_utf8($years.' Anos Atrás');
 	}
	
	// Verifica se há erros
	public function verifica() {
		if (sizeof($this->msg) == 0) {
			return true;
		} else {
			return false;
		}
	}
}

?>