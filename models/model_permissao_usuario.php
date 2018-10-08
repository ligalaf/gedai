<?php
class PermissaoUsuario {
        private $id_permissao_usuario;
        private $fk_permissao;
         private $fk_usuario;

        public function getId_permissao_usuario(){
            return $this->id_permissao_usuario;
        }
        public function getFk_permissao(){
            return $this->fk_permissao;
        }
         public function getFk_usuario(){
            return $this->fk_usuario;
        }
        
    
    
        public function setId_permissao_usuario($value){
            $this->id_permissao_usuario = $value;
            return $this;
        }
        public function setFk_permissao($value){
            $this->fk_permissao = $value;
            return $this;
        }
         public function setFk_usuario($value){
            $this->fk_usuario = $value;
            return $this;
        }
       
    }



?>