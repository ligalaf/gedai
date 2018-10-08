<?php
class Unidade {
        private $id_unidade;
        private $nome;


        public function getId_unidade(){
            return $this->id_unidade;
        }
        public function getNome(){
            return $this->nome;
        }
        
    
    
        public function setId_usuario($value){
            $this->id_unidade = $value;
            return $this;
        }
        public function setNome($value){
            $this->nome = $value;
            return $this;
        }

        
    }



?>