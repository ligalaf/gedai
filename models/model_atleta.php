<?php
class Atleta {
        private $id_atleta;
        private $fk_unidade;
        private $nome;
        private $ra;
        private $rg;
        private $curso;
        private $email;
        private $celular;
        private $ano;
        private $semestre;
        private $turno;
        private $declaracao;
        private $situacao;


        public function getId_atleta(){
            return $this->id_atleta;
        }
        public function getFk_unidade(){
            return $this->fk_unidade;
        }
        public function getNome(){
            return $this->nome;
        }
        public function getRa(){
            return $this->ra;
        }
        public function getRG(){
            return $this->rg;
        }
        public function getCurso(){
            return $this->curso;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getCelular(){
            return $this->celular;
        }
          public function getAno(){
            return $this->ano;
        }
          public function getSemestre(){
            return $this->semestre;
        }
          public function getTurno(){
            return $this->turno;
        }
          public function getDeclaracao(){
            return $this->declaracao;
        }
        public function getSituacao(){
            return $this->situacao;
        }
    
    
        public function setId_Atleta($value){
            $this->id_atleta = $value;
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
        public function setRa($value){
            $this->ra = $value;
            return $this;
        }
        public function setRG($value){
            $this->rg = $value;
            return $this;
        }
        public function setCurso($value){
            $this->curso = $value;
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
        public function setAno($value){
            $this->ano = $value;
            return $this;
        }
        public function setSemestre($value){
            $this->semestre = $value;
            return $this;
        }
        public function setTurno($value){
            $this->turno = $value;
            return $this;
        }
        public function setDeclaracao($value){
            $this->declaracao = $value;
            return $this;
        }
         public function setSituacao($value){
            $this->situacao = $value;
            return $this;
        }
    }



?>