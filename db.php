<?php

Class User extends PDO {
   //Declaração de Variáveis
	  private $conn;
	  private $name;
    private $email;
    private $password;
    private $adm;

  //Conexão ao banco de dados

  public function __construct(){
  	$this->conn = new PDO('mysql:dbname=estudos;host=localhost', 'root', '');
  }
	
  //Setters
  public function setName($name){
  	$this->name = $name;
  }

  public function setEmail($email){
  	$this->email = $email;
  }

  public function setPassword($password){
  	$this->password = $password;
  }

  public function setAdm($adm){
  	$this->adm = $adm;
  }
  
  //Setando Parâmetros 
  private function setParams($stm, $name, $email, $password, $adm){
  	$stm->bindParam(':NAME', $name);
    $stm->bindParam(':EMAIL', $email);
    $stm->bindParam(':PASSWORD', $password);
    $stm->bindParam(':ADM', $adm);
    return $stm;
  }

  //Método de Criação de um Usuário
  public function insert(){
  	$stm = $this->conn->prepare('INSERT INTO usertype (name, email, auth, adm) VALUES (:NAME, :EMAIL, :PASSWORD, :ADM)');
  	$name = $this->name; $email = $this->email; $password = $this->password; $adm = $this->adm;
  	$this->setParams($stm, $name, $email, $password, $adm);
    $stm->execute();
  }

  //Método de Acesso por Usuário
  public function Access($email, $password){
     $stm = $this->conn->prepare('SELECT * FROM usertype WHERE email = :EMAIL AND auth = :PASSWORD');
     $stm->bindParam(':EMAIL', $email);
     $stm->bindParam(':PASSWORD', $password);
     $stm->execute();
     return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  //
  public function selectAll($email){
     $stm = $this->conn->prepare('SELECT * FROM usertype WHERE email = :EMAIL');
     $stm->bindParam(':EMAIL', $email);
     $stm->execute();
     return $stm->fetchAll(PDO::FETCH_ASSOC);
  }

  public function selectOne($id) {
    $stm = $this->conn->prepare('SELECT * FROM usertype WHERE id = :ID');
    $stm->bindParam(':ID', $id);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }




}


?>