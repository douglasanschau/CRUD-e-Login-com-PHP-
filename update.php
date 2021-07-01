<?php

session_start();

if(!isset($_SESSION['user'])){
	header('Location:login.html');
}
require_once('database/db.php');
require_once('database/dbClient.php');

Class Update { 

	public $id;
	public $name; 
	public $birhtday;
	public $address; 

	public function __construct() {
		$this->id = $_POST['id'];
		$this->name = $_POST['name'];
		$this->birthday = $_POST['birthday'];
		$this->address = $_POST['address'];
	}

	public function setValues() {
		$id = $this->id;
		$name = $this->name;
		$birthday = $this->birthday;
		$address = $this->address;
		$this->update($id, $name, $birthday, $address);
	}

	public function update($id, $name, $birthday, $address) {
	    if(isset($id) && isset($name) && isset($birthday) && isset($address)) {
	         $client = new Client();
			 $client->setName($name);
			 $client->setBirthday($birthday);
			 $client->setAddress($address);
			 $client->update($id);
             $this->redirectUser();
		} else {
			throw new Exception ('Não foi possível atualizar esse cadastro!',500);
		}
	}

	public function redirectUser() {
		$data = new User();
		$user = $data->selectAll($_SESSION['user']);
		 if($user[0]['adm'] == 0){
		 	header('Location:acessoUser.php');
		 } else if ($user[0]['adm'] == 1) {
		 	header('Location:acessoAdm.php');
         }
	}


}

$update = new Update();

   try {
     $update->setValues();
   } catch(Exception $e) {
   	 $error = [
         'message' => $e->getMessage(),
         'code' => $e->getCode(),
       	 'line' => $e->getLine()
   	 ]; 
   	 echo $error['message'];
   }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            


?>