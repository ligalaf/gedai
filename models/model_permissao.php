<?php
class Permissao {
        private $id_permissao;
        private $nome;

        public function getId_permissao(){
            return $this->id_permissao;
        }
        public function getNome(){
            return $this->nome;
        }
        
    
    
        public function setId_permissao($value){
            $this->id_permissao = $value;
            return $this;
        }
        public function setNome($value){
            $this->nome = $value;
            return $this;
        }
       
    }



?>