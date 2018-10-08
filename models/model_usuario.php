<?php
class Usuario {
        private $id_usuario;
        private $fk_unidade;
        private $nome;
        private $tipo;
        private $email;
        private $senha;
        private $bloqueado;
        private $avatar;

        public function getId_usuario(){
            return $this->id_usuario;
        }
        public function getFk_unidade(){
            return $this->fk_unidade;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getSenha(){
            return $this->senha;
        }
        public function getBloqueado(){
            return $this->bloqueado;
        }
        public function getAvatar(){
            return $this->avatar;
        }
    
    
        public function setId_usuario($value){
            $this->id_usuario = $value;
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
        public function setTipo($value){
            $this->tipo = $value;
            return $this;
        }
        public function setEmail($value){
            $this->email = $value;
            return $this;
        }
        public function setSenha($value){
            $this->senha = $value;
            return $this;
        }
        public function setBloqueado($value){
            $this->bloqueado = $value;
            return $this;
        }
        public function setAvatar($value){
            $this->avatar = $value;
            return $this;
        }
    }



?>