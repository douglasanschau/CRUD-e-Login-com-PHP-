<?php

class Client extends PDO {
    
    private $conn;
    private $name;
    private $birthday;
    private $address;
    private $attendant; 
    
    //Conexão com Banco de Dados
	public function __construct(){
		$this->conn = new PDO('mysql:dbname=estudos;host=localhost', 'root', '');
	}

    //Setters
	public function setName($name){
		$this->name = $name;
	}

	public function setBirthday($birthday){
		$this->birthday = $birthday;
	}

	public function setAddress($address){
		$this->address = $address;
	}

	public function setAttendant($attendant){
		$this->attendant = $attendant;
	}


	private function setParams($stm, $name, $birthday, $address, $attendant){
	  	$stm->bindParam(':NAME', $name);
	    $stm->bindParam(':BIRTHDAY', $birthday);
	    $stm->bindParam(':ADDRESS', $address);
	    $stm->bindParam(':ATTENDANT', $attendant);
	    return $stm;
    }


	public function insert() {
		$stm = $this->conn->prepare('INSERT INTO client (name, birthday, address, attendant) VALUES (:NAME, :BIRTHDAY, :ADDRESS, :ATTENDANT)');
        $name = $this->name; $birthday = $this->birthday; $address = $this->address;
        $attendant = $this->attendant;
        $this->setParams($stm, $name, $birthday, $address, $attendant);
        $stm->execute();
    }
    

	public function selectAll() {
		$stm = $this->conn->prepare('SELECT * FROM client');
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
 	}

 	public function selectSome($attendant) {
		$stm = $this->conn->prepare('SELECT * FROM client WHERE attendant = :ATTENDANT');
		$stm->bindParam(':ATTENDANT', $attendant);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
 	}

 	public function selectOne($id) {
		$stm = $this->conn->prepare('SELECT * FROM client WHERE id = :ID');
		$stm->bindParam(':ID', $id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
 	}

    public function update($id) {
	   $stm = $this->conn->prepare('UPDATE client SET name = :NAME, birthday = :BIRTHDAY, address = :ADDRESS WHERE id = :ID');
	   $stm->bindParam(':ID', $id);
	   $name = $this->name; $birthday = $this->birthday; $address = $this->address;
	   $stm->bindParam(':NAME', $name);
	   $stm->bindParam(':BIRTHDAY', $birthday);
	   $stm->bindParam(':ADDRESS', $address);
       $stm->execute();
 	}

 	public function delete($id) {
	   $stm = $this->conn->prepare('DELETE FROM client WHERE id = :ID');
	   $stm->bindParam(':ID', $id);
       $stm->execute();
 	}

}



?>