<?php
class Agregado {
        private $id_agregado;
        private $fk_unidade;
        private $nome;
        private $rg;
        private $email;
        private $celular;
        private $tipo;
         private $foto;


        public function getId_Agregado(){
            return $this->id_agregado;
        }
        public function getFk_unidade(){
            return $this->fk_unidade;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getRG(){
            return $this->rg;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getCelular(){
            return $this->celular;
        }

          public function getTipo(){
            return $this->tipo;
        }
         public function getFoto(){
            return $this->foto;
        }
    
    
        public function setId_Agregado($value){
            $this->id_agregado = $value;
            return $this;
        }
        public function setFK_unidade($value){
            $this->fk_unidade = $value;
            return $this;
        }
        public function setNome($value){
            $this->nome = $value;
            return $this;
        }
        public function setRG($value){
            $this->rg = $value;
            return $this;
        }
        public function setCelular($value){
            $this->celular = $value;
            return $this;
        }
        public function setEmail($value){
            $this->email = $value;
            return $this;
        }
        public function setTipo($value){
            $this->tipo = $value;
            return $this;
        }
        public function setFoto($value){
            $this->foto = $value;
            return $this;
        }
    }



?>